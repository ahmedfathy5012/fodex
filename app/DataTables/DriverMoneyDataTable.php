<?php

namespace App\DataTables;

use App\Models\Driver;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\Address;
use Illuminate\Http\Request;

class DriverMoneyDataTable extends DataTable
{
   
    public function dataTable($query,Request $request)
    {
        return datatables()
 ->eloquent($query)

             ->editColumn('order_number',function(Driver $driver){
          
                    $orders = $driver->dorders()->where("status",3)
                    ->where(function ($query)  {
              
                $query->when($this->request()->datepicker1,function($q){
                    $from = explode(" - ",$this->request()->get('datepicker1'))[0];
                    $to = explode(" - ",$this->request()->get('datepicker1'))[1];
                    return $q->whereBetween('created_at',[$from,$to]);
                });
                    })->get();
                
                return count($orders);
            })->editColumn('total',function(Driver $driver){
           $orders = $driver->dorders()->where("status",3)
                    ->where(function ($query)  {
              
                $query->when($this->request()->datepicker1,function($q){
                    $from = explode(" - ",$this->request()->get('datepicker1'))[0];
                    $to = explode(" - ",$this->request()->get('datepicker1'))[1];
                    return $q->whereBetween('created_at',[$from,$to]);
                });
                    })->get();
                    return  array_sum($orders->pluck("priceafterdiscount")->toArray());
                
            })->editColumn('money_driver_commission',function(Driver $driver){
          
           $orders = $driver->dorders()->where("status",3)
                    ->where(function ($query)  {
              
                $query->when($this->request()->datepicker1,function($q){
                    $from = explode(" - ",$this->request()->get('datepicker1'))[0];
                    $to = explode(" - ",$this->request()->get('datepicker1'))[1];
                    return $q->whereBetween('created_at',[$from,$to]);
                });
                    })->get();
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
    public function query(Driver $model)
    {   
        /*$driver_ids = Address::whereIn('zone_id',auth()->user()->zones->pluck('id')->toArray())->get()->pluck('Driver_id');
          $country_id = $this->request()->get('country_id');
     $state_id = $this->request()->get('state_id');
     $city_id = $this->request()->get('city_id');
     $zone_id = $this->request()->get('zone_id');
        $drivers = $model->newQuery()->whereIn('id',$driver_ids);
 if($country_id){
             $driver_ids = Address::where('country_id',$country_id)->get()->pluck('Driver_id');
             $drivers = $drivers->whereIn('id',$driver_ids);
      
         } if($country_id && $state_id){
             $driver_ids = Address::where('state_id',$state_id)->get()->pluck('Driver_id');
            $drivers = $drivers->whereIn('id',$driver_ids);
        
         } if($country_id && $state_id && $city_id){
             $driver_ids = Address::where('city_id',$city_id)->get()->pluck('Driver_id');
          $drivers = $drivers->whereIn('id',$driver_ids);
             
         } if($country_id && $state_id && $city_id && $zone_id){
             $driver_ids = Address::where('zone_id',$zone_id)->get()->pluck('Driver_id');
           $drivers = $drivers->whereIn('id',$driver_ids);
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
              ['data'=>'name','title'=>'الطيار'],
              ['data'=>'order_number','title'=>'عدد الطلبات' ,'searchable'=>false],
            ['data'=>'total','title'=>'المبلغ كامل' ,'searchable'=>false],
             ['data'=>'money_driver_commission','title'=>'النسبه الطيار  ' ,'searchable'=>false],
                
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Driver_' . date('YmdHis');
    }
}
