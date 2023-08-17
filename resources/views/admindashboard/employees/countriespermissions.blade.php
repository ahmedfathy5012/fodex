@extends('layouts.adminindex')
@section('content')

<div class="card card-custom">
 
 
    <div class="card-header">
		<div class="card-title">
			<span class="card-icon">
			
			
    			<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-12-28-020759/theme/html/demo8/dist/../src/media/svg/icons/Files/File-plus.svg-->
                   <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"/>
                            <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000"/>
                        </g>
                    </svg><!--end::Svg Icon-->
                </span>
			
			
			</span>
			
			<h3 class="card-label">   صلاحيات مناطق الموظف   </h3>
			
		</div>
	</div>
 
 
 <!--begin::Form-->
<form method="post" action="{{route('savecountriespermissions',$employee->id)}}" enctype="multipart/form-data">
    @csrf
  <div class="card-body">

 
  <div class="row">
     <div class="form-group col-lg-4 col-md-6">
        <label>الدوله<span class="text-danger">*</span></label>
        <select name="country_id[]" class="form-control selectpicker" multiple onchange="getstates(this)" id="country_id" data-live-search="true">
          @foreach($countries as $country)
          <option value="{{$country->id}}" style="padding-left:30px;" @if(in_array($country->id,$employee->countries->pluck('id')->toArray())) selected @endif >{{$country->name}}</option>
          @endforeach
        </select>
       @error('country_id')
       <p style="color:red;">{{$message}}</p>
       @enderror
       </div> 
        <div class="col-3">
     <label >     <input type="checkbox" class="form-control" onchange="selectall('country_id',this)">الكل </label>
       </div>
       <div class="col-3">
           <span class="badge badge-success">{{count($employee->countries)}}</span>
       </div>
       </div>
       <div class="row">
       <div class="form-group col-lg-4 col-md-6">
        <label>المحافظه<span class="text-danger">*</span></label>
        <select name="state_id[]" class="form-control selectpicker" id="state" multiple onchange="getcities(this)"  data-live-search="true">
          @foreach($states as $state)
          <option value="{{$state->id}}" style="padding-left:30px;"  @if(in_array($state->id,$employee->states->pluck('id')->toArray())) selected @endif >{{$state->name}}</option>
          @endforeach
        </select>
       @error('state_id')
       <p style="color:red;">{{$message}}</p>
       @enderror
       </div>     
          <div class="col-3">
     <label >     <input type="checkbox" class="form-control" onchange="selectall('state',this)">الكل </label>
       </div>
        <div class="col-3">
           <span class="badge badge-success">{{count($employee->states)}}</span>
       </div>
       </div>
       <div class="row"><div class="form-group col-lg-4 col-md-6">
        <label>المدينه<span class="text-danger">*</span></label>
        <select name="city_id[]" class="form-control selectpicker" onchange="getzones(this)"  multiple id="city"  data-live-search="true">
          @foreach($cities as $city)
          <option value="{{$city->id}}" style="padding-left:30px;" @if(in_array($city->id,$employee->cities->pluck('id')->toArray())) selected @endif >{{$city->name}}</option>
          @endforeach
        </select>
       @error('city_id')
       <p style="color:red;">{{$message}}</p>
       @enderror
       </div>    
         <div class="col-3">
     <label >     <input type="checkbox" class="form-control" onchange="selectall('city',this)">الكل </label>
       </div>
        <div class="col-3">
           <span class="badge badge-success">{{count($employee->cities)}}</span>
       </div>
       </div><div class="row"> <div class="form-group col-lg-4 col-md-6">
        <label>المنطقه<span class="text-danger">*</span></label>
        <select name="zone_id[]" class="form-control selectpicker" id="zone"  multiple data-live-search="true">
          @foreach($zones as $zone)
          <option value="{{$zone->id}}" style="padding-left:30px;" @if(in_array($zone->id,$employee->zones->pluck('id')->toArray())) selected @endif >{{$zone->name}}</option>
          @endforeach
        </select>
       @error('zone_id')
       <p style="color:red;">{{$message}}</p>
       @enderror
       </div>   
        <div class="col-3">
     <label >     <input type="checkbox" class="form-control" onchange="selectall('zone',this)">الكل </label>
       </div>
        <div class="col-3">
           <span class="badge badge-success">{{count($employee->zones)}}</span>
       </div>
      
 </div>
 

  
</div>
  <button type="submit" class="btn btn-shadow btn-primary font-weight-bold mt-5">
           إضافة
           <span class="svg-icon svg-icon m-0 svg-icon-md">
    			<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
    			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
    					<polygon points="0 0 24 0 24 24 0 24"></polygon>
    					<path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)"></path>
    					<path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)"></path>
    				</g>
    			</svg>
    			<!--end::Svg Icon-->
    		</span>
           
           
           
       </button>
 </form>
 <!--end::Form-->
</div>
@endsection
@section('scripts')
<script>

function getstates(selected){
let id = selected.value;
console.log(id);
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"post",
       url: `../getstatesmultiple`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       data:{
           "country_id":$("#country_id").val()
       },
       success: function(result){
        if(result.status == true){
       $('#state').empty();
       $('#state').append(result.data);
       $('select#state').selectpicker("refresh");
       console.log(result);
     }
       }

      });
    }function getcities(selected){
let id = selected.value;
console.log(id);
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"post",
       url: `../getcitiesmultiple`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
        data:{
           "state_id":$("#state").val()
       },
       success: function(result){
        if(result.status == true){
       $('#city').empty();
       $('#city').append(result.data);
       $('select#city').selectpicker("refresh");
       console.log(result);
     }
       }

      });
    }function getzones(selected){
let id = selected.value;
console.log(id);
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"post",
       url: `../getzonesmultiple`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       data:{
           "city_id":$("#city").val()
       },
       success: function(result){
        if(result.status == true){
       $('#zone').empty();
       $('#zone').append(result.data);
       $('select#zone').selectpicker("refresh");
       console.log(result);
     }
       }

      });
    }
    
function selectall(id,select){
    $(`#${id}`).find("option").prop("selected", $(select).is(':checked'));
    $(`#${id}`).selectpicker("refresh");
    if(id == "country_id"){
     getstates(select);}
     else if(id == "state"){
     getcities(select);
     }else if(id == "city"){
     getzones(select);
     }
     
}
//   if ($(this).find(":selected").text() == "Select All"){
//     if ($(this).attr("data-select") == "false")
//       $(this).attr("data-select", "true").find("option").prop("selected", true);
//     else
//       $(this).attr("data-select", "false").find("option").prop("selected", false);
//   }
</script>
@endsection