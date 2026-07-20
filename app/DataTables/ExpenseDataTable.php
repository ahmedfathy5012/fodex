<?php

namespace App\DataTables;
use App\Models\Address;
use App\Models\Expense;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon;

class ExpenseDataTable extends DataTable
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
            ->editColumn('expensestype_id',function(Expense $expense){
                if($expense->expensetype){
                    return $expense->expensetype->name;
                }
            })
             ->addColumn('action', 'admindashboard.expenses.V2.action')
        ->rawColumns([
           'action',
        ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ExpenseType $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Expense $model)
    {
        $expenses = $model->newQuery();
        $locationColumn = null;
        $locationId = 0;

        foreach (['zone_id', 'city_id', 'state_id', 'country_id'] as $column) {
            $value = (int) $this->request()->input($column, 0);

            if ($value !== 0) {
                $locationColumn = $column;
                $locationId = $value;
                break;
            }
        }

        if ($locationColumn !== null) {
            $employeeIds = Address::where($locationColumn, $locationId)->pluck('employee_id');
            $expenses->whereIn('employee_id', $employeeIds);
        }

        $dateRange = $this->getDateRange();

        if ($dateRange !== null) {
            $expenses->whereBetween('created_at', $dateRange);

            if ($locationColumn === null) {
                $employeeIds = Address::whereIn(
                    'zone_id',
                    auth()->user()->zones->pluck('id')->toArray()
                )->pluck('employee_id');

                $expenses->whereIn('employee_id', $employeeIds);
            }
        }

        return $expenses;
    }

    private function getDateRange(): ?array
    {
        $datepicker = $this->request()->input('datepicker1');

        if (empty($datepicker)) {
            return null;
        }

        $dates = preg_split('/\s+-\s+/', trim($datepicker));

        if (!is_array($dates) || count($dates) !== 2) {
            return null;
        }

        try {
            return [
                Carbon::createFromFormat('Y-m-d', trim($dates[0]))->startOfDay(),
                Carbon::createFromFormat('Y-m-d', trim($dates[1]))->endOfDay(),
            ];
        } catch (\Throwable $exception) {
            return null;
        }
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
              ['data'=>'expensestype_id','title'=>'نوع المصروف','searchable'=>false],
          ['data'=>'paid','title'=>'المبلغ'],
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
        return 'ExpenseType_' . date('YmdHis');
    }
}
