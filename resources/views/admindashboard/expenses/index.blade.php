@extends('layouts.adminindex')
@section('content')
<style>
  .btn-dating label{
      
    position: absolute;
top: 5px;
right: 32px;
width: 35px;
height: 35px;
display: flex;
align-items: center;
justify-content: center;
font-size: 20px;
background: #2b6ba4;
color: #555;
border-radius: 5px;
cursor: pointer;
transition: 0.5s;
margin: 0;
z-index: 1;
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
    			
    			<h3 class="card-label"> المصروفات</h3>
    			
    		</div>
	    </div>
	           <div class="row">
             <div class="form-group col-lg-3 col-md-6">
        <label>الدوله<span class="text-danger">*</span></label>
        <select name="country_id" class="form-control selectpicker" onchange="getstates(this)" id="country" required="required" data-live-search="true">
            <option value="0">الكل</option>
          @foreach(auth()->user()->countries as $country)
          <option value="{{$country->id}}">{{$country->name}}</option>
          @endforeach
        </select>
       </div>   <div class="form-group col-lg-3 col-md-6">
        <label>المحافظه<span class="text-danger">*</span></label>
        <select name="state_id" class="form-control selectpicker" id="state"  onchange="getcities(this)" required="required" data-live-search="true">
              <option value="0">الكل</option>
          @foreach(auth()->user()->states as $state)
          <option value="{{$state->id}}">{{$state->name}}</option>
          @endforeach
        </select>

       </div>      <div class="form-group col-lg-3 col-md-6">
        <label>المدينه<span class="text-danger">*</span></label>
        <select name="city_id" class="form-control selectpicker" onchange="getzones(this)" id="city" required="required" data-live-search="true">
              <option value="0" >الكل</option>
          @foreach(auth()->user()->cities as $city)
          <option value="{{$city->id}}">{{$city->name}}</option>
          @endforeach
        </select>
       </div>     <div class="form-group col-lg-3 col-md-6">
        <label>المنطقه<span class="text-danger">*</span></label>
        <select name="zone_id" class="form-control selectpicker" id="zone" required="required" data-live-search="true">
              <option value="0">الكل</option>
          @foreach(auth()->user()->zones as $zone)
          <option value="{{$zone->id}}">{{$zone->name}}</option>
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
      <div class="row mt-4 mb-4">
              <span id="btn" class="btn btn-sm  mt-4 btning">بحث</span>
      </div>
     
	   
	      <div class="row">
	        <a class="btn btn-sm  mt-4 btning" href="{{route('expenses.create')}}">اضافه</a>
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
       function getstates(selected){
let id = selected.value;
console.log(id);
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getstatesemployee/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        if(result.status == true){
       $('#state').empty();
       $('#state').append(result.data);
       $('select#state').selectpicker("refresh");
       console.log(result);
     }
       }

      });
    }function getcities(selected){
let id = selected.value;
console.log(id);
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getcitiesemployee/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        if(result.status == true){
       $('#city').empty();
       $('#city').append(result.data);
       $('select#city').selectpicker("refresh");
       console.log(result);
     }
       }

      });
    }function getzones(selected){
let id = selected.value;
console.log(id);
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getzonesemployee/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        if(result.status == true){
       $('#zone').empty();
       $('#zone').append(result.data);
       $('select#zone').selectpicker("refresh");
       console.log(result);
     }
       }

      });
    }
         $("#btn").on("click",function(){
             var table = $('#dataTableBuilder').DataTable();
     table.ajax.reload();
     return false;
}); 

        $("#btn").on("click",function(){
 
 $('#dataTableBuilder').on('preXhr.dt', function ( e, settings, data ) {
      data.datepicker1 = $('#datepicker').val();
             data.country_id = $('#country').val();
         data.state_id = $('#state').val();
              data.city_id = $('#city').val();
         data.zone_id = $('#zone').val();
      });
});
        </script>
@endsection