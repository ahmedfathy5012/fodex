<?php

namespace App\DataTables;

use App\Models\ExpenseDriver;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ExpenseDriverDataTable extends DataTable
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
            ->editColumn('driver_id',function(ExpenseDriver $ExpenseDriver){
                if($ExpenseDriver->driver){
                    return $ExpenseDriver->driver->name;
                }
            })
            ->addColumn('action', 'admindashboard.expensedriver.action')

            ->rawColumns([
           'action',
        ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ExpenseDriver $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ExpenseDriver $model)
    {
        $from = $this->request()->get('from');
          $to = $this->request()->get('to');
             $expenses = $model->newQuery();
          if($from && $to){
              $expenses = $expenses->whereBetween('created_at',[$from,$to]);
          }
          return $expenses;
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
          ['data'=>'driver_id','title'=>'السائق','searchable'=>false],
               ['data'=>'value','title'=>'القيمه'],
            ['data'=>'action','title'=>'الاعدادات','printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ExpenseDriver_' . date('YmdHis');
    }
}
