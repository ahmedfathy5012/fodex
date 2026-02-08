@extends('layouts.sellerindex')
@section('content')
<style>
  .card-block{
    margin-bottom:10px;
  }</style>
	<!--begin::Card-->
    <div class="card card-custom gutter-b">
      
	
        <div class="card-body">
          <div class="container">
            
         
         <div class="row">
                     <div class="col-lg-3 col-md-6">
             <div class="card-block" style="background-color:#eef0f8;height:150px;padding: 5% 15%;">
               <h3 style="margin-top:10px;color:#757575;font-size:16px;font-weight:600px;margin-right:65px">
                 الطعام
               </h3>
               <a href="{{route('orders.index')}}" >   
                     <img src="{{asset('fast-food.png')}}"
                      style="width:80px;height:80px;" class="text-left"></a>
               <div class="text-right" style="font-size:35px;float:right;font-weight:300px;">
                   {{count($items)}}

               </div>
           
               </div>
           </div>
                   <div class="col-lg-3 col-md-6">
             <div class="card-block" style="background-color:#eef0f8;height:150px;padding: 5% 15%;">
               <h3 style="margin-top:10px;color:#757575;font-size:16px;font-weight:600px;margin-right:65px">
                 الطلبات
               </h3>
               <a href="{{route('orders.index')}}" >   
                     <img src="{{asset('online-order.png')}}"
                      style="width:80px;height:80px;" class="text-left"></a>
               <div class="text-right" style="font-size:35px;float:right;font-weight:300px;">
                   {{count($orders)}}

               </div>
           
               </div>
           </div>
          </div>
        <div class="row">
          <div class="col-6">
            <canvas id="myChart3"></canvas>
            </div>
        </div>
   </div>
<style>
    canvas{
        height:450px;
    }
</style>

@endsection
@section("scripts")
<script>
 window.onload= function(){
 

   $.ajax({
       type:"GET",
       url: `mostmyitemsorder`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
var ctx = document.getElementById("myChart3").getContext('2d');


var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: result.data.names,//["ehab",	"ehab",	"ehab City",	"ehab",	"ehab Paulo",	"ehab York",	"ehab","ehab Aires",	"ehab","ehab"],
        datasets: [{
            label: 'اكثر المنتجات مبيعا', // Name the series
            data: result.data.numbers,//[500,	50,	2424,	14040,	14141,	4111,	4544,	47,	5555, 6811], // Specify the data values array
            fill: false,
            borderColor: '#2196f3', // Add custom color border (Line)
            backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
            borderWidth: 1 // Specify bar border width
        }]},
    options: {
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
    }
});
}
});
}
</script>
@endsection