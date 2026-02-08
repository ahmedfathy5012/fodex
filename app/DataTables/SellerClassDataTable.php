<?php

namespace App\DataTables;

use App\Models\Seller;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\Address;
use App\Models\MajorClassificationSeller;
use App\Models\HomeContent;
class SellerClassDataTable extends DataTable
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
 ->editColumn('major_id',function(MajorClassificationSeller $seller){
                if($seller->seller->major){
                    return $seller->seller->major->title;
                }
            })
             ->editColumn('name',function(MajorClassificationSeller $seller){
             //   if($seller->seller){
                    return $seller->seller->name;
              //  }
            })->editColumn('phone',function(MajorClassificationSeller $seller){
             //   if($seller->seller){
                    return $seller->seller->phone;
              //  }
            })
            //  ->editColumn('name',function(MajorClassificationSeller $seller){
          
            //         return '<a href="'.route("seller.show",$seller->seller->id).'">'.$seller->seller->name.'</a>';
                
            // })
           ->addColumn('action', 'admindashboard.majorclassification.selleraction')->with('home',HomeContent::where('id',$this->id)->first())

            ->rawColumns([
           'action',
           'name',
           'major_id'
        ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Seller $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MajorClassificationSeller $model)
    {
  //    $sellers_ids = HomeContent::where('id',$this->id)->first()->sellers;//->orderBy('homecontent_sellers.status','desc');//->pluck('seller_id')->toArray();
     //   $sellers = $model->newQuery()->whereIn('id',$sellers_ids);
        // return $sellers_ids;
   //      $sellers = MajorClassificationSeller::where('homecontent_id',$this->id)->orderBy('status','desc')->get();
         $sellers = $model->newQuery()->where('majorclassification_id',$this->id)->orderBy('order_number','asc');
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
       ['data'=>'name','title'=>'الاسم' ,'orderable'=>false,'searchable'=>false],
              ['data'=>'phone','title'=>'الهاتف','orderable'=>false,'searchable'=>false],
               ['data'=>'major_id','title'=>'القسم ' ,'searchable'=>false],
                    //  ['data'=>'description','title'=>'الوصف'],
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
        return 'Seller_' . date('YmdHis');
    }
}
