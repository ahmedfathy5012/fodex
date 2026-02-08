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
      
	
        <div class="card-body">
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

          <!--</div>-->
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
              <span id="btn" class="btn btn-primary mx-auto" onclick="filtercharts()">بحث</span>
          </div>
          <div class="container">
            
 
        
                <div class="row">
            <div class="col-3"></div>
             <div class="col-6">
            <canvas id="myChart12"></canvas>
            </div>
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
    //   var start = moment().subtract(29, 'days');
    // var end = moment();

    // function cb(start, end) {
    //     $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    // }

    // $('#reportrange').daterangepicker({
    //     startDate: start,
    //     endDate: end,
    //     ranges: {
    //       'Today': [moment(), moment()],
    //       'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    //       'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    //       'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    //       'This Month': [moment().startOf('month'), moment().endOf('month')],
    //       'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    //     }
    // }, cb);

    // cb(start, end);


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
    // .on('apply.daterangepicker', function(ev, picker) {
    //     filterTable(true);
    // });

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
       url: `getstates/${id}`,
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
       url: `getcities/${id}`,
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
       url: `getzones/${id}`,
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
  
//       $("#btn").on("click",function(){
//              var table = $('#dataTableBuilder').DataTable();
//      table.ajax.reload();
//      return false;
// }); 

//         $("#btn").on("click",function(){
 
//  $('#dataTableBuilder').on('preXhr.dt', function ( e, settings, data ) {
//         data.from = $('#from').val();
//         data.to = $('#to').val();
//           data.datepicker1 = $('#datepicker').val();
//       console.log($('#datepicker').val());
//           data.country_id = $('#country').val();
//          data.state_id = $('#state').val();
//               data.city_id = $('#city').val();
//          data.zone_id = $('#zone').val();
//       });
// });
   function filtercharts(){

 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"post",
       url: `filtercharts`,
       data:{
           'datepicker':$("#datepicker").val(),
            'country_id':$("#country").val(),
             'state_id':$("#state").val(),
              'city_id':$("#city").val(),
               'zone_id':$("#zone").val()
       },
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        if(result.status == true){
   var ctx12= document.getElementById("myChart12").getContext('2d');


var myChart12 = new Chart(ctx12, {
    type: 'bar',
    data: {
        labels: result.data.names13,//["ehab",	"ehab",	"ehab",	"ehab",	"ehab Paulo",	"ehab York",	"ehab","ehab Aires",	"ehab","ehab"],
        datasets: [{
            label: 'اسرع الموظفين قبول طلبات', // Name the series
            data:  result.data.numbers13,// [500,	50,	2424,	14040,	14141,	4111,	4544,	47,	5555, 100000], // Specify the data values array
            fill: false,
            borderColor: '#2196f3', // Add custom color border (bar)
            backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
            borderWidth: 1 // Specify bar border width
        }]},
    options: {
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
    }
});
    }
       }
    });
   }
        </script>
<script>
 window.onload= function(){

 
 $.ajax({
       type:"GET",
       url: `fastemployeeorder`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        console.log(result);
    var ctx12= document.getElementById("myChart12").getContext('2d');


var myChart12 = new Chart(ctx12, {
    type: 'bar',
    data: {
        labels: result.data.names,//["ehab",	"ehab",	"ehab",	"ehab",	"ehab Paulo",	"ehab York",	"ehab","ehab Aires",	"ehab","ehab"],
        datasets: [{
            label: 'اسرع الموظفين قبول طلبات', // Name the series
            data:  result.data.numbers,// [500,	50,	2424,	14040,	14141,	4111,	4544,	47,	5555, 100000], // Specify the data values array
            fill: false,
            borderColor: '#2196f3', // Add custom color border (bar)
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