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
class DriverCompanyDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query,Request $request)
    {
        return datatables()
            ->eloquent($query)
           ->addColumn('action', 'admindashboard.driver_companies.action')
  ->addColumn('drivers_count',function(Driver $driver){
          
                    return count($driver->my_drivers);
                
            })
            ->addColumn('orders_count',function(Driver $driver){
          
                    return count($driver->company_done_orders);
                
            })
            ->rawColumns([
           'action',
        //   'name'
        ])->filter(function ($query) use ($request) {
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
              
           
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Driver $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Driver $model)
    {
    //     $country_id = $this->request()->get('country_id');
    //  $state_id = $this->request()->get('state_id');
    //  $city_id = $this->request()->get('city_id');
    //  $zone_id = $this->request()->get('zone_id');
        $drivers = $model->newQuery()->orderBy("id","desc")->where("is_company",1);
//  if($country_id){
//              $driver_ids = Address::where('country_id',$country_id)->get()->pluck('driver_id');
//              $drivers = $drivers->whereIn('id',$driver_ids);
      
//          } if($country_id && $state_id){
//              $driver_ids = Address::where('state_id',$state_id)->get()->pluck('driver_id');
//             $drivers = $drivers->whereIn('id',$driver_ids);
        
//          } if($country_id && $state_id && $city_id){
//              $driver_ids = Address::where('city_id',$city_id)->get()->pluck('driver_id');
//           $drivers = $drivers->whereIn('id',$driver_ids);
             
//          } if($country_id && $state_id && $city_id && $zone_id){
//              $driver_ids = Address::where('zone_id',$zone_id)->get()->pluck('driver_id');
//           $drivers = $drivers->whereIn('id',$driver_ids);
//          }
            $drivers = $model->newQuery()->orderBy("id","desc")->where("is_company",1);
           if(auth()->user()->type == 1 ){
           $drivers = $drivers->whereHas('address', function($query) {
         $query->whereIn("country_id",auth()->user()->countries->pluck("id")->toArray());
            });
         }
        else if(auth()->user()->type == 2 ){
           $drivers = $drivers->whereHas('address', function($query) {
         $query->whereIn("state_id",auth()->user()->states->pluck("id")->toArray());
            });
         }else if(auth()->user()->type == 3 ){
           $drivers = $drivers->whereHas('address', function($query) {
         $query->whereIn("city_id",auth()->user()->cities->pluck("id")->toArray());
            });
         } 
         else if(auth()->user()->type == 4 ){
           $drivers = $drivers->whereHas('address', function($query) {
         $query->whereIn("zone_id",auth()->user()->zones->pluck("id")->toArray());
            });
         }else{
             $drivers = $drivers->where("id" ,"<",0);
         }
         return $drivers;
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
               ['data'=>'drivers_count','title'=>'عدد السائقين'],       
               ['data'=>'orders_count','title'=>'عدد الطلبات الكامله'],

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
        return 'Driver_' . date('YmdHis');
    }
}
