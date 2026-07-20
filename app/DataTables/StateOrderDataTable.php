<?php

namespace App\DataTables;

use App\Models\State;
use Carbon\Carbon;
use Yajra\DataTables\Services\DataTable;

class StateOrderDataTable extends DataTable
{
    /**
     * تجهيز بيانات الجدول.
     *
     * @param mixed $query
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)

            /*
             * عدد الطلبات الخاصة بالمحافظة.
             */
            ->addColumn('order_number', function (State $state) {
                return $this->getStateOrdersQuery($state)->count();
            })

            /*
             * إجمالي أسعار الطلبات.
             */
            ->addColumn('total', function (State $state) {
                return $this->getStateOrdersQuery($state)
                    ->sum('priceafterdiscount');
            })

            /*
             * إجمالي العمولة.
             *
             * money_seller_commission ليست عمودًا في قاعدة البيانات،
             * لذلك نحضر الطلبات أولًا ثم نحسب قيمة الـ Accessor.
             */
            ->addColumn('seller_commission', function (State $state) {
                $orders = $this->getStateOrdersQuery($state)->get();

                return $orders->sum(function ($order) {
                    return (float) ($order->money_seller_commission ?? 0);
                });
            });
    }

    /**
     * Query طلبات المحافظة مع تطبيق فلتر التاريخ.
     */
    private function getStateOrdersQuery(State $state)
    {
        $query = $state->done_orders();

        $dateRange = $this->getDateRange();

        if ($dateRange !== null) {
            [$from, $to] = $dateRange;

            $query->whereBetween('created_at', [$from, $to]);
        }

        return $query;
    }

    /**
     * استخراج فترة التاريخ من Request.
     */
    private function getDateRange(): ?array
    {
        $datepicker = $this->request()->input('datepicker1');

        if (empty($datepicker)) {
            return null;
        }

        $dates = preg_split('/\s+-\s+/', trim($datepicker));

        if (!is_array($dates) || count($dates) !== 2) {
            return null;
        }

        try {
            $from = Carbon::createFromFormat(
                'Y-m-d',
                trim($dates[0])
            )->startOfDay();

            $to = Carbon::createFromFormat(
                'Y-m-d',
                trim($dates[1])
            )->endOfDay();

            return [$from, $to];
        } catch (\Throwable $exception) {
            return null;
        }
    }

    /**
     * Query المحافظات.
     *
     * عند اختيار تاريخ سيتم إظهار المحافظات
     * التي لديها طلبات داخل الفترة المحددة فقط.
     *
     * @param State $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(State $model)
    {
        $query = $model->newQuery();

        $dateRange = $this->getDateRange();

        if ($dateRange !== null) {
            [$from, $to] = $dateRange;

            $query->whereHas(
                'done_orders',
                function ($ordersQuery) use ($from, $to) {
                    $ordersQuery->whereBetween(
                        'created_at',
                        [$from, $to]
                    );
                }
            );
        }

        return $query->orderByDesc('id');
    }

    /**
     * إعدادات DataTable.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('dataTableBuilder')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'dom' => 'Blfrtip',

                'processing' => true,
                'serverSide' => true,

                /*
                 * الترتيب الافتراضي باستخدام ID.
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
            ]);
    }

    /**
     * أعمدة الجدول.
     */
    protected function getColumns()
    {
        return [
            [
                'data' => 'id',
                'name' => 'id',
                'title' => 'ID',
                'searchable' => true,
                'orderable' => true,
            ],

            [
                'data' => 'name',
                'name' => 'name',
                'title' => 'اسم المحافظة',
                'searchable' => true,
                'orderable' => true,
            ],

            [
                'data' => 'order_number',
                'name' => 'order_number',
                'title' => 'عدد الطلبات',
                'searchable' => false,
                'orderable' => false,
            ],

            [
                'data' => 'total',
                'name' => 'total',
                'title' => 'المبلغ كامل',
                'searchable' => false,
                'orderable' => false,
            ],

            [
                'data' => 'seller_commission',
                'name' => 'seller_commission',
                'title' => 'النسبة من المطعم',
                'searchable' => false,
                'orderable' => false,
            ],
        ];
    }

    /**
     * اسم ملف التصدير.
     */
    protected function filename()
    {
        return 'State_Order_' . date('YmdHis');
    }
}
