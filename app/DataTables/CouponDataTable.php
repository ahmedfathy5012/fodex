<?php

namespace App\DataTables;

use App\Models\Coupon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CouponDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {return datatables()
            ->eloquent($query)
           ->addColumn('action', 'admindashboard.coupons.action')
   ->editColumn('percentage',function(Coupon $coupon){
          if($coupon->percentage == 0){
               return "ثابت"; 
          }else{
              return "نسبه مئويه";
          }
            })
            ->rawColumns([
           'action',
           'percentage'
        ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Coupon $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Coupon $model)
    {
        return $model->newQuery()->orderBy("id","desc");
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
        ['data'=>'name','title'=>'الكود'],
           ['data'=>'title','title'=>'الاسم'],
        ['data'=>'date_from','title'=>'من'],
          ['data'=>'date_to','title'=>'الى'], 
          ['data'=>'value','title'=>'القيمه'], 
             ['data'=>'percentage','title'=>'النوع'], 
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
        return 'Coupon_' . date('YmdHis');
    }
}
