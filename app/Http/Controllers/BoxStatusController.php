<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoxStatus;
use App\DataTables\BoxStatusDataTable;

class BoxStatusController extends Controller
{
    private function boxStatusView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.boxstatus.$page"
            : "admindashboard.boxstatus.V2.$page";
    }

    public function index(BoxStatusDataTable $dataTable)
    {
        return $dataTable->render($this->boxStatusView('index'));
    }

    public function create()
    {
        return view($this->boxStatusView('create'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'هذا الحقل مطلوب',
        ]);

        $boxstatus = new BoxStatus;
        $boxstatus->title = $request->title;
        $boxstatus->save();

        return redirect()->route('boxstatus.index');
    }

    public function edit($id)
    {
        $boxstatus = BoxStatus::where('id', $id)->first();

        return view($this->boxStatusView('edit'))
            ->with('boxstatus', $boxstatus);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'هذا الحقل مطلوب',
        ]);

        $boxstatus = BoxStatus::where('id', $id)->first();
        $boxstatus->title = $request->title;
        $boxstatus->save();

        return redirect()->route('boxstatus.index');
    }

    public function destroy($id)
    {
        $boxstatus = BoxStatus::where('id', $id)->first();
        $boxstatus->delete();

        return response()->json([
            'status' => true,
        ]);
    }
}
