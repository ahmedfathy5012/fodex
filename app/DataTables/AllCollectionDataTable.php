<?php

namespace App\DataTables;

use App\Models\CustomField;
use App\Models\AllCollection;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class AllCollectionDataTable extends DataTable
{
    /**
     * custom fields columns
     * @var array
     */
    public static $customFields = [];

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        $columns = array_column($this->getColumns(), 'data');
        $dataTable = $dataTable
    
            ->editColumn('seller_id', function (AllCollection $collect) {
                if($collect->seller){
                    return $collect->seller->name;
                }
            })
         
          
            ->rawColumns(array_merge($columns, []));

        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AllCollection $model)
    {
  $from = $this->request()->get('from');
          $to = $this->request()->get('to');
             $collections = $model->newQuery()->with("seller")->orderBy('updated_at', 'desc');
          if($from && $to){
              $collections = $collections->whereBetween('created_at',[$from,$to]);
          }
          return $collections;
      
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
        $columns = [
            [
                'data' => 'seller_id',
                'title' => 'البائع' ,
 'searchable' => false, 'orderable' => false,
            ],
            [
                'data' => 'money_taken',
                'title' => 'المبلغ',
                'searchable' => false, 'orderable' => false, 'exportable' => false, 'printable' => false,
            ],
            [
                'data' => 'date_time',
                'title' => 'وقت التحصيل',

            ]
        ];

     
        return $columns;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'foodsdatatable_' . time();
    }

    /**
     * Export PDF using DOMPDF
     * @return mixed
     */
    public function pdf()
    {
        $data = $this->getDataForPrint();
        $pdf = PDF::loadView($this->printPreview, compact('data'));
        return $pdf->download($this->filename() . '.pdf');
    }
}