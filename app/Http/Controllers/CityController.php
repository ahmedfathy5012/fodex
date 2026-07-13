<?php

namespace App\Http\Controllers;

use App\DataTables\CityDataTable;
use App\DataTables\CityZoneDataTable;
use App\Models\City;
use App\Models\CityLatlon;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class CityController extends Controller
{
    private function cityView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.cities.$page"
            : "admindashboard.cities.V2.$page";
    }

    private function cityZoneView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.cities.zones.$page"
            : "admindashboard.cities.zones.V2.$page";
    }

    public function index(CityDataTable $dataTable)
    {
        return $dataTable->render($this->cityView('index'));
    }

    public function create()
    {
        $countries = Country::all();
        $states = State::all();

        return view($this->cityView('create'))
            ->with('countries', $countries)
            ->with('states', $states);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'هذا الحقل مطلوب',
        ]);

        $city = new City;
        $city->name = $request->name;
        $city->country_id = $request->country_id;
        $city->state_id = $request->state_id;
        $city->text = $request->points;
        $city->save();

        if ($request->points) {
            foreach (json_decode($request->points) as $point) {
                $area = new CityLatlon;
                $area->lat = $point->lat;
                $area->lon = $point->lng;
                $area->city_id = $city->id;
                $area->save();
            }
        }

        return redirect()->route('city.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $countries = Country::all();
        $states = State::all();
        $city = City::where('id', $id)->first();

        return view($this->cityView('edit'))
            ->with('countries', $countries)
            ->with('states', $states)
            ->with('city', $city);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'هذا الحقل مطلوب',
        ]);

        $city = City::where('id', $id)->first();
        $city->name = $request->name;
        $city->country_id = $request->country_id;
        $city->state_id = $request->state_id;

        if ($request->points) {
            $city->text = $request->points;
        }

        $city->save();

        if ($request->points) {
            CityLatlon::where('city_id', $id)->delete();

            foreach (json_decode($request->points) as $point) {
                $area = new CityLatlon;
                $area->lat = $point->lat;
                $area->lon = $point->lng;
                $area->city_id = $city->id;
                $area->save();
            }
        }

        return redirect()->route('city.index');
    }

    public function destroy($id)
    {
        $city = City::where('id', $id)->first();
        $city->delete();

        return response()->json(['status' => true]);
    }

    public function city_zones(CityZoneDataTable $dataTable, $id)
    {
        $dataTable->id = $id;

        return $dataTable->render($this->cityZoneView('index'));
    }
}
