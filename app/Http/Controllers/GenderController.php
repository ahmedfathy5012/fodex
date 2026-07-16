<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gender;
use App\DataTables\GenderDataTable;

class GenderController extends Controller
{
    private function genderView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.gender.$page"
            : "admindashboard.gender.V2.$page";
    }

    public function index(GenderDataTable $dataTable)
    {
        return $dataTable->render($this->genderView('index'));
    }

    public function create()
    {
        return view($this->genderView('create'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'هذا الحقل مطلوب',
        ]);

        $gender = new Gender;
        $gender->title = $request->title;
        $gender->save();

        return redirect()->route('gender.index');
    }

    public function edit($id)
    {
        $gender = Gender::where('id', $id)->first();

        return view($this->genderView('edit'))
            ->with('gender', $gender);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'هذا الحقل مطلوب',
        ]);

        $gender = Gender::where('id', $id)->first();
        $gender->title = $request->title;
        $gender->save();

        return redirect()->route('gender.index');
    }

    public function destroy($id)
    {
        $gender = Gender::where('id', $id)->first();
        $gender->delete();

        return response()->json([
            'status' => true,
        ]);
    }
}
