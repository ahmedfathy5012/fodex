<?php

namespace App\DataTables;

use App\Models\Employee;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\Address;
use Illuminate\Http\Request;

class EmployeeDataTable extends DataTable
{
    /*
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query,Request $request)
    {
        return datatables()
            ->eloquent($query)->filter(function ($query) use ($request) {
            $query->when($request->country_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("country_id",$request->country_id);
                    });
                });
                $query->when($request->state_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("state_id",$request->state_id);
                    });
                });
                $query->when($request->city_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("city_id",$request->city_id);
                    });
                });
                $query->when($request->zone_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("zone_id",$request->zone_id);
                    });
                });
              
           
        })
           ->addColumn('action', 'admindashboard.employees.action')
->editColumn('name',function(Employee $employee){
          
                    return '<a href="'.route("employee.show",$employee->id).'">'.$employee->name.'</a>';
                
            })
            ->rawColumns([
           'action',
           'name'
        ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Employee $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Employee $model)
    {
         $employees = $model->newQuery()->orderBy("id","desc");
           if(auth()->user()->type == 1 ){
           $employees = $employees->whereHas('address', function($query) {
         $query->whereIn("country_id",auth()->user()->countries->pluck("id")->toArray());
            });
         }
        else if(auth()->user()->type == 2 ){
           $employees = $employees->whereHas('address', function($query) {
         $query->whereIn("state_id",auth()->user()->states->pluck("id")->toArray());
            });
         }else if(auth()->user()->type == 3 ){
           $employees = $employees->whereHas('address', function($query) {
         $query->whereIn("city_id",auth()->user()->cities->pluck("id")->toArray());
            });
         } 
         else if(auth()->user()->type == 4 ){
           $employees = $employees->whereHas('address', function($query) {
         $query->whereIn("zone_id",auth()->user()->zones->pluck("id")->toArray());
            });
         }else{
             $employees = $employees->where("id" ,"<",0);
         }
         return $employees;
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
        ['data'=>'name','title'=>'الاسم'],
              ['data'=>'phone','title'=>'الهاتف'],
            //   ['data'=>'qualification','title'=>'المؤهل'],
            //          ['data'=>'birthday','title'=>'تاريخ الميلاد'],
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
        return 'Employee_' . date('YmdHis');
    }
}
