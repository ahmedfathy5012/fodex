<?php

namespace App\Http\Controllers;

use App\DataTables\CountryDataTable;
use App\DataTables\CountryStateDataTable;
use App\Models\Coin;
use App\Models\Country;
use App\Models\CountryLatlon;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    private function countryView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.countries.$page"
            : "admindashboard.countries.V2.$page";
    }

    private function countryStateView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.countries.states.$page"
            : "admindashboard.countries.states.V2.$page";
    }

    public function index(CountryDataTable $dataTable)
    {
        return $dataTable->render($this->countryView('index'));
    }

    public function create()
    {
        $coins = Coin::all();

        return view($this->countryView('create'))->with('coins', $coins);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'هذا الحقل مطلوب',
        ]);

        $country = new Country;
        $country->name = $request->name;
        $country->code = $request->code;
        $country->coin_id = $request->coin_id;
        $country->lat = $request->lat;
        $country->lon = $request->lon;
        $country->text = $request->points;
        $country->save();

        if ($request->points) {
            foreach (json_decode($request->points) as $point) {
                $area = new CountryLatlon;
                $area->lat = $point->lat;
                $area->lon = $point->lng;
                $area->country_id = $country->id;
                $area->save();
            }
        }

        return redirect()->route('country.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $coins = Coin::all();
        $country = Country::where('id', $id)->first();

        return view($this->countryView('edit'))
            ->with('country', $country)
            ->with('coins', $coins);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'هذا الحقل مطلوب',
        ]);

        $country = Country::where('id', $id)->first();

        $country->name = $request->name;
        $country->lat = $request->lat;
        $country->lon = $request->lon;
        $country->code = $request->code;
        $country->coin_id = $request->coin_id;

        if ($request->points) {
            $country->text = $request->points;
        }

        $country->save();

        if ($request->points) {
            CountryLatlon::where('country_id', $id)->delete();

            foreach (json_decode($request->points) as $point) {
                $area = new CountryLatlon;
                $area->lat = $point->lat;
                $area->lon = $point->lng;
                $area->country_id = $country->id;
                $area->save();
            }
        }

        return redirect()->route('country.index');
    }

    public function destroy($id)
    {
        $country = Country::where('id', $id)->first();
        $country->delete();

        return response()->json(['status' => true]);
    }

    public function country_states(CountryStateDataTable $dataTable, $id)
    {
        $dataTable->id = $id;

        return $dataTable->render($this->countryStateView('index'));
    }
}
