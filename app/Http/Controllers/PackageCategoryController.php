<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PackageCategory;
use App\DataTables\PackageCategoryDataTable;
class PackageCategoryController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
   public function index(PackageCategoryDataTable $dataTable)
    {
      // dd(Country::all());
        return $dataTable->render('admindashboard.packagescategories.index');
    }
  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('admindashboard.packagescategories.create');
  }

 
  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $packagescategories = new PackageCategory;
    $packagescategories->title = $request->title;
    $packagescategories->save();
    return redirect()->route('packagescategories.index');
  }

 
  public function edit($id)
  {
    $packagescategories = PackageCategory::where('id',$id)->first();
    return view('admindashboard.packagescategories.edit')->with('packagescategories',$packagescategories); 
  }
  public function update(Request $request,$id)
  {
      $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $packagescategories = PackageCategory::where('id',$id)->first();
    $packagescategories->title = $request->title;
    $packagescategories->save();
    return redirect()->route('packagescategories.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
     $packagescategories = PackageCategory::where('id',$id)->first();
     $packagescategories->delete();
     return response()->json(['status' => true]);
  }
  
}

?>