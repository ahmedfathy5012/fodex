
         <?php   
         $driver = \App\Models\Driver::where('id',$id)->first();
         $date2 = \Carbon\Carbon::now()->subMonth()->format('Y-m-d');
         $date1 = \Carbon\Carbon::parse($driver->created_at)->format('Y-m-d');
    $period = \Carbon\CarbonPeriod::create($date1, '1 month', $date2);
$aa = [];
    foreach ($period as $dt) {
      
        $aa[]= $dt->format("Y-m");
    } ?>
    @foreach($aa as $a) 
    <?php 
    $date3 = \Carbon\Carbon::parse($a)->format('Y-m');
        $expense = \App\Models\ExpenseDriver::where('driver_id',$id)->where('month_date',$a)
        ->first();?>
    @if($expense)
    @if($expense->money_left == 0)
    @else
      <span class="badge badge-primary" data-toggle="modal" data-target="#myModale{{$a}}" style="cursor:pointer;">{{$a}}</span>
      <div id="myModale{{$a}}" class="modal fade" role="dialog">
  <div class="modal-dialog">


    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">دفع </h4>
      </div>
      <div class="modal-body">
        <div class="row">
     <div class="col-3">
         <label>المبلغ الكلى </label>
   
         <input type="number" disabled required value="{{$expense->total}}" id="total{{$a}}" min="1" name="orders" class="form-control">
     </div>
   
 <div class="col-3">
         <label>المبلغ المدفوع </label>
          <input type="number" disabled required value="{{$expense->value}}"  min="1" name="orders"  class="form-control">
     </div> <div class="col-3">
         <label>المتبقى </label>
          <input type="number" disabled required value="{{$expense->money_left}}"  min="1" name="orders"class="form-control">
     </div>
      <div class="col-3">
         <label>الخصم </label>
          <input type="number" required  disabled value="{{$expense->discounts}}" max="{{$expense->discounts}}"   min="1" name="orders" id="discounts{{$a}}" class="form-control">
     </div> <div class="col-3">
         <label>المكافأه </label>
          <input type="number" required  disabled value="{{$expense->award}}" max="{{$expense->award}}"   min="1" name="orders" id="awards{{$a}}" class="form-control">
     </div><div class="col-3">
         <label>عدد الطلبات </label>
          <input type="number" required  disabled value="{{$expense->ordersnumber}}" max="{{$expense->ordersnumber}}"   min="1" name="orders" id="awards{{$a}}" class="form-control">
     </div>
     </div>
      <div class="row">
           <div class="col-12">
         <label>المبلغ </label>
          <input type="number" required value="{{$expense->money_left}}" max="{{$expense->money_left}}"   min="1" name="orders" id="value{{$a}}" class="form-control">
     </div>
      </div>
<div class="row">
    <div class="col-3"></div>
  <input type="hidden" id="{{$expense->discounts}}" value="{{$a}}">
     <div class="col-3">
         <input type="button" onclick="addemplyeeexpense({{$id}},{{$expense->discounts}})" value="حفظ" class="form-control btn btn-success btn-sm m-4">
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
    //   $orders = $res->orders()->whereYear('orders.created_at',\Carbon\Carbon::parse($a))
    //   ->whereMonth('orders.created_at',\Carbon\Carbon::parse($a))->get();
    //   ->whereMonth('orders.created_at',$date3)->get();

    //   ->where('order_status_id',7)->whereYear('orders.created_at',$date3)
    //   ->whereMonth('orders.created_at',$date3)->get();
    //   $countorders = count($orders); 
    //         $money =array_sum($res->orders()->where('order_status_id',7)->whereYear('orders.created_at',\Carbon\Carbon::parse($a))
    //         ->whereMonth('orders.created_at',\Carbon\Carbon::parse($a))->get()->pluck('total_after_discount')->toArray()) -
    //     array_sum($res->orders()->where('order_status_id',7)->whereYear('orders.created_at',\Carbon\Carbon::parse($a))
    //     ->whereMonth('orders.created_at',\Carbon\Carbon::parse($a))->get()->pluck('delivery_fee')->toArray());
    //     $value = $money * ($res->admin_commission /100);
        $contract = \App\Models\DriverContract::where('driver_id',$id)->where("active",1)->latest()->first();
        $discounts =  array_sum(\App\Models\Discount::where('driver_id',$id)->whereYear('created_at',\Carbon\Carbon::parse($a))
      ->whereMonth('created_at',\Carbon\Carbon::parse($a))->get()->pluck('value')->toArray());
       $awards =  array_sum(\App\Models\Award::where('driver_id',$id)->whereYear('created_at',\Carbon\Carbon::parse($a))
      ->whereMonth('created_at',\Carbon\Carbon::parse($a))->get()->pluck('value')->toArray());
       $orders =  $driver->acceptorders()->whereYear('created_at',\Carbon\Carbon::parse($a))
      ->whereMonth('created_at',\Carbon\Carbon::parse($a))->get();
      $money = 0;
      if($contract != null){
      if(count($orders)){
          foreach($orders as $order){
              if($order->delivery_fee > $contract->least_price){
                  $money += $order->delivery_fee * ($contract->commission / 100);
              }else{
                   $money += $contract->least_price;
              }
          }
      }else{
          $money = 0;
      }
      }
        ?>
@if($contract == null)
@else
          <span class="badge badge-success" data-toggle="modal" data-target="#myModal{{$a}}" style="cursor:pointer;">{{$a}}</span>
      <div id="myModal{{$a}}" class="modal fade" role="dialog">
  <div class="modal-dialog">


    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">دفع </h4>
      </div>
      <div class="modal-body">
            <div class="row">
     <div class="col-3">
         <label>المبلغ الكلى </label>
   
         <input type="number" disabled required value="{{$contract->sallary + $money}}"  min="1" name="orders" id="total{{$a}}" class="form-control">
     </div>
   
 <div class="col-3">
         <label>المبلغ المدفوع </label>
          <input type="number" disabled required value="0"  min="1" name="orders"  class="form-control">
     </div> 
      <div class="col-3">
         <label>الخصم </label>
          <input type="number" required  disabled value="{{$discounts}}"    min="1" name="orders" id="discounts{{$a}}" class="form-control">
     </div> <div class="col-3">
         <label>المكافأه </label>
          <input type="number" required  disabled value="{{$awards}}"    min="1" name="orders" id="awards{{$a}}" class="form-control">
     </div>
          <input type="hidden" id="{{$discounts}}" value="{{$a}}">
     </div>
      <div class="row">
           <div class="col-12">
         <label>المبلغ </label>
          <input type="number" required value="{{($contract->sallary + $awards + $money) - $discounts }}" max="{{($contract->sallary + $awards) - $discounts }}"   min="1" name="orders" id="value{{$a}}" class="form-control">
     </div><div class="col-3">
         <label>عدد الطلبات </label>
          <input type="number" required  disabled value="{{count($orders)}}" max=""   min="1" name="orders" id="awards{{$a}}" class="form-control">
     </div>
      </div>
<div class="row">
    <div class="col-3"></div>
     <div class="col-3">
         <input type="button" onclick="addemplyeeexpense({{$id}},{{$discounts}})" value="حفظ" class="form-control btn btn-success btn-sm m-4">
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
    @endforeach



<script>


function addemplyeeexpense(id,a){
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
       url: `adddriverexpense`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       data:{
           'total':$(`#total${date}`).val(),
            'discounts':$(`#discounts${date}`).val(),
            'awards':$(`#awards${date}`).val(),
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
  title:'تم الدفع بنجاح',
  showConfirmButton: false,
  timer: 1500
})
$(".modal-backdrop").remove();
   $(`#myModale${date}`).modal('hide');
 $(`#myModal${date}`).modal('hide');
       table.ajax.reload();
           }else{
               Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'عفوا لاتملك مال كفايه فى المحفظه',
})
           }
       }
  })
} </script>