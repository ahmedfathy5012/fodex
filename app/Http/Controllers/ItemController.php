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
use App\DataTables\ItemDataTable;
use App\DataTables\ItemSellerDataTable;
use App\Models\Extradetail;
class ItemController extends Controller 
{

 use generaltrait;
  
   public function index(ItemDataTable $dataTable)
    {
      //
      // dd(Country::all());
       return $dataTable->render('admindashboard.items.index');
    }
  public function itemseller(ItemSellerDataTable $dataTable,$id)
    {
      //
      // dd(Country::all());
      $dataTable->id = $id;
       return $dataTable->render('admindashboard.items.index');
    }
  
  public function create()
  {
    $sellers = Seller::all();
    $categories = Category::all();
    return view('admindashboard.items.create')->with('sellers',$sellers)->with('categories',$categories);
  }

  
  public function store(Request $request)
  {
     
    $seller = Seller::where('id',$request->seller_id)->first();
    //     $request->validate([
    //   'title' => 'required',
    //   'price' => 'required',
    // ],[
    //   'required' => 'هذا الحقل مطلوب'
    //    ]);
  
    $item = Item::create($request->all());
      if($request->discount == null){
      $item->discount = 0;
    }

    $item->major_id = $seller->major_id;
   
     $item->save();
    if($request->image){
    foreach($request->image as $image){
           $itemimage = new ItemImage;
            $newimage = $this->uploadimage($image,'items');
            $itemimage->image = $newimage;
            $itemimage->item_id = $item->id;
            $itemimage->save();
    } 
  }
 if($request->sizename){
    foreach($request->sizename as $key => $value) {
       $size = new Size;
       $size->title = $value;
       $size->price = $request->sizeprice[$key];
       $size->item_id = $item->id;
       $size->calory = $request->sizecalory[$key];
       if(is_array($request->size_default) && array_key_exists($key,$request->size_default)){
         if($request->size_default[$key] == 1){
        $size->size_default = $request->size_default[$key];
         }
       }
       $size->save();
    }
  } if($request->extrname){
    foreach($request->extrname as $key => $value) {
       $extra = new Extra;
       $extra->title = $value;
         $extra->price = $request->extrprice[$key];
          $extra->calory = $request->extracalory[$key];
          $extra->count_number = $request->count_number[$key];
         if(is_array($request->multiple) && array_key_exists($key, $request->multiple)){
          if($request->multiple[$key] == 1){
          $extra->multiple = $request->multiple[$key];
          }
          }else{
            $extra->multiple = 0;  
          }
       $extra->item_id = $item->id;
       $extra->save();
         if($request["extrname$key"]){
       foreach ($request["extrname$key"] as $key1 => $value1) {
         $ex2 = new Extradetail;
         $ex2->title = $value1;
         $ex2->extra_price = $request["extrprice$key"][$key1];
           if(is_array($request["extrprice$key"]) &&  array_key_exists($key1, $request["extrprice$key"])){
        if(is_array($request["default$key"]) && array_key_exists($key1, $request["default$key"])){
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
    return redirect()->route('item.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
     $sellers = Seller::all();
     $item = Item::where('id',$id)->first();
    //  $categories = Category::all();
      $seller = Seller::where('id',$item->seller_id)->first();
    $categories = $seller->categories;
    dd($item->extras_ddd);
    return view('admindashboard.items.edit')->with('sellers',$sellers)->with('item',$item)->with('categories',$categories);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request,$id)
  {
    
     
      $item = Item::where('id',$id)->first();
   $item->update($request->all());
     if($request->discount == null){
      $item->discount = 0;
    }
     $item->save();
      if($request->image){
          if(count($item->images) > 0){
          foreach($item->images as $im){
             File::delete(public_path(). '/uploads/'.$im->image);
          }
        }
         ItemImage::where('item_id',$id)->delete();
    foreach($request->image as $image){
     
           $itemimage = new ItemImage;
            $newimage = $this->uploadimage($image,'items');
            $itemimage->image = $newimage;
            $itemimage->item_id = $item->id;
            $itemimage->save();
    } 
  }
 if($request->sizename){
      Size::where('item_id',$id)->update(["hidden" => 1]);
    foreach($request->sizename as $key => $value) {
      
       $size = new Size;
       $size->title = $value;
       $size->price = $request->sizeprice[$key];
       $size->item_id = $item->id;
       $size->calory = $request->sizecalory[$key];
       if(is_array($request->size_default) && array_key_exists($key,$request->size_default)){
        if($request->size_default[$key] == 1){
       $size->size_default = $request->size_default[$key];
        }
       }
       $size->save();
    }
  } if($request->extrname){
      Extra::where('item_id',$id)->update(["hidden" => 1]);
    foreach($request->extrname as $key => $value) {
       $extra = new Extra;
       $extra->title = $value;
         $extra->price = $request->extrprice[$key];
          $extra->calory = $request->extracalory[$key];
       $extra->item_id = $item->id;
         $extra->count_number = $request->count_number[$key];
         if(is_array($request->multiple) && array_key_exists($key, $request->multiple)){
          if($request->multiple[$key] == 1){
          $extra->multiple = $request->multiple[$key];
          }
          }else{
            $extra->multiple = 0;  
          }
       $extra->save();
       if($request["extrname$key"]){
           Extradetail::where('extra_id',$extra->id)->update(["hidden" => 1]);
       foreach ($request["extrname$key"] as $key1 => $value1) {
         $ex2 = new Extradetail;
         $ex2->title = $value1;
         $ex2->extra_price = $request["extrprice$key"][$key1];
       
              if(is_array($request["extrprice$key"]) &&  array_key_exists($key1, $request["extrprice$key"])){
        if(is_array($request["default$key"]) && array_key_exists($key1, $request["default$key"])){
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
   return redirect()->route('item.index'); 
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
        $item = Item::where('id',$id)->first();
          if(count($item->images) > 0){
          foreach($item->images as $im){
             File::delete(public_path(). '/uploads/'.$im->image);
          }
        }
     $item->delete();
     return response()->json(['status' => true]);
  }
  public function addfav($id){
      $item = Item::where('id',$id)->first();
      if($item->fav == 1){
          $item->fav = 0;
          $item->save();
      }else{
           $item->fav = 1;
          $item->save();
      }
      return response()->json(['status' => true]);
  }public function hideitem(Request $request){
       $item = Item::where('id',$request->id)->first();
          if($item->appear == 0){
          $item->appear = 1;
          $item->save();
              return response()->json(['status' => true,'message' => 'تم الظهور بنجاح']);
      }else{
           $item->appear = 0;
           $item->not_appear_reason = $request->not_appear_reason;
          $item->save();
           return response()->json(['status' => true,'message' => 'تم الاخفاء بنجاح']);
      }
}   public function availableitem($id){
        $item = Item::where("id",$id)->first();
    
        if( $item->available == 1){
            $item->available = 0;
            $item->save();
        }elseif( $item->available == 0){
            $item->available =  1;
            $item->save();
        }
    
     
        return response()->json(['status' => true]);
    }
}

?>