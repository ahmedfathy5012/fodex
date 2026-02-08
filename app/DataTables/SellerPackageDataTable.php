<?php

namespace App\DataTables;

use App\Models\SellerPackage;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SellerPackageDataTable extends DataTable
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
            ->editColumn('package_id',function(SellerPackage $pa){
                if($pa->package){
                    return $pa->package->name;
                }
            })
            ->addColumn('action', 'admindashboard.subscriptions.action')

            ->rawColumns([
           'action'
        ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SellerPackage $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SellerPackage $model)
    {
        return $model->newQuery()->where('seller_id',$this->id);
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
                // ['data'=>'id','title'=>'id','visible' => false, 'printable' => false, 'exportable' => true],
               
                     ['data'=>'package_id','title'=>'اسم الباقه' ,'orderable'=>false,'searchable'=>false],
                     ['data'=>'price','title'=>'السعر ' ,'orderable'=>false,'searchable'=>false],
                     ['data'=>'end_date','title'=>'مده الانتهاء '],
                  

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
        return 'SellerPackage_' . date('YmdHis');
    }
}
