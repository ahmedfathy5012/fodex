<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

use App\DataTables\RoleDataTable;
class RoleController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
   public function index(RoleDataTable $dataTable)
    {
      // dd(Country::all());
        return $dataTable->render('admindashboard.roles.index');
    }
  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('admindashboard.roles.create');
  }

 
  public function store(Request $request)
  {
  $role = Role::create([
    'name' => $request->name,
]);
 if($request->permissions){
        $role->attachPermissions($request->permissions);
        }
         return redirect()->route('roles.index');
  }

 
  public function edit($id)
  {
    $role = Role::where('id',$id)->first();
    return view('admindashboard.roles.edit')->with('role',$role); 
  }
  public function update(Request $request,$id)
  {
     
   $role = Role::where('id',$id)->first();
    $role->name = $request->name;
    $role->save();
    if($request->permissions){
        $role->syncPermissions($request->permissions);
        }
    return redirect()->route('roles.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
     $role = Role::where('id',$id)->first();
     $role->delete();
     return response()->json(['status' => true]);
  }
  
}

?>