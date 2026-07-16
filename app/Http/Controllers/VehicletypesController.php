<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicletypes;
use App\DataTables\VehicletypesDataTable;

class VehicletypesController extends Controller
{
    private function vehicletypesView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.vehicletypes.$page"
            : "admindashboard.vehicletypes.V2.$page";
    }

    public function index(VehicletypesDataTable $dataTable)
    {
        return $dataTable->render($this->vehicletypesView('index'));
    }

    public function create()
    {
        return view($this->vehicletypesView('create'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'هذا الحقل مطلوب',
        ]);

        $type = new Vehicletypes;
        $type->title = $request->title;
        $type->save();

        return redirect()->route('vehicletypes.index');
    }

    public function edit($id)
    {
        $type = Vehicletypes::where('id', $id)->first();

        return view($this->vehicletypesView('edit'))
            ->with('type', $type);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'هذا الحقل مطلوب',
        ]);

        $type = Vehicletypes::where('id', $id)->first();
        $type->title = $request->title;
        $type->save();

        return redirect()->route('vehicletypes.index');
    }

    public function destroy($id)
    {
        $type = Vehicletypes::where('id', $id)->first();
        $type->delete();

        return response()->json([
            'status' => true,
        ]);
    }
}
