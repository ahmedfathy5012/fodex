@extends('layouts.sellerindex')
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
			
			<h3 class="card-label"> تعديل منتج </h3>
			
		</div>
	</div>
 
 
 <!--begin::Form-->
<form method="post" action="{{route('myitems.update',$item->id)}}" enctype="multipart/form-data">
    @csrf
    @method('put')
  <div class="card-body">
           <div class="row">
      <div class="mx-auto col-4">
        

      <label id="label" for="gallery-photo-add"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> تحميل صور</label>
          <input type="file"  id="gallery-photo-add" class="image custom-file-input" name="image[]" >
      </div>
    @error('image')
        <p style="color:red;">{{ $message }}</p>
     @enderror
</div>
 <div class="row" id="row">
  @if($item->images)
  @foreach($item->images as $image)
  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 d-flex align-items-center"><figure class="imghvr-fade"><img style="width:100px;height:100px;"src="{{asset('uploads/'.$image->image)}}"></figure></div>
  @endforeach
  @endif
</div>
</div>
      <div class='row'>
   <div class="form-group col-6">
    <label>الاسم     <span class="text-danger">*</span></label>
    <input type="text" class="form-control " value="{{$item->title}}" name="title"  required="required"/>
    @error('title')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>   
  <div class="form-group col-6">
    <label>السعر    <span class="text-danger">*</span></label>
    <input type="number" class="form-control " value="{{$item->price}}" name="price"  required="required"/>
    @error('price')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>     <div class="form-group col-6">
    <label>الخصم   <span class="text-danger">*</span></label>
    <input type="number" class="form-control " value="{{$item->discount}}" name="discount" />
    @error('discount')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>       <div class="form-group col-6">
    <label>الخصم من    <span class="text-danger">*</span></label>
    <input type="date" class="form-control "  name="discount_from" value="{{$item->discount_from}}"/>
    @error('discount_from')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div> 
      <div class="form-group col-6">
    <label>الخصم الى    <span class="text-danger">*</span></label>
    <input type="date" class="form-control "  name="discount_to" value="{{$item->discount_to}}"/>
    @error('discount_to')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>      <div class="form-group col-6">
    <label>وقت التحضير   <span class="text-danger">*</span></label>
    <input type="number" class="form-control " value="{{$item->prepare_time}}" name="prepare_time"  required="required"/>
    @error('prepare_time')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>    <div class="form-group col-6">
    <label>السعرات الحراريه<span class="text-danger">*</span></label>
    <input type="number" class="form-control " value="{{$item->calory}}" name="calory"  />
    @error('calory')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>   
    
         <div class="form-group col-6">
        <label>القسم الرئيسى  <span class="text-danger">*</span></label>
        <select name="category_id" class="form-control selectpicker" onchange="filter_subcategories(this)" id="category_id" 
        required="required" data-live-search="true">
          @foreach($categories as $category)
          <option value="{{$category->id}}"  @if($item->category_id == $category->id) selected @endif>{{$category->title}}</option>
          @endforeach
        </select>
       </div> 
         @if($item->subcategory)
         <div class="form-group col-6">
      <label>القسم الفرعى  <span class="text-danger">*</span></label>
        <select name="subcategory_id" class="form-control selectpicker" id="subcategory_id" 
       data-live-search="true">
             
            <option value="{{$item->subcategory_id}}"  selected >{{$item->subcategory->title ?? ""}}</option>
          
        </select>
       </div> 
       @endif
    <div class="form-group col-lg-6 col-md-12">
    <label> الوصف      <span class="text-danger">*</span></label>
    <textarea class="form-control" rows ="5" name="description">{{$item->description}}</textarea>
    @error('description')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>         
</div>

 <div class="col-4 mx-auto mb-5 mt-5">
                                          <button type="button"  id="addf" class="btn btn-primary btn-light-primary w-100 d-flex justify-content-center align-items-center">
                                            اضافه حجم
                                        </button>
                                    </div>
                                     <div class="col-4 mx-auto mb-5 mt-5">
                                        <button type="button"  id="adds" class="btn btn-success btn-light-success  w-100 d-flex justify-content-center align-items-center">
                                            اضافه اكسترا
                                        </button>
                                    </div>
                                    
                                     <div class="row">
  <label style="display:block;margin-right:24px;">الاحجام </label>
 </div>
<section id="section1">

  @if($item->sizes)
  @foreach($item->sizes as $size)
 <div class="row" style="position: relative;" 
 id="remov{{$size->id}}">
  <div class="form-group col-3">
        <label>اسم الحجم <span class="text-danger">*</span></label>
    <input type="text" class="form-control " name="sizename[]" required="required" value="{{$size->title}}"    />
   @error('sizename')
   <p style="color:red;">{{$message}}</p>
   @enderror
 
  </div>
   
  <div class="form-group col-3">
    <label>السعر    <span class="text-danger">*</span></label>
    <input type="number" class="form-control " value="{{$size->price}}" name="sizeprice[]"  required="required"/>
    @error('sizeprice')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>    
   <div class="form-group col-3">
    <label>السعرات الحراريه<span class="text-danger">*</span></label>
    <input type="number" class="form-control " value="{{$size->calory}}" name="sizecalory[]"  required="required"/>
    @error('sizecalory')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>   
   <div class="form-group col-1">
    <label>default <span class="text-danger">*</span></label>
    <input type="checkbox" class="form-control " value="1" name="size_default[]" @if($size->size_default == 1) checked @endif  />
    @error('size_default')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div> 
  <div class="form-group col-1 mt-4">
        <button class="btn btn-sm  font-weight-bolder btn-light-danger" type="button" onclick="removef({{$size->id}})">مسح</button>
        </div>

    
</div>
@endforeach
@endif
</section>
<!---->
      <div class="row">
  <label style="display:block;margin-right:24px;">الاضافات </label>
 </div>
<section id ="section2">
  
  @if($item->extras)
  @foreach($item->extras as $key3 =>$extra)
     

   <div id="removes{{$key3}}">
    <div class="row all"   style="position: relative;" >
  <div class="form-group col-2">
        <label>الاسم  <span class="text-danger">*</span></label>
    <input type="text" class="form-control " name="extrname[]" required="required" value="{{$extra->title}}"    />
   @error('extrname')
   <p style="color:red;">{{$message}}</p>
   @enderror
 
  </div>
   <div class="form-group col-2">
        <label> السعرات   <span class="text-danger">*</span></label>
    <input type="text" class="form-control " name="extracalory[]" required="required"  value="{{$extra->calory}}"  />
   @error('calory')
   <p style="color:red;">{{$message}}</p>
   @enderror
 
  </div>
  <div class="form-group col-2">
    <label>السعر     <span class="text-danger">*</span></label>
    <input type="number" class="form-control " value="{{$extra->price}}"  name="extrprice[]"  required="required"/>
    @error('extrprice')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div> 
     <div class="form-group col-1">
    <label>العدد     <span class="text-danger">*</span></label>
    <input type="number" class="form-control "  value="{{$extra->count_number}}" name="count_number[]"   required="required"/>
    @error('count_number')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>      <div class="form-group col-1">
    <label>متعدد     <span class="text-danger">*</span></label>
    <input type="checkbox" class="form-control " value="1" @if($extra->multiple == 1) checked @endif name="multiple[]"  />
    @error('multiple')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>
   <div class="form-group col-1 mt-4">
        <button class="btn btn-sm  font-weight-bolder btn-light-danger" type="button" onclick="removes({{$extra->id}})">مسح</button>
        </div>
   <div class="form-group col-1 mt-4">
        <button class="btn btn-sm  font-weight-bolder btn-light-success" type="button" onclick="get1({{$key3}})">اضافه</button>
        </div>
  

</div>

  @if($extra->extraDetails)
  @foreach($extra->extraDetails as $key => $de)

   <div class="row news" style="position: relative;"  id="removec{{$de->id}}">
 <div class="col-2"></div>
 <div class="form-group col-3">
        <label>اسم ال extra  <span class="text-danger">*</span></label>
    <input type="text" class="form-control " name="extrname{{$key3}}[]" required="required"
     value="{{$de->title}}"    />
   @error('extrname2')
   <p style="color:red;">{{$message}}</p>
   @enderror
 
  </div>
  <div class="form-group col-3">
    <label>السعر     <span class="text-danger">*</span></label>
    <input type="number" class="form-control " value="{{$de->extra_price}}" name="extrprice{{$key3}}[]"  required="required"/>
    @error('extrprice')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>    
    <div class="form-group col-1">
    <label>default     <span class="text-danger">*</span></label>
    <input type="checkbox" class="form-control " value="1" name="default{{$key3}}[]"  @if($de->default_new == 1) checked @endif/>
    @error('default')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div> 
    <div class="form-group col-1 mt-4">
        <button class="btn btn-sm  font-weight-bolder btn-light-danger" type="button" onclick="removec({{$de->id}})">مسح</button>
        </div>

</div>

@endforeach
@endif

   @endforeach
   @endif
</section>
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

let id = $("#section1 .row").length;
    $('#addf').click(function(){
        $('#section1').append(`
 <div class="row" style="position: relative;"  id="remov${id}">
  <div class="form-group col-3">
        <label>اسم الحجم <span class="text-danger">*</span></label>
    <input type="text" class="form-control " required="required" name="sizename[]"  value="{{old('sizename')}}"    />
   @error('sizename')
   <p style="color:red;">{{$message}}</p>
   @enderror
 
  </div>
      
  <div class="form-group col-3">
    <label>السعر    <span class="text-danger">*</span></label>
    <input type="number" class="form-control " value="{{old('sizeprice')}}" name="sizeprice[]"  required="required"/>
    @error('sizeprice')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>    
   <div class="form-group col-2">
    <label>السعرات الحراريه<span class="text-danger">*</span></label>
    <input type="number" class="form-control " value="{{old('sizecalory')}}" name="sizecalory[]"  required="required"/>
    @error('sizecalory')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>   <div class="form-group col-1">
    <label>default <span class="text-danger">*</span></label>
    <input type="checkbox" class="form-control " value="1" name="size_default[]"  />
    @error('size_default')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div> 
   <div class="form-group col-1 mt-4">
        <button class="btn btn-sm  font-weight-bolder btn-light-danger" type="button" onclick="removef(${id})">مسح</button>
        </div>

</div>`);
id++;
console.log(id);
    });
    function removef(id){
    $(`#remove${id}`).remove();
    $(`#remov${id}`).remove();
    id--;
    }
    //new 
    let id1 = $('#section2 .all').length;
    $('#adds').click(function(){
        $('#section2').append(`
        <div id="removes${id1}" class="col-12">
 <div class="row all" style="position: relative;"  >
  <div class="form-group col-2">
        <label>الاسم  <span class="text-danger">*</span></label>
    <input type="text" class="form-control " required="required" name="extrname[]"  value="{{old('extrname')}}"    />
   @error('extrname')
   <p style="color:red;">{{$message}}</p>
   @enderror
 
  </div>
    <div class="form-group col-2">
        <label> السعرات   <span class="text-danger">*</span></label>
    <input type="text" class="form-control " name="extracalory[]" required="required"    />
   @error('calory')
   <p style="color:red;">{{$message}}</p>
   @enderror
 
  </div>
  <div class="form-group col-2">
    <label>السعر     <span class="text-danger">*</span></label>
    <input type="number" class="form-control " value="{{old('extrprice')}}" name="extrprice[]"  required="required"/>
    @error('extrprice')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>      <div class="form-group col-1">
    <label>العدد     <span class="text-danger">*</span></label>
    <input type="number" class="form-control "  value="0" name="count_number[]"   required="required"/>
    @error('count_number')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>      <div class="form-group col-1">
    <label>متعدد     <span class="text-danger">*</span></label>
    <input type="checkbox" class="form-control " value="1" name="multiple[]"  />
    @error('multiple')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>
    <div class="form-group col-1 mt-4">
        <button class="btn btn-sm  font-weight-bolder btn-light-danger" type="button" onclick="removes(${id1})">مسح</button>
        </div>
<div class="form-group col-1 mt-4">
        <button class="btn btn-sm  font-weight-bolder btn-light-success" type="button" onclick="get1(${id1})">اضافه</button>
        </div>

</div>
</div>`);
id1++;
console.log(id);
    });
    function removes(id){
    $(`#removes${id}`).remove();
    id1--;
    }
    ///
      let id2 = $("#section2 .news").length;
    function get1(i){
        $(`#removes${i}`).append(`
 <div class="row news" style="position: relative;"  id="removec${id2}">
 <div class="col-2"></div>
<div class="form-group col-3">
        <label>اسم ال extra  <span class="text-danger">*</span></label>
    <input type="text" class="form-control " name="extrname${i}[]" required="required" value="{{old('extrname2')}}"    />
   @error('extrname2')
   <p style="color:red;">{{$message}}</p>
   @enderror
 
  </div>
  <div class="form-group col-2">
    <label>السعر     <span class="text-danger">*</span></label>
    <input type="number" class="form-control " value="{{old('extrprice')}}" name="extrprice${i}[]"  required="required"/>
    @error('extrprice')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div>       <div class="form-group col-1">
    <label>default     <span class="text-danger">*</span></label>
    <input type="checkbox" class="form-control " value="1" name="default${i}[]"  />
    @error('default')
    <p style="color:red;">{{ $message }}</p>
 @enderror
   </div> 
 <div class="form-group col-1 mt-4">
        <button class="btn btn-sm  font-weight-bolder btn-light-danger" type="button" onclick="removec(${id2})">مسح</button>
        </div>
</div>`);

id2++;
}
    function removec(id){
    $(`#removec${id}`).remove();
    id2--;
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

  $('#row').append('<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 d-flex align-items-center"><figure class="imghvr-fade"><img style="width:100px;height:100px;"src=' + e.target.result + '></figure></div>');
};

function filter_subcategories(selected){
let id = selected.value;
console.log(id);
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `../filter_subcategories/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        if(result.status == true){
       $('#subcategory_id').empty();
       $('#subcategory_id').append(result.data);
       $('select#subcategory_id').selectpicker("refresh");
       console.log(result);
     }
       }

      });
    }
</script>
@endsection