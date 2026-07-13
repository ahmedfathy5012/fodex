<?php

namespace App\Http\Controllers;

use App\DataTables\StateCityDataTable;
use App\DataTables\StateDataTable;
use App\Models\Country;
use App\Models\State;
use App\Models\StateLatlon;
use Illuminate\Http\Request;

class StateController extends Controller
{
    private function stateView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.states.$page"
            : "admindashboard.states.V2.$page";
    }

    private function stateCityView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.states.cities.$page"
            : "admindashboard.states.cities.V2.$page";
    }

    public function index(StateDataTable $dataTable)
    {
        return $dataTable->render($this->stateView('index'));
    }

    public function create()
    {
        $countries = Country::all();

        return view($this->stateView('create'))->with('countries', $countries);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'هذا الحقل مطلوب',
        ]);

        $state = new State;
        $state->name = $request->name;
        $state->country_id = $request->country_id;
        $state->lat = $request->lat;
        $state->lon = $request->lon;
        $state->text = $request->points;
        $state->save();

        if ($request->points) {
            foreach (json_decode($request->points) as $point) {
                $area = new StateLatlon;
                $area->lat = $point->lat;
                $area->lon = $point->lng;
                $area->state_id = $state->id;
                $area->save();
            }
        }

        return redirect()->route('state.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $countries = Country::all();
        $state = State::where('id', $id)->first();

        return view($this->stateView('edit'))
            ->with('countries', $countries)
            ->with('state', $state);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'هذا الحقل مطلوب',
        ]);

        $state = State::where('id', $id)->first();
        $state->name = $request->name;
        $state->country_id = $request->country_id;
        $state->lat = $request->lat;
        $state->lon = $request->lon;

        if ($request->points) {
            $state->text = $request->points;
        }

        $state->save();

        if ($request->points) {
            StateLatlon::where('state_id', $id)->delete();

            foreach (json_decode($request->points) as $point) {
                $area = new StateLatlon;
                $area->lat = $point->lat;
                $area->lon = $point->lng;
                $area->state_id = $state->id;
                $area->save();
            }
        }

        return redirect()->route('state.index');
    }

    public function destroy($id)
    {
        $state = State::where('id', $id)->first();
        $state->delete();

        return response()->json(['status' => true]);
    }

    public function state_cities(StateCityDataTable $dataTable, $id)
    {
        $dataTable->id = $id;

        return $dataTable->render($this->stateCityView('index'));
    }
}
