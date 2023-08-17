 @extends('layouts.adminindex')
@section('content')
<style>
  .card-block{
    margin-bottom:10px;
  }</style>
	<!--begin::Card-->
    <!--<div class="card card-custom gutter-b">-->
      
	
        <!--<div class="card-body">-->
   <!--       <div class="container">-->
            
         
   
<style>
  .row .card-block{
    border-radius: 10px;
    opacity: .9;
    margin-bottom:10px;
    transition: .25s all ease;
  }
  .row .card-block:hover{
    box-shadow: 0 4px 6px rgb(0, 0, 0 , .7);
transform: rotateY(-2deg) ;
  }
  .row .card-block:hover img{
    transform: rotateZ(360deg);
  }
  .row .card-block h3{
    position: absolute;
    top: 37%;
    right: 74%;
    font-weight: 600;
    font-size: 32px;
    font-family: 'semibold';
  
    color:#252733  !important;
   
  }  .row .card-block p{
    position: absolute;
    top: 68%;
    left: 9%;
    font-family: 'semibold';
    font-size: 22px;
    font-weight: 500;
    color: #B2B5C0 !important;
    line-height: 1;}
    .card-block img{
      position: absolute;
      right: 11%;
      top: 25%;
    width: 27%;
    transform: rotateZ(0);
    transition: .5s all ease-in;
    }
    .card-block img:hover{
    }
  .card-custom{
  background-color:#edeff7;}
  .footer{
  background-color:#edeff7 !important;}
  .card_tit{
  margin: 17px;}
  #card_title h3 {
    font-weight: 600;
    font-size: 25px;
    font-family: 'semibold';
    color: #2E4765;
    line-height: 1.2;}
    .style{
    right: 12px;
    padding: 20px;
    margin-left: 53px;
   }.style h3{
    font-weight: 600;
    font-size: 28px;
    font-family: 'semibold';
    color:#252733;
   
  }.style p{
    font-weight: 500;
     font-size: 17px;
      white-space: nowrap;
    color: #B2B5C0 !important;
    line-height: 1;}
    div.dataTables_wrapper div.dataTables_info{
        font-size:10px;
    }canvas{
        /*height:450px !important;*/
    }
    </style>
	<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
					
						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">
							                    <div class="row">
          @if(auth()->user()->type == 1)
             <div class="form-group col-lg-3 col-md-6">
        <label>الدوله<span class="text-danger">*</span></label>
        <select name="country_id" class="form-control selectpicker" onchange="getstates(this)" id="country" required="required" data-live-search="true">
            <option value="0">الكل</option>
          @foreach(auth()->user()->countries as $country)
          <option value="{{$country->id}}">{{$country->name}}</option>
          @endforeach
        </select>
       </div> 
       @endif
        @if(auth()->user()->type == 1 || auth()->user()->type == 2)
       <div class="form-group col-lg-3 col-md-6">
        <label>المحافظه<span class="text-danger">*</span></label>
        <select name="state_id" class="form-control selectpicker" id="state"  onchange="getcities(this)" required="required" data-live-search="true">
              <option value="0">الكل</option>
          @foreach(auth()->user()->states as $state)
          <option value="{{$state->id}}">{{$state->name}}</option>
          @endforeach
        </select>

       </div>    
       @endif
         @if(auth()->user()->type == 1 ||auth()->user()->type == 2 || auth()->user()->type == 3)
       <div class="form-group col-lg-3 col-md-6">
        <label>المدينه<span class="text-danger">*</span></label>
        <select name="city_id" class="form-control selectpicker" onchange="getzones(this)" id="city" required="required" data-live-search="true">
              <option value="0" >الكل</option>
          @foreach(auth()->user()->cities as $city)
          <option value="{{$city->id}}">{{$city->name}}</option>
          @endforeach
        </select>
       </div>   
       @endif
        @if(auth()->user()->type == 1 ||auth()->user()->type == 2 || auth()->user()->type == 3 || auth()->user()->type == 4)
       <div class="form-group col-lg-3 col-md-6">
        <label>المنطقه<span class="text-danger">*</span></label>
        <select name="zone_id" class="form-control selectpicker" id="zone" required="required" data-live-search="true">
              <option value="0">الكل</option>
          @foreach(auth()->user()->zones as $zone)
          <option value="{{$zone->id}}">{{$zone->name}}</option>
          @endforeach
        </select>
       </div>    
       @endif
<!--     <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">-->
<!--    <i class="fa fa-calendar"></i>&nbsp;-->
<!--    <span></span> <i class="fa fa-caret-down"></i>-->
<!--</div>-->

          </div>
             <div class="row mt-3 mb-4">
              <span id="btn" class="btn btn-sm  mt-4 btning" onclick="filter_dashboard()">بحث</span>
          </div>
								<!--begin::Dashboard-->
								   <div class="row">
         <div class="col-md-3 col-sm-6" >
             <div class="card-block" style="background-color:#fff;height:150px;padding: 5% 15%;">
             
               <div class="text-right" style="font-size:29px;float:right;font-weight:300px;color:#252733;">
                  <h3 style="color:#252733;" id="daily_orders" class="counter" data-count="{{$daily_orders}}">   
             0
             </h3>
              
                 <p style="color:#252733;">
                الطلبات الجديده
               </p>
                </div>
          <a href="{{route('dailyorders')}}" >  <img src="{{asset('online-order.png')}}"
            class="text-left"></a>
               </div>
           </div>
               <div class="col-md-3 col-sm-6" >
             <div class="card-block" style="background-color:#fff;height:150px;padding: 5% 15%;">
             
               <div class="text-right" style="font-size:29px;float:right;font-weight:300px;color:#252733;">
                  <h3 style="color:#252733;" id="count_sellers" class="counter" data-count="{{$count_sellers}}">   
            0
             </h3>
              
                 <p style="color:#252733;">
                 المطاعم
               </p>
                </div>
          <a href="{{route('seller.index')}}" >  <img src="{{asset('restaurant.png')}}"
            class="text-left"></a>
               </div>
           </div>     <div class="col-md-3 col-sm-6" >
             <div class="card-block" style="background-color:#fff;height:150px;padding: 5% 15%;">
             
               <div class="text-right" style="font-size:29px;float:right;font-weight:300px;color:#252733;">
                  <h3 style="color:#252733;" id="count_employees" class="counter" data-count="{{$count_employees}}">   
               0
             </h3>
              
                 <p style="color:#252733;">
                 الموظفين
               </p>
                </div>
          <a href="{{route('employee.index')}}" >  <img src="{{asset('employee.png')}}"
            class="text-left"></a>
               </div>
           </div>     <div class="col-md-3 col-sm-6" >
             <div class="card-block" style="background-color:#fff;height:150px;padding: 5% 15%;">
             
               <div class="text-right" style="font-size:29px;float:right;font-weight:300px;color:#252733;">
                  <h3 style="color:#252733;" id="count_drivers" class="counter" data-count="{{$count_drivers}}">   
               0
             </h3>
              
                 <p style="color:#252733;">
                 السائقين
               </p>
                </div>
          <a href="{{route('driver.index')}}" >  <img src="{{asset('driver.png')}}"
            class="text-left"></a>
               </div>
           </div>    
         
  
          </div>
          <script>
               $(document).ready(function(){
$('.counter').each(function() {
  var $this = $(this),
      countTo = $this.attr('data-count');
  $({ countNum: $this.text()}).animate({
    countNum: countTo
  },
  {
    duration: 2000,
    easing:'linear',
    step: function() {
      $this.text(Math.floor(this.countNum));
    },
    complete: function() {
      $this.text(this.countNum);
    }
  });
});
});
          </script>
								<!--begin::Row-->
								<div class="row">
								    		<div class="col-lg-6 col-xxl-4">
										<!--begin::List Widget 9-->
										<div class="card card-custom card-stretch gutter-b" style="background-color:#fff !important;">
											<!--begin::Header-->
											<div class="card-header align-items-center border-0 mt-4">
												<h3 class="card-title align-items-start flex-column">
													<span class="font-weight-bolder text-dark">اشعارات الطلبات اليوميه</span>
												
												</h3>
										
											</div>
											<!--end::Header-->
											<!--begin::Body-->
											<div class="card-body pt-4">
												<!--begin::Timeline-->
												<div class="timeline timeline-6 mt-3" id="notifications">
												  
												    @if(count($notifications) > 0)
												    @foreach($notifications as $notification)
													<!--begin::Item-->
													<div class="timeline-item align-items-start subnoty">
														<!--begin::Label-->
														<div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">{{$notification->time}}</div>
														<!--end::Label-->
														<!--begin::Badge-->
														<div class="timeline-badge">
															<i class="fa fa-genderless text-warning icon-xl"></i>
														</div>
														<!--end::Badge-->
														<!--begin::Text-->
														<div class="font-weight-mormal font-size-lg timeline-content text-muted pl-3">
														    {{$notification->message}}</div>
														<!--end::Text-->
													</div>
													<!--end::Item-->
											@endforeach
											@else
										<lottie-player src="{{asset('85891-search.json')}}" id="lotto" background="transparent" 
										speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>
											@endif
												
												</div>
												<!--end::Timeline-->
											</div>
											<!--end: Card Body-->
										</div>
										<!--end: List Widget 9-->
									</div>
  <!--  الطلبات/ المطاعم -->
        <div class="col-lg-6 col-md-6 col-12 mt-5">
            <canvas id="myChart"></canvas>

            <script>
                // const zyx = document.getElementById("myChart").getContext('2d');
                // const labels2 = <?php echo json_encode($sellers_names);?>;
                // const data2 = {
                //     labels: labels2,
                //     datasets: [{
                //         label: 'المطاعم / الطلبات',
                //         data: 
                //         backgroundColor: [
                //             '#4B6587','#889EAF','#D8D2CB','#54BAB9'
                //         ],
                //         borderColor: [
                //           '#4B6587'
                //         ],
                //         borderWidth: 1,
                //         barPercentage: 0.5,
                //         barThickness: 50,
                //         // maxBarThickness: 15,
                //         minBarLength: 3,
                //     }]
                // };
                // const config2 = {
                //     type: 'bar',
                //     data: data2,
                //     options: {
                //         responsive: true,
                //         scales: {
                //             y: {
                //                 beginAtZero: true
                //             }
                //         }
                //     },
                // };
                // const myChart2 = new Chart(zyx, config2);
                
                  var ctx1= document.getElementById("myChart").getContext('2d');

              const labels2 = <?php echo json_encode($sellers_names);?>;
              
var myChart1 = new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: labels2,//["ehab",	"ehab",	"ehab",	"ehab",	"ehab Paulo",	"ehab York",	"ehab","ehab Aires",	"ehab","ehab"],
        datasets: [{
              label: 'المطاعم / الطلبات',
            data:  <?php echo json_encode($seller_order_numbers);?>,// [500,	50,	2424,	14040,	14141,	4111,	4544,	47,	5555, 100000], // Specify the data values array
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
            </script>
        </div>
        <!-- المطاعم / الطلبات --
           <!--  أكثر العملاء طلبا  -->
        <div class="col-lg-6 col-md-6 col-12 mt-5">
            <span style="display: flex;
    justify-content: center;">     أكثر العملاء طلبا  </span>
            <canvas id="myChart3" ></canvas>

            <script>
                const zyx3 = document.getElementById("myChart3").getContext('2d');
                const labels4 = <?php echo json_encode($users_names);?>;
                const data4 = {
                    labels: labels4,
                    datasets: [{
                        label: 'العملاء / الطلبات',
                        data:<?php echo json_encode($user_order_numbers);?>,
                        backgroundColor: [
                            '#4B6587','#889EAF','#D8D2CB','#54BAB9'
                        ],
                        borderColor: [
                          '#4B6587','#889EAF','#D8D2CB','#54BAB9'
                        ],
                        borderWidth: 1,
                        barPercentage: 0.5,
                        barThickness: 50,
                        // maxBarThickness: 15,
                        minBarLength: 3,
                    }]
                };
                const config4 = {
                    type: 'pie',
                    data: data4,
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    },
                };
                const myChart4 = new Chart(zyx3, config4);
            </script>
        </div>
        <!-- أكثر العملاء طلبا -->
    <!--  اكثر  السائقين  توصيلا للطلبات    -->
        <div class="col-lg-6 col-md-6 col-12 mt-5">
            <span style="display: flex;
    justify-content: center;">     أكثر السائقين  توصيلا للطلبات  </span>
            <canvas id="myChart5" ></canvas>

            <script>
                const zyx5 = document.getElementById("myChart5").getContext('2d');
                const labels5 = <?php echo json_encode($drivers_names);?>;
                const data5 = {
                    labels: labels5,
                    datasets: [{
                        label: 'السائقين / الطلبات',
                        data:<?php echo json_encode($driver_order_numbers);?>,
                      backgroundColor: [
                            '#4B6587','#889EAF','#D8D2CB','#54BAB9'
                        ],
                        borderColor: [
                          '#4B6587','#889EAF','#D8D2CB','#54BAB9'
                        ],
                        borderWidth: 1,
                        barPercentage: 0.5,
                        barThickness: 50,
                        // maxBarThickness: 15,
                        minBarLength: 3,
                    }]
                };
                const config5 = {
                    type: 'pie',
                    data: data5,
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    },
                };
                const myChart5 = new Chart(zyx5, config5);
            </script>
        </div>
      <!--  اكثر  السائقين  توصيلا للطلبات    -->
							
	
								</div>
								<!--end::Row-->
								<!--begin::Row-->
								<div class="row">
								
									<div class="col-lg-12">
										<!--begin::Advance Table Widget 4-->
										<div class="card card-custom card-stretch gutter-b"  style="background-color:#fff !important;">
											<!--begin::Header-->
											<div class="card-header border-0 py-5">
												<h3 class="card-title align-items-start flex-column">
													<span class="card-label font-weight-bolder text-dark">الكوبونات المتاحه </span>
													<!--<span class="text-muted mt-3 font-weight-bold font-size-sm">More than 400+ new members</span>-->
												</h3>
											
											</div>
											<!--end::Header-->
											<!--begin::Body-->
											<div class="card-body pt-0 pb-3">
												<div class="tab-content">
													<!--begin::Table-->
													<div class="table-responsive">
														<table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
															<thead>
																<tr class="text-left text-uppercase">
																	<th style="min-width: 100px" >
																		
																		الاسم
																	</th>
																	<th style="min-width: 100px">الكود</th>
																	<th style="min-width: 100px">من</th>
																	<th style="min-width: 100px">الى </th>
																	<th style="min-width: 100px">القيمه</th>
																	<th style="min-width: 80px">النوع</th>
																</tr>
															</thead>
															<tbody>
															    @foreach($coupons as $coupon)
																<tr>
																
																	<td>
																		<span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$coupon->title}}</span>
																		
																	</td>
																	<td>
																		<span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$coupon->name}}</span>
																		
																	</td>
																	<td>
																		<span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$coupon->date_from}}</span>
																	
																	</td>
																	<td>
																		<span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$coupon->date_to}}</span>
																	</td>
																	<td >
																		<span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$coupon->value}}</span>
																	</td>
																		<td >
																		<span class="text-dark-75 font-weight-bolder d-block font-size-lg">
																		    			@if($coupon->percentage == 0)
                                                                                          <?php  echo "ثابت"; ?>
                                                                                   @else
                                                                                          <?php echo "نسبه مئويه"; ?>
                                                                                          @endif
                                                                                      
																		</span>
																	</td>
														
																</tr>
																@endforeach
														
															</tbody>
														</table>
													</div>
													<!--end::Table-->
												</div>
											</div>
											<!--end::Body-->
										</div>
										<!--end::Advance Table Widget 4-->
									</div>
								</div>
								<!--end::Row-->
								<!--end::Dashboard-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>
			
					<!--end::Content-->
					<audio src="{{asset('notification.mp3')}}"></audio>
@endsection
@section("scripts")
<script>
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
                  function filter_dashboard(){
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"post",
       url: `filter_dashboard`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       data:{
         "country_id": $('#country').val(),
         "state_id" : $('#state').val(),
         "city_id" : $('#city').val(),
         "zone_id" : $('#zone').val(),
       },
       success: function(result){
           if(result.status == true){
           $("#count_sellers").empty();
           $("#count_sellers").text(result.data.count_sellers);
           $("#count_drivers").empty();
           $("#count_drivers").text(result.data.count_drivers);
           $("#count_employees").empty();
           $("#count_employees").text(result.data.count_employees);
           $("#daily_orders").empty();
           $("#daily_orders").text(result.data.daily_orders);
            var ctx1= document.getElementById("myChart").getContext('2d');

              const labels2 =  result.data.sellers_names;
              
var myChart1 = new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: labels2,//["ehab",	"ehab",	"ehab",	"ehab",	"ehab Paulo",	"ehab York",	"ehab","ehab Aires",	"ehab","ehab"],
        datasets: [{
              label: 'المطاعم / الطلبات',
            data:  result.data.seller_order_numbers,// [500,	50,	2424,	14040,	14141,	4111,	4544,	47,	5555, 100000], // Specify the data values array
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

     const zyx5 = document.getElementById("myChart5").getContext('2d');
                const labels5 = result.data.drivers_names;
                const data5 = {
                    labels: labels5,
                    datasets: [{
                        label: 'السائقين / الطلبات',
                        data:result.data.driver_order_numbers,
                      backgroundColor: [
                            '#4B6587','#889EAF','#D8D2CB','#54BAB9'
                        ],
                        borderColor: [
                          '#4B6587','#889EAF','#D8D2CB','#54BAB9'
                        ],
                        borderWidth: 1,
                        barPercentage: 0.5,
                        barThickness: 50,
                        // maxBarThickness: 15,
                        minBarLength: 3,
                    }]
                };
                const config5 = {
                    type: 'pie',
                    data: data5,
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    },
                };
                const myChart5 = new Chart(zyx5, config5);
                
                
                       const zyx3 = document.getElementById("myChart3").getContext('2d');
                const labels4 = result.data.users_names;
                const data4 = {
                    labels: labels4,
                    datasets: [{
                        label: 'العملاء / الطلبات',
                        data:result.data.user_order_numbers,
                        backgroundColor: [
                            '#4B6587','#889EAF','#D8D2CB','#54BAB9'
                        ],
                        borderColor: [
                          '#4B6587','#889EAF','#D8D2CB','#54BAB9'
                        ],
                        borderWidth: 1,
                        barPercentage: 0.5,
                        barThickness: 50,
                        // maxBarThickness: 15,
                        minBarLength: 3,
                    }]
                };
                const config4 = {
                    type: 'pie',
                    data: data4,
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    },
                };
                const myChart4 = new Chart(zyx3, config4);
           }
           }
    });
    }
 window.onload= function(){
       

     

 
}
Echo.channel('FodexApp')
                .listen('GetOrder', (e) => {
                    console.log(e);
                    $("#lotto").empty();
                    let length = $('#notifications .subnoty').length;
                    if(length >= 10){
                        $('#notifications .subnoty').slice(-1).remove();
                    }
                     var x = new Audio('https://fodex.dawena.net/public/notification.mp3');
      // Show loading animation.
      var playPromise = x.play();
                    $("#notifications").prepend(`
				<div class="timeline-item align-items-start subnoty">
						
								<div class="timeline-label font-weight-bolder 
								text-dark-75 font-size-lg">${e.time}</div>
							
							
								<div class="timeline-badge">
									<i class="fa fa-genderless text-warning icon-xl"></i>
								</div>
								
								<div class="font-weight-mormal font-size-lg timeline-content text-muted pl-3">
								${e.message}
								</div>
							
							</div>
								`);
								
Swal.fire(
  'طلب جديد',
  `	${e.message}`
)
                });
</script>
@endsection