@extends('layouts.adminindex')
@section('content')
<style>
    #tag_id {
  width: 100%;
}
</style>
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
			
			<h3 class="card-label"> {{ $title }}  </h3>
			
		</div>
	</div>
 
 
 <!--begin::Form-->
<form method="post" action="{{route('seller.store')}}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="is_central" value="{{ $is_central }}">
  <div class="card-body">
          <div class="row">
      <div class="mx-auto col-4">
        

      <label id="label" for="gallery-photo-add"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> تحميل صوره</label>
          <input type="file"  id="gallery-photo-add" class="image custom-file-input" name="image[]" required>
      </div>
    @error('image')
        <p style="color:red;">{{ $message }}</p>
     @enderror
</div>
     
 <div class="row" id="row">
</div>
  <div class="row">
     <!--        <div class="col-4"><div class="image-input image-input-outline image-input-circle" id="kt_image_3">-->
     <!--   <div class="image-input-wrapper mb-5" id="im4" ></div>-->
       
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
 <div class="col-4"><div class="image-input image-input-outline image-input-circle" id="kt_image_2">
        <div class="image-input-wrapper mb-5" id="im2" ></div>
       
        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow p-5" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
         <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-12-28-020759/theme/html/demo1/dist/../src/media/svg/icons/Devices/Camera.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24"/>
                <path d="M5,7 L19,7 C20.1045695,7 21,7.8954305 21,9 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,9 C3,7.8954305 3.8954305,7 5,7 Z M12,17 C14.209139,17 16,15.209139 16,13 C16,10.790861 14.209139,9 12,9 C9.790861,9 8,10.790861 8,13 C8,15.209139 9.790861,17 12,17 Z" fill="#000000"/>
                <rect fill="#000000" opacity="0.3" x="9" y="4" width="6" height="2" rx="1"/>
                <circle fill="#000000" opacity="0.3" cx="12" cy="13" r="2"/>
            </g>
        </svg><!--end::Svg Icon--></span>
         <input type="file" name="logo" id="do3" />
         <input type="hidden" name="profile_avatar_remove"/>
        </label>
        <label>  logo photo </label>
        @error('logo')
        <p style="color:red;">{{ $message }}</p>
     @enderror
        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
         <i class="ki ki-bold-close icon-xs text-muted"></i>
        </span>
       </div>
     </div> <div class="col-5"><div class="image-input image-input-outline image-input-circle" id="kt_image_1">
        <div class="image-input-wrapper mb-5" id="im1" ></div>
       
        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow p-5" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
         <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-12-28-020759/theme/html/demo1/dist/../src/media/svg/icons/Devices/Camera.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24"/>
                <path d="M5,7 L19,7 C20.1045695,7 21,7.8954305 21,9 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,9 C3,7.8954305 3.8954305,7 5,7 Z M12,17 C14.209139,17 16,15.209139 16,13 C16,10.790861 14.209139,9 12,9 C9.790861,9 8,10.790861 8,13 C8,15.209139 9.790861,17 12,17 Z" fill="#000000"/>
                <rect fill="#000000" opacity="0.3" x="9" y="4" width="6" height="2" rx="1"/>
                <circle fill="#000000" opacity="0.3" cx="12" cy="13" r="2"/>
            </g>
        </svg><!--end::Svg Icon--></span>
         <input type="file" name="cover" id="do2" />
         <input type="hidden" name="profile_avatar_remove"/>
        </label>
        <label>  cover photo </label>
        @error('cover')
        <p style="color:red;">{{ $message }}</p>
     @enderror
        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
         <i class="ki ki-bold-close icon-xs text-muted"></i>
        </span>
       </div>
     </div>
</div>
<div class="row"><div class="col-4"><label>المعلومات الرئسيه</label>
</div>  </div>
      <div class='row'>
   <div class="form-group col-6">
    <label>الاسم    <span class="text-danger">*</span></label>
    <input type="text" class="form-control " value="{{old('name')}}" name="name"  required="required"/>
    @error('name')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>   
  <div class="form-group col-6">
    <label>رقم الهاتف    <span class="text-danger">*</span></label>
    <input type="text" class="form-control " value="{{old('phone')}}" name="phone"  required="required"/>
    @error('phone')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>     <div class="form-group col-6">
    <label>رقم الهاتف الثانى (اختياري)    <span class="text-danger">*</span></label>
    <input type="text" class="form-control " value="{{old('mobile')}}" name="mobile"  />
    @error('mobile')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>     <div class="form-group col-6">
    <label>كلمه السر     <span class="text-danger">*</span></label>
    <input type="password" class="form-control " value="{{old('password')}}" name="password"  required="required"/>
    @error('password')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div> 
      <div class="col-6">
          <span class="switch btn btns-m switch-outline switch-icon switch-primary">
              متفق معه
    <label>
        <input type="checkbox"  name="agreed" 
      
         value="1"/>
        <span></span>
    </label>
</span>
   </div></div>  
    <div class="row"><hr style="width:70%;"></div>
   <div class="row">
      <div class="col-4"><label>المعلومات الشخصيه</label>
</div>  </div>
      <div class='row'>           <div class="form-group col-6">
        <label>القسم  <span class="text-danger">*</span></label>
        <select name="major_id" class="form-control selectpicker" onchange="getsubcategories(this)" id="major" required="required" data-live-search="true">
          @foreach($majors as $major)
          <option value="{{$major->id}}">{{$major->title}}</option>
          @endforeach
        </select>
       @error('major_id')
       <p style="color:red;">{{$message}}</p>
       @enderror
       </div>   
        <div class="form-group col-6">
       <label class="container">category
  <input type="radio" checked="checked" name="is_subcategory" value="0">
  <span class="checkmark"></span>
</label>
<label class="container">subcategory
  <input type="radio" name="is_subcategory" value="1">
  <span class="checkmark"></span>
</label>
</div>
       <!--<div class="form-group col-6">-->
       <!-- <label>القسم الرئيسى   <span class="text-danger">*</span></label>-->
       <!-- <select name="category_id[]" multiple class="form-control selectpicker" id="sub" required="required" data-live-search="true">-->
       <!--   @foreach($categories as $category)-->
       <!--   <option value="{{$category->id}}">{{$category->title}}</option>-->
       <!--   @endforeach-->
       <!-- </select>-->
       <!--@error('category_id')-->
       <!--<p style="color:red;">{{$message}}</p>-->
       <!--@enderror-->
       <!--</div>         -->
       <div class="form-group col-6">
        <label>  الوسوم   <span class="text-danger">*</span></label>
        <select name="tag_id[]"  multiple="multiple" class="form-control" id="tag_id"  data-live-search="true">
          @foreach($tags as $tag)
          <option value="{{$tag->id}}" >{{$tag->title}}</option>
          @endforeach
        </select>
       @error('category_id')
       <p style="color:red;">{{$message}}</p>
       @enderror
       </div>  <div class="form-group col-6">
    <label>وقت التحضير    <span class="text-danger">*</span></label>
    <input type="number" class="form-control " value="{{old('prepare_time')}}" name="prepare_time"  required="required"/>
    @error('prepare_time')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>  
             <div class="form-group col-6">
        <label>طرق الدفع  <span class="text-danger">*</span></label>
        <select name="payment_id[]" class="form-control selectpicker" multiple  data-live-search="true">
          @foreach($payments as $payment)
          <option value="{{$payment->id}}">{{$payment->title}}</option>
          @endforeach
        </select>
       @error('payment_id')
       <p style="color:red;">{{$message}}</p>
       @enderror
       </div>
       <div class="form-group col-6">
    <label>الحد الادنى للطلب<span class="text-danger">*</span></label>
    <input type="number" class="form-control " value="{{old('min_order')}}" name="min_order"  required="required"/>
    @error('min_order')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>  
       </div>
       <div class="row">
        <div class="form-group col-6">
    <label>نسبه الخصم     <span class="text-danger">*</span></label>
    <input type="number" class="form-control " value="{{old('discount')}}" name="discount"  />
    @error('discount')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>    <div class="form-group col-6">
    <label> سعر التوصيل     <span class="text-danger">*</span></label>
    <input type="number" class="form-control " value="{{old('delivery_money')}}" name="delivery_money"  />
    @error('delivery_money')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>
   <div class="col-6">
     <span class="switch btn btns-m switch-outline switch-icon switch-primary">
    <label>
        <input type="checkbox"  name="is_new" 
       
         value="1"/>
        <span></span>
       
     
     
    </label>   جديد
</span>
   
   </div>
 <!--           <div class="form-group col-6">-->
 <!--   <label> النسبه<span class="text-danger">*</span></label>-->
 <!--   <input type="number" class="form-control " value="{{old('commission')}}" name="commission"  required="required"/>-->
 <!--   @error('commission')-->
 <!--   <p style="color:red;">{{ $message }}</p>-->
 <!--@enderror-->
 <!--  </div> -->
 </div> 
  
  <div class="row"><hr style="width:70%;"></div>
    <div class="row"><div class="col-4"><label>معلومات العنوان </label>
</div>  </div><div class="row">
     <div class="form-group col-6">
        <label>الدوله<span class="text-danger">*</span></label>
        <select name="country_id" class="form-control selectpicker" onchange="getstates(this)" id="country_id" required="required" data-live-search="true">
          @foreach($countries as $country)
          <option value="{{$country->id}}">{{$country->name}}</option>
          @endforeach
        </select>
       @error('country_id')
       <p style="color:red;">{{$message}}</p>
       @enderror
       </div>   <div class="form-group col-6">
        <label>المحافظه<span class="text-danger">*</span></label>
        <select name="state_id" class="form-control selectpicker" id="state"  onchange="getcities(this)" required="required" data-live-search="true">
          @foreach($states as $state)
          <option value="{{$state->id}}">{{$state->name}}</option>
          @endforeach
        </select>
       @error('state_id')
       <p style="color:red;">{{$message}}</p>
       @enderror
       </div>      <div class="form-group col-6">
        <label>المدينه<span class="text-danger">*</span></label>
        <select name="city_id" class="form-control selectpicker" onchange="getzones(this)" id="city" required="required" data-live-search="true">
          @foreach($cities as $city)
          <option value="{{$city->id}}">{{$city->name}}</option>
          @endforeach
        </select>
       @error('city_id')
       <p style="color:red;">{{$message}}</p>
       @enderror
       </div>     <div class="form-group col-6">
        <label>المنطقه<span class="text-danger">*</span></label>
        <select name="zone_id" class="form-control selectpicker" id="zone" required="required" data-live-search="true">
          @foreach($zones as $zone)
          <option value="{{$zone->id}}">{{$zone->name}}</option>
          @endforeach
        </select>
       @error('zone_id')
       <p style="color:red;">{{$message}}</p>
       @enderror
       </div>     
 <div class="form-group col-6">
    <label>الشارع     <span class="text-danger">*</span></label>
    <input type="text" class="form-control " value="{{old('street')}}" name="street"  required="required"/>
    @error('street')
    <p style="color:red;">{{ $message }}</p>
 @enderror
  </div>   
<div class="form-group col-6">
    <label>العنوان     <span class="text-danger">*</span></label>
    <input type="text" class="form-control " value="{{old('address')}}" name="address"  required="required"/>
    @error('address')
    <p style="color:red;">{{ $message }}</p>
 @enderror
  </div>   

 <div class="form-group col-6">
    <label> المسافه<span class="text-danger">*</span></label>
    <input type="number" class="form-control " value="{{$number->res_distance ?? ''}}" name="distance_range"  required="required"/>
    @error('distance_range')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>    
   <div id="map" style="width:100%;height:400px; ">
     </div>
       <div class="form-group col-6">
        <label>lat <span class="text-danger">*</span></label>
        <input type="text" class="form-control " value="{{old('lat')}}" id="Lat" name="lat" />
       </div>
  <div class="form-group col-6">
        <label>lon <span class="text-danger">*</span></label>
        <input type="text" class="form-control " value="{{old('lon')}}"  id="Lng" name="lon" />
       </div>
 <!--<div class="form-group col-6">-->
 <!--   <label>تاريخ العمل  من     <span class="text-danger">*</span></label>-->
 <!--   <input type="date" class="form-control " value="{{old('from_day')}}" name="from_day"  required="required"/>-->
 <!--   @error('from_day')-->
 <!--   <p style="color:red;">{{ $message }}</p>-->
 <!--@enderror-->
 <!--  </div> <div class="form-group col-6">-->
 <!--   <label>تاريخ العمل  الى      <span class="text-danger">*</span></label>-->
 <!--   <input type="date" class="form-control " value="{{old('to_day')}}" name="to_day"  required="required"/>-->
 <!--   @error('to_day')-->
 <!--   <p style="color:red;">{{ $message }}</p>-->
 <!--@enderror-->
 <!--  </div> <div class="form-group col-6">-->
 <!--   <label>النسبه المئويه         <span class="text-danger">*</span></label>-->
 <!--   <input type="number" class="form-control " value="{{old('percentage')}}" name="percentage"  required="required"/>-->
 <!--   @error('percentage')-->
 <!--   <p style="color:red;">{{ $message }}</p>-->
 <!--@enderror-->
 <!--  </div> -->
 <!--  </div>-->
 <!--  <div class="row"> <div class="form-group col-lg-6 col-md-12">-->
 <!--   <label> ملاحظات  عن العمل  <span class="text-danger">*</span></label>-->
 <!--   <textarea class="form-control" name="notes">{{old('notes')}}</textarea>-->
 <!--   @error('notes')-->
 <!--   <p style="color:red;">{{ $message }}</p>-->
 <!--@enderror-->
   <!--</div>-->
   <div class="form-group col-lg-6 col-md-12">
    <label> وصف البائع     <span class="text-danger">*</span></label>
    <textarea class="form-control" rows="6" name="description">{{old('description')}}</textarea>
    @error('description')
    <p style="color:red;">{{ $message }}</p>
 @enderror
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

@endsection
@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
    function initialize() {
        var myLatlng = new google.maps.LatLng(25.381427, 49.582997);

        var mapOptions = {
            center: myLatlng,
            zoom: 14
        };

        var map = new google.maps.Map(document.getElementById("map"), mapOptions);
        var geocoder = new google.maps.Geocoder;
        var infowindow = new google.maps.InfoWindow;

        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: 'I move with you man :)'
        });

        google.maps.event.addListener(map, 'click', function(e) {
            //marker.setPosition(e.latLng);
            map.panTo(e.latLng)
            var Lat = e.latLng.lat();
                    var Lng = e.latLng.lng();
                    $('#Lat').val(Lat);
                    $('#Lng').val(Lng);
            //map.setCenter(e.latLng);
        });
        
        google.maps.event.addListener(map, 'center_changed', function() {
            var center = map.getCenter();
            marker.setPosition(center);

            window.setTimeout(function() {
                geocodeLatLng(geocoder, map, infowindow, marker);
            }, 2000);
        });
    }

    function geocodeLatLng(geocoder, map, infowindow, marker) {
        geocoder.geocode({
            'location': marker.position
        }, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                console.log(results);
                if (results[1]) {
                    //map.setZoom(11);
                    infowindow.setContent(results[1].formatted_address);
                    infowindow.open(map, marker);
                } else {
                    console.warn('GeoCoder: No results found');
                }
            } else {
                console.warn('Geocoder failed due to: ' + status);
            }
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
    </script>
<script>
  
    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#im1').css('background-image', 0);
            
            $('#im1').css('background-image', "url(" + e.target.result + ")");
        }

        reader.readAsDataURL(input.files[0]);
    }
}
$("#do2").change(function(){
    readURL(this);
    console.log($('#im1').css('background-image'));
   
});
 function readURL1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#im2').css('background-image', 0);
            
            $('#im2').css('background-image', "url(" + e.target.result + ")");
        }

        reader.readAsDataURL(input.files[0]);
    }
}
$("#do3").change(function(){
    readURL1(this);
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
    }function getsubcategories(selected){
let id = selected.value;
console.log(id);
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `../getsubcategories/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        if(result.status == true){
       $('#sub').empty();
       $('#sub').append(result.data);
       $('select#sub').selectpicker("refresh");
       console.log(result);
     }
       }

      });
    }
$(".image:file").change(function() {
               $('#row').empty();
    if (this.files && this.files[0]) {
      for (var i = 0; i < this.files.length; i++) {
        var reader = new FileReader();
        reader.onload = imageIsLoaded;
        reader.readAsDataURL(this.files[i]);
      }
    }
  });
function imageIsLoaded(e) {

  $('#row').append('<div class="col-xl-4 col-6 col-sm-12 d-flex align-items-center"><figure class="imghvr-fade"><img style="width:100px;height:100px;"src=' + e.target.result + '></figure></div>');
};
            $('#tag_id').select2({
  tags: false
});
</script>
@endsection