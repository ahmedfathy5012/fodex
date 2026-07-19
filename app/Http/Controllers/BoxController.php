<?php

namespace App\Http\Controllers;

use App\traits\generaltrait;
use Illuminate\Http\Request;
use App\Models\BoxStatus;
use App\Models\Box;
use App\DataTables\BoxDataTable;
use Illuminate\Support\Facades\File;

class BoxController extends Controller
{
    use generaltrait;

    private function boxView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.boxs.$page"
            : "admindashboard.boxs.V2.$page";
    }

    public function index(BoxDataTable $dataTable)
    {
        return $dataTable->render($this->boxView('index'));
    }

    public function create()
    {
        $boxstatus = BoxStatus::all();

        return view($this->boxView('create'))
            ->with("boxstatus", $boxstatus);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'هذا الحقل مطلوب',
        ]);

        $box = new Box;
        $box->title = $request->title;
        $box->width = $request->width;
        $box->height = $request->height;
        $box->code = $request->code;


        if ($request->hasFile('image')) {
            $image = $this->uploadimage($request->image, 'boxs');
            $box->image = $image;
        }


        $box->boxstatus_id = $request->boxstatus_id;
        $box->save();

        return redirect()->route('boxs.index');
    }

    public function edit($id)
    {
        $box = Box::where('id', $id)->first();
        $boxstatus = BoxStatus::all();

        return view($this->boxView('edit'))
            ->with('boxstatus', $boxstatus)
            ->with("box", $box);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'هذا الحقل مطلوب',
        ]);

        $box = Box::where('id', $id)->first();
        $box->title = $request->title;
        $box->width = $request->width;
        $box->height = $request->height;
        $box->boxstatus_id = $request->boxstatus_id;
        $box->code = $request->code;

        if ($request->hasFile('image')) {
            if ($box->image) {
                File::delete(public_path() . '/uploads/' . $box->image);
            }

            $image = $this->uploadimage($request->image, 'boxs');
            $box->image = $image;
        }

        $box->save();

        return redirect()->route('boxs.index');
    }

    public function destroy($id)
    {
        $box = Box::where('id', $id)->first();
        $box->delete();

        return response()->json([
            'status' => true,
        ]);
    }
}
