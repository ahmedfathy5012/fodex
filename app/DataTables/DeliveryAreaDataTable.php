<?php

namespace App\DataTables;

use App\Models\DeliveryArea;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DeliveryAreaDataTable extends DataTable
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
                   ->editColumn('country_id',function(DeliveryArea $zone){
                if($zone->country){
                    return $zone->country->name;
                }
            }) ->editColumn('state_id',function(DeliveryArea $zone){
                if($zone->state){
                    return $zone->state->name;
                }
            })->editColumn('city_id',function(DeliveryArea $zone){
                if($zone->city){
                    return $zone->city->name;
                }
            })
            ->addColumn('action', 'admindashboard.delivery_areas.action')

            ->rawColumns([
           'action',
        ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Zone $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DeliveryArea $model)
    {
        return $model->newQuery();
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
            ['data'=>'country_id','title'=>'الدوله'],
              ['data'=>'state_id','title'=>'المحافظه'],
        ['data'=>'city_id','title'=>'المدينه'],
               ['data'=>'name','title'=>'الاسم'],
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
        return 'DeliveryArea_' . date('YmdHis');
    }
}
