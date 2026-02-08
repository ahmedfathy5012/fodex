<?php

namespace App\DataTables;

use App\Models\Subcategory;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SubcategoryDataTable extends DataTable
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
             ->addColumn('image',function(Subcategory $subcategory){
                  if($subcategory->image){
            $image = asset("uploads/$subcategory->image");
            return '<img  src="' . $image . '" style ="width:100px;height:100px;" />';
        }
              }) ->editColumn('major_id',function(Subcategory $subcategory){
            if($subcategory->major){
            return $subcategory->major->title;}
        })->editColumn('category_id',function(Subcategory $subcategory){
            if($subcategory->category){
            return $subcategory->category->title;
        }
              })
            ->addColumn('action', 'admindashboard.subcategories.action')

            ->rawColumns([
           'action',
           'image'
        ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Subcategory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Subcategory $model)
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
                 ['data'=>'image','title'=>'الصوره '],
            ['data'=>'title','title'=>'لاسم '],
             ['data'=>'major_id','title'=>' القسم '],
              ['data'=>'category_id','title'=>'القسم الرئيسى '],
          //    ['data'=>'description','title'=>'لوصف'],
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
        return 'Subcategory_' . date('YmdHis');
    }
}
