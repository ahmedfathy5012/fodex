<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Box;
use App\Models\Driver;
use App\Models\BoxTake;
use App\DataTables\BoxTakeDataTable;

class BoxTakeController extends Controller
{
    private function boxTakeView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.boxtake.$page"
            : "admindashboard.boxtake.V2.$page";
    }

    public function index(BoxTakeDataTable $dataTable)
    {
        return $dataTable->render($this->boxTakeView('index'));
    }

    public function create()
    {
        $drivers = Driver::all();
        $boxs = Box::all();

        return view($this->boxTakeView('create'))
            ->with("boxs", $boxs)
            ->with("drivers", $drivers);
    }

    public function store(Request $request)
    {
        $box = new BoxTake;
        $box->driver_id = $request->driver_id;
        $box->box_id = $request->box_id;
        $box->notes = $request->notes;
        $box->save();

        return redirect()->route('boxtake.index');
    }
}
