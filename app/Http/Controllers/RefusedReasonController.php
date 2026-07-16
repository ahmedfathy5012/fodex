<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RefusedReason;
use App\DataTables\RefusedReasonDataTable;

class RefusedReasonController extends Controller
{
    private function refusedReasonView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.refusedreasons.$page"
            : "admindashboard.refusedreasons.V2.$page";
    }

    public function index(RefusedReasonDataTable $dataTable)
    {
        return $dataTable->render($this->refusedReasonView('index'));
    }

    public function create()
    {
        return view($this->refusedReasonView('create'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required',
        ], [
            'text.required' => 'هذا الحقل مطلوب',
        ]);

        $reason = new RefusedReason;
        $reason->text = $request->text;
        $reason->save();

        return redirect()->route('refusedreasons.index');
    }

    public function edit($id)
    {
        $reason = RefusedReason::where('id', $id)->first();

        return view($this->refusedReasonView('edit'))
            ->with('reason', $reason);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'text' => 'required',
        ], [
            'text.required' => 'هذا الحقل مطلوب',
        ]);

        $reason = RefusedReason::where('id', $id)->first();
        $reason->text = $request->text;
        $reason->save();

        return redirect()->route('refusedreasons.index');
    }

    public function destroy($id)
    {
        $reason = RefusedReason::where('id', $id)->first();
        $reason->delete();

        return response()->json([
            'status' => true,
        ]);
    }
}
