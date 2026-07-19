<?php

namespace App\DataTables;

use App\Models\Box;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BoxDataTable extends DataTable
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
            ->editColumn('image', function (Box $box) {
                if (!$box->image) {
                    return '<span class="text-muted">لا توجد صورة</span>';
                }

                return '<img src="' . asset('uploads/' . $box->image) . '"
                    alt="' . e($box->title) . '"
                    style="width:70px;height:70px;object-fit:cover;border-radius:8px;">';
            })
            ->addColumn('action','admindashboard.boxs.V2.action')
        ->rawColumns([
           'image',
           'action',
        ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\BoxStatus $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Box $model)
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
            'Box' => [0, 'desc'],
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

               ['data'=>'title','title'=>'الاسم'],
                ['data'=>'image','title'=>'الصورة','orderable'=>false,'searchable'=>false],
                ['data'=>'width','title'=>'العرض'],
                 ['data'=>'height','title'=>'الطول'],
            ['data'=>'action','title'=>'الاعدادات','printable'=>false,'exportable'=>false,'Boxable'=>false,'searchable'=>false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'BoxStatus_' . date('YmdHis');
    }
}
