<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Box;
use App\Models\Driver;
use App\Models\BoxDeliver;
use App\DataTables\BoxDeliverDataTable;

class BoxDeliverController extends Controller
{
    private function boxDeliverView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.boxdeliver.$page"
            : "admindashboard.boxdeliver.V2.$page";
    }

    public function index(BoxDeliverDataTable $dataTable)
    {
        return $dataTable->render($this->boxDeliverView('index'));
    }

    public function create()
    {
        $drivers = Driver::all();
        $boxs = Box::all();

        return view($this->boxDeliverView('create'))
            ->with("boxs", $boxs)
            ->with("drivers", $drivers);
    }

    public function store(Request $request)
    {
        $box = new BoxDeliver;
        $box->driver_id = $request->driver_id;
        $box->box_id = $request->box_id;
        $box->notes = $request->notes;
        $box->save();

        return redirect()->route('boxdeliver.index');
    }
}
