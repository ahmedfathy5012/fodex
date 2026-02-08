<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gender;
use App\Models\Role;
use App\Models\Statussocial;
use App\Models\Armycase;
use App\Models\SellerEmployee;
use App\Models\Seller;
use App\Models\City;
use App\Models\Zone;
use App\traits\generaltrait;
use App\Models\Employeescontract;
use App\DataTables\EmployeescontractDataTable;
use App\DataTables\SellerEmployee2DataTable;
use App\Models\Address;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Hash;
class SellerEmployee2Controller extends Controller 
{
use generaltrait;
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(SellerEmployee2DataTable $dataTable)
    {

        return $dataTable->render('sellerdashboard.selleremployees.index');
    }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
   

    return view('sellerdashboard.selleremployees.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
       $seller_id = auth()->user()->seller_id;
    $request->validate(['phone' => 'required|unique:sellers_employees']);
    $employee = SellerEmployee::create($request->all());
    $employee->password = Hash::make($request->password);
   $employee->seller_id = $seller_id;
   $employee->save();
 
      return redirect()->route("myselleremployees.index");

  }

  
  public function show(EmployeescontractDataTable $dataTable,$id){
     $dataTable->id = $id;
     $employee = Employee::where('id',$id)->first();
     $contract = Employeescontract::where('employee_id',$id)->where("active",1)->latest()->first();
     return $dataTable->render('sellerdashboard.employees.show',['employee' => $employee,'contract' => $contract]);  
  }


  public function edit($id)
  {

    $employee =SellerEmployee::where('id',$id)->first();

    return view('sellerdashboard.selleremployees.edit')->with('employee',$employee);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request,$id)
  {
   //   dd($request->all());
     $employee = SellerEmployee::where('id',$id)->first();
     $password = $employee->password;
     $request->validate(['phone' => "required|unique:sellers_employees,phone,$id"]);
    $employee = $employee->update($request->all());
     $employee = SellerEmployee::where('id',$id)->first();
    if($request->password){
    $employee->password = Hash::make($request->password);}else{
         $employee->password = $password;
    }$employee->save();

     return redirect()->route("myselleremployees.index");
    }

  


  public function destroy($id)
  {
     $employee = SellerEmployee::where('id',$id)->first();
      $employee->delete();
      return response()->json(['status' => true]);
  }public function blockemployee(Request $request){
      $employee = Employee::where('id',$request->id)->first();
      if($employee->block == 1){
          $employee->block = 0;
          $employee->save();
      }else{
           $employee->block = 1;
           $employee->block_reason = $request->block_reason;
        $employee->display_block_reason = $request->display_block_reason;
          $employee->save();
      }
      return response()->json(['status' => true]);
  }  public function employeecontracts(EmployeescontractDataTable $dataTable,$id){
     $dataTable->id = $id;
     return $dataTable->render('sellerdashboard.employees.contracts',['id' => $id]);
}
}

?> 