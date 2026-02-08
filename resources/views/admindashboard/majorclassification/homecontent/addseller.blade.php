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
			
			<h3 class="card-label"> add classification major homecontent     </h3>
			
		</div>
	</div>
 
 
 <!--begin::Form-->
<form method="post" action="{{route('updatemajorcontentseller',$home->id)}}" enctype="multipart/form-data">
    @csrf
  <div class="card-body">
  <div class="row"><div class="image-input image-input-outline image-input-circle" id="kt_image_3">
        <div class="image-input-wrapper mb-5" id="im" 
        style="background-image:url({{asset('uploads/'.$home->image)}})"></div>
       
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
        @error('image')
        <p style="color:red;">{{ $message }}</p>
     @enderror
        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
         <i class="ki ki-bold-close icon-xs text-muted"></i>
        </span>
       </div>
</div>
      <div class='row'>
   <div class="form-group col-lg-4 col-md-12">
    <label>الاسم    <span class="text-danger">*</span></label>
    <input type="text" class="form-control " value="{{$home->title}}" name="title"  required="required"/>
    @error('title')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>   

  </div>
     <div class='row'>
   <div class="form-group col-lg-4 col-md-12">
    <label>البائعين    <span class="text-danger">*</span></label>
      <select name="seller_id[]" class="form-control selectpicker"
      multiple
    required="required" id="seller_id" onchange="addseller()" data-live-search="true">
          @foreach($sellers as $seller)
          <option value="{{$seller->id}}"style="padding-left:30px;" 
     
          @if(in_array($seller->id,$home->sellers->pluck('id')->toArray())) selected @endif>{{$seller->name}}</option>
          @endforeach
        </select>
       @error('seller_id')
       <p style="color:red;">{{$message}}</p>
       @enderror

   </div>   

  </div>
  <div class="row" id="row">
    @foreach($home->sellers as $seller)
    <span class="badge badge-success" id="{{$seller->id}}" style="height:25px;margin:4px;font-size:15px;position:relative;">
        {{$seller->name}}
    <span onClick='deleteselect({{$seller->id}},"{{$seller->name}}");'
    style="cursor:pointer;position:absolute;right:-5px;color:red;padding-left:3px;">X</span></span>
 
    @endforeach
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
function addseller(){
    var values = $('#seller_id').find(":selected").text();
    console.log(values);
    $("#row").empty()
    $("#seller_id option:selected").each(function () {
   var $this = $(this);
   if ($this.length) {
    $("#row").append(`<span  id="${$this.val()}" class="badge badge-success" style="height:25px;margin:4px;font-size:15px;position:relative;">
    ${$this.text()}    <span onClick='deleteselect(${$this.val()}, "${$this.text()}")'
    style="cursor:pointer;position:absolute;right:-5px;color:red;padding-left:3px;">X</span></span>`);
   }
});
 
   // console.log("dwdds");
}
     function deleteselect(id,text){
         $(`#${id}`).remove();
          $('#seller_id :selected').each(function(i, selected){
           if($(this).val() == id){
           $("select option[value='"+id+"']").prop("selected", false); // to deselect that option from selectbox
          //   $("select option[value='"+id+"']").removeAttr("selected");
          let divElem = $(`.filter-option-inner-inner`);
        let newContent =  $(`.filter-option-inner-inner`).html().replace(text + ',','');
     //    let newContent =  $(`.filter-option-inner-inner`).html().replace(text,'');
        divElem.html(newContent)
           }
        });
     }   
</script>
@endsection