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
use App\DataTables\MenuTypeItemDataTable;
use App\Models\Extradetail;
use App\Models\MenuType;

class MenuTypeItemController extends Controller
{

  use generaltrait;

  public function index(MenuTypeItemDataTable $dataTable, $menu_type_id)
  {
    $menu_type = MenuType::find($menu_type_id);
    $seller = $menu_type->seller;
    $create_route = route('menu_type.items.create', $menu_type_id);
    return $dataTable->with('menu_type_id', $menu_type_id)->render('admindashboard.seller_items.index', [
      "seller" => $seller,
      'menu_type_id' => $menu_type_id,
      'create_route' => $create_route
    ]);
  }

  public function create($menu_type_id)
  {
    $menu_type = MenuType::find($menu_type_id);
    $seller = $menu_type->seller;
    $categories = $seller->categories;
    $store_route  = route('menu_type.items.store', $menu_type_id);
    $data = [
      'store_route' => $store_route,
      'categories' => $categories,
      'seller' => $seller,
    ];
    return view('admindashboard.seller_items.create')->with($data);
  }


  public function store(Request $request, $menu_type_id)
  {
    //  dd($request->all());
    //     $request->validate([
    //   'title' => 'required',
    //   'price' => 'required',
    // ],[
    //   'required' => 'هذا الحقل مطلوب'
    //    ]);
    $menu_type = MenuType::find($menu_type_id);
    $seller = $menu_type->seller;
    $item = Item::create($request->all());
    if ($request->discount == null) {
      $item->discount = 0;
    }
    $item->seller_id = $seller->id;
    $item->major_id = $seller->major_id;
    $item->menu_type_id = $menu_type_id;


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
        if (is_array($request->size_default) && array_key_exists($key, $request->size_default)) {
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
        if (is_array($request->multiple) && array_key_exists($key, $request->multiple)) {
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
            if (is_array($request["extrprice$key"]) &&  array_key_exists($key1, $request["extrprice$key"])) {
              if (is_array($request["default$key"]) && array_key_exists($key1, $request["default$key"])) {
                //if($request["default$key"][$key1]){
                $ex2->default_new = $request["default$key"][$key1];
              }
            }
            $ex2->extra_id  = $extra->id;
            $ex2->save();
          }
        }
      }
    }
    return redirect()->route('menu_type.items.index', $menu_type_id);
  }

}
