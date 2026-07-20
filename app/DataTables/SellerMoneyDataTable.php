<?php

namespace App\DataTables;

use App\Models\Seller;
use Carbon\Carbon;
use Yajra\DataTables\Services\DataTable;

class SellerMoneyDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()->eloquent($query)
            ->addColumn('order_number', function (Seller $seller) {
                return $this->getSellerOrdersQuery($seller)->count();
            })
            ->addColumn('total', function (Seller $seller) {
                return $this->getSellerOrdersQuery($seller)->sum('priceafterdiscount');
            })
            ->addColumn('seller_commission', function (Seller $seller) {
                return $this->getSellerOrdersQuery($seller)->get()->sum(function ($order) {
                    return (float) ($order->money_seller_commission ?? 0);
                });
            });
    }

    private function getSellerOrdersQuery(Seller $seller)
    {
        $query = $seller->orders()->where('status', 3);
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

    public function query(Seller $model)
    {
        $query = $model->newQuery();
        $majorId = (int) $this->request()->input('major_id', 0);
        $dateRange = $this->getDateRange();

        if ($majorId !== 0) {
            $query->where('major_id', $majorId);
        }

        if ($dateRange !== null) {
            $query->whereHas('orders', function ($ordersQuery) use ($dateRange) {
                $ordersQuery->where('status', 3);
                $this->applyCompletionDateFilter($ordersQuery, $dateRange);
            });
        }

        return $query;
    }

    /**
     * المستحقات تُنسب إلى تاريخ التسليم، مع دعم الطلبات القديمة
     * التي لم يكن يُحفظ لها delivery_time.
     */
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
            ['data' => 'name', 'name' => 'name', 'title' => 'المطعم'],
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
        return 'Seller_' . date('YmdHis');
    }
}
