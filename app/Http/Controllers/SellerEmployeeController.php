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
use App\DataTables\SellerEmployeeDataTable;
use App\Models\Address;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Hash;
class SellerEmployeeController extends Controller 
{
use generaltrait;
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(SellerEmployeeDataTable $dataTable,$id)
    {
  $dataTable->id = $id;
        return $dataTable->render('admindashboard.employees.selleremployees.index',['id' => $id]);
    }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create($id)
  {
   

    return view('admindashboard.employees.selleremployees.create')->with('id',$id);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request,$id)
  {
       $seller_id = $id;
    $request->validate(['phone' => 'required|unique:sellers_employees']);
    $employee = SellerEmployee::create($request->all());
    $employee->password = Hash::make($request->password);
   $employee->seller_id = $seller_id;
   $employee->save();
 
        //  $contract = new Employeescontract;
        //  $contract->from_day = $request->from_day;
        //   $contract->to_day = $request->to_day;

        //  $contract->sallary = $request->sallary;
        //  $contract->notes = $request->notes;
        //  if($request->hasFile('paper_contract_image'))
        // {
       
        //     $image = $this->uploadimage($request->paper_contract_image,'contracts');
        //     $contract->paper_contract_image = $image;
        // }    $contract->employee_id = $employee->id;
        // $contract->save();
      //  $employee->attachRole('admin');
        // if($request->role_id){
        // $employee->attachRole($request->role_id);
        // }
        
        return redirect('selleremployees/'.$id);

  }

  
  public function show(EmployeescontractDataTable $dataTable,$id){
     $dataTable->id = $id;
     $employee = Employee::where('id',$id)->first();
     $contract = Employeescontract::where('employee_id',$id)->where("active",1)->latest()->first();
     return $dataTable->render('admindashboard.employees.show',['employee' => $employee,'contract' => $contract]);  
  }


  public function edit($id)
  {

    $employee =SellerEmployee::where('id',$id)->first();

    return view('admindashboard.employees.selleremployees.edit')->with('employee',$employee);
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
   
        //     if($request->permissions){
        // $employee->attachPermissions($request->permissions);
        // }
        //  if($request->role_id){
        // $employee->syncRoles([$request->role_id]);
        // }
      return redirect('selleremployees/'.$employee->seller_id);
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
     return $dataTable->render('admindashboard.employees.contracts',['id' => $id]);
}public function addemployeecontract($id){
    return view('admindashboard.employees.addemployeecontract')->with('id',$id);
}public function storeemployeecontract(Request $request,$id){
       Employeescontract::where('employee_id',$id)->update(['active' => 0]);
    $contract = new Employeescontract;
         $contract->from_day = $request->from_day;
          $contract->to_day = $request->to_day;

         $contract->sallary = $request->sallary;
         $contract->notes = $request->notes;
         if($request->hasFile('paper_contract_image'))
        {
       
            $image = $this->uploadimage($request->paper_contract_image,'contracts');
            $contract->paper_contract_image = $image;
        }  
          $contract->active = 1;
         $contract->employee_id = $id; 
        $contract->save();
        return redirect('employeecontracts/'.$id);
}public function editemployeecontract($id){
    $contract =  Employeescontract::where('id',$id)->first();
    return view('admindashboard.employees.editemployeecontract')->with('contract',$contract);
}public function updateemployeecontract(Request $request,$id){
    $contract =  Employeescontract::where('id',$id)->first();
         $contract->from_day = $request->from_day;
          $contract->to_day = $request->to_day;

         $contract->sallary = $request->sallary;
         $contract->notes = $request->notes;
         if($request->hasFile('paper_contract_image'))
        {
         File::delete(public_path(). '/uploads/'.$contract->paper_contract_image);
            $image = $this->uploadimage($request->paper_contract_image,'contracts');
            $contract->paper_contract_image = $image;
        }  
        $contract->save();
        return redirect('employeecontracts/'.$contract->employee_id);
} public function deleteemployeecontract($id)
  {
        $contract =  Employeescontract::where('id',$id)->first();
           File::delete(public_path(). '/uploads/'.$contract->paper_contract_image);
      $contract->delete();
      return response()->json(['status' => true]);
  }public function activeemployeecontract($id){
        $contract =  Employeescontract::where('id',$id)->first();
        if($contract->active == 1){
            $contract->active = 0;
            $contract->save();
            return response()->json(['status' => true,'message' => 'تم الغاء التفعيل']);
        }   elseif($contract->active == 0){
            $contract->active = 1;
            $contract->save();
            return response()->json(['status' => true,'message' => 'تم  التفعيل']);
        }
  }public function getemployeesalary($id){
      $contract = Employeescontract::where('employee_id',$id)->where('active',1)->first();
      return response()->json(['status' => true,'sallary' => $contract->sallary]);
  }
}

?>