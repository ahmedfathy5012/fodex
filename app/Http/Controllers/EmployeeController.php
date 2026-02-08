<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gender;
use App\Models\Role;
use App\Models\ExpenseDriver;
use App\Models\Expense;
use App\Models\Income;
use App\Models\AllCollection;
use App\Models\Discount;
use App\DataTables\NotcollectemployeeDataTable;
use App\Models\Statussocial;
use App\Models\Armycase;
use App\Models\Employee;
use App\Models\Country;
use App\Models\ExpenseEmployee;
use App\Models\State;
use App\Models\City;
use App\Models\Award;
use App\Models\Zone;
use App\traits\generaltrait;
use App\Models\Employeescontract;
use App\DataTables\EmployeescontractDataTable;
use App\DataTables\EmployeeDataTable;
use App\DataTables\DiscountDataTable;
use App\DataTables\AwardDataTable;
use App\Models\Address;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Hash;
class EmployeeController extends Controller 
{
use generaltrait;
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(EmployeeDataTable $dataTable)
    {
             $countries = Country::all();
    $states = State::all();
    $cities = City::all();
    $zones = Zone::all();
        return $dataTable->render('admindashboard.employees.index',['countries' => $countries,'states' => $states,'cities' => $cities,'zones'=>$zones]);
    
    }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $armycases = Armycase::all();
    $statuss = Statussocial::all();
    $genders = Gender::all();
    $countries = Country::all();
    $states = State::all();
    $cities = City::all();
    $zones = Zone::all();
    $roles = Role::all();
    return view('admindashboard.employees.create')->with('genders',$genders)->with('roles',$roles)->with('armycases',$armycases)->with('statuss',$statuss)->with('countries',$countries)->with('states',$states)->with('cities',$cities)->with('zones',$zones);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    $request->validate(['phone' => 'required|unique:employees']);
    $employee = Employee::create([
        "name" => $request->name,
         "phone" => $request->phone,
          "mobile" => $request->mobile,
      "password" =>  Hash::make($request->password),
 
        ]);
     if($request->hasFile('image'))
        {
       
            $image = $this->uploadimage($request->image,'employees');
            $employee->image = $image;
        } 
        // if($request->hasFile('identification_number_image'))
        // {
       
        //     $image = $this->uploadimage($request->identification_number_image,'employees');
        //     $employee->identification_number_image = $image;
        // } if($request->hasFile('residence_deed_image'))
        // {
       
        //     $image = $this->uploadimage($request->residence_deed_image,'employees');
        //     $employee->residence_deed_image = $image;
        // }
        // $employee->save();
        $address = new Address;
        $address->country_id = $request->country_id;
        $address->state_id = $request->state_id;
        $address->city_id = $request->city_id;
        $address->zone_id = $request->zone_id;
        $address->floor_number = $request->floor_number;
        $address->building_number = $request->building_number;
        $address->lat = $request->lat;
        $address->lon = $request->lon;
         $address->street = $request->street;
         $address->employee_id = $employee->id;
         $address->save();
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
        if($request->role_id){
        $employee->attachRole($request->role_id);
        }
        
        return redirect()->route('employee.index');

  }

  
  public function show(EmployeescontractDataTable $dataTable,$id){
     $dataTable->id = $id;
     $employee = Employee::where('id',$id)->first();
     $contract = Employeescontract::where('employee_id',$id)->where("active",1)->latest()->first();
     return $dataTable->render('admindashboard.employees.show',['employee' => $employee,'contract' => $contract]);  
  }


  public function edit($id)
  {
      $armycases = Armycase::all();
    $statuss = Statussocial::all();
    $genders = Gender::all();
    $countries = Country::all();
    $states = State::all();
    $cities = City::all();
    $zones = Zone::all();
     $roles = Role::all();
    $employee = Employee::where('id',$id)->first();
    $address = Address::where('employee_id',$id)->first();
    $contract = Employeescontract::where('employee_id',$id)->first();
    return view('admindashboard.employees.edit')->with('genders',$genders)->with('roles',$roles)->with('armycases',$armycases)->with('statuss',$statuss)->with('countries',$countries)->with('states',$states)->with('cities',$cities)->with('zones',$zones)->with('employee',$employee)->with('address',$address)->with('contract',$contract);
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
     $employee = Employee::where('id',$id)->first();
     $request->validate(['phone' => "required|unique:employees,phone,$id"]);
          $password = $employee->password;

     $employee = Employee::where('id',$id)->first();
     if($request->password){
    $employee->password = Hash::make($request->password);
         
     }else{
         $driver->password = $password;
    }
     
    $driver->save();
        $driver->update([
        "name" => $request->name,
         "phone" => $request->phone,
          "mobile" => $request->mobile,
           ]);
    
     if($request->hasFile('image'))
        {
        File::delete(public_path(). '/uploads/'.$employee->image);
            $image = $this->uploadimage($request->image,'employees');
            $employee->image = $image;
            $employee->save();
        }
    //     if($request->hasFile('identification_number_image'))
    //     {
    //     File::delete(public_path(). '/uploads/'.$employee->identification_number_image);
    //         $image = $this->uploadimage($request->identification_number_image,'employees');
    //         $employee->identification_number_image = $image;
    //     } if($request->hasFile('residence_deed_image'))
    //     {
    //   File::delete(public_path(). '/uploads/'.$employee->residence_deed_image);
    //         $image = $this->uploadimage($request->residence_deed_image,'employees');
    //         $employee->residence_deed_image = $image;
    //     }
    //     $employee->save();
        
        $address =  Address::where('employee_id',$id)->first();
        if($address){
        
            $address = $address;
        }else{
            $address = new Address;
        }
        $address->country_id = $request->country_id;
        $address->state_id = $request->state_id;
        $address->city_id = $request->city_id;
        $address->zone_id = $request->zone_id;
        $address->floor_number = $request->floor_number;
        $address->building_number = $request->building_number;
        $address->lat = $request->lat;
        $address->lon = $request->lon;
        $address->street = $request->street;
         $address->employee_id = $employee->id;
         $address->save();
    //      $contract = new Employeescontract;
    //      $contract->from_day = $request->from_day;
    //       $contract->to_day = $request->to_day;
    //      $contract->sallary = $request->sallary;
    //      $contract->notes = $request->notes;
    //      if($request->hasFile('paper_contract_image'))
    //     {
    //   File::delete(public_path(). '/uploads/'.$contract->paper_contract_image);
    //         $image = $this->uploadimage($request->paper_contract_image,'contracts');
    //         $contract->paper_contract_image = $image;
    //     }    $contract->employee_id = $employee->id;
    //     $contract->save();
            if($request->permissions){
        $employee->attachPermissions($request->permissions);
        }
         if($request->role_id){
        $employee->syncRoles([$request->role_id]);
        }
        return redirect()->route('employee.index');
    }

  


  public function destroy($id)
  {
     $employee = Employee::where('id',$id)->first();
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
  }public function awardemployee(Request $request){
      $award = new Award;
      $award->employee_id = $request->id;
      $award->reason = $request->reason;
      $award->value = $request->value;
      $award->save();
      return response()->json(['status' => true]);
  }public function discountemployee(Request $request){
      $discount = new Discount;
      $discount->employee_id = $request->id;
      $discount->reason = $request->reason;
      $discount->value = $request->value;
      $discount->save();
      return response()->json(['status' => true]);
  }public function employeeawards(AwardDataTable $dataTable,$id){
      $dataTable->id = $id;
         return $dataTable->render('admindashboard.employees.employeeawards');
  }public function employeediscounts(DiscountDataTable $dataTable,$id){
        $dataTable->id = $id;
         return $dataTable->render('admindashboard.employees.employeediscounts');
  }public function notcollectemployees(NotcollectemployeeDataTable $dataTable){
       $countries = Country::all();
    $states = State::all();
    $cities = City::all();
    $zones = Zone::all();
         return $dataTable->render('admindashboard.employees.notcollectemployee',['countries' => $countries,'states' => $states,'cities' => $cities,'zones'=>$zones]);
  }public function addemplyeeexpense(Request $request){
      //dd($request->all());
        $expenses = array_sum(ExpenseDriver::get()->pluck('value')->toArray()) + 
        array_sum(ExpenseEmployee::get()->pluck('value')->toArray()) +  array_sum(Expense::get()->pluck('paid')->toArray());
        $allcolletions =  array_sum(AllCollection::get()->pluck('money_taken')->toArray()) + 
        array_sum(Income::get()->pluck('value')->toArray());
        $rest = $allcolletions - $expenses;
        if($allcolletions > ($expenses + $request->value)){
          $expense = ExpenseEmployee::where('employee_id',$request->id)->where('month_date',$request->date)
        ->first();
        if($expense){
               
            $expense->value +=$request->value;
           $expense->money_left = ($expense->total + $expense->awards) - ($expense->value + $expense->discounts);
           $expense->save();
        }else{
              $expense = new ExpenseEmployee;
              $expense->value = $request->value;
               $expense->employee_id = $request->id;
              $expense->total = $request->total;
            $expense->month_date = $request->date;
              $expense->awards = $request->awards;
              $expense->discounts = $request->discounts;
              $expense->money_left = ($request->total +$request->awards) - ($request->value + $request->discounts);
              $expense->save();
        }
        return response()->json(['status' => true]);
        }else{
             return response()->json(['status' => false]);
        }
  }  public function countriespermissions($id)
  {
$employee = Employee::where('id',$id)->first();
    $countries = Country::all();
    $states = State::all();
    $cities = City::all();
    $zones = Zone::all();
    return view('admindashboard.employees.countriespermissions')->with('countries',$countries)->with('states',$states)
    ->with('cities',$cities)->with('zones',$zones)->with('employee',$employee);
  }public function savecountriespermissions(Request $request,$id){
      $employee = Employee::where('id',$id)->first();
      if($request->country_id){
      $employee->countries()->sync($request->country_id);
      }else{
         $employee->countries()->sync([]); 
      }if($request->state_id){
       $employee->states()->sync($request->state_id);}else{
           
        $employee->states()->sync([]); 
           
       }if($request->city_id){
        $employee->cities()->sync($request->city_id);
       }else{
                $employee->cities()->sync([]); 
       }if($request->zone_id){
         $employee->zones()->sync($request->zone_id);
       }else{
       $employee->zones()->sync([]); 
       }
         return redirect()->route('employee.index');
  }
  
}

?>