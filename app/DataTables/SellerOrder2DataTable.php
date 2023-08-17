<?php

namespace App\DataTables;

use App\Models\Order;
use App\Models\Address;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\Request;
class SellerOrder2DataTable extends DataTable
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
            // ->editColumn('seller_id',function(Order $order){
            //     if($order->seller){
            //         return $order->seller->name;
            //     }
            // }) 
            ->editColumn('user_id',function(Order $order){
                if($order->user){
                    return $order->user->name;
                }
            })
           ->addColumn('action', 'sellerdashboard.orders.action')
            ->rawColumns([
           'action',
        ])->filter(function ($query) use ($request) {
                $query->when($request->datepicker1,function($q) use($request){
                    $from = explode(" - ",$this->request()->get('datepicker1'))[0];
                    $to = explode(" - ",$this->request()->get('datepicker1'))[1];
                    return $q->whereBetween('created_at',[$from,$to]);
                });
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
    {
    //  $country_id = $this->request()->get('country_id');
    //  $state_id = $this->request()->get('state_id');
    //  $city_id = $this->request()->get('city_id');
    //  $zone_id = $this->request()->get('zone_id');
    //  $from = $this->request()->get('from');
    //  $to = $this->request()->get('to');
        // return  Order::with(['seller' => function ($q){
        //   $q->with(['address' => function ($q1){
        //       $q1->where('address.country_id',$this->request()->get('country_id')); 
        // }]);
        // }]);
        
         $orders = $model->newQuery()->where('seller_id',auth()->user()->seller_id);
//   if($from && $to){
//                  $orders = $orders->whereBetween('created_at',[$from,$to]);
//   }
         return $orders;
        //->has("seller")->where(function($q){
        //     $q->country_id() = 4;
        // });
        //->where("seller.address.country_id",$this->request()->get('country_id'))->get();
        //     dd($query->seller_id);
        //     if($query->seller->address->country_id == $this->request()->get('country_id')){
        //         return $query;
        //     }
        // });
        //   if($this->request()->get('country_id') && $this->request()->get('state_id')){
           
        //   }
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
           ['data'=>'id','title'=>'id'],
            ['data'=>'user_id','title'=>'المشتري'],    
             //['data'=>'seller_id','title'=>'البائع'], 
       ['data'=>'price','title'=>'السعر'],
         ['data'=>'priceafterdiscount','title'=>'السعر بعد الخصم'],
       
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
        return 'Order_' . date('YmdHis');
    }
}
