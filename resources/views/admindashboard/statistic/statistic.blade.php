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
            <div class="col-6">
            <canvas id="myChart"></canvas>
            </div> <div class="col-6">
            <canvas id="myChart1"></canvas>
            </div>
        </div>
         <div class="row">
            <div class="col-6">
            <canvas id="myChart2"></canvas>
            </div> <div class="col-6">
            <canvas id="myChart3"></canvas>
            </div>
        </div>
         <!--<div class="row">-->
         <!--  <div class="col-2">  <label>الدول</label></div>-->
         <!--   <div class="col-10">   <hr></div>-->
         <!--    </div>-->
           
         <!--    <div class="row">-->
         <!--   <div class="col-6">-->
         <!--   <canvas id="myChart4"></canvas>-->
         <!--   </div> <div class="col-6">-->
         <!--   <canvas id="myChart5"></canvas>-->
         <!--   </div>-->
         <!--   </div>-->
         <!--   <div class="row">-->
         <!--  <div class="col-2">  <label>المحافظات</label></div>-->
         <!--   <div class="col-10">   <hr></div>-->
         <!--    </div>-->
             
         <!--    <div class="row">-->
         <!--   <div class="col-6">-->
         <!--   <canvas id="myChart6"></canvas>-->
         <!--   </div> <div class="col-6">-->
         <!--   <canvas id="myChart7"></canvas>-->
         <!--   </div>-->
         <!--   </div>-->
         <!--   <div class="row">-->
         <!--  <div class="col-2">  <label>المدن</label></div>-->
         <!--   <div class="col-10">   <hr></div>-->
         <!--    </div>-->
           
         <!--    <div class="row">-->
         <!--   <div class="col-6">-->
         <!--   <canvas id="myChart8"></canvas>-->
         <!--   </div> <div class="col-6">-->
         <!--   <canvas id="myChart9"></canvas>-->
         <!--   </div>-->
         <!--   </div>-->
         <!--   <div class="row">-->
         <!--  <div class="col-2">  <label>المناطق</label></div>-->
         <!--   <div class="col-10">   <hr></div>-->
         <!--    </div>-->
       
         <!--    <div class="row">-->
         <!--   <div class="col-6">-->
         <!--   <canvas id="myChart10"></canvas>-->
         <!--   </div> <div class="col-6">-->
         <!--   <canvas id="myChart11"></canvas>-->
         <!--   </div>-->
         <!--   </div>-->
         <!--       <div class="row">-->
         <!--   <div class="col-3"></div>-->
         <!--    <div class="col-6">-->
         <!--   <canvas id="myChart12"></canvas>-->
         <!--   </div>-->
         <!--   </div>-->
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
     var ctx1= document.getElementById("myChart").getContext('2d');


var myChart1 = new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: result.data.names1,//["ehab",	"ehab",	"ehab",	"ehab",	"ehab Paulo",	"ehab York",	"ehab","ehab Aires",	"ehab","ehab"],
        datasets: [{
            label: 'اكثر البائعين منتجات', // Name the series
            data:  result.data.numbers1,// [500,	50,	2424,	14040,	14141,	4111,	4544,	47,	5555, 100000], // Specify the data values array
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
var ctx2 = document.getElementById("myChart1").getContext('2d');


var myChart2 = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: result.data.names2,//["ehab",	"ehab",	"ehab City",	"ehab",	"ehab Paulo",	"ehab York",	"ehab","ehab Aires",	"ehab","ehab"],
        datasets: [{
             label: 'اكثر البائعين طلبات', // Name the series
            data: result.data.numbers2,//[500,	50,	2424,	14040,	14141,	4111,	4544,	47,	5555, 6811], // Specify the data values array
            fill: false,
            borderColor: '#2196f3', // Add custom color border (Line)
            backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
            borderWidth: 1 // Specify bar border width
        }]},
    options: {
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
    }
});var ctx3 = document.getElementById("myChart2").getContext('2d');


var myChart3 = new Chart(ctx3, {
    type: 'bar',
    data: {
        labels: result.data.names3,//["ehab",	"ehab",	"ehab City",	"ehab",	"ehab Paulo",	"ehab York",	"ehab","ehab Aires",	"ehab","ehab"],
        datasets: [{
             label: 'اكثر السائقين توصيل طلبات',// Name the series
            data: result.data.numbers3,//[500,	50,	2424,	14040,	14141,	4111,	4544,	47,	5555, 6811], // Specify the data values array
            fill: false,
            borderColor: '#2196f3', // Add custom color border (Line)
            backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
            borderWidth: 1 // Specify bar border width
        }]},
    options: {
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
    }
});var ctx4 = document.getElementById("myChart3").getContext('2d');


var myChart4 = new Chart(ctx4, {
    type: 'bar',
    data: {
        labels: result.data.names4,//["ehab",	"ehab",	"ehab City",	"ehab",	"ehab Paulo",	"ehab York",	"ehab","ehab Aires",	"ehab","ehab"],
        datasets: [{
            label: 'اكثر المنتجات مبيعا', // Name the series
            data: result.data.numbers4,//[500,	50,	2424,	14040,	14141,	4111,	4544,	47,	5555, 6811], // Specify the data values array
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
       }

      });
      
      var ctx5 = document.getElementById("myChart5").getContext('2d');


var myChart5 = new Chart(ctx5, {
    type: 'bar',
    data: {
        labels: result.data.names6,//["ehab",	"ehab",	"ehab",	"ehab",	"ehab Paulo",	"ehab York",	"ehab","ehab Aires",	"ehab","ehab"],
        datasets: [{
            label: 'اكثر الدول سعر للطلبات', // Name the series
            data:  result.data.numbers6,// [500,	50,	2424,	14040,	14141,	4111,	4544,	47,	5555, 100000], // Specify the data values array
            fill: false,
            borderColor: '#2196f3', // Add custom color border (Line)
            backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
            borderWidth: 1 // Specify bar border width
        }]},
    options: {
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
    }
});    var ctx4 = document.getElementById("myChart4").getContext('2d');


var myChart4 = new Chart(ctx4, {
    type: 'bar',
    data: {
        labels: result.data.names5,//["ehab",	"ehab",	"ehab",	"ehab",	"ehab Paulo",	"ehab York",	"ehab","ehab Aires",	"ehab","ehab"],
        datasets: [{
            label: 'اكثر الدول طلبات', // Name the series
            data:  result.data.numbers5,// [500,	50,	2424,	14040,	14141,	4111,	4544,	47,	5555, 100000], // Specify the data values array
            fill: false,
            borderColor: '#2196f3', // Add custom color border (Line)
            backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
            borderWidth: 1 // Specify bar border width
        }]},
    options: {
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
    }
});  var ctx7 = document.getElementById("myChart7").getContext('2d');


var myChart7 = new Chart(ctx7, {
    type: 'bar',
    data: {
        labels: result.data.names8,//["ehab",	"ehab",	"ehab",	"ehab",	"ehab Paulo",	"ehab York",	"ehab","ehab Aires",	"ehab","ehab"],
        datasets: [{
            label: 'اكثر المحافظات سعر للطلبات', // Name the series
            data:  result.data.numbers8,// [500,	50,	2424,	14040,	14141,	4111,	4544,	47,	5555, 100000], // Specify the data values array
            fill: false,
            borderColor: '#2196f3', // Add custom color border (Line)
            backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
            borderWidth: 1 // Specify bar border width
        }]},
    options: {
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
    }
});        console.log(result);
    var ctx6= document.getElementById("myChart6").getContext('2d');


var myChart6 = new Chart(ctx6, {
    type: 'bar',
    data: {
        labels: result.data.names7,//["ehab",	"ehab",	"ehab",	"ehab",	"ehab Paulo",	"ehab York",	"ehab","ehab Aires",	"ehab","ehab"],
        datasets: [{
            label: 'اكثر المحافظات طلبات', // Name the series
            data:  result.data.numbers7,// [500,	50,	2424,	14040,	14141,	4111,	4544,	47,	5555, 100000], // Specify the data values array
            fill: false,
            borderColor: '#2196f3', // Add custom color border (Line)
            backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
            borderWidth: 1 // Specify bar border width
        }]},
    options: {
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
    }
});    var ctx9 = document.getElementById("myChart9").getContext('2d');


var myChart9 = new Chart(ctx9, {
    type: 'bar',
    data: {
        labels: result.data.names10,//["ehab",	"ehab",	"ehab",	"ehab",	"ehab Paulo",	"ehab York",	"ehab","ehab Aires",	"ehab","ehab"],
        datasets: [{
            label: 'اكثر المدن سعر للطلبات', // Name the series
            data:  result.data.numbers10,// [500,	50,	2424,	14040,	14141,	4111,	4544,	47,	5555, 100000], // Specify the data values array
            fill: false,
            borderColor: '#2196f3', // Add custom color border (Line)
            backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
            borderWidth: 1 // Specify bar border width
        }]},
    options: {
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
    }
}); var ctx8= document.getElementById("myChart8").getContext('2d');


var myChart8 = new Chart(ctx8, {
    type: 'bar',
    data: {
        labels: result.data.names9,//["ehab",	"ehab",	"ehab",	"ehab",	"ehab Paulo",	"ehab York",	"ehab","ehab Aires",	"ehab","ehab"],
        datasets: [{
            label: 'اكثر المدن طلبات', // Name the series
            data:  result.data.numbers9,// [500,	50,	2424,	14040,	14141,	4111,	4544,	47,	5555, 100000], // Specify the data values array
            fill: false,
            borderColor: '#2196f3', // Add custom color border (Line)
            backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
            borderWidth: 1 // Specify bar border width
        }]},
    options: {
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
    }
});    var ctx11 = document.getElementById("myChart11").getContext('2d');


var myChart11 = new Chart(ctx11, {
    type: 'bar',
    data: {
        labels: result.data.names12,//["ehab",	"ehab",	"ehab",	"ehab",	"ehab Paulo",	"ehab York",	"ehab","ehab Aires",	"ehab","ehab"],
        datasets: [{
            label: 'اكثر المناطق سعر للطلبات', // Name the series
            data:  result.data.numbers12,// [500,	50,	2424,	14040,	14141,	4111,	4544,	47,	5555, 100000], // Specify the data values array
            fill: false,
            borderColor: '#2196f3', // Add custom color border (Line)
            backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
            borderWidth: 1 // Specify bar border width
        }]},
    options: {
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
    }
});  var ctx10= document.getElementById("myChart10").getContext('2d');


var myChart10 = new Chart(ctx10, {
    type: 'bar',
    data: {
        labels: result.data.names11,//["ehab",	"ehab",	"ehab",	"ehab",	"ehab Paulo",	"ehab York",	"ehab","ehab Aires",	"ehab","ehab"],
        datasets: [{
            label: 'اكثر المناطق طلبات', // Name the series
            data:  result.data.numbers11,// [500,	50,	2424,	14040,	14141,	4111,	4544,	47,	5555, 100000], // Specify the data values array
            fill: false,
            borderColor: '#2196f3', // Add custom color border (Line)
            backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
            borderWidth: 1 // Specify bar border width
        }]},
    options: {
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
    }
});   var ctx12= document.getElementById("myChart12").getContext('2d');


var myChart12 = new Chart(ctx12, {
    type: 'bar',
    data: {
        labels: result.data.names13,//["ehab",	"ehab",	"ehab",	"ehab",	"ehab Paulo",	"ehab York",	"ehab","ehab Aires",	"ehab","ehab"],
        datasets: [{
            label: 'اسرع الموظفين قبول طلبات', // Name the series
            data:  result.data.numbers13,// [500,	50,	2424,	14040,	14141,	4111,	4544,	47,	5555, 100000], // Specify the data values array
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
        </script>
<script>
 window.onload= function(){
        $.ajax({
       type:"GET",
       url: `mostresitems`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        console.log(result);
    var ctx = document.getElementById("myChart").getContext('2d');


var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: result.data.names,//["ehab",	"ehab",	"ehab",	"ehab",	"ehab Paulo",	"ehab York",	"ehab","ehab Aires",	"ehab","ehab"],
        datasets: [{
            label: 'اكثر البائعين منتجات', // Name the series
            data:  result.data.numbers,// [500,	50,	2424,	14040,	14141,	4111,	4544,	47,	5555, 100000], // Specify the data values array
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
 $.ajax({
       type:"GET",
       url: `mostsellerorder`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        console.log(result);
var ctx = document.getElementById("myChart1").getContext('2d');


var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: result.data.names,//["ehab",	"ehab",	"ehab City",	"ehab",	"ehab Paulo",	"ehab York",	"ehab","ehab Aires",	"ehab","ehab"],
        datasets: [{
             label: 'اكثر البائعين طلبات', // Name the series
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

     $.ajax({
       type:"GET",
       url: `mostdriverorder`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
var ctx = document.getElementById("myChart2").getContext('2d');


var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: result.data.names,//["ehab",	"ehab",	"ehab City",	"ehab",	"ehab Paulo",	"ehab York",	"ehab","ehab Aires",	"ehab","ehab"],
        datasets: [{
             label: 'اكثر السائقين توصيل طلبات',// Name the series
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

   $.ajax({
       type:"GET",
       url: `mostitemorder`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
var ctx = document.getElementById("myChart3").getContext('2d');


var myChart = new Chart(ctx, {
    type: 'bar',
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
//country
      $.ajax({
       type:"GET",
       url: `mostcountryprice`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        console.log(result);
    var ctx5 = document.getElementById("myChart5").getContext('2d');


var myChart5 = new Chart(ctx5, {
    type: 'bar',
    data: {
        labels: result.data.names,//["ehab",	"ehab",	"ehab",	"ehab",	"ehab Paulo",	"ehab York",	"ehab","ehab Aires",	"ehab","ehab"],
        datasets: [{
            label: 'اكثر الدول سعر للطلبات', // Name the series
            data:  result.data.numbers,// [500,	50,	2424,	14040,	14141,	4111,	4544,	47,	5555, 100000], // Specify the data values array
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
});  $.ajax({
       type:"GET",
       url: `mostcountryorder`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        console.log(result);
    var ctx4 = document.getElementById("myChart4").getContext('2d');


var myChart4 = new Chart(ctx4, {
    type: 'bar',
    data: {
        labels: result.data.names,//["ehab",	"ehab",	"ehab",	"ehab",	"ehab Paulo",	"ehab York",	"ehab","ehab Aires",	"ehab","ehab"],
        datasets: [{
            label: 'اكثر الدول طلبات', // Name the series
            data:  result.data.numbers,// [500,	50,	2424,	14040,	14141,	4111,	4544,	47,	5555, 100000], // Specify the data values array
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
//state
  $.ajax({
       type:"GET",
       url: `moststateprice`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        console.log(result);
    var ctx7 = document.getElementById("myChart7").getContext('2d');


var myChart7 = new Chart(ctx7, {
    type: 'bar',
    data: {
        labels: result.data.names,//["ehab",	"ehab",	"ehab",	"ehab",	"ehab Paulo",	"ehab York",	"ehab","ehab Aires",	"ehab","ehab"],
        datasets: [{
            label: 'اكثر المحافظات سعر للطلبات', // Name the series
            data:  result.data.numbers,// [500,	50,	2424,	14040,	14141,	4111,	4544,	47,	5555, 100000], // Specify the data values array
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
});  $.ajax({
       type:"GET",
       url: `moststateorder`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        console.log(result);
    var ctx6= document.getElementById("myChart6").getContext('2d');


var myChart6 = new Chart(ctx6, {
    type: 'bar',
    data: {
        labels: result.data.names,//["ehab",	"ehab",	"ehab",	"ehab",	"ehab Paulo",	"ehab York",	"ehab","ehab Aires",	"ehab","ehab"],
        datasets: [{
            label: 'اكثر المحافظات طلبات', // Name the series
            data:  result.data.numbers,// [500,	50,	2424,	14040,	14141,	4111,	4544,	47,	5555, 100000], // Specify the data values array
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

//city

  $.ajax({
       type:"GET",
       url: `mostcityprice`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        console.log(result);
    var ctx9 = document.getElementById("myChart9").getContext('2d');


var myChart9 = new Chart(ctx9, {
    type: 'bar',
    data: {
        labels: result.data.names,//["ehab",	"ehab",	"ehab",	"ehab",	"ehab Paulo",	"ehab York",	"ehab","ehab Aires",	"ehab","ehab"],
        datasets: [{
            label: 'اكثر المدن سعر للطلبات', // Name the series
            data:  result.data.numbers,// [500,	50,	2424,	14040,	14141,	4111,	4544,	47,	5555, 100000], // Specify the data values array
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
});  $.ajax({
       type:"GET",
       url: `mostcityorder`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        console.log(result);
    var ctx8= document.getElementById("myChart8").getContext('2d');


var myChart8 = new Chart(ctx8, {
    type: 'bar',
    data: {
        labels: result.data.names,//["ehab",	"ehab",	"ehab",	"ehab",	"ehab Paulo",	"ehab York",	"ehab","ehab Aires",	"ehab","ehab"],
        datasets: [{
            label: 'اكثر المدن طلبات', // Name the series
            data:  result.data.numbers,// [500,	50,	2424,	14040,	14141,	4111,	4544,	47,	5555, 100000], // Specify the data values array
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
//zone
//city

  $.ajax({
       type:"GET",
       url: `mostzoneprice`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        console.log(result);
    var ctx11 = document.getElementById("myChart11").getContext('2d');


var myChart11 = new Chart(ctx11, {
    type: 'bar',
    data: {
        labels: result.data.names,//["ehab",	"ehab",	"ehab",	"ehab",	"ehab Paulo",	"ehab York",	"ehab","ehab Aires",	"ehab","ehab"],
        datasets: [{
            label: 'اكثر المناطق سعر للطلبات', // Name the series
            data:  result.data.numbers,// [500,	50,	2424,	14040,	14141,	4111,	4544,	47,	5555, 100000], // Specify the data values array
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
});  $.ajax({
       type:"GET",
       url: `mostzoneorder`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        console.log(result);
    var ctx10= document.getElementById("myChart10").getContext('2d');


var myChart10 = new Chart(ctx10, {
    type: 'bar',
    data: {
        labels: result.data.names,//["ehab",	"ehab",	"ehab",	"ehab",	"ehab Paulo",	"ehab York",	"ehab","ehab Aires",	"ehab","ehab"],
        datasets: [{
            label: 'اكثر المناطق طلبات', // Name the series
            data:  result.data.numbers,// [500,	50,	2424,	14040,	14141,	4111,	4544,	47,	5555, 100000], // Specify the data values array
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