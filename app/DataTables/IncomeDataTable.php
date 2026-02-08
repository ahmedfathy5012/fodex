<?php

namespace App\DataTables;
use App\Models\Address;
use App\Models\Income;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class IncomeDataTable extends DataTable
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
            ->editColumn('collectiontype_id',function(Income $income){
                if($income->type){
                    return $income->type->name;
                }
            })
             ->addColumn('action', 'admindashboard.incomes.action')
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
    public function query(Income $model)
    {
          $employee_ids = Address::whereIn('zone_id',auth()->user()->zones->pluck('id')->toArray())->get()->pluck('employee_id');
                $incomes = $model->newQuery()->whereIn('employee_id',$employee_ids);;
     $country_id = $this->request()->get('country_id');
     $state_id = $this->request()->get('state_id');
     $city_id = $this->request()->get('city_id');
     $zone_id = $this->request()->get('zone_id');
     $datepicker = explode(" - ",$this->request()->get('datepicker1'));
     if($this->request()->get('datepicker1') != null){
     $from = explode(" - ",$this->request()->get('datepicker1'))[0];
    
   //  $datepicker[1] = explode(" - ",$this->request()->get('datepicker1'))[1];
  // dd( $incomes = $incomes->whereBetween('created_at',[$from,$datepicker[1]])->get());
     }
        // return  Order::with(['seller' => function ($q){
        //   $q->with(['address' => function ($q1){
        //       $q1->where('address.country_id',$this->request()->get('country_id')); 
        // }]);
        // }]);

 
      // dd($from,$datepicker[1]);
        
       if($country_id && $state_id && $city_id && $zone_id ){
             $employee_ids = Address::where('zone_id',$zone_id)->get()->pluck('employee_id');
             $incomes = $incomes->whereIn('employee_id',$employee_ids);
                  if($this->request()->get('datepicker1') != null) {
                 $incomes = $incomes->whereBetween('created_at',[$from,$datepicker[1]]);
             }
         }
        else if($country_id && $state_id && $city_id){
             $employee_ids = Address::where('city_id',$city_id)->get()->pluck('employee_id');
             $incomes = $incomes->whereIn('employee_id',$employee_ids);
                  if($this->request()->get('datepicker1') != null){
                 $incomes = $incomes->whereBetween('created_at',[$from,$datepicker[1]]);
             }
         }else if($country_id && $state_id){
             $employee_ids = Address::where('state_id',$state_id)->get()->pluck('employee_id');
             $incomes = $incomes->whereIn('employee_id',$employee_ids);
                  if($this->request()->get('datepicker1') != null){
                 $incomes = $incomes->whereBetween('created_at',[$from,$datepicker[1]]);
             }
         } 
       else if($country_id){
             $employee_ids = Address::where('country_id',$country_id)->get()->pluck('employee_id');
             $incomes = $incomes->whereIn('employee_id',$employee_ids);
             if($this->request()->get('datepicker1') != null){
                 $incomes = $incomes->whereBetween('created_at',[$from,$datepicker[1]]);
             }
         }   elseif($this->request()->get('datepicker1') != null){
            
            $employee_ids = Address::whereIn('zone_id',auth()->user()->zones->pluck('id')->toArray())->get()->pluck('employee_id');
       
                 $incomes = $incomes->whereBetween('created_at',[$from,$datepicker[1]]);
             }
         return $incomes;
       
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
              ['data'=>'collectiontype_id','title'=>'نوع الايراد','searchable'=>false],
          ['data'=>'value','title'=>'المبلغ'],
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
