<?php

namespace App\DataTables;

use App\Models\Category;
use App\Models\Seller;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SellercategoryDataTable extends DataTable
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
           ->addColumn('image',function(Category $Sellercategory){
            if($Sellercategory->image){
                $im = $Sellercategory->image;
            $image = asset("uploads/$im");
            return '<img  src="' . $image . '" style ="width:100px;height:100px;" />';
        }
              }) 
              ->editColumn('major_id',function(Category $Sellercategory){
            if($Sellercategory->major){
            return $Sellercategory->major->title;
        }
              }) 
        //->editColumn('title',function(Sellercategory $Sellercategory){
        //     if($Sellercategory->category){
        //     return $Sellercategory->category->title;
        // }
        //       })  ->editColumn('description',function(Sellercategory $Sellercategory){
        //     if($Sellercategory->category){
        //     return $Sellercategory->category->description;
        // }
        //       })
            ->addColumn('action', 'admindashboard.categories.selleraction')

            ->rawColumns([
           'action',
           'image'
        ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Sellercategory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model)
    {
       $seller = Seller::where("id",$this->id)->first();
            return $model->with('major')->where("is_subcategory",$seller->is_subcategory)
            ->select("*")
          ->orderBy('id', 'desc');
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
            ['data'=>'title','title'=>'الاسم '],
             ['data'=>'major_id','title'=>'القسم '],
           //   ['data'=>'description','title'=>'الوصف'],
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
        return 'Sellercategory_' . date('YmdHis');
    }
}
