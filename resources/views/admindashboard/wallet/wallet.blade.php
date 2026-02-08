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
    			
    			<h3 class="card-label">المحفظه</h3>
    			
    		</div>
	    </div>
 
 <!--begin::Form-->

  
  <div class="card-body">
   <div class="row">
         <div class="col-lg-4 col-md-6" >
             <div class="card-block" style="background-color:#1C6DD0;height:150px;padding: 5% 15%;">
               <h3 style="">
                المصروفات
               </h3>
               <div class="text-right" style="font-size:23px;float:right;font-weight:300px;color:#fff;">
                 {{$expenses}}
               </div>
          <img src="{{asset('expenses.png')}}"
            class="text-left">

               </div>
           </div>
           <div class="col-lg-4 col-md-6" >
             <div class="card-block" style="background-color:#16C79A;height:150px;padding: 5% 15%;">
               <h3 style="">
             التحصيلات
               </h3>
               <div class="text-right" style="font-size:23px;float:right;font-weight:300px;color:#fff;">
                 {{$allcolletions}}
               </div>
            <img src="{{asset('revenue.png')}}"
            class="text-left">
               </div>
           </div>
                   <div class="col-lg-4 col-md-6" >
             <div class="card-block" style="background-color:#e54e6b;height:150px;padding: 5% 15%;">
               <h3 style="">
             المتبقى
               </h3>
              <img src="{{asset('money-bag.png')}}" 
                class="text-left">
               <div class="text-right" style="font-size:23px;float:right;font-weight:300px;color:#fff;">
                   {{$rest}}
               </div>
           
               </div>
           </div>

          </div>
           <div class="row mt-4">
                <div class="col-4 mx-auto">
          <div class="form-group btn-dating">
                                <label for="datepicker">    <i class="fa fa-calendar"></i>&nbsp;
    <span></span> <i class="fa fa-caret-down" id="fsq"></i></label>
                                <input type="text" id="datepicker" name="datepicker" class="datepicker" readonly="">
                            </div>
                            </div>
                            </div>
      <div class="row mx-auto">
    <button class="btn btn-primary" style="margin: auto;" id="btn" ><img src="{{asset('search.png')}}"  style="cursor: pointer;
width: 12px;
height: 20px;
"  value="click" onclick="walletfilter()" class="icon-img">
        بحث</button>
    </div>
    <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                <div class="col-md-9">
                    <div class="table-responsive">
                        <table class="table" id="invoice_table">
                            <thead>
                                <tr>
                                    <th class="pl-0 font-weight-bold text-muted text-uppercase">المصروفات </th>
                                    <th class="pl-0 font-weight-bold text-muted text-uppercase">  التحصيلات</th>
                                    <th class="font-weight-bold text-muted text-uppercase">المتبقى </th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="font-weight-boldest border-bottom-0 font-size-lg" id="">
                                <td class="border-top-0 pl-0 py-4"><span id="expenses"><span> </td>
                                    <td class="border-top-0 py-4"><span id="collections"><span></td>
                                    <td class="border-top-0 pr-0 py-4"><span id="rest"><span></td>
                            
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
  
   
  
 </form>
 <!--end::Form-->
</div>
@endsection
@section("scripts")
<script>
     function walletfilter(){


 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

 
    $.ajax({
       type:"post",
       url: `walletfilter`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       data:{
           'datepicker':$("#datepicker").val(),
            // 'month':$("#month").val(),
       },
       success: function(result){
           if(result.status == true){
      $("#expenses").empty();
      $("#expenses").text(result.expenses);
          $("#rest").empty();
      $("#rest").text(result.rest);
          $("#collections").empty();
      $("#collections").text(result.collections);
           }
       }
  
  })
}  $('.datepicker').daterangepicker({
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
</script>
@endsection