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
            
            <h3 class="card-label">   اضافه جدول عمل  </h3>
            
        </div>
    </div>
 
 
 <!--begin::Form-->
<form method="post" action="{{route('sellerworkschedule.store',$seller->id)}}" enctype="multipart/form-data">
    @csrf
  <div class="card-body">
    
</div>
    

   
<section id="section1">
  <label>الايام   </label>
 <div class="row" style="position: relative;">
  <div class="form-group col-lg-4 col-md-6">
        <label>اليوم <span class="text-danger">*</span></label>
        <select name="day_id[]" class="form-control selectpicker" required="required"   data-live-search="true">
          @foreach($days as $day)
          <option value="{{$day->id}}">{{$day->day_ar}}</option>
          @endforeach
        </select>
       @error('seller_id')
       <p style="color:red;">{{$message}}</p>
       @enderror
       </div>  
   
  <div class="form-group col-3">
    <label>من    <span class="text-danger">*</span></label>
    <input type="time" class="form-control " value="{{old('from')}}" name="from[]"  required="required"/>
    @error('from')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>    
   <div class="form-group col-3">
    <label>الى  <span class="text-danger">*</span></label>
    <input type="time" class="form-control " value="{{old('to')}}" name="to[]"  required="required"/>
    @error('to')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>   
<span class="svg-icon svg-icon-primary svg-icon-2x col-2 d-inline-block"
 style="position: absolute;top:30px;left:0px;" id="addf">
    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Plus.svg-->
    <svg xmlns="http://www.w3.org/2000/svg"
    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
        <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,
        6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,
        12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 
        C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 
        C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>
    
</div>
</section>
<!---->
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
  
let id = 1;
    $('#addf').click(function(){
 var table = $('.dataTable').DataTable();
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    
    $.ajax({
       type:"get",
       url: `../getdays`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
           if(result.status == true){

    console.log(`<div class="row" style="position: relative;"  id="remov">
  <div class="form-group col-lg-4 col-md-6  col-3">
        <label>اليوم <span class="text-danger">*</span></label>
        <select name="day_id[]" class="form-control selectpicker" required="required"   data-live-search="true">` + result.data +`
       
        </select>`);

        $('#section1').append(`
 <div class="row" style="position: relative;"  id="remov${id}">
  <div class="form-group col-lg-4 col-md-6  col-3">
        <label>اليوم <span class="text-danger">*</span></label>
        <select name="day_id[]" class="form-control "  required="required"   
        data-live-search="true">${result.data}
       
        </select>
       </div>  
   
  <div class="form-group col-3">
    <label>من    <span class="text-danger">*</span></label>
    <input type="time" class="form-control " value="{{old('from')}}" name="from[]"  required="required"/>
    @error('from')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>    
   <div class="form-group col-3">
    <label>الى  <span class="text-danger">*</span></label>
    <input type="time" class="form-control " value="{{old('to')}}" name="to[]"  required="required"/>
    @error('to')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>   

<span class="col-2 d-inline-block"  style="position: absolute;top:30px;left:0px;" onclick="removef(${id})">
    <span class="svg-icon svg-icon-danger svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-12-28-020759/theme/html/demo1/dist/../src/media/svg/icons/Code/Error-circle.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <rect x="0" y="0" width="24" height="24"/>
            <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
            <path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#000000"/>
        </g>
    </svg><!--end::Svg Icon--></span>
</span>
</div>`);
        $(".selectpicker").select("refresh");
id++;
           }
       }
    });
    });
    function removef(id){
    $(`#remove${id}`).remove();
    $(`#remov${id}`).remove();
    id--;
    }
    
</script>
@endsection