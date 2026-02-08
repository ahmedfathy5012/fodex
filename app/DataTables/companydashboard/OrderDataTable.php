<?php

namespace App\DataTables\companydashboard;

use App\Models\Order;
use App\Models\Address;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\Request;

class OrderDataTable extends DataTable
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
            ->editColumn('seller_id',function(Order $order){
                if($order->seller){
                    return $order->seller->name;
                }
            }) ->editColumn('user_id',function(Order $order){
                if($order->user){
                    return $order->user->name;
                }
            })
           ->addColumn('action', 'companydashboard.orders.action')
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

        $orders =  $model->newQuery()->orderBy("id","desc")->where('company_id',auth()->id());
    // if(auth()->user()->type == 1 ){
    //       $orders = $orders->whereIn("country_id",auth()->user()->countries->pluck("id")->toArray());
    //      }
    //     else if(auth()->user()->type == 2 ){
    //       $orders = $orders->whereIn("state_id",auth()->user()->states->pluck("id")->toArray());
    //      }else if(auth()->user()->type == 3 ){
    //       $orders = $orders->whereIn("city_id",auth()->user()->cities->pluck("id")->toArray());
    //      } 
    //      else if(auth()->user()->type == 4 ){
    //       $orders = $orders->whereIn("zone_id",auth()->user()->zones->pluck("id")->toArray());
    //      }else{
    //          $orders = $orders->where("id" ,"<",0);
    //      }
         return $orders;
     
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
             ['data'=>'seller_id','title'=>'البائع'], 
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
