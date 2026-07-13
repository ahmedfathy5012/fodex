<?php

namespace App\DataTables;

use App\Models\BoxTake;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BoxTakeDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('driver_name', function (BoxTake $boxTake) {
                return $boxTake->driver_name ?: '-';
            })
            ->editColumn('box_title', function (BoxTake $boxTake) {
                return $boxTake->box_title ?: '-';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\BoxStatus $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(BoxTake $model)
    {
        return $model->newQuery()
            ->leftJoin('drivers', 'drivers.id', '=', 'box_takes.driver_id')
            ->leftJoin('boxs', 'boxs.id', '=', 'box_takes.box_id')
            ->select([
                'box_takes.*',
                'drivers.name as driver_name',
                'boxs.title as box_title',
            ]);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
          return $this->builder()
        ->columns($this->getColumns())
        ->minifiedAjax()
        ->parameters([
            'dom' => 'Blfrtip',
            'order' => [[3, 'desc']],
            'lengthMenu' => [
                [10,25,50,100,-1],[10,25,50,'all record']
            ],
       'buttons'      => ['export'],
   ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['data' => 'driver_name', 'name' => 'drivers.name', 'title' => 'السائق'],
            ['data' => 'box_title', 'name' => 'boxs.title', 'title' => 'الصندوق'],
            ['data' => 'notes', 'title' => 'ملاحظات'],
            ['data' => 'created_at', 'title' => 'الوقت'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'BoxStatus_' . date('YmdHis');
    }
}
