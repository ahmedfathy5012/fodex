<?php

namespace App\DataTables;

use App\Models\Driver;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\Address;
class CompanyCollectionDataTable extends DataTable
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
            
           ->addColumn('action', 'admindashboard.driver_companies.notcollectaction')

            ->rawColumns([
           'action'
        ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Seller $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Driver $model)
    {
         $driver_ids = Address::whereIn('zone_id',auth()->user()->zones->pluck('id')->toArray())->get()->pluck('driver_id');
         $ress =  Driver::whereIn('id',$driver_ids)->where("is_company",1)->get();
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
        $collect = \App\Models\AllCollection::where('driver_id',$res->id)->where('month_date',$a)
        ->first();
    if($collect){
        
  if($collect->money_left == 0){
        
    }else{
        $res_ids[]= $res->id;
    }
           
       
    }
    else{
    
    
        $orders = $res->company_done_orders()->whereYear('orders.created_at',\Carbon\Carbon::parse($a))
      ->whereMonth('orders.created_at',\Carbon\Carbon::parse($a))->get();
    //   ->whereMonth('orders.created_at',$date3)->get();

    //   ->where('order_status_id',7)->whereYear('orders.created_at',$date3)
    //   ->whereMonth('orders.created_at',$date3)->get();
       $countorders = count($orders); 
            $money =array_sum($res->orders()->where('status',1)->whereYear('orders.created_at',\Carbon\Carbon::parse($a))
            ->whereMonth('orders.created_at',\Carbon\Carbon::parse($a))->get()->pluck('priceafterdiscount')->toArray()) -
        array_sum($res->orders()->where('status',1)->whereYear('orders.created_at',\Carbon\Carbon::parse($a))
        ->whereMonth('orders.created_at',\Carbon\Carbon::parse($a))->get()->pluck('delivery_fee')->toArray());

       
         
     
if($countorders == 0){
    
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
        $drivers = $model->newQuery();
 if($country_id){
             $driver_ids = Address::where('country_id',$country_id)->get()->pluck('driver_id');
             $drivers = $drivers->whereIn('id',$driver_ids);
      
         } if($country_id && $state_id){
             $driver_ids = Address::where('state_id',$state_id)->get()->pluck('driver_id');
            $drivers = $drivers->whereIn('id',$driver_ids);
        
         } if($country_id && $state_id && $city_id){
             $driver_ids = Address::where('city_id',$city_id)->get()->pluck('driver_id');
          $drivers = $drivers->whereIn('id',$driver_ids);
             
         } if($country_id && $state_id && $city_id && $zone_id){
             $driver_ids = Address::where('zone_id',$zone_id)->get()->pluck('driver_id');
           $drivers = $drivers->whereIn('id',$driver_ids);
         }
         return $drivers->whereIn('id',$res_ids);
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
        return 'Driver_' . date('YmdHis');
    }
}
