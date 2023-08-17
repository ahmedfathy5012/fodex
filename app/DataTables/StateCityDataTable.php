<?php

namespace App\DataTables;

use App\Models\City;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StateCityDataTable extends DataTable
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
             ->editColumn('country_id',function(City $city){
                if($city->country){
                    return $city->country->name;
                }
            }) ->editColumn('state_id',function(City $city){
                if($city->state){
                    return $city->state->name;
                }
            })
            ->addColumn('action', 'admindashboard.states.cities.action')

            ->rawColumns([
           'action',
        ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\City $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(City $model)
    {
        return $model->newQuery()->where("state_id",$this->id);
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
            ['data'=>'country_id','title'=>'الدوله','searchable'=>false],
              ['data'=>'state_id','title'=>'المحافظه','searchable'=>false],
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
        return 'City_' . date('YmdHis');
    }
}
