@extends('layouts.adminindex')
@section('content')
<style>
  .btn-dating label{
top: 2px;
    position: absolute;
    background-color: #be0605;
    width: 42px;
    height: 41px;
    padding-top: 8px;
    opacity: .8;
}
/*.btn-dating {*/
/*    position: relative;*/
/*    overflow: hidden;*/
/*}*/
/*.fa-calendar{*/
/*    padding-right: 10px;*/
/*}#fsq{*/
/*    padding-left: 6px;*/
/*}*/
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
    			
    			<h3 class="card-label">الطلبات</h3>
    			
    		</div>
	    </div>
	      <div class="row">
	        <!--<a class="btn btn-primary btn-sm ml-4 mt-4" href="{{route('item.create')}}">اضافه</a>-->
	    </div>
        <div class="card-body">
            <!--begin: Datatable-->
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
            <div class="row mt-4">
                                    <div class="col-md-2 col-sm-4 mb-3">
                                        <button type="button" onclick="filterstatus('')" class="btn btn-primary w-100 d-flex justify-content-center align-items-center">
                                          الكل
                                         
                                        </button>
                                    </div>
                                    <div class="col-md-2 col-sm-4 mb-3">
                                        <button type="button" onclick="filterstatus(0)" class="btn btn-success w-100 d-flex justify-content-center align-items-center">
                                           جديده
                                          
                                        </button>
                                    </div>
                                    <div class="col-md-2 col-sm-4 mb-3">
                                        <button type="button" onclick="filterstatus(1)" class="btn btn-primary w-100 d-flex justify-content-center align-items-center">
                                            مقبوله
                                          
                                        </button>
                                    </div>    <div class="col-md-2 col-sm-4 mb-3">
                                        <button type="button" onclick="filterstatus(2)" class="btn btn-primary w-100 d-flex justify-content-center align-items-center">
                                            تم التحضير
                                          
                                        </button>
                                    </div>    <div class="col-md-2 col-sm-4 mb-3">
                                        <button type="button" onclick="filterstatus(3)" class="btn btn-success w-100 d-flex justify-content-center align-items-center">
                                            تم التسليم
                                          
                                        </button>
                                    </div>
                                    <div class="col-md-2 col-sm-4 mb-3">
                                        <button type="button" onclick="filterstatus(5)" class="btn btn-danger w-100 d-flex justify-content-center align-items-center">
                                            ملغيه
                                          
                                        </button>
                                    </div>
                                </div>
    {!! $dataTable->table([
                    
                     ],true) !!}
            <!--end: Datatable-->
        </div>
    <!--end::Card-->
   
  


@endsection
@section('scripts')   
{{$dataTable->scripts()}} 
      <script>   
      window.onload = function(){
$("#datepicker").val('');}
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

        $("#btn").on("click",function(){
 
 $('#dataTableBuilder').on('preXhr.dt', function ( e, settings, data ) {
        data.from = $('#from').val();
        data.to = $('#to').val();
          data.datepicker1 = $('#datepicker').val();
      console.log($('#datepicker').val());
          data.country_id = $('#country').val();
         data.state_id = $('#state').val();
              data.city_id = $('#city').val();
         data.zone_id = $('#zone').val();
      });
             $('#dataTableBuilder').DataTable().ajax.reload();
});
 function filterstatus(status) {
            $('#dataTableBuilder').on('preXhr.dt', function(e, settings, data) {
                data.status =status;
                   data.from = $('#from').val();
        data.to = $('#to').val();
          data.datepicker1 = $('#datepicker').val();
      console.log($('#datepicker').val());
          data.country_id = $('#country').val();
         data.state_id = $('#state').val();
              data.city_id = $('#city').val();
         data.zone_id = $('#zone').val();
            });
            $('#dataTableBuilder').DataTable().ajax.reload();
        }
        </script>
@endsection