<?php

namespace App\DataTables;

use App\Models\Major;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\Address;
use Illuminate\Http\Request;

class MajorMoneyDataTable extends DataTable
{
   
    public function dataTable($query,Request $request)
    {
        return datatables()
             ->eloquent($query)
             ->editColumn('order_number',function(Major $major){
                    $orders = $major->done_orders()
                    ->filter(function ($query)  {
              
                $query->when($this->request()->datepicker1 != null,function($q){
                    $from = explode(" - ",$this->request()->get('datepicker1'))[0];
                    $to = explode(" - ",$this->request()->get('datepicker1'))[1];
                    return $q->whereBetween('created_at',[$from,$to]);
                });
                
                    });
              //  dd(count($major->done_orders()),count($orders));
                return count($orders);
            })->editColumn('total',function(Major $major){
           $orders = $major->done_orders()
                    ->filter(function ($query)  {
              
                $query->when($this->request()->datepicker1 != null,function($q){
                    $from = explode(" - ",$this->request()->get('datepicker1'))[0];
                    $to = explode(" - ",$this->request()->get('datepicker1'))[1];
                    return $q->whereBetween('created_at',[$from,$to]);
                });
                    });
                    return  array_sum($orders->pluck("priceafterdiscount")->toArray());
                
            })->editColumn('money_driver_commission',function(Major $major){
          
           $orders = $major->done_orders()
                    ->filter(function ($query)  {
              
                $query->when($this->request()->datepicker1 != null,function($q){
                    $from = explode(" - ",$this->request()->get('datepicker1'))[0];
                    $to = explode(" - ",$this->request()->get('datepicker1'))[1];
                    return $q->whereBetween('created_at',[$from,$to]);
                });
                    });
                    return  array_sum($orders->pluck("money_driver_commission")->toArray());
                
            })
         

            ->rawColumns([
           'money_driver_commission',
           'order_number','total'
        ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Driver $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Major $model)
    {   
        /*$major_ids = Address::whereIn('zone_id',auth()->user()->zones->pluck('id')->toArray())->get()->pluck('Driver_id');
          $country_id = $this->request()->get('country_id');
     $state_id = $this->request()->get('state_id');
     $city_id = $this->request()->get('city_id');
     $zone_id = $this->request()->get('zone_id');
        $majors = $model->newQuery()->whereIn('id',$major_ids);
 if($country_id){
             $major_ids = Address::where('country_id',$country_id)->get()->pluck('Driver_id');
             $majors = $majors->whereIn('id',$major_ids);
      
         } if($country_id && $state_id){
             $major_ids = Address::where('state_id',$state_id)->get()->pluck('Driver_id');
            $majors = $majors->whereIn('id',$major_ids);
        
         } if($country_id && $state_id && $city_id){
             $major_ids = Address::where('city_id',$city_id)->get()->pluck('Driver_id');
          $majors = $majors->whereIn('id',$major_ids);
             
         } if($country_id && $state_id && $city_id && $zone_id){
             $major_ids = Address::where('zone_id',$zone_id)->get()->pluck('Driver_id');
           $majors = $majors->whereIn('id',$major_ids);
         }*/
         return  $model->newQuery();
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
              ['data'=>'title','title'=>'التخصص'],
              ['data'=>'order_number','title'=>'عدد الطلبات' ,'searchable'=>false,'orderable'=>false],
            ['data'=>'total','title'=>'المبلغ كامل' ,'searchable'=>false,'orderable'=>false],
             ['data'=>'money_driver_commission','title'=>'النسبه الطيار  ' ,'searchable'=>false,'orderable'=>false],
                
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Major_' . date('YmdHis');
    }
}
