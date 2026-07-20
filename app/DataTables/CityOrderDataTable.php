<?php

namespace App\DataTables;

use App\Models\City;
use Carbon\Carbon;
use Yajra\DataTables\Services\DataTable;

class CityOrderDataTable extends DataTable
{
    /**
     * تجهيز بيانات الجدول.
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('order_number', function (City $city) {
                return $this->getCityOrdersQuery($city)->count();
            })
            ->addColumn('total', function (City $city) {
                return $this->getCityOrdersQuery($city)
                    ->sum('priceafterdiscount');
            })
            ->addColumn('seller_commission', function (City $city) {
                $orders = $this->getCityOrdersQuery($city)->get();

                return $orders->sum(function ($order) {
                    return (float) ($order->money_seller_commission ?? 0);
                });
            });
    }

    /**
     * طلبات المدينة المكتملة مع تطبيق نطاق التاريخ.
     */
    private function getCityOrdersQuery(City $city)
    {
        $query = $city->done_orders();
        $dateRange = $this->getDateRange();

        if ($dateRange !== null) {
            [$from, $to] = $dateRange;

            $query->whereBetween('created_at', [$from, $to]);
        }

        return $query;
    }

    /**
     * استخراج فترة التاريخ المرسلة من واجهة التقرير.
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
            $from = Carbon::createFromFormat('Y-m-d', trim($dates[0]))->startOfDay();
            $to = Carbon::createFromFormat('Y-m-d', trim($dates[1]))->endOfDay();

            return [$from, $to];
        } catch (\Throwable $exception) {
            return null;
        }
    }

    /**
     * إظهار المدن التي لديها طلبات داخل الفترة المحددة فقط.
     */
    public function query(City $model)
    {
        $query = $model->newQuery();
        $dateRange = $this->getDateRange();

        if ($dateRange !== null) {
            [$from, $to] = $dateRange;

            $query->whereHas('done_orders', function ($ordersQuery) use ($from, $to) {
                $ordersQuery->whereBetween('created_at', [$from, $to]);
            });
        }

        return $query->orderByDesc('id');
    }

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
                'title' => 'اسم المدينة',
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

    protected function filename()
    {
        return 'City_Order_' . date('YmdHis');
    }
}
