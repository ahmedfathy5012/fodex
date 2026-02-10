<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use App\Models\MenuType;
use App\DataTables\MenuTypeDataTable;

class MenuTypeController extends Controller
{
  public function index(MenuTypeDataTable $dataTable, int $sellerId)
  {
    $seller_name = Seller::withoutGlobalScope(\App\Scopes\CentralRestaurantVisibilityScope::class)->find($sellerId)->name;
    return $dataTable->with('seller_id', $sellerId)->render('admindashboard.menu_types.index', compact('seller_name', 'sellerId'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create(int $sellerId)
  {
    $seller_name = Seller::withoutGlobalScope(\App\Scopes\CentralRestaurantVisibilityScope::class)->find($sellerId)->name;
    return view('admindashboard.menu_types.create', compact('sellerId', 'seller_name'));
  }


  /**
   * Summary of store
   * @param Request $request
   * @param int $sellerId
   * @return \Illuminate\Http\RedirectResponse
   */ 
  public function store(Request $request, int $sellerId)
  {
    $request->validate([
      'title' => 'required'
    ], [
      'title.required' => 'هذا الحقل مطلوب'
    ]);
    $menutype = new MenuType;
    $menutype->title = $request->title;
    $menutype->seller_id = $sellerId;
    $menutype->save();
    return redirect()->route('seller.menu_types.index', $sellerId);
  }


  public function edit($id)
  {
    $menutype = MenuType::where('id', $id)->first();
    return view('admindashboard.menu_types.edit')->with('menutype', $menutype);
  }
  public function update(Request $request, $id)
  {
    $request->validate([
      'title' => 'required'
    ], [
      'title.required' => 'هذا الحقل مطلوب'
    ]);
    $menutype = MenuType::where('id', $id)->first();
    $menutype->title = $request->title;
    $menutype->save();
    return redirect()->route('seller.menu_types.index', $menutype->seller_id);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $menutype = MenuType::where('id', $id)->first();
    if ($menutype->items()->count() > 0) {
      return response()->json(['status' => false, 'msg' => 'لا يمكن حذف هذا النوع لأنه مرتبط بعناصر']);
    }
    $menutype->delete();
    return response()->json(['status' => true, 'msg' => 'تم حذف هذا النوع بنجاح']);
  }
}
