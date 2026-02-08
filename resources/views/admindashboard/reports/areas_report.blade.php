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

  } .row .card-block .text-right{
    filter: brightness(0) invert(1);
    width:50px !important;
    height:50px !important;
    bottom: 52px;
    right: 45px;
    position: absolute;
}
  .row .card-block h3{
    top: 15px;
   right: 28%;
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
    			
    			<h3 class="card-label">تقارير المناطق</h3>
    			
    		</div>
	    </div>
 
 <!--begin::Form-->

  
  <div class="card-body">
   <div class="row">
         <div class="col-lg-3 col-md-6" >
             <div class="card-block" style="background-color:#0A81AB;height:150px;padding: 5% 15%;">
               <h3 style="">
                الدول
               </h3>
                 <a href="{{route('country_icomes')}}"> <img src="{{asset('money-bag.png')}}"
            class="text-right"></a>
           <a href="{{route('country_orders')}}"> <img src="{{asset('order.png')}}"
            class="text-left"></a>
               </div>

               
           </div>
           <div class="col-lg-3 col-md-6" >
             <div class="card-block" style="background-color:#16C79A;height:150px;padding: 5% 15%;">
               <h3 style="">
             المحافظات
               </h3>
             <a href="{{route('state_icomes')}}"> <img src="{{asset('money-bag.png')}}"
            class="text-right"></a>
            <a href="{{route('state_orders')}}"><img src="{{asset('order.png')}}"
            class="text-left"></a>
               </div>
           </div>
                   <div class="col-lg-3 col-md-6" >
             <div class="card-block" style="background-color:#e54e6b;height:150px;padding: 5% 15%;">
               <h3 style="">
             المدن
               </h3>
            
             <a href="{{route('city_icomes')}}"> <img src="{{asset('money-bag.png')}}"
            class="text-right"></a>
             <a href="{{route('city_orders')}}"><img src="{{asset('order.png')}}"
            class="text-left"></a>
             
           
               </div>
           </div>
           <div class="col-lg-3 col-md-6" >
             <div class="card-block" style="background-color:#38A3A5;height:150px;padding: 5% 15%;">
               <h3 style="">
             المناطق
               </h3>
            
             <a href="{{route('zone_icomes')}}"> <img src="{{asset('money-bag.png')}}"
            class="text-right"></a>
            <a href="{{route('zone_orders')}}"> <img src="{{asset('order.png')}}"
            class="text-left"></a>
               </div>
           
               </div>
           </div>

          </div>
      
 </form>
 <!--end::Form-->

@endsection
@section("scripts")

@endsection