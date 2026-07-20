<?php

namespace App\DataTables;

use App\Models\Major;
use App\Models\Order;
use Carbon\Carbon;
use Yajra\DataTables\Services\DataTable;

class MajorMoneyDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()->eloquent($query)
            ->addColumn('order_number', function (Major $major) {
                return $this->getMajorOrdersQuery($major)->count();
            })
            ->addColumn('total', function (Major $major) {
                return $this->getMajorOrdersQuery($major)->sum('priceafterdiscount');
            })
            ->addColumn('money_driver_commission', function (Major $major) {
                return $this->getMajorOrdersQuery($major)->get()->sum(function ($order) {
                    return (float) ($order->money_driver_commission ?? 0);
                });
            });
    }

    private function getMajorOrdersQuery(Major $major)
    {
        $query = Order::query()
            ->where('status', 3)
            ->whereHas('seller', function ($sellerQuery) use ($major) {
                $sellerQuery->where('major_id', $major->id);
            });

        $dateRange = $this->getDateRange();

        if ($dateRange !== null) {
            $this->applyCompletionDateFilter($query, $dateRange);
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

    private function applyCompletionDateFilter($query, array $dateRange): void
    {
        $query->where(function ($dateQuery) use ($dateRange) {
            $dateQuery
                ->whereBetween('delivery_time', $dateRange)
                ->orWhere(function ($legacyQuery) use ($dateRange) {
                    $legacyQuery
                        ->whereNull('delivery_time')
                        ->whereBetween('created_at', $dateRange);
                });
        });
    }

    public function query(Major $model)
    {
        $query = $model->newQuery();
        $dateRange = $this->getDateRange();

        if ($dateRange !== null) {
            $query->whereHas('sellers.orders', function ($ordersQuery) use ($dateRange) {
                $ordersQuery->where('status', 3);
                $this->applyCompletionDateFilter($ordersQuery, $dateRange);
            });
        }

        return $query;
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
            ['data' => 'title', 'name' => 'title', 'title' => 'التخصص'],
            ['data' => 'order_number', 'name' => 'order_number', 'title' => 'عدد الطلبات', 'searchable' => false, 'orderable' => false],
            ['data' => 'total', 'name' => 'total', 'title' => 'المبلغ كامل', 'searchable' => false, 'orderable' => false],
            ['data' => 'money_driver_commission', 'name' => 'money_driver_commission', 'title' => 'النسبة الطيار', 'searchable' => false, 'orderable' => false],
        ];
    }

    protected function filename()
    {
        return 'Major_' . date('YmdHis');
    }
}
