<?php

namespace App\DataTables;

use App\Models\SellerEmployee;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\Address;
class SellerEmployeeDataTable extends DataTable
{
    /*
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
           ->addColumn('action', 'admindashboard.employees.selleremployees.action')
// ->editColumn('name',function(Employee $employee){
          
//                     return '<a href="'.route("employee.show",$employee->id).'">'.$employee->name.'</a>';
                
//             })
            ->rawColumns([
           'action',
           //'name'
        ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Employee $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SellerEmployee $model)
    {
         $country_id = $this->request()->get('country_id');
     $state_id = $this->request()->get('state_id');
     $city_id = $this->request()->get('city_id');
     $zone_id = $this->request()->get('zone_id');
        $employees = $model->newQuery()->where("seller_id",$this->id);
//  if($country_id){
//              $employee_ids = Address::where('country_id',$country_id)->get()->pluck('employee_id');
//              $employees = $employees->whereIn('id',$employee_ids);
      
//          } if($country_id && $state_id){
//              $employee_ids = Address::where('state_id',$state_id)->get()->pluck('employee_id');
//             $employees = $employees->whereIn('id',$employee_ids);
        
//          } if($country_id && $state_id && $city_id){
//              $employee_ids = Address::where('city_id',$city_id)->get()->pluck('employee_id');
//           $employees = $employees->whereIn('id',$employee_ids);
             
//          } if($country_id && $state_id && $city_id && $zone_id){
//              $employee_ids = Address::where('zone_id',$zone_id)->get()->pluck('employee_id');
//           $employees = $employees->whereIn('id',$employee_ids);
//          }
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
