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
class UserOrderDataTable extends DataTable
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
                       $orders = Order::where("id","<",$order->id)->where("seller_id",$order->seller_id)->get();
                    $count = count($orders) + 1;
                 $input = '<input type="checkbox" onclick="checkres('.$order->id.')">';
                $bin = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
  <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
</svg>';
   if($order->vertfiy_res == 1){
                  return $order->seller->name .  ' ' . $bin .  '<span class="badge badge-success ml-2 mr-2">'.$count.'</span>';
            }elseif($order->vertfiy_res == 0){
                  return $order->seller->name . ' ' . $input .  '<span class="badge badge-success ml-2 mr-2">'.$count.'</span>';
            }
                // if($order->seller){
                //     return $order->seller->name;
                // }
                }
            }) ->editColumn('user_id',function(Order $order){
                if($order->user){
                    $orders = Order::where("id","<",$order->id)->where("user_id",$order->user_id)->get();
                    $count = count($orders) + 1;
                    return $order->user->name  . '<span class="badge badge-success ml-2 mr-2">'.$count.'</span>';
                }
            })
           ->addColumn('action', 'admindashboard.orders.action')
            ->rawColumns([
           'action',
           'seller_id',
           'user_id'
        ]);
           
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
    {
     
      $orders =  $model->newQuery()->orderBy("id","desc")->where("user_id",$this->id);
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
       
             ['data'=>'action','title'=>'الاعدادات','printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false,'width'=>'120px'],
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
