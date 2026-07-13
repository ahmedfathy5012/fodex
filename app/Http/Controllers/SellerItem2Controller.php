<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\ItemImage;
use App\Models\Size;
use App\Models\Category;
use App\Models\Extra;
use App\Models\Seller;
use App\traits\generaltrait;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\DataTables\Item2DataTable;
use App\DataTables\SellerItemDataTable;
use App\Models\Extradetail;
use App\Scopes\CentralRestaurantVisibilityScope;

class SellerItem2Controller extends Controller
{
    use generaltrait;

    private function sellerItemView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.seller_items.$page"
            : "admindashboard.seller_items.V2.$page";
    }

    public function index(SellerItemDataTable $dataTable, $id)
    {
        $seller = Seller::where('id', $id)->first();

        $dataTable->id = $id;

        $create_route = route('create_seller_items', $id);

        return $dataTable->render($this->sellerItemView('index'), [
            'seller' => $seller,
            'create_route' => $create_route,
        ]);
    }

    public function create($id)
    {
        $seller = Seller::where('id', $id)->first();
        $categories = $seller->categories;
        $store_route = route('store_seller_items', $seller->id);

        $data = [
            'store_route' => $store_route,
            'categories' => $categories,
            'seller' => $seller,
        ];

        return view($this->sellerItemView('create'))->with($data);
    }

    public function store(Request $request, $id)
    {
        $seller = Seller::where('id', $id)->first();

        $item = Item::create($request->all());

        if ($request->discount == null) {
            $item->discount = 0;
        }

        $item->save();

        $item->seller_id = $seller->id;
        $item->major_id = $seller->major_id;
        $item->save();

        if ($request->image) {
            foreach ($request->image as $image) {
                $itemimage = new ItemImage;
                $newimage = $this->uploadimage($image, 'items');

                $itemimage->image = $newimage;
                $itemimage->item_id = $item->id;
                $itemimage->save();
            }
        }

        if ($request->sizename) {
            foreach ($request->sizename as $key => $value) {
                $size = new Size;
                $size->title = $value;
                $size->price = $request->sizeprice[$key];
                $size->item_id = $item->id;
                $size->calory = $request->sizecalory[$key];

                if (
                    is_array($request->size_default) &&
                    array_key_exists($key, $request->size_default)
                ) {
                    if ($request->size_default[$key] == 1) {
                        $size->size_default = $request->size_default[$key];
                    }
                }

                $size->save();
            }
        }

        if ($request->extrname) {
            foreach ($request->extrname as $key => $value) {
                $extra = new Extra;
                $extra->title = $value;
                $extra->price = $request->extrprice[$key];
                $extra->calory = $request->extracalory[$key];
                $extra->count_number = $request->count_number[$key];

                if (
                    is_array($request->multiple) &&
                    array_key_exists($key, $request->multiple)
                ) {
                    if ($request->multiple[$key] == 1) {
                        $extra->multiple = $request->multiple[$key];
                    }
                } else {
                    $extra->multiple = 0;
                }

                $extra->item_id = $item->id;
                $extra->save();

                if ($request["extrname$key"]) {
                    foreach ($request["extrname$key"] as $key1 => $value1) {
                        $ex2 = new Extradetail;
                        $ex2->title = $value1;
                        $ex2->extra_price = $request["extrprice$key"][$key1];

                        if (
                            is_array($request["extrprice$key"]) &&
                            array_key_exists($key1, $request["extrprice$key"])
                        ) {
                            if (
                                is_array($request["default$key"]) &&
                                array_key_exists($key1, $request["default$key"])
                            ) {
                                $ex2->default_new = $request["default$key"][$key1];
                            }
                        }

                        $ex2->extra_id = $extra->id;
                        $ex2->save();
                    }
                }
            }
        }

        return redirect()->route('seller_items', [
            'id' => $seller->id,
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $item = Item::where('id', $id)->first();

        $seller = Seller::withoutGlobalScope(
            CentralRestaurantVisibilityScope::class
        )
            ->where('id', $item->seller_id)
            ->first();

        $categories = $seller->categories;

        return view($this->sellerItemView('edit'))
            ->with('item', $item)
            ->with('categories', $categories);
    }

    public function update(Request $request, $id)
    {
        $item = Item::where('id', $id)->first();

        $item->update($request->all());

        if ($request->discount == null) {
            $item->discount = 0;
        }

        $item->save();

        if ($request->image) {
            if (count($item->images) > 0) {
                foreach ($item->images as $im) {
                    File::delete(
                        public_path() . '/uploads/' . $im->image
                    );
                }
            }

            ItemImage::where('item_id', $id)->delete();

            foreach ($request->image as $image) {
                $itemimage = new ItemImage;
                $newimage = $this->uploadimage($image, 'items');

                $itemimage->image = $newimage;
                $itemimage->item_id = $item->id;
                $itemimage->save();
            }
        }

        if ($request->discount == null) {
            $item->discount = 0;
        }

        $item->save();

        if ($request->sizename) {
            Size::where('item_id', $id)->delete();

            foreach ($request->sizename as $key => $value) {
                $size = new Size;
                $size->title = $value;
                $size->price = $request->sizeprice[$key];
                $size->item_id = $item->id;
                $size->calory = $request->sizecalory[$key];

                if (
                    is_array($request->size_default) &&
                    array_key_exists($key, $request->size_default)
                ) {
                    if ($request->size_default[$key] == 1) {
                        $size->size_default = $request->size_default[$key];
                    }
                }

                $size->save();
            }
        }

        if ($request->extrname) {
            Extra::where('item_id', $id)->delete();

            foreach ($request->extrname as $key => $value) {
                $extra = new Extra;
                $extra->title = $value;
                $extra->price = $request->extrprice[$key];
                $extra->calory = $request->extracalory[$key];
                $extra->item_id = $item->id;
                $extra->count_number = $request->count_number[$key];

                if (
                    is_array($request->multiple) &&
                    array_key_exists($key, $request->multiple)
                ) {
                    if ($request->multiple[$key] == 1) {
                        $extra->multiple = $request->multiple[$key];
                    }
                } else {
                    $extra->multiple = 0;
                }

                $extra->save();

                if ($request["extrname$key"]) {
                    Extradetail::where(
                        'extra_id',
                        $extra->id
                    )->delete();

                    foreach ($request["extrname$key"] as $key1 => $value1) {
                        $ex2 = new Extradetail;
                        $ex2->title = $value1;
                        $ex2->extra_price = $request["extrprice$key"][$key1];

                        if (
                            is_array($request["extrprice$key"]) &&
                            array_key_exists($key1, $request["extrprice$key"])
                        ) {
                            if (
                                is_array($request["default$key"]) &&
                                array_key_exists($key1, $request["default$key"])
                            ) {
                                $ex2->default_new = $request["default$key"][$key1];
                            }
                        }

                        $ex2->extra_id = $extra->id;
                        $ex2->save();
                    }
                }
            }
        }

        return redirect()->route('seller_items', [
            'id' => $item->seller_id,
        ]);
    }

    public function destroy($id)
    {
        $item = Item::where('id', $id)->first();
        $item->delete();

        return response()->json([
            'status' => true,
        ]);
    }
}
