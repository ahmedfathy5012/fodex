<?php

namespace App\DataTables;

use App\Models\OrderItem;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrderItemDataTable extends DataTable
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
            ->editColumn('item_id',function(OrderItem $order){
                if($order->item){
                    return $order->item->title;
                }
            }) ->editColumn('size_id',function(OrderItem $order){
                if($order->size){
                    return $order->size->title;
                }
            }) ->editColumn('extras', function (OrderItem $foodOrder) {
                $names =  $foodOrder->extras->pluck("title")->toArray();
                $titles = "";
                foreach($names as $name){
                    $titles .= $name . "</br>";
                }
                return $titles;
            })
            ->editColumn('price', function ($foodOrder) {
                foreach ($foodOrder->extrass as $extra) {
                    $foodOrder['price'] += $extra->price;
                }
                return $foodOrder['price'];
            })  ->addColumn('action', 'admindashboard.orders.orderitemaction')
           ->rawColumns([
               'action',
           'extras',
           'price'
        ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\OrderItem $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(OrderItem $model)
    {
        return $model->newQuery()->where("order_id",$this->id);
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
            ['data'=>'id','title'=>'id','orderable'=>false,'searchable'=>false],
            ['data'=>'item_id','title'=>'الطعام','orderable'=>false,'searchable'=>false],    
             ['data'=>'size_id','title'=>'الحجم','orderable'=>false,'searchable'=>false],
             ['data'=>'extras','title'=>'extras','orderable'=>false,'searchable'=>false],
               ['data'=>'quantity','title'=>'الكميه'], 
       ['data'=>'price','title'=>'السعر','class'=>'text-danger'],
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
        return 'OrderItem_' . date('YmdHis');
    }
}
