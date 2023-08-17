<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Major;
use App\Models\Sellercategory;
use App\traits\generaltrait;
use App\DataTables\CategoryDataTable;
use App\DataTables\SellercategoryDataTable;
use Illuminate\Support\Facades\File; 
class CategoryController extends Controller 
{
 use generaltrait;
  
  public function index(CategoryDataTable $dataTable)
  {
    return $dataTable->render('admindashboard.categories.index');
  }

  public function create()
  {
    $majors = Major::all();
    return view('admindashboard.categories.create')->with('majors',$majors);
    
  }

 
  public function store(Request $request)
  {
     $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $category = new Category;
    $category->title = $request->title;
    $category->major_id = $request->major_id;
    $category->description = $request->description;
     if($request->hasFile('image'))
        {
       
            $image = $this->uploadimage($request->image,'categories');
            $category->image = $image;
        }
        if($request->is_subcategory){
       $category->is_subcategory = 1;
        }else{
        $category->is_subcategory = 0;
        }
    $category->save();
    return redirect()->route('category.index');
  }


  public function show($id)
  {
    
  }


  public function edit($id)
  {
     $majors = Major::all();
     $category = Category::where('id',$id)->first();
    return view('admindashboard.categories.edit')->with('majors',$majors)->with('category',$category);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request,$id)
  {
     $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $category = Category::where('id',$id)->first();
    $category->title = $request->title;
    $category->major_id = $request->major_id;
    $category->description = $request->description;
     if($request->hasFile('image'))
        {
       File::delete(public_path(). '/uploads/'.$category->image);
            $image = $this->uploadimage($request->image,'categories');
            $category->image = $image;
        }
          if($request->is_subcategory){
       $category->is_subcategory = 1;
        }else{
        $category->is_subcategory = 0;
        }
    $category->save();
    return redirect()->route('category.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
     $category = Category::where('id',$id)->first();
       File::delete(public_path(). '/uploads/'.$category->image);
      $category->delete();
      return response()->json(['status' => true]);
  }public function sellercategory(SellercategoryDataTable $dataTable,$id){
      $dataTable->id = $id;
  return $dataTable->render('admindashboard.categories.seller_categories');
  }  public function addfav1($id){
      $item = Sellercategory::where('id',$id)->first();
      if($item->fav == 1){
          $item->fav = 0;
          $item->save();
      }else{
           $item->fav = 1;
          $item->save();
      }
      return response()->json(['status' => true]);
  }public function order_numbercategory(Request $request){
      $selcategory = Sellercategory::where('id',$request->id)->first();
      $selcategory->order_number = $request->order_number;
      $selcategory->save();
      return response()->json(['status' => true]);
  }public function add_category_seller(Request $request){
        $seller_category = Sellercategory::where([['seller_id','=',$request->seller_id],['category_id','=',$request->seller_id]])->first();
        if($seller_category){
            $seller_category->delete();
        }else{
            $seller_category = new Sellercategory;
            $seller_category->seller_id = $request->seller_id;
            $seller_category->category_id = $request->category_id;
            $seller_category->save();
        }
        return response()->json(['status' => true]);
  }
}

?>