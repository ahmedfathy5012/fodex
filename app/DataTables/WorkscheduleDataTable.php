<?php

namespace App\DataTables;

use App\Models\Workschedule;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon;
class WorkscheduleDataTable extends DataTable
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
            //->
            // editColumn('seller.name',function(Workschedule $Workschedule){
            //     if($Workschedule->seller){
            //         return $Workschedule->seller->name;
            //     }
         //   })
            ->editColumn('work_from',function(Workschedule $Workschedule){
                
                    return Carbon::parse($Workschedule->work_from)->format(' a g:i ');
               
            }) ->editColumn('work_to',function(Workschedule $Workschedule){
                
                    return Carbon::parse($Workschedule->work_to)->format(' a g:i ');
               
            }) 
            // ->editColumn('day_id',function(Workschedule $Workschedule){
            //     if($Workschedule->day){
            //         return $Workschedule->day->day_ar;
            //     }
            // })
            ->addColumn('action', 'admindashboard.workschedules.action')

            ->rawColumns([
           'action',
        ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Workschedule $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Workschedule $model)
    {
       return $model->newQuery()->with("seller")->with("day")->select('workschedules.*');
      //  dd( $model->newQuery()->with("seller")->select('*');
    
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
           ['data'=>'seller.name','title'=>'البائع'],
              ['data'=>'day.day_ar','title'=>'اليوم '],
        ['data'=>'work_from','title'=>'من '],
               ['data'=>'work_to','title'=>'الى '],
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
        return 'Workschedule_' . date('YmdHis');
    }
}
