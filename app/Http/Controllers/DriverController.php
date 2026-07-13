<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicletypes;
use App\Models\Gender;
use App\Models\Statussocial;
use App\Models\Armycase;
use App\Models\ExpenseDriver;
use App\Models\Expense;
use App\Models\AllCollection;
use App\Models\Income;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Zone;
use App\traits\generaltrait;
use App\Models\DriverContract;
use App\Http\Resources\DriverResource;
use App\DataTables\DriverDataTable;
use App\DataTables\DriverContractDataTable;
use App\DataTables\DriverordersDataTable;
use App\DataTables\NotcollectdriverDataTable;
use App\Models\Address;
use App\Models\Driver;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Events\DriverMoved;
use App\Events\GetOrder;

class DriverController extends Controller
{
    use generaltrait;

    private function driverView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.drivers.$page"
            : "admindashboard.drivers.V2.$page";
    }

    public function index(DriverDataTable $dataTable)
    {
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $zones = Zone::all();

        return $dataTable->render($this->driverView('index'), [
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities,
            'zones' => $zones
        ]);
    }

    public function create()
    {
        $armycases = Armycase::all();
        $statuss = Statussocial::all();
        $genders = Gender::all();
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $zones = Zone::all();
        $vtypes = Vehicletypes::all();

        return view($this->driverView('create'))
            ->with('genders', $genders)
            ->with('armycases', $armycases)
            ->with('statuss', $statuss)
            ->with('countries', $countries)
            ->with('states', $states)
            ->with('cities', $cities)
            ->with('zones', $zones)
            ->with('vtypes', $vtypes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|unique:drivers'
        ]);

        $driver = Driver::create([
            "name" => $request->name,
            "phone" => $request->phone,
            "mobile" => $request->mobile,
            "least_price" => $request->least_price,
            "commission" => $request->commission,
            "password" => Hash::make($request->phone)
        ]);

        $address = new Address;
        $address->country_id = $request->country_id;
        $address->state_id = $request->state_id;
        $address->city_id = $request->city_id;
        $address->zone_id = $request->zone_id;
        $address->floor_number = $request->floor_number;
        $address->building_number = $request->building_number;
        $address->lat = $request->lat;
        $address->lon = $request->lon;
        $address->street = $request->street;
        $address->driver_id = $driver->id;
        $address->save();

        return redirect()->route('driver.index');
    }

    public function show(DriverordersDataTable $dataTable, $id)
    {
        $driver = Driver::where('id', $id)->first();

        $dataTable->id = $id;

        $contract = DriverContract::where('driver_id', $id)
            ->where("active", 1)
            ->latest()
            ->first();

        return $dataTable->render($this->driverView('show'), [
            'driver' => $driver,
            'contract' => $contract
        ]);
    }

    public function edit($id)
    {
        $armycases = Armycase::all();
        $statuss = Statussocial::all();
        $genders = Gender::all();
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $zones = Zone::all();
        $vtypes = Vehicletypes::all();

        $driver = Driver::where('id', $id)->first();
        $address = Address::where('driver_id', $id)->first();
        $contract = DriverContract::where('driver_id', $id)->first();

        return view($this->driverView('edit'))
            ->with('genders', $genders)
            ->with('armycases', $armycases)
            ->with('statuss', $statuss)
            ->with('countries', $countries)
            ->with('states', $states)
            ->with('cities', $cities)
            ->with('zones', $zones)
            ->with('vtypes', $vtypes)
            ->with('driver', $driver)
            ->with('address', $address)
            ->with('contract', $contract);
    }

    public function update(Request $request, $id)
    {
        $driver = Driver::where('id', $id)->first();

        $password = $driver->password;

        $request->validate([
            'phone' => "required|unique:drivers,phone,$id"
        ]);

        if ($request->password) {
            $driver->password = Hash::make($request->password);
        } else {
            $driver->password = $password;
        }

        $driver->save();

        $driver->update([
            "name" => $request->name,
            "phone" => $request->phone,
            "mobile" => $request->mobile,
            "least_price" => $request->least_price,
            "commission" => $request->commission
        ]);

        $address = Address::where('driver_id', $id)->first();

        if (!$address) {
            $address = new Address;
        }

        $address->country_id = $request->country_id;
        $address->state_id = $request->state_id;
        $address->city_id = $request->city_id;
        $address->zone_id = $request->zone_id;
        $address->floor_number = $request->floor_number;
        $address->building_number = $request->building_number;
        $address->lat = $request->lat;
        $address->lon = $request->lon;
        $address->street = $request->street;
        $address->driver_id = $driver->id;
        $address->save();

        return redirect()->route('driver.index');
    }

    public function destroy($id)
    {
        $driver = Driver::where('id', $id)->first();
        $driver->delete();

        return response()->json([
            'status' => true
        ]);
    }

    public function drivercontracts(DriverContractDataTable $dataTable, $id)
    {
        $dataTable->id = $id;

        return $dataTable->render($this->driverView('contracts'), [
            'id' => $id
        ]);
    }

    public function adddrivercontract($id)
    {
        return view($this->driverView('adddrivercontract'))
            ->with('id', $id);
    }

    public function storedrivercontract(Request $request, $id)
    {
        DriverContract::where('driver_id', $id)->update([
            'active' => 0
        ]);

        $contract = new DriverContract;
        $contract->from_day = $request->from_day;
        $contract->to_day = $request->to_day;
        $contract->sallary = $request->sallary;
        $contract->notes = $request->notes;

        if ($request->hasFile('paper_contract_image')) {
            $image = $this->uploadimage($request->paper_contract_image, 'contracts');
            $contract->paper_contract_image = $image;
        }

        $contract->driver_id = $id;
        $contract->active = 1;
        $contract->save();

        return redirect('drivercontracts/' . $id);
    }

    public function editdrivercontract($id)
    {
        $contract = DriverContract::where('id', $id)->first();

        return view($this->driverView('editdrivercontract'))
            ->with('contract', $contract);
    }

    public function updatedrivercontract(Request $request, $id)
    {
        $contract = DriverContract::where('id', $id)->first();

        $contract->from_day = $request->from_day;
        $contract->to_day = $request->to_day;
        $contract->sallary = $request->sallary;
        $contract->notes = $request->notes;

        if ($request->hasFile('paper_contract_image')) {
            File::delete(public_path() . '/uploads/' . $contract->paper_contract_image);

            $image = $this->uploadimage($request->paper_contract_image, 'contracts');
            $contract->paper_contract_image = $image;
        }

        $contract->save();

        return redirect('drivercontracts/' . $contract->driver_id);
    }

    public function deletedrivercontract($id)
    {
        $contract = DriverContract::where('id', $id)->first();

        File::delete(public_path() . '/uploads/' . $contract->paper_contract_image);

        $contract->delete();

        return response()->json([
            'status' => true
        ]);
    }

    public function activedrivercontract($id)
    {
        $contract = DriverContract::where('id', $id)->first();

        if ($contract->active == 1) {
            $contract->active = 0;
            $contract->save();

            return response()->json([
                'status' => true,
                'message' => 'تم الغاء التفعيل'
            ]);
        } elseif ($contract->active == 0) {
            $contract->active = 1;
            $contract->save();

            return response()->json([
                'status' => true,
                'message' => 'تم  التفعيل'
            ]);
        }
    }

    public function notcollectdriver(NotcollectdriverDataTable $dataTable)
    {
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $zones = Zone::all();

        return $dataTable->render($this->driverView('notcollectdriver'), [
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities,
            'zones' => $zones
        ]);
    }

    public function adddriverexpense(Request $request)
    {
        $expenses = array_sum(ExpenseDriver::get()->pluck('value')->toArray()) +
            array_sum(ExpenseDriver::get()->pluck('value')->toArray()) +
            array_sum(Expense::get()->pluck('paid')->toArray());

        $allcolletions = array_sum(AllCollection::get()->pluck('money_taken')->toArray()) +
            array_sum(Income::get()->pluck('value')->toArray());

        $rest = $allcolletions - $expenses;

        if ($allcolletions > ($expenses + $request->value)) {
            $expense = ExpenseDriver::where('driver_id', $request->id)
                ->where('month_date', $request->date)
                ->first();

            if ($expense) {
                $expense->value += $request->value;
                $expense->money_left = ($expense->total + $expense->awards) - ($expense->value + $expense->discounts);
                $expense->save();
            } else {
                $driver = Driver::where('id', $request->id)->first();

                $orders = $driver->acceptorders()
                    ->whereYear('created_at', \Carbon\Carbon::parse($request->date))
                    ->whereMonth('created_at', \Carbon\Carbon::parse($request->date))
                    ->get();

                $expense = new ExpenseDriver;
                $expense->value = $request->value;
                $expense->driver_id = $request->id;
                $expense->total = $request->total;
                $expense->month_date = $request->date;
                $expense->awards = $request->awards;
                $expense->discounts = $request->discounts;
                $expense->ordersnumber = count($orders);
                $expense->money_left = ($request->total + $request->awards) - ($request->value + $request->discounts);
                $expense->save();
            }

            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }

    public function driversmap()
    {
        $drivers = Driver::get();
        $drivers = DriverResource::collection($drivers);

        return view($this->driverView('driversmap'), compact("drivers"));
    }

    public function alldrivers()
    {
        $drivers = Driver::get();

        return response()->json([
            'status' => true,
            "data" => DriverResource::collection($drivers)
        ]);
    }

    public function move()
    {
        // event(new DriverMoved(30.899179528367632,31.303097083010904,"esraa"));
        // event(new GetOrder("message","esraa"));
    }

    public function driver_map($id)
    {
        $driver = Driver::where('id', $id)->first();

        return view($this->driverView('driver_map'), compact("driver"));
    }

    public function get_driver($id)
    {
        $drivers = Driver::where("id", $id)->get();

        return response()->json([
            'status' => true,
            "data" => DriverResource::collection($drivers)
        ]);
    }
}
