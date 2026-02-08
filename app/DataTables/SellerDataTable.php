<?php

namespace App\DataTables;

use App\Models\Seller;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\Address;
use Illuminate\Http\Request;

class SellerDataTable extends DataTable
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
 ->editColumn('major_id',function(Seller $seller){
                if($seller->major){
                    return $seller->major->title;
                }
            })
            //  ->editColumn('name',function(Seller $seller){
          
            //         return '<a href="'.route("seller.show",$seller->id).'">'.$seller->name.'</a>';
                
            // })
            ->filter(function ($query) use ($request) {
                 if ($request->has('search') && isset($request->input('search')['value']) 
                && !empty($request->input('search')['value'])) {
                    $searchValue = $request->input('search')['value'];
                      $query->where("name", "like","%" . $searchValue . "%");
                }
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
           ->addColumn('action', 'admindashboard.sellers.action')

            ->rawColumns([
           'action',
         //  'name'
        ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Seller $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Seller $model)
    {   
        /*$seller_ids = Address::whereIn('zone_id',auth()->user()->zones->pluck('id')->toArray())->get()->pluck('seller_id');
          $country_id = $this->request()->get('country_id');
     $state_id = $this->request()->get('state_id');
     $city_id = $this->request()->get('city_id');
     $zone_id = $this->request()->get('zone_id');
        $sellers = $model->newQuery()->whereIn('id',$seller_ids);
 if($country_id){
             $seller_ids = Address::where('country_id',$country_id)->get()->pluck('seller_id');
             $sellers = $sellers->whereIn('id',$seller_ids);
      
         } if($country_id && $state_id){
             $seller_ids = Address::where('state_id',$state_id)->get()->pluck('seller_id');
            $sellers = $sellers->whereIn('id',$seller_ids);
        
         } if($country_id && $state_id && $city_id){
             $seller_ids = Address::where('city_id',$city_id)->get()->pluck('seller_id');
          $sellers = $sellers->whereIn('id',$seller_ids);
             
         } if($country_id && $state_id && $city_id && $zone_id){
             $seller_ids = Address::where('zone_id',$zone_id)->get()->pluck('seller_id');
           $sellers = $sellers->whereIn('id',$seller_ids);
         }*/
         $sellers = $model->newQuery()->orderBy("id","desc");
        //   if(auth()->user()->type == 1 ){
        //   $sellers = $sellers->whereHas('address', function($query) {
        //  $query->whereIn("country_id",auth()->user()->countries->pluck("id")->toArray());
        //     });
        //  }
        // else if(auth()->user()->type == 2 ){
        //   $sellers = $sellers->whereHas('address', function($query) {
        //  $query->whereIn("state_id",auth()->user()->states->pluck("id")->toArray());
        //     });
        //  }else if(auth()->user()->type == 3 ){
        //   $sellers = $sellers->whereHas('address', function($query) {
        //  $query->whereIn("city_id",auth()->user()->cities->pluck("id")->toArray());
        //     });
        //  } 
        //  else if(auth()->user()->type == 4 ){
        //   $sellers = $sellers->whereHas('address', function($query) {
        //  $query->whereIn("zone_id",auth()->user()->zones->pluck("id")->toArray());
        //     });
        //  }else{
          //   $sellers = $sellers->where("id" ,"<",0);
        // }
         return $sellers;
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
                ['data'=>'mobile','title'=>'رقم الهاتف الثانى'],
               ['data'=>'major_id','title'=>'القسم ' ,'searchable'=>false],
                    //  ['data'=>'description','title'=>'الوصف'],
            ['data'=>'action','title'=>'الاعدادات','printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false,'width'=>'150px'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Seller_' . date('YmdHis');
    }
}
