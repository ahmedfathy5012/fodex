<?php

namespace App\DataTables;

use App\Models\Employee;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\Address;
class NotcollectemployeeDataTable extends DataTable
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
           ->addColumn('action', 'admindashboard.employees.notcollectaction')
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
        $ress =  Employee::all();
   $res_ids = [];
   
    foreach($ress as $res){
      //  dd($res->id);
                      $date2 = \Carbon\Carbon::now()->subMonth()->format('Y-m-d');
         $date1 = \Carbon\Carbon::parse($res->created_at)->format('Y-m-d');
    $period = \Carbon\CarbonPeriod::create($date1, '1 month', $date2);
$aa = [];
    foreach ($period as $dt) {
      
        $aa[]= $dt->format("Y-m");
    } 
    foreach($aa as $a){
    
    $date3 = \Carbon\Carbon::parse($a)->format('Y-m');
        $collect = \App\Models\ExpenseEmployee::where('employee_id',$res->id)->where('month_date',$a)
        ->first();
    if($collect){
        
  if($collect->money_left == 0){
        
    }else{
        $res_ids[]= $res->id;
    }
           
       
    }
    else{
    
    
    //   $orders = $res->orders()->whereYear('orders.created_at',\Carbon\Carbon::parse($a))
    //   ->whereMonth('orders.created_at',\Carbon\Carbon::parse($a))->get();
    //   ->whereMonth('orders.created_at',$date3)->get();

    //   ->where('order_status_id',7)->whereYear('orders.created_at',$date3)
    //   ->whereMonth('orders.created_at',$date3)->get();
       $contract = \App\Models\Employeescontract::where('employee_id',$res->id)->where("active",1)->latest()->first();
        $discounts =  array_sum(\App\Models\Discount::where('employee_id',$res->id)->whereYear('created_at',\Carbon\Carbon::parse($a))
      ->whereMonth('created_at',\Carbon\Carbon::parse($a))->get()->pluck('value')->toArray());
       $awards =  array_sum(\App\Models\Award::where('employee_id',$res->id)->whereYear('created_at',\Carbon\Carbon::parse($a))
      ->whereMonth('created_at',\Carbon\Carbon::parse($a))->get()->pluck('value')->toArray());
       
if($contract == null){
    
}
else{
$res_ids[] = $res->id;
}
}
}}

         $country_id = $this->request()->get('country_id');
     $state_id = $this->request()->get('state_id');
     $city_id = $this->request()->get('city_id');
     $zone_id = $this->request()->get('zone_id');
        $employees = $model->newQuery();
 if($country_id){
             $employee_ids = Address::where('country_id',$country_id)->get()->pluck('employee_id');
             $employees = $employees->whereIn('id',$employee_ids);
      
         } if($country_id && $state_id){
             $employee_ids = Address::where('state_id',$state_id)->get()->pluck('employee_id');
            $employees = $employees->whereIn('id',$employee_ids);
        
         } if($country_id && $state_id && $city_id){
             $employee_ids = Address::where('city_id',$city_id)->get()->pluck('employee_id');
          $employees = $employees->whereIn('id',$employee_ids);
             
         } if($country_id && $state_id && $city_id && $zone_id){
             $employee_ids = Address::where('zone_id',$zone_id)->get()->pluck('employee_id');
           $employees = $employees->whereIn('id',$employee_ids);
         }
            return $employees->whereIn('id',$res_ids);
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
