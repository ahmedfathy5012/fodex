<?php

namespace App\DataTables;

use App\Models\Address;
use App\Models\Income;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Services\DataTable;

class IncomeDataTable extends DataTable
{
    /**
     * Determine the action partial according to the environment.
     */
    private function actionView(): string
    {
        return app()->environment('production')
            ? 'admindashboard.incomes.action'
            : 'admindashboard.incomes.V2.action';
    }

    /**
     * Build DataTable class.
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)

            ->editColumn('collectiontype_id', function (Income $income) {
                return $income->type?->name ?? '-';
            })

            ->editColumn('value', function (Income $income) {
                return number_format((float) $income->value, 2);
            })

            ->addColumn('action', $this->actionView())

            ->rawColumns([
                'action',
            ]);
    }

    /**
     * Get query source of DataTable.
     */
    public function query(Income $model): Builder
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
            ->values();

        /*
         * البحث عن الموظفين التابعين للمناطق المسموحة.
         */
        $addressQuery = Address::query()
            ->whereIn('zone_id', $allowedZoneIds)
            ->whereNotNull('employee_id');

        /*
         * تطبيق فلتر الموقع من الأكثر تحديدًا إلى الأقل.
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

        $employeeIds = $addressQuery
            ->distinct()
            ->pluck('employee_id');

        $hasLocationFilter =
            $countryId > 0 ||
            $stateId > 0 ||
            $cityId > 0 ||
            $zoneId > 0;

        /*
         * الإيراد الجديد يتم تسجيله باستخدام auth()->id().
         *
         * لذلك عند عدم اختيار فلتر موقع نضيف المستخدم الحالي
         * حتى تظهر الإيرادات التي قام بإضافتها.
         */
        if (!$hasLocationFilter) {
            $employeeIds->push(auth()->id());
        }

        $employeeIds = $employeeIds
            ->filter()
            ->unique()
            ->values();

        $query = $model
            ->newQuery()
            ->with('type')
            ->whereIn('employee_id', $employeeIds);

        /*
         * فلتر التاريخ.
         */
        if ($request->filled('datepicker1')) {
            $dates = explode(
                ' - ',
                $request->get('datepicker1'),
                2
            );

            if (count($dates) === 2) {
                try {
                    $from = Carbon::createFromFormat(
                        'Y-m-d',
                        trim($dates[0])
                    )->startOfDay();

                    $to = Carbon::createFromFormat(
                        'Y-m-d',
                        trim($dates[1])
                    )->endOfDay();

                    $query->whereBetween('created_at', [
                        $from,
                        $to,
                    ]);
                } catch (\Throwable $exception) {
                    /*
                     * في حالة إرسال تاريخ غير صحيح
                     * يتم تجاهل فلتر التاريخ بدل إيقاف الجدول.
                     */
                }
            }
        }

        /*
         * أحدث إيراد يظهر أولًا.
         */
        return $query->orderByDesc('id');
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

                /*
                 * العمود رقم صفر هو id المخفي.
                 */
                'order' => [
                    [0, 'desc'],
                ],

                'lengthMenu' => [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'كل السجلات'],
                ],

                'buttons' => [
                    'export',
                ],

                'language' => [
                    'emptyTable' => 'لا توجد إيرادات لعرضها',
                    'zeroRecords' => 'لا توجد نتائج مطابقة',
                    'processing' => 'جاري التحميل...',
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
     * Get DataTable columns.
     */
    protected function getColumns(): array
    {
        return [
            [
                'data' => 'id',
                'name' => 'id',
                'title' => '#',
                'visible' => false,
                'searchable' => false,
            ],
            [
                'data' => 'collectiontype_id',
                'name' => 'collectiontype_id',
                'title' => 'نوع الإيراد',
                'searchable' => false,
            ],
            [
                'data' => 'value',
                'name' => 'value',
                'title' => 'المبلغ',
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
        return 'Incomes_' . date('YmdHis');
    }
}
