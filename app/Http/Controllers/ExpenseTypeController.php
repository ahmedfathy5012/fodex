<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseType;
use App\DataTables\ExpenseTypeDataTable;

class ExpenseTypeController extends Controller
{
    private function expenseTypeView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.expensetypes.$page"
            : "admindashboard.expensetypes.V2.$page";
    }

    public function index(ExpenseTypeDataTable $dataTable)
    {
        return $dataTable->render($this->expenseTypeView('index'));
    }

    public function create()
    {
        return view($this->expenseTypeView('create'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'هذا الحقل مطلوب',
        ]);

        $extype = new ExpenseType;
        $extype->name = $request->name;
        $extype->value = $request->value;
        $extype->save();

        return redirect()->route('expensetype.index');
    }

    public function edit($id)
    {
        $extype = ExpenseType::where('id', $id)->first();

        return view($this->expenseTypeView('edit'))
            ->with('extype', $extype);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'هذا الحقل مطلوب',
        ]);

        $extype = ExpenseType::where('id', $id)->first();
        $extype->name = $request->name;
        $extype->value = $request->value;
        $extype->save();

        return redirect()->route('expensetype.index');
    }

    public function destroy($id)
    {
        $extype = ExpenseType::where('id', $id)->first();
        $extype->delete();

        return response()->json([
            'status' => true,
        ]);
    }
}
