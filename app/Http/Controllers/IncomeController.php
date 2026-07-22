<?php

namespace App\Http\Controllers;

use App\DataTables\IncomeDataTable;
use App\Models\AllcollectionType;
use App\Models\Income;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class IncomeController extends Controller
{
    /**
     * Determine the Blade view according to the environment.
     */
    private function incomeView(string $page): string
    {
        return app()->environment('production')
            ? "admindashboard.incomes.$page"
            : "admindashboard.incomes.V2.$page";
    }

    /**
     * Display incomes list.
     */
    public function index(IncomeDataTable $dataTable)
    {
        return $dataTable->render($this->incomeView('index'));
    }

    /**
     * Show the form for creating a new income.
     */
    public function create(): View
    {
        $expenses = AllcollectionType::query()
            ->orderBy('name')
            ->get();

        return view(
            $this->incomeView('create'),
            compact('expenses')
        );
    }

    /**
     * Store a new income.
     */
    public function store(Request $request): RedirectResponse
    {
        $collectionTypeTable = (new AllcollectionType())->getTable();

        $validated = $request->validate([
            'collectiontype_id' => [
                'required',
                Rule::exists($collectionTypeTable, 'id'),
            ],
            'value' => [
                'required',
                'numeric',
                'min:0',
            ],
        ], [
            'collectiontype_id.required' => 'نوع الإيراد مطلوب.',
            'collectiontype_id.exists' => 'نوع الإيراد المحدد غير صحيح.',
            'value.required' => 'قيمة الإيراد مطلوبة.',
            'value.numeric' => 'قيمة الإيراد يجب أن تكون رقمًا.',
            'value.min' => 'قيمة الإيراد لا يمكن أن تكون أقل من صفر.',
        ]);

        $collectionType = AllcollectionType::findOrFail(
            $validated['collectiontype_id']
        );

        $income = new Income();
        $income->collectiontype_id = $collectionType->id;

        /*
         * نستخدم القيمة الموجودة في نوع التحصيل.
         * وفي حالة عدم وجودها نستخدم القيمة القادمة من الفورم.
         */
        $income->value = $collectionType->value ?? $validated['value'];

        /*
         * هذا هو نفس المستخدم الذي ستتم إضافته
         * إلى استعلام DataTable حتى يظهر الإيراد.
         */
        $income->employee_id = auth()->id();

        $income->save();

        return redirect()
            ->route('incomes.index')
            ->with('success', 'تمت إضافة الإيراد بنجاح.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Delete income.
     */
    public function destroy($id): JsonResponse
    {
        $income = Income::findOrFail($id);

        $income->delete();

        return response()->json([
            'status' => true,
            'message' => 'تم حذف الإيراد بنجاح.',
        ]);
    }
}
