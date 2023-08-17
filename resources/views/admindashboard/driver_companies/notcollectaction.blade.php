
    <?php
    $res = \App\Models\Driver::where('id',$id)->first();
    $collect = \App\Models\AllCollection::where('driver_id',$id)->latest()->first();
    // if(isset($collect)){
        
    //      $orders = $res->acceptorders()->whereBetween('created_at',[$collect->created_at,now()])->get();
    //     $countorders = count($orders);
    //     $money =array_sum($orders->pluck('priceafterdiscount')->toArray()) - array_sum($orders->pluck('delivery_fee')->toArray());
    //     $value = $money * ($res->admin_commission /100) + $collect->money_left;
    
    // }else{
    //     $orders = $res->orders->where('order_status_id',7);
    //     $countorders = count($res->orders->where('order_status_id',7));
    //     $money =array_sum($res->orders->where('order_status_id',7)->pluck('priceafterdiscount')->toArray()) -
    //     array_sum($res->orders->where('order_status_id',7)->pluck('delivery_fee')->toArray());
    //     $value = $money * ($res->admin_commission /100);
    // }?>
         <?php    
         $date2 = \Carbon\Carbon::now()->subMonth()->format('Y-m-d');
         $date1 = \Carbon\Carbon::parse($res->created_at)->format('Y-m-d');
    $period = \Carbon\CarbonPeriod::create($date1, '1 month', $date2);
$aa = [];
    foreach ($period as $dt) {
      
        $aa[]= $dt->format("Y-m");
    } ?>
    @foreach($aa as $a) 
    <?php 
    $date3 = \Carbon\Carbon::parse($a)->format('Y-m');
        $collect = \App\Models\AllCollection::where('driver_id',$id)->where('month_date',$a)
        ->first();?>
    @if($collect)
    @if($collect->money_left == 0)
    @else
      <span class="badge badge-primary" data-toggle="modal" data-target="#myModale{{$a}}" style="cursor:pointer;">{{$a}}</span>
      <div id="myModale{{$a}}" class="modal fade" role="dialog">
  <div class="modal-dialog">


    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">تحصيل </h4>
      </div>
      <div class="modal-body">
        <div class="row">
     <div class="col-4">
         <label>عدد الطلبات</label>
   
         <input type="number" disabled required value="{{$collect->ordersnumber}}"  min="1" name="orders" class="form-control">
     </div>
   
 <div class="col-4">
         <label>المبلغ الكلى </label>
          <input type="number" disabled required value="{{$collect->total}}"  min="1" name="orders"  class="form-control">
     </div> <div class="col-4">
         <label>المحصل </label>
          <input type="number" disabled required value="{{$collect->money_taken}}"  min="1" name="orders"class="form-control">
     </div>
     </div>
      <div class="row">
           <div class="col-12">
         <label>المتبقى </label>
          <input type="number" required value="{{$collect->money_left}}" max="{{$collect->money_left}}"   min="1" name="orders" id="value{{$a}}" class="form-control">
     </div>
      </div>
<div class="row">
    <div class="col-3"></div>
     <input type="hidden" id="{{$collect->ordersnumber}}" value="{{$a}}">
     <div class="col-3">
         <input type="button" onclick="add_company_collection({{$id}},{{$collect->ordersnumber}})" value="حفظ" class="form-control btn btn-success btn-sm m-4">
     </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</div>
    @endif
    @else
    
       <?php 
      $orders = $res->company_done_orders()->whereYear('orders.created_at',\Carbon\Carbon::parse($a))
      ->whereMonth('orders.created_at',\Carbon\Carbon::parse($a))->get();
    //   ->whereMonth('orders.created_at',$date3)->get();

    //   ->where('order_status_id',7)->whereYear('orders.created_at',$date3)
    //   ->whereMonth('orders.created_at',$date3)->get();
       $countorders = count($orders); 
            $money =
        array_sum($res->company_done_orders()->whereYear('orders.created_at',\Carbon\Carbon::parse($a))
        ->whereMonth('orders.created_at',\Carbon\Carbon::parse($a))->get()->pluck('delivery_fee')->toArray());

        ?>
        @if($res->commission)
        <?php 
          $value = $money * ($contract->percentage /100);
        ?>
@if($countorders == 0)
@else
          <span class="badge badge-success" data-toggle="modal" data-target="#myModal{{$a}}" style="cursor:pointer;">{{$a}}</span>
      <div id="myModal{{$a}}" class="modal fade" role="dialog">
  <div class="modal-dialog">


    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">تحصيل </h4>
      </div>
      <div class="modal-body">
        <div class="row">
     <div class="col-4">
         <label>عدد الطلبات</label>
   
         <input type="number" disabled required value="{{$countorders}}"  min="1" name="orders" id="orders{{$a}}" class="form-control">
     </div>
   
 <div class="col-4">
         <label>المبلغ الكلى </label>
          <input type="number" disabled required value="{{$value}}"  min="1" name="orders" id="total{{$a}}" class="form-control">
     </div> 
     <div class="col-4">
         <label>المحصل </label>
          <input type="number" disabled required value="0"  min="1" name="orders"class="form-control">
     </div>
     </div>
      <div class="row">
           <div class="col-12">
         <label>المبلغ </label>
          <input type="number" required value="{{$value}}" max="{{$value}}"   min="1" name="orders" id="value{{$a}}" class="form-control">
     </div>
      </div>
<div class="row">
    <div class="col-3"></div>
    <input type="hidden" id="{{$countorders}}" value="{{$a}}">
     <div class="col-3">
         <input type="button" onclick="add_company_collection({{$id}},{{$countorders}})" value="حفظ" class="form-control btn btn-success btn-sm m-4">
     </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</div>
@endif
    @endif
    @endif
    @endforeach



<script>
            
//
function add_company_collection(id,a){
 var table = $('.dataTable').DataTable();
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
  let date = $(`#${a}`).val();
  console.log(date);
    $.ajax({
       type:"post",
       url: `add_company_collection`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       data:{
           //'total':$(`#total${id}`).val(),
             'value':$(`#value${date}`).val(),
             'date' :date,
           //'money_left':$(`#discount_to${id}`).val(),
           'id':id
       },
       success: function(result){
           if(result.status == true){
  

Swal.fire({
  position: 'top-end',
  icon: 'success',
  title:result.message,
  showConfirmButton: false,
  timer: 1500
})
$(".modal-backdrop").remove();
   $(`#myModale${date}`).modal('hide');
 $(`#myModal${date}`).modal('hide');
       table.ajax.reload();
           }
       }
  })
} </script>