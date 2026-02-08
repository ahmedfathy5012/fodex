<?php

namespace App\DataTables;

use App\Models\Discount;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DiscountDataTable extends DataTable
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
            ->eloquent($query);
          //  ->addColumn('action', 'discount.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Discount $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Discount $model)
    {
        return $model->newQuery()->where('employee_id',$this->id);
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
            'order' => [0, 'desc'],
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
        ['data'=>'value','title'=>'الاسم'],
        ['data'=>'reason','title'=>'السبب'],
          ['data'=>'created_at','title'=>'الوقت'], 
        ];
    }


    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Discount_' . date('YmdHis');
    }
}
