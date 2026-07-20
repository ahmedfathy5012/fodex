<?php

namespace App\DataTables;

use App\Models\BoxDeliver;
use Yajra\DataTables\Services\DataTable;

class BoxDeliverDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('driver_name', function (BoxDeliver $boxDeliver) {
                return $boxDeliver->driver_name ?: '-';
            })
            ->editColumn('box_title', function (BoxDeliver $boxDeliver) {
                return $boxDeliver->box_title ?: '-';
            })
            ->editColumn('created_at', function (BoxDeliver $boxDeliver) {
                if (!$boxDeliver->created_at) {
                    return '-';
                }

                return $boxDeliver->created_at
                    ->timezone('Africa/Cairo')
                    ->format('Y-m-d h:i A');
            });
    }

    public function query(BoxDeliver $model)
    {
        return $model->newQuery()
            ->leftJoin('drivers', 'drivers.id', '=', 'box_deliver.driver_id')
            ->leftJoin('boxs', 'boxs.id', '=', 'box_deliver.box_id')
            ->select([
                'box_deliver.*',
                'drivers.name as driver_name',
                'boxs.title as box_title',
            ])
            ->orderBy('box_deliver.id', 'asc');
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'dom' => 'Blfrtip',

                'order' => [[0, 'asc']],

                'lengthMenu' => [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 'all record']
                ],

                'buttons' => ['export'],
            ]);
    }

    protected function getColumns()
    {
        return [
            [
                'data' => 'id',
                'name' => 'box_deliver.id',
                'title' => 'ID',
                'visible' => false,
                'searchable' => false,
                'orderable' => true,
            ],

            [
                'data' => 'driver_name',
                'name' => 'drivers.name',
                'title' => 'السائق',
            ],

            [
                'data' => 'box_title',
                'name' => 'boxs.title',
                'title' => 'الصندوق',
            ],

            [
                'data' => 'notes',
                'name' => 'box_deliver.notes',
                'title' => 'ملاحظات',
            ],

            [
                'data' => 'created_at',
                'name' => 'box_deliver.created_at',
                'title' => 'الوقت',
            ],
        ];
    }

    protected function filename()
    {
        return 'BoxDeliver_' . date('YmdHis');
    }
}
