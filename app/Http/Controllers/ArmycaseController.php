<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Armycase;
use App\DataTables\ArmycaseDataTable;

class ArmycaseController extends Controller
{
    private function armycaseView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.armycases.$page"
            : "admindashboard.armycases.V2.$page";
    }

    public function index(ArmycaseDataTable $dataTable)
    {
        return $dataTable->render($this->armycaseView('index'));
    }

    public function create()
    {
        return view($this->armycaseView('create'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'هذا الحقل مطلوب',
        ]);

        $army = new Armycase;
        $army->title = $request->title;
        $army->save();

        return redirect()->route('armycase.index');
    }

    public function edit($id)
    {
        $army = Armycase::where('id', $id)->first();

        return view($this->armycaseView('edit'))
            ->with('army', $army);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'هذا الحقل مطلوب',
        ]);

        $army = Armycase::where('id', $id)->first();
        $army->title = $request->title;
        $army->save();

        return redirect()->route('armycase.index');
    }

    public function destroy($id)
    {
        $army = Armycase::where('id', $id)->first();
        $army->delete();

        return response()->json([
            'status' => true,
        ]);
    }
}
