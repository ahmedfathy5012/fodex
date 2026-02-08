<?php 
$order =\App\Models\Order::where('id',$id)->first();
                $drivers = \App\Models\Driver::where("driver_id",auth()->id())->where("available",1)->get();

$reasons = \App\Models\RefusedReason::all();
?>
<style>
    .span{
      width: 160px !important;
    margin-top: 3px;
    }
     .fa-star.checked {
  color: orange;
}
</style>

                            
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
            <select class="form-control"  style="display:block;" id="driver_id{{$order->id}}" data-live-search="true">
                @foreach($drivers as $driver)
                <option value="{{$driver->id}}" @if($order->driver_id == $driver->id) selected @endif>{{$driver->name}}</option>
                @endforeach
            </select>
        </div>
        </div>
        <div class="row">
            <button class="btn btn-primary mx-auto mt-4" 
           onclick="choose_your_driver({{$order->id}})" >حفظ</button>
            </div>
      </div>
     
    </div>             

     
@if($order->cancel == 1)
 <span class="label label-lg font-weight-bold label-light-danger label-inline span">ملغى</span>
                        
   
                            @elseif($order->status == 0)
                         
                           
                           @elseif($order->status == 1)

                            
                            @elseif($order->status == 2)
                            <span class="label label-lg font-weight-bold label-light-primary label-inline span">  تم التحضير</span>
                            @elseif($order->status == 3)
                            <span class="label label-lg font-weight-bold label-light-success label-inline span">تم تسليم الطلب</span>
                            @endif
                           
                            <script>
function choose_your_driver(id){

 var table = $('.dataTable').DataTable();
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
      
    $.ajax({
       type:"post",
       url: `choose_your_driver`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       data:{
           "order_id":id,
           'driver_id':$(`#driver_id${id}`).val()
       },
       success: function(result){
         $(`#myModalw${id}`).modal('hide');
      Swal.fire(
      'done!',
        result.message,
      'success'
         )
           }
 
  })
}

</script>