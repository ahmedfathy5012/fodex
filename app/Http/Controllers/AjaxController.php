<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Country;
use App\Models\City;
use App\Models\Category;
use App\Models\Zone;
use App\Models\Day;
use App\Models\Seller;
use App\Models\Subcategory;
use App\Models\ExpenseType;
use App\Models\AllcollectionType;
class AjaxController extends Controller
{
    public function getstates($id){
    $states = State::where('country_id',$id)->get();
    if($id == 0){
        $states = State::all();
    }
    $text = '';
      $text .= '<option value="0">الكل</option>';
    foreach($states as $state){
      $text .='<option value="'.$state->id.'">'.$state->name.'</option>';
    }
    return response()->json(['status' => true,'data' => $text]);
  }public function getcities($id){
    $cities = City::where('state_id',$id)->get();
    if($id == 0){
        $cities = City::all();
    }
    $text = '';
     $text .= '<option value="0">الكل</option>';
    foreach($cities as $city){
      $text .='<option value="'.$city->id.'">'.$city->name.'</option>';
    }
    return response()->json(['status' => true,'data' => $text]);
  }public function getsubcategories($id){
    $subcategories = Category::where('major_id',$id)->get();
    $text = '';
    foreach($subcategories as $sub){
      $text .='<option value="'.$sub->id.'">'.$sub->title.'</option>';
    }
    return response()->json(['status' => true,'data' => $text]);
  }public function getzones($id){
    $zones = Zone::where('city_id',$id)->get();
        if($id == 0){
        $zones = Zone::all();
    }
    $text = '';
    $text .= '<option value="0">الكل</option>';
    foreach($zones as $zone){
      $text .='<option value="'.$zone->id.'">'.$zone->name.'</option>';
    }
    return response()->json(['status' => true,'data' => $text]);
  }public function getdays(){
    $days = Day::all();
    $text = '';
    foreach($days as $day){
      $text .='<option value="'.$day->id.'">'.$day->day_ar.'</option>';
    }
    return response()->json(['status' => true,'data' => $text]);
  } 
  public function getsellerscategory($id){
    $categories = Seller::where('id',$id)->first()->categories;
    $text = '';
    foreach($categories as $category){
      $text .='<option value="'.$category->id.'">'.$category->title.'</option>';
    }
    return response()->json(['status' => true,'data' => $text]);
  }  public function getstatesmultiple(Request $request){
    $states = State::whereIn('country_id',$request->country_id)->get();

    $text = '';
    
    foreach($states as $state){
      $text .='<option value="'.$state->id.'" style="padding-left:30px;">'.$state->name.'</option>';
    }
    return response()->json(['status' => true,'data' => $text]);
  }public function getcitiesmultiple(Request $request){
    $cities = City::whereIn('state_id',$request->state_id)->get();

    $text = '';
     
    foreach($cities as $city){
      $text .='<option value="'.$city->id.'" style="padding-left:30px;">'.$city->name.'</option>';
    }
    return response()->json(['status' => true,'data' => $text]);
  }public function getzonesmultiple(Request $request){
    $zones = Zone::whereIn('city_id',$request->city_id)->get();
   
    $text = '';
   
    foreach($zones as $zone){
      $text .='<option value="'.$zone->id.'" style="padding-left:30px;">'.$zone->name.'</option>';
    }
    return response()->json(['status' => true,'data' => $text]);
  }    public function getstatesemployee($id){
    $states = auth()->user()->states()->where('country_id',$id)->get();
    if($id == 0){
        $states = auth()->user()->states;
    }
    $text = '';
      $text .= '<option value="0">الكل</option>';
    foreach($states as $state){
      $text .='<option value="'.$state->id.'">'.$state->name.'</option>';
    }
    return response()->json(['status' => true,'data' => $text]);
  }public function getcitiesemployee($id){
    $cities = auth()->user()->cities()->where('state_id',$id)->get();
    if($id == 0){
        $cities = auth()->user()->cities;
    }
    $text = '';
     $text .= '<option value="0">الكل</option>';
    foreach($cities as $city){
      $text .='<option value="'.$city->id.'">'.$city->name.'</option>';
    }
    return response()->json(['status' => true,'data' => $text]);
  }public function getzonesemployee($id){
    $zones = auth()->user()->zones()->where('city_id',$id)->get();
        if($id == 0){
        $zones = auth()->user()->zones;
    }
    $text = '';
    $text .= '<option value="0">الكل</option>';
    foreach($zones as $zone){
      $text .='<option value="'.$zone->id.'">'.$zone->name.'</option>';
    }
    return response()->json(['status' => true,'data' => $text]);
  }public function filterexpensetype($id){
    $expense = ExpenseType::where('id',$id)->first();
        return response()->json(['status' => true,'value' => $expense->value]);
  }public function filtercollectiontype($id){
    $collect = AllcollectionType::where('id',$id)->first();
        return response()->json(['status' => true,'value' => $collect->value]);
  }public function filterstates(Request $request){
      
      $states = State::whereIn("country_id",$request->country_id)->get();
      $text = '';
      foreach($states as $state){
          $text .='  <div class="checkbox checkbox-success form-check-inline" >
                                                <input type="checkbox" name="state_id[]" 
                                                style="opacity:1;z-index:2;"  onchange="filtercities()" id="st'.$state->id.'" value="'.$state->id.'">
                                                <label for="st'.$state->id.'" style="margin-right: 30px;">'.$state->name.'</label>
                                            </div>';
      }
        return response()->json(['status' => true,'data' => $text]);
  }public function filtercities(Request $request){
      $cities = City::whereIn("state_id",$request->state_id)->get();
      $text = '';
      foreach($cities as $city){
          $text .='<div class="checkbox checkbox-success form-check-inline" >
                                                <input type="checkbox" name="city_id[]" 
                                                style="opacity:1;z-index:2;" id="ci'.$city->id.'" onchange="filterzones()" value="'.$city->id.'">
                                                <label for="ci'.$city->id.'" style="margin-right: 30px;">'.$city->name.'</label>
                                            </div>';
      }
        return response()->json(['status' => true,'data' => $text]);
  }public function filterzones(Request $request){
      $zones = Zone::whereIn("city_id",$request->city_id)->get();
      $text = '';
      foreach($zones as $zone){
          $text .=' <div class="checkbox checkbox-success form-check-inline" >
                                                <input type="checkbox" name="zone_id[]" 
                                                style="opacity:1;z-index:2;" id="zz'.$zone->id.'" value="'.$zone->id.'">
                                                <label for="zz'.$zone->id.'" style="margin-right: 30px;">'.$zone->name.'</label>
                                            </div>';
      }
        return response()->json(['status' => true,'data' => $text]);
  }public function filter_subcategories($id){
    $subcategories = Subcategory::where('category_id',$id)->get();
    $text = '';
    foreach($subcategories as $sub){
      $text .='<option value="'.$sub->id.'">'.$sub->title.'</option>';
    }
    return response()->json(['status' => true,'data' => $text]);
  }
}
