<?php

namespace App\DataTables;

use App\Models\Address;
use App\Models\AllCollection;
use App\Models\Driver;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Services\DataTable;

class CompanyCollectionDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)

            ->addColumn(
                'action',
                'admindashboard.driver_companies.V2.notcollectaction'
            )

            ->rawColumns([
                'action',
            ]);
    }

    /**
     * Get query source of DataTable.
     */
    public function query(Driver $model): Builder
    {
        $request = $this->request();

        $countryId = (int) $request->get('country_id', 0);
        $stateId = (int) $request->get('state_id', 0);
        $cityId = (int) $request->get('city_id', 0);
        $zoneId = (int) $request->get('zone_id', 0);

        /*
         * المناطق المسموح للمستخدم الحالي بالوصول إليها.
         */
        $allowedZoneIds = auth()
            ->user()
            ->zones
            ->pluck('id')
            ->filter()
            ->unique()
            ->values();

        /*
         * الحصول على السائقين الموجودين في المناطق المسموحة.
         */
        $addressQuery = Address::query()
            ->whereIn('zone_id', $allowedZoneIds)
            ->whereNotNull('driver_id');

        /*
         * تطبيق فلتر المكان من الأكثر تحديدًا إلى الأقل.
         */
        if ($zoneId > 0) {
            $addressQuery->where('zone_id', $zoneId);
        } elseif ($cityId > 0) {
            $addressQuery->where('city_id', $cityId);
        } elseif ($stateId > 0) {
            $addressQuery->where('state_id', $stateId);
        } elseif ($countryId > 0) {
            $addressQuery->where('country_id', $countryId);
        }

        $driverIds = $addressQuery
            ->distinct()
            ->pluck('driver_id')
            ->filter()
            ->unique()
            ->values();

        /*
         * جلب سائقي الشركات فقط.
         */
        $companyDrivers = $model
            ->newQuery()
            ->where('is_company', 1)
            ->whereIn('id', $driverIds)
            ->get([
                'id',
                'name',
                'phone',
                'created_at',
            ]);

        $resultDriverIds = [];

        foreach ($companyDrivers as $driver) {
            if ($this->driverHasPendingCollection($driver)) {
                $resultDriverIds[] = $driver->id;
            }
        }

        /*
         * يجب أن ترجع query() Builder وليس Collection.
         */
        return $model
            ->newQuery()
            ->where('is_company', 1)
            ->whereIn(
                'id',
                array_values(array_unique($resultDriverIds))
            );
    }

    /**
     * Check whether the driver has any pending company collection.
     */
    private function driverHasPendingCollection(Driver $driver): bool
    {
        if (!$driver->created_at) {
            return false;
        }

        /*
         * أول شهر يتم فحصه هو شهر إنشاء السائق.
         */
        $startDate = Carbon::parse($driver->created_at)
            ->startOfMonth();

        /*
         * آخر شهر يتم فحصه هو الشهر السابق.
         */
        $endDate = Carbon::now()
            ->subMonthNoOverflow()
            ->startOfMonth();

        /*
         * لو السائق تمت إضافته هذا الشهر،
         * فلا يوجد شهر سابق لفحصه.
         *
         * هذا يمنع CarbonPeriod من استقبال فترة عكسية.
         */
        if ($startDate->greaterThan($endDate)) {
            return false;
        }

        $period = CarbonPeriod::create(
            $startDate,
            '1 month',
            $endDate
        );

        foreach ($period as $month) {
            $monthDate = $month->format('Y-m');

            /*
             * التحقق هل تم إنشاء تحصيل لهذا الشهر.
             */
            $collection = AllCollection::query()
                ->where('driver_id', $driver->id)
                ->where('month_date', $monthDate)
                ->first([
                    'id',
                    'money_left',
                ]);

            /*
             * يوجد تحصيل ولكن ما زال عليه مبلغ متبقٍ.
             */
            if ($collection) {
                if ((float) $collection->money_left !== 0.0) {
                    return true;
                }

                /*
                 * هذا الشهر تم تحصيله بالكامل،
                 * لذلك ننتقل إلى الشهر التالي.
                 */
                continue;
            }

            /*
             * لا يوجد تحصيل لهذا الشهر:
             * نتحقق هل توجد طلبات شركات مكتملة في الشهر.
             *
             * whereYear يحتاج رقم السنة.
             * whereMonth يحتاج رقم الشهر.
             */
            $hasCompanyOrders = $driver
                ->company_done_orders()
                ->whereYear(
                    'orders.created_at',
                    $month->year
                )
                ->whereMonth(
                    'orders.created_at',
                    $month->month
                )
                ->exists();

            if ($hasCompanyOrders) {
                return true;
            }
        }

        return false;
    }

    /**
     * Optional method if you want to use HTML builder.
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'dom' => 'Blfrtip',

                'order' => [
                    [0, 'desc'],
                ],

                'processing' => true,
                'serverSide' => true,

                'lengthMenu' => [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'كل السجلات'],
                ],

                'buttons' => [
                    'export',
                ],

                'language' => [
                    'processing' => 'جاري التحميل...',
                    'emptyTable' => 'لا توجد بيانات لعرضها',
                    'zeroRecords' => 'لا توجد نتائج مطابقة',
                    'search' => 'بحث:',
                    'lengthMenu' => 'عرض _MENU_ سجل',
                    'info' => 'عرض _START_ إلى _END_ من أصل _TOTAL_ سجل',
                    'infoEmpty' => 'لا توجد سجلات',
                    'paginate' => [
                        'first' => 'الأول',
                        'last' => 'الأخير',
                        'next' => 'التالي',
                        'previous' => 'السابق',
                    ],
                ],
            ]);
    }

    /**
     * Get columns.
     */
    protected function getColumns(): array
    {
        return [
            [
                'data' => 'name',
                'name' => 'name',
                'title' => 'الاسم',
            ],
            [
                'data' => 'phone',
                'name' => 'phone',
                'title' => 'الهاتف',
            ],
            [
                'data' => 'action',
                'name' => 'action',
                'title' => 'الإعدادات',
                'printable' => false,
                'exportable' => false,
                'orderable' => false,
                'searchable' => false,
            ],
        ];
    }

    /**
     * Get filename for export.
     */
    protected function filename(): string
    {
        return 'CompanyCollections_' . date('YmdHis');
    }
}
