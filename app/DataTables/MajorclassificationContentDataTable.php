<?php

namespace App\DataTables;

use App\Models\MajorclassificationContent;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MajorclassificationContentDataTable extends DataTable
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
     ->addColumn('image',function(MajorclassificationContent $home){
    if($home->image){
            $image = asset("uploads/$home->image");
            return '<img  src="' . $image . '" style ="width:100px;height:100px;" />';
        }
              })->editColumn('title',function(MajorclassificationContent $home){

        
            return '<a  href="' . route("sellersmajorcontent",$home->id) . '" />'.$home->title.'</a>';
              })
            ->addColumn('action', 'admindashboard.majorclassification.homecontent.action')

            ->rawColumns([
           'action',
           'image',
           'title'
        ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MajorclassificationContent $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MajorclassificationContent $model)
    {
        return $model->newQuery()->where('majorclassification_id',$this->id);
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
         ['data'=>'image','title'=>'الصوره'],
            ['data'=>'title','title'=>'الاسم '],
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
        return 'MajorclassificationContent_' . date('YmdHis');
    }
}
