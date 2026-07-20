<?php

namespace App\DataTables;

use App\Models\Zone;
use Carbon\Carbon;
use Yajra\DataTables\Services\DataTable;

class ZoneOrderDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()->eloquent($query)
            ->addColumn('order_number', function (Zone $zone) {
                return $this->getZoneOrdersQuery($zone)->count();
            })
            ->addColumn('total', function (Zone $zone) {
                return $this->getZoneOrdersQuery($zone)->sum('priceafterdiscount');
            })
            ->addColumn('seller_commission', function (Zone $zone) {
                return $this->getZoneOrdersQuery($zone)->get()->sum(function ($order) {
                    return (float) ($order->money_seller_commission ?? 0);
                });
            });
    }

    private function getZoneOrdersQuery(Zone $zone)
    {
        $query = $zone->done_orders();
        $dateRange = $this->getDateRange();

        if ($dateRange !== null) {
            [$from, $to] = $dateRange;
            $query->whereBetween('created_at', [$from, $to]);
        }

        return $query;
    }

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
            return [
                Carbon::createFromFormat('Y-m-d', trim($dates[0]))->startOfDay(),
                Carbon::createFromFormat('Y-m-d', trim($dates[1]))->endOfDay(),
            ];
        } catch (\Throwable $exception) {
            return null;
        }
    }

    public function query(Zone $model)
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
                'order' => [[0, 'desc']],
                'lengthMenu' => [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'كل السجلات'],
                ],
                'buttons' => ['export'],
            ]);
    }

    protected function getColumns()
    {
        return [
            ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
            ['data' => 'name', 'name' => 'name', 'title' => 'اسم المنطقة'],
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
        return 'Zone_Order_' . date('YmdHis');
    }
}
