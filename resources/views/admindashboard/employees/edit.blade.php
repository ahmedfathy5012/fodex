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
			
			<h3 class="card-label">   تعديل موظف  </h3>
			
		</div>
	</div>
 
 
 <!--begin::Form-->
<form method="post" action="{{route('employee.update',$employee->id)}}" enctype="multipart/form-data">
    @csrf
    @method('put')
  <div class="card-body">
  <div class="row">
    <div class="col-6"><div class="image-input image-input-outline image-input-circle" id="kt_image_3">
        <div class="image-input-wrapper mb-5" id="im" 
        style="background-image:url({{asset('uploads/'. $employee->image)}})"></div>
       
        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow p-5" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
         <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-12-28-020759/theme/html/demo1/dist/../src/media/svg/icons/Devices/Camera.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24"/>
                <path d="M5,7 L19,7 C20.1045695,7 21,7.8954305 21,9 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,9 C3,7.8954305 3.8954305,7 5,7 Z M12,17 C14.209139,17 16,15.209139 16,13 C16,10.790861 14.209139,9 12,9 C9.790861,9 8,10.790861 8,13 C8,15.209139 9.790861,17 12,17 Z" fill="#000000"/>
                <rect fill="#000000" opacity="0.3" x="9" y="4" width="6" height="2" rx="1"/>
                <circle fill="#000000" opacity="0.3" cx="12" cy="13" r="2"/>
            </g>
        </svg><!--end::Svg Icon--></span>
         <input type="file" name="image" id="do" />
         <input type="hidden" name="profile_avatar_remove"/>
        </label>
          <label> صوره </label>
        @error('image')
        <p style="color:red;">{{ $message }}</p>
     @enderror
        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
         <i class="ki ki-bold-close icon-xs text-muted"></i>
        </span>
       </div>
     </div>
     <!-- <div class="col-6"><div class="image-input image-input-outline image-input-circle" id="kt_image_3">-->
     <!--   <div class="image-input-wrapper mb-5" id="im1" style="background-image:url({{asset('uploads/'. $employee->identification_number_image)}})"></div>-->
       
     <!--   <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow p-5" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">-->
     <!--    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-12-28-020759/theme/html/demo1/dist/../src/media/svg/icons/Devices/Camera.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">-->
     <!--       <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">-->
     <!--           <rect x="0" y="0" width="24" height="24"/>-->
     <!--           <path d="M5,7 L19,7 C20.1045695,7 21,7.8954305 21,9 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,9 C3,7.8954305 3.8954305,7 5,7 Z M12,17 C14.209139,17 16,15.209139 16,13 C16,10.790861 14.209139,9 12,9 C9.790861,9 8,10.790861 8,13 C8,15.209139 9.790861,17 12,17 Z" fill="#000000"/>-->
     <!--           <rect fill="#000000" opacity="0.3" x="9" y="4" width="6" height="2" rx="1"/>-->
     <!--           <circle fill="#000000" opacity="0.3" cx="12" cy="13" r="2"/>-->
     <!--       </g>-->
     <!--   </svg><!--end::Svg Icon--></span>-->
     <!--    <input type="file" name="identification_number_image" id="do1" />-->
     <!--    <input type="hidden" name="profile_avatar_remove"/>-->
     <!--   </label>-->
     <!--   <label>صوره البطاقه</label>-->
     <!--   @error('identification_number_image')-->
     <!--   <p style="color:red;">{{ $message }}</p>-->
     <!--@enderror-->
     <!--   <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">-->
     <!--    <i class="ki ki-bold-close icon-xs text-muted"></i>-->
     <!--   </span>-->
     <!--  </div>-->
     <!--</div>-->

     <!--<div class="col-6"><div class="image-input image-input-outline image-input-circle" id="kt_image_3">-->
     <!--   <div class="image-input-wrapper mb-5" id="im2" style="background-image:url({{asset('uploads/'. $employee->residence_deed_image)}})"></div>-->
       
     <!--   <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow p-5" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">-->
     <!--    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-12-28-020759/theme/html/demo1/dist/../src/media/svg/icons/Devices/Camera.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">-->
     <!--       <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">-->
     <!--           <rect x="0" y="0" width="24" height="24"/>-->
     <!--           <path d="M5,7 L19,7 C20.1045695,7 21,7.8954305 21,9 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,9 C3,7.8954305 3.8954305,7 5,7 Z M12,17 C14.209139,17 16,15.209139 16,13 C16,10.790861 14.209139,9 12,9 C9.790861,9 8,10.790861 8,13 C8,15.209139 9.790861,17 12,17 Z" fill="#000000"/>-->
     <!--           <rect fill="#000000" opacity="0.3" x="9" y="4" width="6" height="2" rx="1"/>-->
     <!--           <circle fill="#000000" opacity="0.3" cx="12" cy="13" r="2"/>-->
     <!--       </g>-->
     <!--   </svg><!--end::Svg Icon--></span>-->
     <!--    <input type="file" name="identification_number_image" id="do2" />-->
     <!--    <input type="hidden" name="profile_avatar_remove"/>-->
     <!--   </label>-->
     <!--   <label>صوره الاقامه </label>-->
     <!--   @error('residence_deed_image')-->
     <!--   <p style="color:red;">{{ $message }}</p>-->
     <!--@enderror-->
     <!--   <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" -->
     <!--   data-action="cancel" data-toggle="tooltip" title="Cancel avatar">-->
     <!--    <i class="ki ki-bold-close icon-xs text-muted"></i>-->
     <!--   </span>-->
     <!--  </div>-->
     <!--</div>-->
     <!---->
     <!--     <div class="col-6"><div class="image-input image-input-outline image-input-circle" id="kt_image_3">-->
     <!--   <div class="image-input-wrapper mb-5" id="im4"  @if($contract) -->
     <!--   style="background-image:url({{asset('uploads/'. $contract->paper_contract_image)}})" @endif></div>-->
       
     <!--   <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow p-5" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">-->
     <!--    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-12-28-020759/theme/html/demo1/dist/../src/media/svg/icons/Devices/Camera.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">-->
     <!--       <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">-->
     <!--           <rect x="0" y="0" width="24" height="24"/>-->
     <!--           <path d="M5,7 L19,7 C20.1045695,7 21,7.8954305 21,9 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,9 C3,7.8954305 3.8954305,7 5,7 Z M12,17 C14.209139,17 16,15.209139 16,13 C16,10.790861 14.209139,9 12,9 C9.790861,9 8,10.790861 8,13 C8,15.209139 9.790861,17 12,17 Z" fill="#000000"/>-->
     <!--           <rect fill="#000000" opacity="0.3" x="9" y="4" width="6" height="2" rx="1"/>-->
     <!--           <circle fill="#000000" opacity="0.3" cx="12" cy="13" r="2"/>-->
     <!--       </g>-->
     <!--   </svg><!--end::Svg Icon--></span>-->
     <!--    <input type="file" name="paper_contract_image" id="do4" />-->
     <!--    <input type="hidden" name="profile_avatar_remove"/>-->
     <!--   </label>-->
     <!--   <label>صوره عقد العمل </label>-->
     <!--   @error('paper_contract_image')-->
     <!--   <p style="color:red;">{{ $message }}</p>-->
     <!--@enderror-->
     <!--   <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">-->
     <!--    <i class="ki ki-bold-close icon-xs text-muted"></i>-->
     <!--   </span>-->
     <!--  </div>-->
     <!--</div>-->

</div><div class="row"><div class="col-4"><label>المعلومات الرئسيه</label>
</div>  </div>
      <div class='row'>
   <div class="form-group col-6">
    <label>الاسم    <span class="text-danger">*</span></label>
    <input type="text" class="form-control " value="{{$employee->name}}" name="name"  required="required"/>
    @error('name')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>   
  <div class="form-group col-6">
    <label>رقم الهاتف    <span class="text-danger">*</span></label>
    <input type="text" class="form-control " value="{{$employee->phone}}" name="phone"  required="required"/>
    @error('phone')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>     <div class="form-group col-6">
    <label>رقم الهاتف الثانى (اختياري)    <span class="text-danger">*</span></label>
    <input type="text" class="form-control " value="{{$employee->mobile}}" name="mobile"  />
    @error('mobile')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>     <div class="form-group col-6">
    <label>كلمه السر     <span class="text-danger">*</span></label>
    <input type="password" class="form-control " value="{{old('password')}}" name="password"  />
    @error('password')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>    </div>
   <hr style="width:70%;">
<!--    <div class="row">-->
<!--        <div class="col-4"><label>المعلومات الشخصيه</label>-->
<!--</div>  </div>-->
<!--<div class="row"> <div class="form-group col-6">-->
<!--    <label>المؤهل    <span class="text-danger">*</span></label>-->
<!--    <input type="text" class="form-control " value="{{$employee->qualification}}" name="qualification"  required="required"/>-->
<!--    @error('qualification')-->
<!--    <p style="color:red;">{{ $message }}</p>-->
<!-- @enderror-->
<!--   </div>     <div class="form-group col-6">-->
<!--    <label>تاريخ الميلاد    <span class="text-danger">*</span></label>-->
<!--    <input type="date" class="form-control " value="{{$employee->birthday}}" name="birthday"  required="required"/>-->
<!--    @error('birthday')-->
<!--    <p style="color:red;">{{ $message }}</p>-->
<!-- @enderror-->
<!--   </div>          <div class="form-group col-6">-->
<!--        <label>الجنس <span class="text-danger">*</span></label>-->
<!--        <select name="gender_id" class="form-control selectpicker" id="gender" required="required" data-live-search="true">-->
<!--          @foreach($genders as $gender)-->
<!--          <option value="{{$gender->id}}" @if($employee->gender_id == $gender->id) selected @endif>{{$gender->title}}</option>-->
<!--          @endforeach-->
<!--        </select>-->
<!--       @error('gender_id')-->
<!--       <p style="color:red;">{{$message}}</p>-->
<!--       @enderror-->
<!--       </div>       <div class="form-group col-6">-->
<!--        <label>الحاله الاجتماعيه <span class="text-danger">*</span></label>-->
<!--        <select name="statussocial_id" class="form-control selectpicker" id="statussocial_id" required="required" data-live-search="true">-->
<!--          @foreach($statuss as $status)-->
<!--          <option value="{{$status->id}}" @if($employee->statussocial_id == $status->id) selected @endif>{{$status->title}}</option>-->
<!--          @endforeach-->
<!--        </select>-->
<!--       @error('statussocial_id')-->
<!--       <p style="color:red;" >{{$message}}</p>-->
<!--       @enderror-->
<!--       </div>    -->
<!--          <div class="form-group col-6">-->
<!--        <label> حاله الجيش <span class="text-danger">*</span></label>-->
<!--        <select name="armycase_id" class="form-control selectpicker" id="armycase_id" required="required" data-live-search="true">-->
<!--          @foreach($armycases as $armycase)-->
<!--          <option value="{{$armycase->id}}">{{$armycase->title}}</option>-->
<!--          @endforeach-->
<!--        </select>-->
<!--       @error('armycase_id')-->
<!--       <p style="color:red;" @if($employee->armycase_id == $armycase->id) selected @endif>{{$message}}</p>-->
<!--       @enderror-->
<!--       </div>       <div class="form-group col-6">-->
<!--    <label>تاريخ الانتهاء من الجيش    <span class="text-danger">*</span></label>-->
<!--    <input type="date" class="form-control " value="{{$employee->expiry_date_postponement}}" name="expiry_date_postponement"  />-->
<!--    @error('expiry_date_postponement')-->
<!--    <p style="color:red;">{{ $message }}</p>-->
<!-- @enderror-->
<!--   </div>   -->
<!--   </div> -->
  <hr style="width:70%;">
    <div class="row"><div class="col-4"><label>معلومات العنوان </label>
</div>  </div><div class="row">
     <div class="form-group col-6">
        <label>الدوله<span class="text-danger">*</span></label>
        <select name="country_id" class="form-control selectpicker" onchange="getstates(this)" id="country_id" required="required" data-live-search="true">
          @foreach($countries as $country)
          <option value="{{$country->id}}"  @if($address) @if($address->country_id == $country->id) selected @endif @endif>{{$country->name}}</option>
          @endforeach
        </select>
       @error('country_id')
       <p style="color:red;">{{$message}}</p>
       @enderror
       </div>   <div class="form-group col-6">
        <label>المحافظه<span class="text-danger">*</span></label>
        <select name="state_id" class="form-control selectpicker" id="state"  onchange="getcities(this)" required="required" data-live-search="true">
          @foreach($states as $state)
          <option value="{{$state->id}}"  @if($address) @if($address->state_id == $state->id) selected @endif @endif>{{$state->name}}</option>
          @endforeach
        </select>
       @error('state_id')
       <p style="color:red;">{{$message}}</p>
       @enderror
       </div>      <div class="form-group col-6">
        <label>المدينه<span class="text-danger">*</span></label>
        <select name="city_id" class="form-control selectpicker" onchange="getzones(this)" id="city" required="required" data-live-search="true">
          @foreach($cities as $city)
          <option value="{{$city->id}}"  @if($address) @if($address->city_id == $city->id) selected @endif @endif>{{$city->name}}</option>
          @endforeach
        </select>
       @error('city_id')
       <p style="color:red;">{{$message}}</p>
       @enderror
       </div>     <div class="form-group col-6">
        <label>المنطقه<span class="text-danger">*</span></label>
        <select name="zone_id" class="form-control selectpicker" id="zone" required="required" data-live-search="true">
          @foreach($zones as $zone)
          <option value="{{$zone->id}}"  @if($address)  @if($address->zone_id == $zone->id) selected @endif @endif>{{$zone->name}}</option>
          @endforeach
        </select>
       @error('zone_id')
       <p style="color:red;">{{$message}}</p>
       @enderror
       </div>     
 <div class="form-group col-6">
    <label>الشارع     <span class="text-danger">*</span></label>
    <input type="text" class="form-control "  @if($address) value="{{$address->street}}" @endif name="street"  />
    @error('street')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>     <div class="form-group col-6">
    <label>رقم المبنى      <span class="text-danger">*</span></label>
    <input type="number" class="form-control "  @if($address) value="{{$address->building_number}}" @endif 
    name="building_number"  />
    @error('building_number')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>     <div class="form-group col-6">
    <label>رقم الطابق     <span class="text-danger">*</span></label>
    <input type="number" class="form-control "  @if($address) value="{{$address->floor_number}}" @endif name="floor_number" />
    @error('floor_number')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>    
  <!--     <div class="form-group col-6">-->
  <!--      <label>lat <span class="text-danger">*</span></label>-->
  <!--      <input type="text" class="form-control " @if($address) value="{{$address->lat}}" @endif id="Lat" name="lat" />-->
  <!--     </div>-->
  <!--<div class="form-group col-6">-->
  <!--      <label>lon <span class="text-danger">*</span></label>-->
  <!--      <input type="text" class="form-control "  @if($address) value="{{$address->lon}}" @endif  id="Lng" name="lon" />-->
  <!--     </div>  -->
 <!--      <div class="form-group col-6">-->
 <!--   <label>تاريخ العمل  من     <span class="text-danger">*</span></label>-->
 <!--   <input type="date" class="form-control " @if($contract) value="{{$contract->from_day}}" @endif name="from_day"  required="required"/>-->
 <!--   @error('from_day')-->
 <!--   <p style="color:red;">{{ $message }}</p>-->
 <!--@enderror-->
 <!--  </div> -->
 <!--  <div class="form-group col-6">-->
 <!--   <label>تاريخ العمل  الى      <span class="text-danger">*</span></label>-->
 <!--   <input type="date" class="form-control " @if($contract) value="{{$contract->to_day}}" @endif name="to_day"  required="required"/>-->
 <!--   @error('to_day')-->
 <!--   <p style="color:red;">{{ $message }}</p>-->
 <!--@enderror-->
 <!--  </div> <div class="form-group col-6">-->
 <!--   <label>المرتب         <span class="text-danger">*</span></label>-->
 <!--   <input type="number" class="form-control " @if($contract) value="{{$contract->sallary}}" @endif name="sallary"  required="required"/>-->
 <!--   @error('sallary')-->
 <!--   <p style="color:red;">{{ $message }}</p>-->
 <!--@enderror-->
 <!--  </div> -->
 <!--  </div>-->
 <!--  <div class="row"> <div class="form-group col-lg-6 col-md-12">-->
 <!--   <label>ملاحظات<span class="text-danger">*</span></label>-->
 <!--   <textarea class="form-control" name="notes">@if($contract) {{$contract->notes}} @endif</textarea>-->
 <!--   @error('notes')-->
 <!--   <p style="color:red;">{{ $message }}</p>-->
 <!--@enderror-->
 <!--  </div> -->
     @php
           $models = [      'country' ,
            'state' ,
            'city' ,
              'major' ,
            'category' ,
            'subcategory' ,
              'item' ,
            'incomes' ,
            'seller' ,
              'offers' ,
            'expensetype' ,
            'collectionstypes' ,
             'expenses' ,
            'workschedule' ,
            'expenseemployee' ,
            'employee',
             'zone',
             'driver'];
                                $maps = ['create','read','update','delete']
                            @endphp
 <div class="form-group col-6">
        <label>دور الموظف<span class="text-danger">*</span></label>
        <select name="role_id" class="form-control selectpicker" id="role" required="required" data-live-search="true">
          @foreach($roles as $role)
          <option value="{{$role->id}}" @if($employee->hasRole($role->name)) selected @endif>{{$role->name}}</option>
          @endforeach
        </select>
       @error('role_id')
       <p style="color:red;">{{$message}}</p>
       @enderror
       </div> 
                            <!--<div class="col-xl-12">-->
                            <!--    <label class="mb-3">الصلاحيات</label>-->
                            <!--    <ul class="nav nav-tabs">-->
                            <!--        @foreach($models as $index=>$model)-->
                            <!--        <li class="nav-item">-->
                            <!--            <a href="#{{$model}}" data-toggle="tab" aria-expanded="false" class="nav-link {{$index == 0 ? 'active' : ''}}">-->
                            <!--                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>-->
                            <!--                <span class="d-none d-sm-block">{{__('messages.'.$model)}}</span>-->
                            <!--            </a>-->
                            <!--        </li>-->
                            <!--        @endforeach-->
                            <!--    </ul>-->
                            <!--    <div class="tab-content" style="float:right;">-->
                            <!--        @foreach($models as $index=>$model)-->

                            <!--        <div role="tabpanel" class="tab-pane fade show {{$index == 0 ? 'active' : ''}}" id="{{$model}}">-->
                            <!--            @foreach($maps as $key => $map)-->
                            <!--                <div class="checkbox checkbox-success form-check-inline" >-->
                            <!--                    <input type="checkbox" name="permissions[]" style="opacity:1;z-index:2;"-->
                            <!--                    @if($employee->hasPermission($model .'-'.$map))  checked @endif  id="inlineCheckbox{{$key}}" value="{{$model}}-{{$map}}">-->
                            <!--                    <label for="inlineCheckbox{{$key}}" style="margin-right: 30px;"> {{__('messages.'.$map)}}</label>-->
                            <!--                </div>-->
                            <!--             @endforeach-->
                            <!--        </div>-->
                            <!--            @endforeach-->
                            <!--    </div>-->
                            <!--</div><!-- end col -->
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
  
           function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#im').css('background-image', 0);
            
            $('#im').css('background-image', "url(" + e.target.result + ")");
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#do").change(function(){
    readURL(this);
    console.log($('#im').css('background-image'));
   
});
          function readURL1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#im1').css('background-image', 0);
            
            $('#im1').css('background-image', "url(" + e.target.result + ")");
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#do1").change(function(){
    readURL1(this);
    console.log($('#im1').css('background-image'));
   
});      function readURL2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#im2').css('background-image', 0);
            
            $('#im2').css('background-image', "url(" + e.target.result + ")");
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#do2").change(function(){
    readURL2(this);
    console.log($('#im2').css('background-image'));
   
});
  function readURL4(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#im4').css('background-image', 0);
            
            $('#im4').css('background-image', "url(" + e.target.result + ")");
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#do4").change(function(){
    readURL4(this);
    console.log($('#im4').css('background-image'));
   
});

function getstates(selected){
let id = selected.value;
console.log(id);
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `../getstates/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
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
       type:"get",
       url: `../getcities/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
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
       type:"get",
       url: `../getzones/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
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

function initMap(_Lat = '',_Lng = '') {
           let lat1 = $('#Lat').val();
           let lng1 =   $('#Lng').val();
              if ( _Lat ) {
              	var LatLng = new google.maps.LatLng(_Lat, _Lng);
              } else {
              	var LatLng = new google.maps.LatLng(lat1, lng1);
              }

                
                
                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 8,
                    center: LatLng,
                });
                
                let marker = new google.maps.Marker({
                    map,
                    animation: google.maps.Animation.DROP,
                    position: LatLng,
                });
                
                map.addListener("click", (mapsMouseEvent) => {
                    marker.setMap(null);
                    marker = new google.maps.Marker({
                        map,
                        position: mapsMouseEvent.latLng,
                    });
                    const cityCircle = new google.maps.Circle({
                      strokeColor: "#000",
                      strokeOpacity: 0.8,
                      strokeWeight: 2,
                      fillColor: "#fff",
                      fillOpacity: 0.35,
                      map,
                      center: mapsMouseEvent.latLng,
                      radius: 6000,
                    });
                    var Lat = mapsMouseEvent.latLng.lat();
                    var Lng = mapsMouseEvent.latLng.lng();
                    $('#Lat').val(Lat);
                    $('#Lng').val(Lng);
                });
                
            }
</script>
@endsection