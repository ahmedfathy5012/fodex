<?php

namespace App\DataTables;

use App\Models\UserWalletTransformation;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\Address;
class UserWalletTransformationDataTable extends DataTable
{
    /*
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Employee $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(UserWalletTransformation $model)
    {
     
       

            return $model->newQuery()->with(["employee","user"])->orderBy("id","desc")->select("user_wallet_transformations.*");
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
        ['data'=>'user.name','title'=>'اسم المستخدم'],
       ['data'=>'employee.name','title'=>'اسم الموظف'],
        ['data'=>'value','title'=>'القيمه المضافه '],
        ['data'=>'user.wallet_amount','title'=>'القيمه الحاليه فى المحفظه'],
         ['data'=>'created_at','title'=>'التاريخ'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'UserWalletTransformation_' . date('YmdHis');
    }
}
