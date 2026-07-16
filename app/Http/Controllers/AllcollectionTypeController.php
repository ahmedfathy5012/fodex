<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AllcollectionType;
use App\DataTables\AllcollectionTypeDataTable;

class AllcollectionTypeController extends Controller
{
    private function collectionTypeView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.collectionstypes.$page"
            : "admindashboard.collectionstypes.V2.$page";
    }

    public function index(AllcollectionTypeDataTable $dataTable)
    {
        return $dataTable->render($this->collectionTypeView('index'));
    }

    public function create()
    {
        return view($this->collectionTypeView('create'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'هذا الحقل مطلوب',
        ]);

        $collect = new AllcollectionType;
        $collect->name = $request->name;
        $collect->value = $request->value;
        $collect->save();

        return redirect()->route('collectionstypes.index');
    }

    public function edit($id)
    {
        $collect = AllcollectionType::where('id', $id)->first();

        return view($this->collectionTypeView('edit'))
            ->with('collect', $collect);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'هذا الحقل مطلوب',
        ]);

        $collect = AllcollectionType::where('id', $id)->first();
        $collect->name = $request->name;
        $collect->value = $request->value;
        $collect->save();

        return redirect()->route('collectionstypes.index');
    }

    public function destroy($id)
    {
        $collect = AllcollectionType::where('id', $id)->first();
        $collect->delete();

        return response()->json([
            'status' => true,
        ]);
    }
}
