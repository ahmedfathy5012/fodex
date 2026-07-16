<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statussocial;
use App\DataTables\StatussocialDataTable;

class StatussocialsController extends Controller
{
    private function statussocialView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.statussocials.$page"
            : "admindashboard.statussocials.V2.$page";
    }

    public function index(StatussocialDataTable $dataTable)
    {
        return $dataTable->render($this->statussocialView('index'));
    }

    public function create()
    {
        return view($this->statussocialView('create'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'هذا الحقل مطلوب',
        ]);

        $status = new Statussocial;
        $status->title = $request->title;
        $status->save();

        return redirect()->route('statussocials.index');
    }

    public function edit($id)
    {
        $status = Statussocial::where('id', $id)->first();

        return view($this->statussocialView('edit'))
            ->with('status', $status);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'هذا الحقل مطلوب',
        ]);

        $status = Statussocial::where('id', $id)->first();
        $status->title = $request->title;
        $status->save();

        return redirect()->route('statussocials.index');
    }

    public function destroy($id)
    {
        $status = Statussocial::where('id', $id)->first();
        $status->delete();

        return response()->json([
            'status' => true,
        ]);
    }
}
