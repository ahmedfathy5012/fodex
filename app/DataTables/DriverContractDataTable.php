<?php

namespace App\DataTables;

use App\Models\DriverContract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DriverContractDataTable extends DataTable
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
               ->addColumn('paper_contract_image',function(DriverContract $Sellercategory){
            if($Sellercategory->paper_contract_image){
                $im = $Sellercategory->paper_contract_image;
            $image = asset("uploads/$im");
            return '<img  src="' . $image . '" style ="width:100px;height:100px;" />';
        }
              }) 
          ->addColumn('action', 'admindashboard.drivers.contractaction')
             ->rawColumns([
         'action',
           'paper_contract_image'
        ]);
    
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\DriverContract $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DriverContract $model)
    {
       return $model->where('driver_id',$this->id);
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
     protected function getColumns()
    {
        return [
                ['data'=>'paper_contract_image','title'=>'الصوره '],
             ['data'=>'from_day','title'=>'من '],
              ['data'=>'to_day','title'=>'الى'],
                ['data'=>'sallary','title'=>'المرتب'],
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
        return 'DriverContract_' . date('YmdHis');
    }
}
