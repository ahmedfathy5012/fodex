<?php

namespace App\Http\Controllers;

use App\DataTables\OrderItemSellerDataTable;
use App\DataTables\Seller3DataTable;
use App\DataTables\SellerCentralDataTable;
use App\DataTables\SellercontractDataTable;
use App\DataTables\SellerDataTable;
use App\Models\Address;
use App\Models\AllCollection;
use App\Models\Armycase;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Major;
use App\Models\NumberSetting;
use App\Models\Payment;
use App\Models\Seller;
use App\Models\Sellercontract;
use App\Models\SellerEmployee;
use App\Models\Sellerimage;
use App\Models\State;
use App\Models\Tag;
use App\Models\WebsiteSeller;
use App\Models\Zone;
use App\traits\generaltrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    use generaltrait;

    public function index(SellerDataTable $dataTable, bool $is_central = false)
    {

        $create_route = $is_central ? route('seller.add_central') : route('seller.create');

        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $zones = Zone::all();

        $data = [
            'create_route' => $create_route,
            'is_central' => $is_central,
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities,
            'zones' => $zones,
        ];
        return $dataTable->render('admindashboard.sellers.index', $data);
    }

    public function central_index(SellerCentralDataTable $dataTable)
    {

        $create_route = route('seller.add_central');

        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $zones = Zone::all();

        $data = [
            'create_route' => $create_route,
            'is_central' => true,
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities,
            'zones' => $zones,
        ];
        return $dataTable->render('admindashboard.sellers.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function create()
    {
        $is_central = request()->routeIs('seller.add_central');
        $armycases = Armycase::all();

        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $zones = Zone::all();
        $majors = Major::all();
        $tags = Tag::all();
        $payments = Payment::all();
        $number = NumberSetting::first();
        $categories = Category::all();
        $data = [
            'is_central' => $is_central,
            'armycases' => $armycases,
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities,
            'zones' => $zones,
            'majors' => $majors,
            'tags' => $tags,
            'payments' => $payments,
            'number' => $number,
            'categories' => $categories,
            'title' => $is_central ? __('messages.add_central_seller') : __('messages.add_seller')
        ];
        if (env('APP_ENV') == 'production') {
            return view('admindashboard.sellers.create', $data);
        } else {
            return view('admindashboard.sellers.V2.create', $data);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $is_central = boolval($request->is_central) ?? false;

        $request->validate([
            'phone' => 'required|unique:sellers',
            'cover' => 'nullable|image|max:10240', // 10MB
            'logo' => 'nullable|image|max:10240',  // 10MB
            'image.*' => 'nullable|image|max:10240', // 10MB each
            'from_day' => 'required|date',
            'to_day' => 'required|date|after_or_equal:from_day',
            'percentage' => 'required|numeric',
            'paper_contract_image' => 'required|mimes:jpg,jpeg,png,gif,webp,pdf|max:10240', // 10MB, image or PDF
            'major_id' => 'required|exists:majors,id',
            'country_id' => 'required|exists:countries,id',
            // The cascading dropdowns fall back to a "الكل" (All) option with value 0 when
            // the admin doesn't reselect after changing a parent field; 0 never exists.
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'zone_id' => 'required|exists:zones,id',
        ]);

        $request->merge(['is_central' => $is_central]);

        // Normalize discount_type to integer (1 = fixed amount, 0 = percentage)
        $dt = $request->input('discount_type');
        $norm_dt = 0;
        if (!is_null($dt)) {
            if (is_numeric($dt)) {
                $norm_dt = intval($dt);
            } else {
                $norm_dt = (strtolower($dt) === 'amount') ? 1 : 0;
            }
        }
        $request->merge(['discount_type' => $norm_dt]);

        DB::transaction(function () use ($request) {
            $seller = Seller::create($request->all());
            $seller->password = Hash::make($request->password);
            $seller->discount = $request->discount;
            $seller->delivery_phone = $request->delivery_phone;
            $seller->discount_type = (int) $request->discount_type;
            $seller->delivery_money = $request->delivery_money;
            $seller->min_order = $request->min_order;
            $seller->is_new = $request->is_new ? 1 : 0;

            $seller->agreed = $request->agreed ? 1 : 0;
            $seller->is_subcategory = $request->is_subcategory;
            if ($request->hasFile('cover')) {
                $cover = $this->uploadimage($request->cover, 'sellers');
                $seller->cover = $cover;
            }
            if ($request->hasFile('logo')) {

                $logo = $this->uploadimage($request->logo, 'sellers');
                $seller->logo = $logo;
            }
            $seller->save();
            if ($request->image) {
                foreach ($request->image as $image) {
                    $sellerimage = new Sellerimage;
                    $newimage = $this->uploadimage($image, 'sellers');
                    $sellerimage->image = $newimage;
                    $sellerimage->seller_id = $seller->id;
                    $seller->save();
                }
            }
            $major = Major::where('id', $request->major_id)->first();

            $seller->categories()->attach($major->categories()->pluck('id')->toArray());

            if ($request->tag_id) {
                $seller->tags()->attach($request->tag_id);
            }

            if ($request->payment_id) {
                $seller->payments()->attach($request->payment_id);
            }
            $address = new Address;
            $address->country_id = $request->country_id;
            $address->state_id = $request->state_id;
            $address->city_id = $request->city_id;
            $address->zone_id = $request->zone_id;
            // $address->floor_number = $request->floor_number;
            // $address->building_number = $request->building_number;
            $address->lat = $request->lat;
            $address->lon = $request->lon;
            $address->street = $request->street;
            $address->address = $request->address;
            $address->seller_id = $seller->id;
            $address->save();
            $employee = new SellerEmployee;
            $employee->name = $request->name;
            $employee->phone = $request->phone;
            $employee->password = Hash::make($request->phone);
            $employee->seller_id = $seller->id;
            $employee->save();
            $contract = new Sellercontract;
            $contract->from_day = $request->from_day;
            $contract->to_day = $request->to_day;
            $contract->percentage = $request->percentage;
            $contract->notes = $request->notes;
            if ($request->hasFile('paper_contract_image')) {
                $image = $this->uploadimage($request->paper_contract_image, 'contracts');
                $contract->paper_contract_image = $image;
            }
            $contract->seller_id = $seller->id;
            $contract->active = 1;
            $contract->save();
        });
        $index_route = $is_central ? 'seller.central_index' : 'seller.index';

        return redirect()->route($index_route)->with('success', 'Seller created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(SellercontractDataTable $dataTable, $id)
    {
        $seller = Seller::where('id', $id)->first();
        $dataTable->id = $id;
        return $dataTable->render('admindashboard.sellers.show', ['seller' => $seller]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $armycases = Armycase::all();

        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $zones = Zone::all();
        $majors = Major::all();
        $tags = Tag::all();
        $payments = Payment::all();
        $categories = Category::all();
        $seller = Seller::where('id', $id)->first();
        $address = Address::where('seller_id', $id)->first();
        $contract = Sellercontract::where('seller_id', $id)->first();
        $view = env('APP_ENV') == 'production' ? 'admindashboard.sellers.edit' : 'admindashboard.sellers.V2.edit';
        return view($view)->with('countries', $countries)->with('tags', $tags)
            ->with('states', $states)->with('cities', $cities)->with('zones', $zones)->with('majors', $majors)
            ->with('categories', $categories)->with('seller', $seller)->with('address', $address)->with('contract', $contract)
            ->with('payments', $payments);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'phone' => "required|unique:sellers,phone,$id",
            'major_id' => 'required|exists:majors,id',
            'country_id' => 'required|exists:countries,id',
            // The cascading dropdowns fall back to a "الكل" (All) option with value 0 when
            // the admin doesn't reselect after changing a parent field; 0 never exists.
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'zone_id' => 'required|exists:zones,id',
        ]);

        $major = Major::where('id', $request->major_id)->first();
        $seller = Seller::where('id', $id)->first();
        $password = $seller->password;

        // Normalize discount_type to integer before updating (1 = fixed amount, 0 = percentage)
        $dt = $request->input('discount_type');
        $norm_dt = 0;
        if (!is_null($dt)) {
            if (is_numeric($dt)) {
                $norm_dt = intval($dt);
            } else {
                $norm_dt = (strtolower($dt) === 'amount') ? 1 : 0;
            }
        }
        $request->merge(['discount_type' => $norm_dt]);

        DB::transaction(function () use ($request, $seller, $major, $id, $password) {
            $seller = $seller->update($request->all());
            $seller = Seller::where('id', $id)->first();
            if ($request->password) {
                $seller->password = Hash::make($request->password);
            } else {
                $seller->password = $password;
            }
            $seller->discount = $request->discount;
            $seller->is_subcategory = $request->is_subcategory;
            $seller->delivery_money = $request->delivery_money;
            $seller->min_order = $request->min_order;
            $seller->is_new = $request->is_new ? 1 : 0;

            $seller->discount_type = (int) $request->discount_type;
            $seller->agreed = $request->agreed ? 1 : 0;
            $seller->save();
            if ($request->hasFile('cover')) {
                File::delete(public_path() . '/uploads/' . $seller->cover);
                $image = $this->uploadimage($request->cover, 'sellers');
                $seller->cover = $image;
            }
            if ($request->hasFile('logo')) {
                File::delete(public_path() . '/uploads/' . $seller->logo);
                $image = $this->uploadimage($request->logo, 'sellers');
                $seller->logo = $image;
            }
            $seller->save();
            if ($request->image) {
                if (count($seller->images) > 0) {
                    foreach ($seller->images as $im) {
                        File::delete(public_path() . '/uploads/' . $im->image);
                    }
                }
                foreach ($request->image as $image) {

                    $sellerimage = new Sellerimage;
                    $newimage = $this->uploadimage($image, 'sellers');
                    $sellerimage->image = $newimage;
                    $sellerimage->seller_id = $seller->id;
                    $sellerimage->save();
                }
            }
            $seller->categories()->sync($major->categories()->pluck('id')->toArray());
            $seller->tags()->sync($request->tag_id);
            if ($request->payment_id) {
                $seller->payments()->sync($request->payment_id);
            }
            $address = Address::where('seller_id', $seller->id)->firstOrNew();
            $address->country_id = $request->country_id;
            $address->state_id = $request->state_id;
            $address->city_id = $request->city_id;
            $address->zone_id = $request->zone_id;
            $address->floor_number = $request->floor_number;
            $address->building_number = $request->building_number;
            $address->lat = $request->lat;
            $address->lon = $request->lon;
            $address->address = $request->address;
            $address->street = $request->street;
            $address->seller_id = $seller->id;
            $address->save();
        });
        //      $contract =  Sellercontract::where('seller_id',$seller->id)->first();
        //      $contract->from_day = $request->from_day;
        //       $contract->to_day = $request->to_day;

        //      $contract->percentage = $request->percentage;
        //      $contract->notes = $request->notes;
        //      if($request->hasFile('paper_contract_image'))
        //     {
        //   File::delete(public_path(). '/uploads/'.$contract->paper_contract_image);
        //         $image = $this->uploadimage($request->paper_contract_image,'contracts');
        //         $contract->paper_contract_image = $image;
        //     }
        //      $contract->seller_id = $seller->id;
        //     $contract->save();
        return redirect()->route('seller.index')->with('success', 'Seller updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $seller = Seller::where('id', $id)->first();
        if (count($seller->images) > 0) {
            foreach ($seller->images as $im) {
                File::delete(public_path() . '/uploads/' . $im->image);
            }
        }
        $seller->address()->delete();
        $seller->delete();
        return response()->json(['status' => true]);
    }

    public function blockseller(Request $request)
    {
        $seller = Seller::where('id', $request->id)->first();
        if ($seller->block == 1) {
            $seller->block = 0;
            $seller->save();
        } else {
            $seller->block = 1;
            $seller->block_reason = $request->block_reason;
            $seller->save();
        }
        return response()->json(['status' => true]);
    }

    public function openseller($id)
    {
        $seller = Seller::where('id', $id)->first();

        $seller->availability = !$seller->availability;
        $seller->save();
        return response()->json(['status' => true]);
    }

    public function sellercontracts(SellercontractDataTable $dataTable, $id)
    {
        $dataTable->id = $id;
        return $dataTable->render('admindashboard.sellers.contracts', ['id' => $id]);
    }

    public function addsellercontract($id)
    {
        return view('admindashboard.sellers.addsellercontract')->with('id', $id);
    }

    public function storesellercontract(Request $request, $id)
    {
        Sellercontract::where('seller_id', $id)->update(['active' => 0]);
        $contract = new Sellercontract;
        $contract->from_day = $request->from_day;
        $contract->to_day = $request->to_day;

        $contract->percentage = $request->percentage;
        $contract->notes = $request->notes;
        if ($request->hasFile('paper_contract_image')) {

            $image = $this->uploadimage($request->paper_contract_image, 'contracts');
            $contract->paper_contract_image = $image;
        }
        $contract->seller_id = $id;
        $contract->active = 1;
        $contract->save();
        return redirect('sellercontracts/' . $id);
    }

    public function editsellercontract($id)
    {
        $contract = Sellercontract::where('id', $id)->first();
        return view('admindashboard.sellers.editsellercontract')->with('contract', $contract);
    }

    public function updatesellercontract(Request $request, $id)
    {
        $contract = Sellercontract::where('id', $id)->first();
        $contract->from_day = $request->from_day;
        $contract->to_day = $request->to_day;

        $contract->percentage = $request->percentage;
        $contract->notes = $request->notes;
        if ($request->hasFile('paper_contract_image')) {
            File::delete(public_path() . '/uploads/' . $contract->paper_contract_image);
            $image = $this->uploadimage($request->paper_contract_image, 'contracts');
            $contract->paper_contract_image = $image;
        }

        $contract->save();

        return redirect('sellercontracts/' . $contract->seller_id);
    }

    public function deletesellercontract($id)
    {
        $contract = Sellercontract::where('id', $id)->first();
        File::delete(public_path() . '/uploads/' . $contract->paper_contract_image);
        $contract->delete();
        return response()->json(['status' => true]);
    }

    public function activesellercontract($id)
    {
        $contract = Sellercontract::where('id', $id)->first();
        if ($contract->active == 1) {
            $contract->active = 0;
            $contract->save();
            return response()->json(['status' => true, 'message' => 'تم الغاء التفعيل']);
        } elseif ($contract->active == 0) {
            $contract->active = 1;
            $contract->save();
            return response()->json(['status' => true, 'message' => 'تم  التفعيل']);
        }
    }

    public function addcollection(Request $request)
    {
        $res = Seller::where('id', $request->id)->first();
        $collect = AllCollection::where('seller_id', $request->id)->where('month_date', $request->date)
            ->first();
        if ($collect) {
            $collect->money_left = $collect->total - ($collect->money_taken + $request->value);
            $collect->money_taken = $collect->money_taken + $request->value;
            $collect->save();
            return response()->json(['status' => true, 'message' => 'تم التحصيل بنجاح']);
        } else {
            //     dd($request->all());
            $orders = $res->acceptorders()->whereYear('orders.created_at', Carbon::parse($request->date))
                ->whereMonth('orders.created_at', Carbon::parse($request->date))->get();
            //   ->whereMonth('orders.created_at',$date3)->get();

            //   ->where('order_status_id',7)->whereYear('orders.created_at',$date3)
            //   ->whereMonth('orders.created_at',$date3)->get();
            $countorders = count($orders);
            $money = array_sum($res->orders()->where('status', 1)->whereYear('orders.created_at', Carbon::parse($request->date))
                    ->whereMonth('orders.created_at', Carbon::parse($request->date))->get()->pluck('priceafterdiscount')->toArray()) -
                array_sum($res->orders()->where('status', 1)->whereYear('orders.created_at', Carbon::parse($request->date))
                    ->whereMonth('orders.created_at', Carbon::parse($request->date))->get()->pluck('delivery_fee')->toArray());
            $contract = Sellercontract::where('seller_id', $request->id)->where('active', 1)->latest()->first();


            $value = $money * ($contract->percentage / 100);
            $collect = new AllCollection;
            $collect->seller_id = $request->id;
            $collect->total = $value;
            $collect->ordersnumber = $countorders;
            $collect->money_taken = $request->value;
            $collect->month_date = $request->date;
            $collect->money_left = $value - $request->value;
            $collect->save();
            return response()->json(['status' => true, 'message' => 'تم التحصيل بنجاح']);
        }
    }

    public function notcollectsellers(Seller3DataTable $dataTable)
    {
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $zones = Zone::all();
        return $dataTable->render('admindashboard.sellers.notcollectsellers', ['countries' => $countries, 'states' => $states, 'cities' => $cities, 'zones' => $zones]);
    }

    public function orderitemseller(OrderItemSellerDataTable $dataTable, $id)
    {
        $dataTable->id = $id;
        return $dataTable->render('admindashboard.sellers.orderitemseller');
    }

    public function choose_seller_website($id)
    {
        $seller = WebsiteSeller::where('seller_id', $id)->first();
        if ($seller) {
            $seller->delete();
        } else {
            WebsiteSeller::create([
                "seller_id" => $id
            ]);
        }
        return response()->json(['status' => true]);
    }
}
