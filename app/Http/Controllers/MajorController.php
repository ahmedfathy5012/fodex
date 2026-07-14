<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Major;
use App\traits\generaltrait;
use App\DataTables\MajorDataTable;
use Illuminate\Support\Facades\File;

class MajorController extends Controller
{
    use generaltrait;

    private function majorView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.majors.$page"
            : "admindashboard.majors.V2.$page";
    }

    public function index(MajorDataTable $dataTable)
    {
        return $dataTable->render($this->majorView('index'));
    }

    public function create()
    {
        return view($this->majorView('create'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'هذا الحقل مطلوب',
        ]);

        $major = new Major;
        $major->title = $request->title;
        $major->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $this->uploadimage($request->image, 'majors');
            $major->image = $image;
        }

        $major->save();

        return redirect()->route('major.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $major = Major::where('id', $id)->first();

        return view($this->majorView('edit'))
            ->with('major', $major);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'هذا الحقل مطلوب',
        ]);

        $major = Major::where('id', $id)->first();

        $major->title = $request->title;
        $major->description = $request->description;

        if ($request->hasFile('image')) {
            File::delete(public_path() . '/uploads/' . $major->image);

            $image = $this->uploadimage($request->image, 'majors');
            $major->image = $image;
        }

        $major->save();

        return redirect()->route('major.index');
    }

    public function destroy($id)
    {
        $major = Major::where('id', $id)->first();

        File::delete(public_path() . '/uploads/' . $major->image);

        $major->delete();

        return response()->json([
            'status' => true,
        ]);
    }

    public function major_order(Request $request)
    {
        $major = Major::where('id', $request->major_id)->first();

        $major->order_number = $request->order_number;
        $major->save();

        return response()->json([
            'status' => true,
        ]);
    }
}
