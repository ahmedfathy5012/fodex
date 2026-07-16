<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\Day;
use App\Models\Workschedule;
use App\DataTables\WorkscheduleDataTable;

class WorkscheduleController extends Controller
{
    private function workscheduleView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.workschedules.$page"
            : "admindashboard.workschedules.V2.$page";
    }

    public function index(WorkscheduleDataTable $dataTable)
    {
        return $dataTable->render($this->workscheduleView('index'));
    }

    public function create()
    {
        $sellers = Seller::all();
        $days = Day::all();

        return view($this->workscheduleView('create'))
            ->with('sellers', $sellers)
            ->with('days', $days);
    }

    public function store(Request $request)
    {
        foreach ($request->day_id as $key => $value) {
            $worksc = new Workschedule;
            $worksc->seller_id = $request->seller_id;
            $worksc->work_from = $request->from[$key];
            $worksc->work_to = $request->to[$key];
            $worksc->day_id = $value;
            $worksc->save();
        }

        return redirect()->route('workschedule.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $sellers = Seller::all();
        $days = Day::all();
        $work = Workschedule::where('id', $id)->first();

        return view($this->workscheduleView('edit'))
            ->with('sellers', $sellers)
            ->with('days', $days)
            ->with('work', $work);
    }

    public function update(Request $request, $id)
    {
        $worksc = Workschedule::where('id', $id)->first();
        $worksc->seller_id = $request->seller_id;
        $worksc->work_from = $request->from;
        $worksc->work_to = $request->to;
        $worksc->day_id = $request->day_id;
        $worksc->save();

        return redirect()->route('workschedule.index');
    }

    public function destroy($id)
    {
        $worksc = Workschedule::where('id', $id)->first();
        $worksc->delete();

        return response()->json([
            'status' => true,
        ]);
    }
}
