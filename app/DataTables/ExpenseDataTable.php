<?php

namespace App\DataTables;
use App\Models\Address;
use App\Models\Expense;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ExpenseDataTable extends DataTable
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
            ->editColumn('expensestype_id',function(Expense $expense){
                if($expense->expensetype){
                    return $expense->expensetype->name;
                }
            })
             ->addColumn('action', 'admindashboard.expenses.action')
        ->rawColumns([
           'action',
        ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ExpenseType $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Expense $model)
    {
            $expenses = $model->newQuery();
     $country_id = $this->request()->get('country_id');
     $state_id = $this->request()->get('state_id');
     $city_id = $this->request()->get('city_id');
     $zone_id = $this->request()->get('zone_id');
     $datepicker = explode(" - ",$this->request()->get('datepicker1'));
     if($this->request()->get('datepicker1') != null){
     $from = explode(" - ",$this->request()->get('datepicker1'))[0];
   //  $datepicker[1] = explode(" - ",$this->request()->get('datepicker1'))[1];
  // dd( $expenses = $expenses->whereBetween('created_at',[$from,$datepicker[1]])->get());
     }
        // return  Order::with(['seller' => function ($q){
        //   $q->with(['address' => function ($q1){
        //       $q1->where('address.country_id',$this->request()->get('country_id')); 
        // }]);
        // }]);

 
      // dd($from,$datepicker[1]);
        
       if($country_id && $state_id && $city_id && $zone_id ){
             $employee_ids = Address::where('zone_id',$zone_id)->get()->pluck('employee_id');
             $expenses = $expenses->whereIn('employee_id',$employee_ids);
                  if($this->request()->get('datepicker1') != null) {
                 $expenses = $expenses->whereBetween('created_at',[$from,$datepicker[1]]);
             }
         }
        else if($country_id && $state_id && $city_id){
             $employee_ids = Address::where('city_id',$city_id)->get()->pluck('employee_id');
             $expenses = $expenses->whereIn('employee_id',$employee_ids);
                  if($this->request()->get('datepicker1') != null){
                 $expenses = $expenses->whereBetween('created_at',[$from,$datepicker[1]]);
             }
         }else if($country_id && $state_id){
             $employee_ids = Address::where('state_id',$state_id)->get()->pluck('employee_id');
             $expenses = $expenses->whereIn('employee_id',$employee_ids);
                  if($this->request()->get('datepicker1') != null){
                 $expenses = $expenses->whereBetween('created_at',[$from,$datepicker[1]]);
             }
         } 
       else if($country_id){
             $employee_ids = Address::where('country_id',$country_id)->get()->pluck('employee_id');
             $expenses = $expenses->whereIn('employee_id',$employee_ids);
             if($this->request()->get('datepicker1') != null){
                 $expenses = $expenses->whereBetween('created_at',[$from,$datepicker[1]]);
             }
         }   elseif($this->request()->get('datepicker1') != null){
            
            $employee_ids = Address::whereIn('zone_id',auth()->user()->zones->pluck('id')->toArray())->get()->pluck('employee_id');
        
                 $expenses = $expenses->whereBetween('created_at',[$from,$datepicker[1]])->whereIn('employee_id',$employee_ids);
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
              ['data'=>'expensestype_id','title'=>'نوع المصروف','searchable'=>false],
          ['data'=>'paid','title'=>'المبلغ'],
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
        return 'ExpenseType_' . date('YmdHis');
    }
}
