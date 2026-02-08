@extends('layouts.adminindex')
@section('content')
<style>
  .btn-dating label{
 position: absolute;
top: 1px;
right: 0%;
width: 44px;
height: 41px;
display: flex;
align-items: center;
justify-content: center;
font-size: 20px;
background: #3C9FEA;
color: #7b2727;
border-radius: 5px;
cursor: pointer;
transition: 0.5s;
margin: 0;
z-index: 1
}
.btn-dating {
    position: relative;
    overflow: hidden;
}

.fa-calendar{
    padding-right: 10px;
}#fsq{
    padding-left: 6px;
}
  .card-block{
    margin-bottom:10px;
  }
  .row .card-block{
    border-radius: 32px;
    opacity: .9;
  }  .row .card-block .text-left{
    filter: brightness(0) invert(1);
    width:50px !important;
    height:50px !important;
    bottom: 52px;
    left: 45px;
    position: absolute;

  }.row .card-block .text-right{
    bottom: 57px;
    right: 64px;
    position: absolute;
  }.row .card-block h3{
    top: 15px;
    right: 35px;
    position: absolute;
    color:#fff;
    font-size:22px;
    font-weight:800px;
  }.datepicker{
     width:253px; 
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
    			
    			<h3 class="card-label">  الإيرادات الخاصه بالمحافظات </h3>
    			
    		</div>
	    </div>
	      <div class="row">
	        <!--<a class="btn btn-primary btn-sm ml-4 mt-4" href="{{route('item.create')}}">اضافه</a>-->
	    </div>
        <div class="card-body">
            <!--begin: Datatable-->
          <div class="row">
             <div class="form-group col-lg-7 col-md-6">
        <label>المحافظه<span class="text-danger">*</span></label>
        <select name="state_id" class="form-control selectpicker"  id="state" required="required" data-live-search="true">
            <option value="0">الكل</option>
          @foreach(auth()->user()->states as $state)
          <option value="{{$state->id}}">{{$state->name}}</option>
          @endforeach
        </select>
       </div>  
<!--     <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">-->
<!--    <i class="fa fa-calendar"></i>&nbsp;-->
<!--    <span></span> <i class="fa fa-caret-down"></i>-->
<!--</div>-->

          </div>
            <div class="row">
                <div class="col-4 mx-auto">
          <div class="form-group btn-dating">
                                <label for="datepicker">    <i class="fa fa-calendar"></i>&nbsp;
    <span></span> <i class="fa fa-caret-down" id="fsq"></i></label>
                                <input type="text" id="datepicker" name="datepicker" class="datepicker" readonly="">
                            </div>
                            </div>
                            </div>
          <!--<div class="row">-->
          <!--    <div class="col-6">-->
          <!--        <input type="date" id="from" class="form-control">-->
          <!--    </div>  <div class="col-6">-->
          <!--        <input type="date" id="to" class="form-control">-->
          <!--    </div>-->
          <!--</div>-->
          <div class="row">
              <span id="btn" class="btn btn-sm  mt-4 btning">بحث</span>
          </div>
      <div class="row mt-5">
         <div class="col-lg-3 col-md-6" >
             <div class="card-block" style="background-color:#1C6DD0;height:150px;padding: 5% 15%;">
               <h3 style="">
                المبلغ الكلى
               </h3>
               <div class="text-right" id="total" style="font-size:23px;float:right;font-weight:300px;color:#fff;">
                 {{$total}}
               </div>
          <img src="{{asset('money-bag.png')}}"
            class="text-left">

               </div>
           </div>
           <div class="col-lg-3 col-md-6" >
             <div class="card-block" style="background-color:#16C79A;height:150px;padding: 5% 15%;">
               <h3 style="">
             النسبه من المطعم
               </h3>
               <div class="text-right" id="seller_commission" style="font-size:23px;float:right;font-weight:300px;color:#fff;">
                 {{$seller_commission}}
               </div>
            <img src="{{asset('revenue.png')}}"
            class="text-left">
               </div>
           </div>
                   <div class="col-lg-3 col-md-6" >
             <div class="card-block" style="background-color:#e54e6b;height:150px;padding: 5% 15%;">
               <h3 style="">
             النسبه من الدليفري
               </h3>
              <img src="{{asset('revenue.png')}}" 
                class="text-left">
               <div class="text-right" id="driver_commission" style="font-size:23px;float:right;font-weight:300px;color:#fff;">
                   {{$driver_commission}}
               </div>
           
               </div>
           </div>
   <div class="col-lg-3 col-md-6" >
             <div class="card-block" style="background-color:#495371;height:150px;padding: 5% 15%;">
               <h3 style="">
           عدد الطلبات
               </h3>
              <img src="{{asset('order.png')}}" 
                class="text-left">
               <div class="text-right" id="order_count" style="font-size:23px;float:right;font-weight:300px;color:#fff;">
                   {{$order_count}}
               </div>
           
               </div>
           </div>
          </div>
        </div>
    <!--end::Card-->
   
  


@endsection
@section('scripts')   
      <script>   
window.onload = function(){
$("#datepicker").val('');}
      //  DATE RANGE PICKER
    $('.datepicker').daterangepicker({
        autoApply: true,
        opens: "left",
        drops: "auto",
        parentEl: "main",
        ranges: {
            "اليوم": [moment(), moment()],
            "أمس": [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            "آخر 7 أيام": [moment().subtract(6, 'days'), moment()],
            "آخر 30 يوم": [moment().subtract(29, 'days'), moment()],
            "هذا الشهر": [moment().startOf('month'), moment().endOf('month')],
            "الشهر الماضي": [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        locale: {
            customRangeLabel: "تاريخ مخصص",
            direction: "rtl",
            format: "YYYY-MM-DD",
            applyLabel: "تطبيق",
            cancelLabel: "إلغاء",
            fromLabel: "من",
            toLabel: "إلي",
            firstDay: 6,
            daysOfWeek: [
                "ح",
                "ن",
                "ث",
                "ر",
                "خ",
                "ج",
                "س"
            ],
            monthNames: [
                "يناير",
                "فبراير",
                "مارس",
                "أبريل",
                "مايو",
                "يونيو",
                "يوليو",
                "أغسطس",
                "سبتمبر",
                "أكتوبر",
                "نوفمبر",
                "ديسمبر"
            ],
        },
    });


      
        $("#btn").on("click",function(){
  
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    console.log($("#datepicker").val());
    $.ajax({
       type:"post",
       url: `filterstate_icomes`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       data:{
           "datepicker":String($("#datepicker").val()),
           "state_id":$('#state').val()
       },
       success: function(result){
        if(result.status == true){
            $("#total").empty();
      $("#total").text(result.total);
          $("#driver_commission").empty();
      $("#driver_commission").text(result.driver_commission);
          $("#seller_commission").empty();
      $("#seller_commission").text(result.seller_commission);
            $("#order_count").empty();
      $("#order_count").text(result.order_count);
     }
       }

      });
    
});
        </script>
@endsection