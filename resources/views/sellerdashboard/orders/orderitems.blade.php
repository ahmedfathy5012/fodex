@extends('layouts.sellerindex')
@section('content')
<style>
    #rowing span{
        margin-right:20px;
    }
    #new .text{
        opacity: .8;
    font-size: 13px;
    font-style: italic;
    font-weight: lighter;
    color: #4e4040;
    display: flex;
    align-items: center;
    justify-content: center;
    } #new .text2{
       font-size: 16px;
    font-style: oblique;
    /* font-weight: lighter; */
    color: #1c1b1b;
    display: flex;
    align-items: center;
    justify-content: center;
    }#new a{
         color: #1c1b1b !important;
    }
</style>
	<!--begin::Card-->
    <div class="card card-custom gutter-b">
        <div class="card-header">
		<div class="card-title">
    			<span class="card-icon">
    			
    			
        			<span class="svg-icon svg-icon-primary svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5"/>
                            <path d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L18.5,10 C19.3284271,10 20,10.6715729 20,11.5 C20,12.3284271 19.3284271,13 18.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z" fill="#000000" opacity="0.3"/>
                        </g>
                    </svg><!--end::Svg Icon--></span>
                    
    			
    			
    			</span>
    			
    			<h3 class="card-label">اطعمه الطلب</h3>
    			
    		</div>
	    </div>
	          <section id="new">
	    <div class="row mt-5">
	  
	        <div class="col-lg-4 col-md-6">
	                <p  class="text">
	                    رقم الطلب 
	                    </p>
	            
	                <p class="text2" >#{{$order->id}}</p>
	            
	        </div>
	              <div class="col-lg-4 col-md-6">
	                <p  class="text">السعر  
	                </p>
	             
	                <span class="text2">{{$order->price}}</span>
	            
	        </div>
	             <div class="col-lg-4 col-md-6">
	                <p  class="text"> السعر بعد الخصم 
	                </p>
	              
	                 <p class="text2">{{$order->priceafterdiscount}}</p>
	            
	        </div>
	             <div class="col-lg-4 col-md-6">
	                <p class="text"> اسم العميل 
	                </p>
	              
	                 
	              <p class="text2">{{$order->user['name']}}</p>
	           
	        </div>    
	        <div class="col-lg-4 col-md-6">
	                <p  class="text">رقم هاتف العميل
	                </p>
	             
	            <p class="text2">{{$order->phone}}</p>
	            
	        </div>
	        <div class="col-lg-4 col-md-6">
	                <p class="text"> عنوان العميل 
	                </p>
	           
	                 <p class="text2">
	                     {{ $order->address }}</p>
	           
	        </div> 

	         <div class="col-lg-4 col-md-6 ">
	              <p  class="text"> اسم الموظف  
	              </p>

	                   @if($order->employee)
	              <p class="text2"><a href="{{route('employee.show',$order->employee_id)}}">{{$order->employee['name']}}</a></p>
	              @endif
	            
	         </div> <div class="col-lg-4 col-md-6">
	              <p class="text"> وقت قبول الطلب   
	              </p>
	             
	              <p class="text2">{{$order->time_accept}}</p>

	         </div>
	    </div>
	    <hr style="width:70%" />
	    <div class="row" id="rowing">
	       <?php 
$drivers = \App\Models\Driver::all();
$reasons = \App\Models\RefusedReason::all();
$orderstatus = \App\Models\OrderStatus::all();
?>
 <span class="" style="cursor:pointer;" data-toggle="modal" data-target="#myModalp{{$order->id}}" ><img src="{{asset('dollar.png')}}"style="width:25px;height:25px;"></span>
                            <div id="myModalp{{$order->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">السعر</h4>
      </div>
      <div class="modal-body">
       <div class="row">
            <div class="col-6">
            <label>السعر </label>
        <input type="number" min="0" class="form-control" id="price{{$order->id}}" value="{{$order->price}}">
        </div>    <div class="col-6">
            <label>الخصم </label>
        <input type="number" min="0" class="form-control" id="discount{{$order->id}}" value="{{$order->price -$order->priceafterdiscount}}">
        </div>
        </div>
        <div class="row">
            <button class="btn btn-primary mx-auto mt-4" 
           onclick="editprice({{$order->id}})" >حفظ</button>
            </div>
      </div>
     
    </div>

  </div>
</div>
  @if($order->status == 1)
     <span class="btn btn-success"data-toggle="modal" data-target="#myModalw{{$order->id}}" >{{ $order->driver ?  $order->driver->name : 'الدليفري'}} </span>
                            <div id="myModalw{{$order->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">الدليفري</h4>
      </div>
      <div class="modal-body">
       <div class="row">
            <div class="col-6">
            <label>الدليفري</label>
            <select class="form-control"  style="display:block;" id="driver_idw{{$order->id}}" data-live-search="true">
                @foreach($drivers as $driver)
                <option value="{{$driver->id}}" @if($order->driver_id == $driver->id) selected @endif>{{$driver->name}}</option>
                @endforeach
            </select>
        </div>
        </div>
        <div class="row">
            <button class="btn btn-primary mx-auto mt-4" 
           onclick="choosedriver({{$order->id}})" >حفظ</button>
            </div>
      </div>
     
    </div>

  </div>
</div>
@endif
     
@if($order->cancel == 1)
 <span class="label label-lg font-weight-bold label-light-danger label-inline">ملغى</span>
                        @endif
                          @if($order->status == 0)
                            <span onclick="orderstatus({{$order->id}},1)" style="cursor:pointer;" class="label label-lg font-weight-bold label-light-success label-inline">قبول</span>
                         
                            <!--<span class="btn btn-success"data-toggle="modal" data-target="#myModal{{$order->id}}" >قبول</span>-->
     
         <span class="label label-lg font-weight-bold label-light-danger label-inline"  
         data-toggle="modal" data-target="#myModale{{$order->id}}" style="cursor:pointer;">رفض</span>
                                 <div id="myModale{{$order->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">اسباب الرفض</h4>
      </div>
      <div class="modal-body">
       <div class="row">
            <div class="col-6">
            <label>السبب</label>
            <select class="form-control"  style="display:block;" id="refusedreason_id{{$order->id}}" data-live-search="true">
                @foreach($reasons as $reason)
                <option value="{{$reason->id}}">{{$reason->text}}</option>
                @endforeach
            </select>
        </div>
        </div>
        <div class="row">
            <button class="label label-lg font-weight-bold label-light-danger label-inline  mx-auto mt-4" 
           onclick="orderstatus({{$order->id}},2)" >رفض</button>
            </div>
      </div>
     
    </div>

  </div>
</div>
                           
                           @elseif($order->status == 1)
<span class="btn btn-sm btn-success sm-4" data-toggle="modal" data-target="#myModalaa{{$order->id}}">
   قيد التحضير 
</span>

<div  id="myModalaa{{$order->id}}"  class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

   
      <div class="modal-header">
        <h4 class="modal-title">الطيارين </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
    
      
      <div class="modal-body">
       <div class="row">
           <div class="col-6">
               <select class="form-control" data-live-search="true" 
               title="اختر طيار" id="driver_id{{$order->id}}">
           @foreach($drivers as $driver)
           <option value="{{$driver->id}}">{{$driver->name}}</option>
           @endforeach
               </select>
</div>
</div>
<div class="mt-4 row">
<button type="button" class="btn btn-success mx-auto"  onclick="choosedriver({{$order->id}})" >ارسال</button>
</div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
                            
                            @elseif($order->status == 2)
                            <span class="label label-lg font-weight-bold label-light-primary label-inline">  تم التحضير</span>
                            @elseif($order->status == 3)
                            <span class="label label-lg font-weight-bold label-light-success label-inline">تم تسليم الطلب</span>
                            @endif
                            @if($order->status != 3 )
         <span class="label label-lg font-weight-bold label-light-primary label-inline"  data-toggle="modal" data-target="#myModalos{{$order->id}}">حاله الطلب</span>
         @endif
                                 <div id="myModalos{{$order->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">حاله الطلب</h4>
      </div>
      <div class="modal-body">
       <div class="row">
           <div class="col-6">
            <label>حاله الطلب</label>
            <select class="form-control"  style="display:block;" id="orderstatus_id{{$order->id}}" data-live-search="true">
               
                <option value="1" @if($order->status == 1) selected @endif>
                المطعم استلم الطلب</option>   
                 <option value="2" @if($order->status == 2) selected @endif>
                تم التحضير
                  </option>
                 <option value="3" @if($order->status == 3) selected @endif>
                تم تسليم الطلب
                </option>
               
            </select>
        </div>
        </div>
        <div class="row">
            <button class="btn btn-primary mx-auto mt-4" 
           onclick="changeorderstatus_id({{$order->id}})" >حفظ</button>
            </div>
      </div>
     
    </div>

  </div>
                          
	    </div>
	    
	    
	    <!--delivery status --->
	       @if($order->status == 2)
         <span class="label label-lg font-weight-bold label-light-danger label-inline"  data-toggle="modal" data-target="#myModalstatus{{$order->id}}">حاله الدليفري </span>
         @endif
                                 <div id="myModalstatus{{$order->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">حاله الدليفري</h4>
      </div>
      <div class="modal-body">
       <div class="row">
           <div class="col-6">
            <label>حاله الدليفري</label>
            <select class="form-control"  style="display:block;" id="delivery_status{{$order->id}}" data-live-search="true">
               
                <option value="1" @if($order->delivery_status == 1) selected @endif>
                  قبول السائق</option>   
                 <option value="2" @if($order->delivery_status == 2) selected @endif>
                   السائق وصل للمنقد 
                  </option>
                 <option value="3" @if($order->delivery_status == 3) selected @endif>
                السائق استلم الطلب
                </option>
                 <option value="4" @if($order->delivery_status == 4) selected @endif>
              تم توصيل الطلب
                </option>
               
            </select>
        </div>
        </div>
        <div class="row">
            <button class="btn btn-primary mx-auto mt-4" 
           onclick="change_delivery_status({{$order->id}})" >حفظ</button>
            </div>
      </div>
     
    </div>

  </div>
                          
	    </div>
	    <!-- end delivery status-->
	    
	     <!--<span class="btn btn-primary btn-sm" style="cursor:pointer;" data-toggle="modal" data-target="#myModalde{{$order->id}}">-->
	     <!--    سعر الدليفري</span>-->
                            <div id="myModalde{{$order->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">السعر</h4>
      </div>
      <div class="modal-body">
       <div class="row">
            <div class="col-6">
            <label>سعر الدليفري </label>
        <input type="number" min="0" class="form-control"  id="delivery_fee{{$order->id}}" value="{{$order->delivery_fee}}">
        </div>   
        </div>
        <div class="row">
            <button class="btn btn-primary mx-auto mt-4" 
           onclick="delivery_fee({{$order->id}})" >حفظ</button>
            </div>
      </div>
     
    </div>

  </div>
</div>
	    </section>
	      <div class="row">
	        <!--<a class="btn btn-primary btn-sm ml-4 mt-4" href="{{route('item.create')}}">اضافه</a>-->
	    </div>
        <div class="card-body">
            <!--begin: Datatable-->
          
    {!! $dataTable->table([
                    
                     ],true) !!}
            <!--end: Datatable-->
        </div>
    <!--end::Card-->
   
  


@endsection
@section('scripts')   
{{$dataTable->scripts()}} 
      <script>       
       function orderstatus(sel,status){
    let id = sel;
 console.log(sel);

 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
      
    $.ajax({
       type:"post",
       url: `../orderstatus`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       data:{
           "id":sel,
           "status":status,
           'driver_id':$(`#driver_id${id}`).val(),
           'refusedreason_id':$(`#refusedreason_id${id}`).val(),
       },
       success: function(result){
     if(result.type == "accept"){
         $(`#myModal${id}`).modal('hide');
         Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'تم قبول الطلب بنجاح',
  showConfirmButton: false,
  timer: 1500
})
     }else if(result.type == "refused"){
         $(`#myModale${id}`).modal('hide');
                  Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'تم رفض الطلب بنجاح',
  showConfirmButton: false,
  timer: 1500
})
     }
        $("#new").load(`https://fodex.dawena.net/public/sellerdash/showmyorders/${id} #new`);
           }
 
  })
}   
  function editprice(sel){
    let id = sel;
 console.log(sel);
 var table = $('.dataTable').DataTable();
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
      
    $.ajax({
       type:"post",
       url: `../editprice`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       data:{
           "id":sel,
           "price":$(`#price${id}`).val(),
           'discount':$(`#discount${id}`).val()
       },
       success: function(result){
     if(result.status == true){
         $(`#myModalp${id}`).modal('hide');
           Swal.fire(
      'done!',
      'تم تغيير السعر بنحاح',
      'success'
         )
          $("#new").load(`https://fodex.dawena.net/public/sellerdash/showmyorders/${id} #new`);
     }
       
           }
 
  })
}
function choosedriver(sel){
    let id = sel;
 console.log(sel);
 var table = $('.dataTable').DataTable();
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
      
    $.ajax({
       type:"post",
       url: `../choosedriver`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       data:{
           "id":sel,
           'driver_id':$(`#driver_id${id}`).val()
       },
       success: function(result){
         $(`#myModalaa${id}`).modal('hide');
      Swal.fire(
      'done!',
        result.message,
      'success'
         )
       $("#new").load(`https://fodex.dawena.net/public/sellerdash/showmyorders/${id} #new`);
           }
 
  })
}function changeorderstatus_id(sel){
    let id = sel;
 console.log(sel);
 var table = $('.dataTable').DataTable();
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
      
    $.ajax({
       type:"post",
       url: `../changeorderstatus_id`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       data:{
           "id":sel,
           'orderstatus_id':$(`#orderstatus_id${id}`).val()
       },
       success: function(result){
         $(`#myModalos${id}`).modal('hide');
        //  $(`#myModalew${id}`).modal('hide');
             Swal.fire(
      'done!',
       'تم تغييرالحاله بنجاح',
      'success'
         )
       $("#new").load(`https://fodex.dawena.net/public/sellerdash/showmyorders/${id} #new`);
           }
 
  })
}
function change_delivery_status(sel){
    let id = sel;
 console.log(sel);
 var table = $('.dataTable').DataTable();
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
      
    $.ajax({
       type:"post",
       url: `../change_delivery_status`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       data:{
           "id":sel,
           'orderstatus_id':$(`#delivery_status${id}`).val()
       },
       success: function(result){
         $(`#myModalstatus${id}`).modal('hide');
        //  $(`#myModalew${id}`).modal('hide');
             Swal.fire(
      'done!',
       'تم تغييرالحاله بنجاح',
      'success'
         )
       $("#new").load(`https://fodex.dawena.net/public/sellerdash/showmyorders/${id} #new`);
           }
 
  })
}
//
function delivery_fee(sel){
    let id = sel;
 console.log(sel);
 var table = $('.dataTable').DataTable();
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
      
    $.ajax({
       type:"post",
       url: `../delivery_fee`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       data:{
           "order_id":sel,
           'delivery_fee':$(`#delivery_fee${id}`).val()
       },
       success: function(result){
         $(`#myModalde${id}`).modal('hide');
        //  $(`#myModalew${id}`).modal('hide');
             Swal.fire(
      'done!',
        'تم تغيير سعر الدليفري بنجاح',
      'success'
         )
       $("#new").load(`https://fodex.dawena.net/public/sellerdash/showmyorders/${id} #new`);
           }
 
  })
}
        </script>
@endsection