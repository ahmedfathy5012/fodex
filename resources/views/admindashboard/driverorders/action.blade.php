<?php 
$order =\App\Models\Order::where('id',$id)->first();
$drivers = \App\Models\Driver::has('orders_ongoing', '=', 0)
->get();

$reasons = \App\Models\RefusedReason::all();
?>
   <a href="{{route('showorders',$id)}}"  ><img src="{{asset('visibility.png')}}" style="width:25px;height:25px;"></a>
                            <div style="cursor:pointer;" onclick="deleteorder({{$id}})" class="btn btn-sm btn-hover-bg-light mr-1">
                                <span class="svg-icon svg-icon-danger m-0 p-0 svg-icon-md"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-12-28-020759/theme/html/demo8/dist/../src/media/svg/icons/Home/Trash.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>
                                            <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
                                        </g>
                                    </svg><!--end::Svg Icon-->
                                </span>
                            </div>
                                            <span class="" style="cursor:pointer;" data-toggle="modal" data-target="#myModalp{{$id}}" ><img src="{{asset('dollar.png')}}"style="width:25px;height:25px;"></span>
                            <div id="myModalp{{$id}}" class="modal fade" role="dialog">
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
        <input type="number" min="0" class="form-control" id="price{{$id}}" value="{{$order->price}}">
        </div>    <div class="col-6">
            <label>الخصم </label>
        <input type="number" min="0" class="form-control" id="discount{{$id}}" value="{{$order->price -$order->priceafterdiscount}}">
        </div>
        </div>
        <div class="row">
            <button class="btn btn-primary mx-auto mt-4" 
           onclick="editprice({{$id}})" >حفظ</button>
            </div>
      </div>
     
    </div>

  </div>
</div>
<!--  @if($order->status == 1)-->
<!--     <span class="btn btn-success"data-toggle="modal" data-target="#myModalw{{$id}}" >{{ $order->driver ?  $order->driver->name : 'الدليفري'}} </span>-->
<!--                            <div id="myModalw{{$id}}" class="modal fade" role="dialog">-->
<!--  <div class="modal-dialog">-->

    <!-- Modal content-->
<!--    <div class="modal-content">-->
<!--      <div class="modal-header">-->
<!--        <button type="button" class="close" data-dismiss="modal">&times;</button>-->
<!--        <h4 class="modal-title">الدليفري</h4>-->
<!--      </div>-->
<!--      <div class="modal-body">-->
<!--       <div class="row">-->
<!--            <div class="col-6">-->
<!--            <label>الدليفري</label>-->
<!--            <select class="form-control"  style="display:block;" id="driver_idw{{$id}}" data-live-search="true">-->
<!--                @foreach($drivers as $driver)-->
<!--                <option value="{{$driver->id}}" @if($order->driver_id == $driver->id) selected @endif>{{$driver->name}}</option>-->
<!--                @endforeach-->
<!--            </select>-->
<!--        </div>-->
<!--        </div>-->
<!--        <div class="row">-->
<!--            <button class="btn btn-primary mx-auto mt-4" -->
<!--           onclick="choosedriver({{$id}})" >حفظ</button>-->
<!--            </div>-->
<!--      </div>-->
     
<!--    </div>-->

<!--  </div>-->
<!--</div>-->
<!--@endif   -->
@if($order->delivery_status == 0)
     <span style="cursor:pointer;" 
     class="label label-lg font-weight-bold label-light-success label-inline">السائق لم يقبل الطلب بعد</span>
@elseif($order->delivery_status == 1)
     <span style="cursor:pointer;" 
     class="label label-lg font-weight-bold label-light-success label-inline">السائق قبل</span>
     @elseif($order->delivery_status == 2)
     <span style="cursor:pointer;" 
     class="label label-lg font-weight-bold label-light-success label-inline">السائق وصل للمنفذ</span>
     @elseif($order->delivery_status == 3)
     <span style="cursor:pointer;" 
     class="label label-lg font-weight-bold label-light-success label-inline">السائق استلم الطلب </span>
     @elseif($order->delivery_status == 4)
     <span style="cursor:pointer;" 
     class="label label-lg font-weight-bold label-light-success label-inline">السائق وصل الطلب</span>
     @endif
     
@if($order->cancel == 1)
 <span class="label label-lg font-weight-bold label-light-danger label-inline">ملغى</span>
                        @endif
                        @if($order->status == 4)
 <span class="label label-lg font-weight-bold label-light-danger label-inline">مرفوض</span>
                        @endif
                            @if($order->status == 0)
                            <span onclick="orderstatus({{$id}},1)" style="cursor:pointer;" class="label label-lg font-weight-bold label-light-success label-inline">قبول</span>
                         
                            <!--<span class="btn btn-success"data-toggle="modal" data-target="#myModal{{$id}}" >قبول</span>-->
     
         <span class="label label-lg font-weight-bold label-light-danger label-inline"  
         data-toggle="modal" data-target="#myModale{{$id}}" style="cursor:pointer;">رفض</span>
                                 <div id="myModale{{$id}}" class="modal fade" role="dialog">
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
            <select class="form-control"  style="display:block;" id="refusedreason_id{{$id}}" data-live-search="true">
                @foreach($reasons as $reason)
                <option value="{{$reason->id}}">{{$reason->text}}</option>
                @endforeach
            </select>
        </div>
        </div>
        <div class="row">
            <button class="label label-lg font-weight-bold label-light-danger label-inline  mx-auto mt-4" 
           onclick="orderstatus({{$id}},2)" >رفض</button>
            </div>
      </div>
     
    </div>

  </div>
</div>
                           
                           @elseif($order->status == 1)
<span class="btn btn-sm btn-success sm-4" data-toggle="modal" data-target="#myModalaa{{$id}}">
   قيد التحضير 
</span>

<div  id="myModalaa{{$id}}"  class="modal fade" role="dialog">
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
               title="اختر طيار" id="driver_id{{$id}}">
           @foreach($drivers as $driver)
           <option value="{{$driver->id}}">{{$driver->name}}</option>
           @endforeach
               </select>
</div>
</div>
<div class="mt-4 row">
<button type="button" class="btn btn-success mx-auto"  onclick="choosedriver({{$id}})" >ارسال</button>
</div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
                            
                            @elseif($order->status == 2)
                            <span class="label label-lg font-weight-bold label-light-primary label-inline">السائق استلم الطلب</span>
                            @elseif($order->status == 3)
                            <span class="label label-lg font-weight-bold label-light-success label-inline">تم تسليم الطلب</span>
                            @endif
                           
                            <script>
              function deleteorder(sel){
    let id = sel;
 console.log(sel);
 var table = $('.dataTable').DataTable();
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
     Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
      console.log(id);
    $.ajax({
       type:"delete",
       url: `../orders/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
           if(result.status == true){
     Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
         )
       }
       table.ajax.reload();
           }
    });
    }
  })
}
  function orderstatus(sel,status){
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
       table.ajax.reload();
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
         table.ajax.reload();
     }
       
           }
 
  })
}function choosedriver(sel){
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
        //  $(`#myModalew${id}`).modal('hide');
              Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'تم قبول الطلب بنجاح',
  showConfirmButton: false,
  timer: 1500
})
       table.ajax.reload();
           }
 
  })
}function checkres(sel){
    let id = sel;
 console.log(sel);
 var table = $('.dataTable').DataTable();
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
   
    $.ajax({
       type:"get",
       url: `../checkres/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
           if(result.status == true){
   
       table.ajax.reload();
           }
       }
  
  })
}</script>