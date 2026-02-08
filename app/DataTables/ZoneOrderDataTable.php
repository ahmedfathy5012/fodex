<?php

namespace App\DataTables;

use App\Models\Order;
use App\Models\Zone;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ZoneOrderDataTable extends DataTable
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
             ->editColumn('order_number',function(Zone $Zone){
          
                    $orders = $Zone->done_orders()
                    ->where(function ($query)  {
              
                $query->when($this->request()->datepicker1,function($q){
                    $from = explode(" - ",$this->request()->get('datepicker1'))[0];
                    $to = explode(" - ",$this->request()->get('datepicker1'))[1];
                    return $q->whereBetween('created_at',[$from,$to]);
                });
                    })->get();
                
                return count($orders);
            })->editColumn('total',function(Zone $Zone){
           $orders = $Zone->done_orders()
                    ->where(function ($query)  {
              
                $query->when($this->request()->datepicker1,function($q){
                    $from = explode(" - ",$this->request()->get('datepicker1'))[0];
                    $to = explode(" - ",$this->request()->get('datepicker1'))[1];
                    return $q->whereBetween('created_at',[$from,$to]);
                });
                    })->get();
                    return  array_sum($orders->pluck("priceafterdiscount")->toArray());
                
            })->editColumn('seller_commission',function(Zone $Zone){
          
           $orders = $Zone->done_orders()
                    ->where(function ($query)  {
              
                $query->when($this->request()->datepicker1,function($q){
                    $from = explode(" - ",$this->request()->get('datepicker1'))[0];
                    $to = explode(" - ",$this->request()->get('datepicker1'))[1];
                    return $q->whereBetween('created_at',[$from,$to]);
                });
                    })->get();
                    return  array_sum($orders->pluck("money_seller_commission")->toArray());
                
            })
         

            ->rawColumns([
           'seller_commission',
           'order_number','total'
        ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Zone $model)
    {

        $orders = $model->newQuery()->orderBy("id","desc");
  
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
           ["data" => "name" ,"title" =>"اسم المنطقه"],
          ['data'=>'order_number','title'=>'عدد الطلبات' ,'searchable'=>false],
            ['data'=>'total','title'=>'المبلغ كامل' ,'searchable'=>false],
             ['data'=>'seller_commission','title'=>'النسبه من المطعم ' ,'searchable'=>false]
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
