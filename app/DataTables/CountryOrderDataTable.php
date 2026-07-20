<?php

namespace App\DataTables;

use App\Models\Country;
use Carbon\Carbon;
use Yajra\DataTables\Services\DataTable;

class CountryOrderDataTable extends DataTable
{
    /**
     * Build DataTable class.
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)

            ->addColumn('order_number', function (Country $country) {
                return $this->getCountryOrdersQuery($country)->count();
            })

            ->addColumn('total', function (Country $country) {
                return $this->getCountryOrdersQuery($country)
                    ->sum('priceafterdiscount');
            })

            ->addColumn('seller_commission', function (Country $country) {
                $orders = $this->getCountryOrdersQuery($country)->get();

                return $orders->sum(function ($order) {
                    return (float) ($order->money_seller_commission ?? 0);
                });
            })

            ->rawColumns([
                'order_number',
                'total',
                'seller_commission',
            ]);
    }

    /**
     * Get filtered country orders.
     */
    private function getCountryOrdersQuery(Country $country)
    {
        $query = $country->done_orders();
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
            $from = Carbon::createFromFormat('Y-m-d', trim($dates[0]))->startOfDay();
            $to = Carbon::createFromFormat('Y-m-d', trim($dates[1]))->endOfDay();

            return [$from, $to];
        } catch (\Throwable $exception) {
            return null;
        }
    }

    /**
     * Get query source of DataTable.
     */
    public function query(Country $model)
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

    /**
     * Optional method if you want to use HTML builder.
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('dataTableBuilder')
            ->columns($this->getColumns())
            ->minifiedAjax()

            ->parameters([
                'dom' => 'Blfrtip',
                'order' => [[0, 'desc']],
                'processing' => true,
                'serverSide' => true,

                'lengthMenu' => [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'كل السجلات'],
                ],

                'buttons' => ['export'],
            ]);
    }
    /**
     * Get columns.
     */
    protected function getColumns()
    {
        return [
            [
                'data' => 'id',
                'name' => 'id',
                'title' => 'ID',
            ],
            [
                'data' => 'name',
                'name' => 'name',
                'title' => 'اسم الدولة',
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
     * Get filename for export.
     */
    protected function filename()
    {
        return 'Country_Order_' . date('YmdHis');
    }
}
