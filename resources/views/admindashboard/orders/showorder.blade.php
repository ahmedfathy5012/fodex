@extends('layouts.adminindex')
@section('content')
        <!-- begin::Card-->
        <div class="card card-custom overflow-hidden invoice_table" id="invoice">
            <div class="card-body p-0">
                <!-- begin: Invoice-->
                <!-- begin: Invoice header-->
                <div class="row justify-content-center bgi-size-cover bgi-no-repeat py-8 px-8 py-md-27 px-md-0 invoice_back">
                    
                    <div class="col-md-9">
                        <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                            <h1 class="display-4 text-white font-weight-boldest mb-10 title_wizard">تفاصيل الطلب</h1>
                            <div class="d-flex flex-column align-items-md-end px-0">
                             
                            </div>
                        </div>
                        <div class="border-bottom w-100 opacity-20"></div>
                        <div class="d-flex justify-content-between text-white pt-6">
                        <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolde mb-2r title_wizard">الاسم</span>
                                <span
                                    class="opacity-70 text-wizard">{{ $order->user->name ?? "" }}</span>
                            </div>
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolde mb-2r title_wizard">رقم الهاتف</span>
                                <span
                                    class="opacity-70 text-wizard">{{ $order->user->phone ?? "" }}</span>
                            </div>
                            
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolde mb-2r title_wizard">العنوان</span>
                                <span
                                    class="opacity-70 text-wizard">{{ $order->address }}</span>
                            </div>
                           
                          
</div>
 <div class="d-flex justify-content-between text-white pt-6">
                        <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolde mb-2r title_wizard">اسم البائع</span>
                                <span
                                    class="opacity-70 text-wizard">{{ $order->seller->name ?? "" }}</span>
                            </div>
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolde mb-2r title_wizard">رقم هاتف البائع </span>
                                <span
                                    class="opacity-70 text-wizard">{{ $order->seller->phone ?? "" }}</span>
                            </div>
                            
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolde mb-2r title_wizard"> عنوان البائع </span>
                                <span
                                    class="opacity-70 text-wizard">{{ $order->seller->address->address ?? "" }}</span>
                            </div>
                           
                          
</div>
 <div class="d-flex justify-content-between text-white pt-6">
                        <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolde mb-2r title_wizard">اسم الموظف</span>
                                <span
                                    class="opacity-70 text-wizard">{{ $order->seller->name ?? "" }}</span>
                            </div>
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolde mb-2r title_wizard"> شركه التوصيل   </span>
                                <span
                                    class="opacity-70 text-wizard">{{$order->company->name ?? ""}}</span>
                            </div>
                            
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolde mb-2r title_wizard">  اسم السائق   </span>
                                <span
                                    class="opacity-70 text-wizard">{{$order->driver->name ?? ""}}</span>
                            </div>
                           
                          
</div>
                            <div class="d-flex justify-content-between text-white pt-6">
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolde mb-2r title_wizard">  السعر</span>
                                <span
                                    class="opacity-70 text-wizard">{{$order->price}}</span>
                            </div>
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolde mb-2r title_wizard"> السعر بعد الخصم</span>
                                <span
                                    class="opacity-70 text-wizard">{{ $order->priceafterdiscount }}</span>
                            </div>
                         
                         <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolde mb-2r title_wizard">سعر التوصيل</span>
                                <span
                                    class="opacity-70 text-wizard">{{ $order->delivery_fee }}</span>
                            </div>
                            
                        
</div>
                        </div>
                        
                        
                    </div>
                    
                    	    <div class="row">
	    <!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary col-md-3 m-3" data-toggle="modal" data-target="#myModal444">
  اوقات الطلب 
</button>

<!-- The Modal -->
<div class="modal fade" role="dialog" id="myModal444">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">اوقات الطلب </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
	              <p class="text font-weight-bolder mb-2"> وقت قبول الطلب   
	              </p>
	             
	              <p class="text2 opacity-70">
	         {{$order->accepted_at ? \Carbon\Carbon::parse($order->accepted_at)->format('g:i A') : null}}
	         </p>

	         </div>
	         
	         <div class="col-md-6">
	              <p class="text font-weight-bolder mb-2"> وقت قبول المطعم   
	              </p>
	             
	              <p class="text2 opacity-70">
	                   {{$order->seller_accept ? \Carbon\Carbon::parse($order->seller_accept)->format('g:i A') : null}}
	              </p>

	         </div><div class="col-md-6">
	              <p class="text font-weight-bolder mb-2"> وقت  ادراج الطلب للشركه   
	              </p>
	             
	              <p class="text2 opacity-70">
	                  {{$order->insert_order_driver ? \Carbon\Carbon::parse($order->insert_order_company)->format('g:i A') : null}}
	              </p>

	         </div> <div class="col-md-6">
	              <p class="text font-weight-bolder mb-2"> وقت  ادراج الطلب للسائق   
	              </p>
	             
	              <p class="text2 opacity-70">
	                  {{$order->insert_order_driver ? \Carbon\Carbon::parse($order->insert_order_driver)->format('g:i A') : null}}
	              </p>

	         </div><div class="col-md-6">
	              <p class="text font-weight-bolder mb-2"> وقت قبول السائق   
	              </p>
	             
	              <p class="text2 opacity-70">
	                   {{$order->driver_accept ? \Carbon\Carbon::parse($order->driver_accept)->format('g:i A') : null}}
	              </p>

	         </div>
	         <div class="col-md-6">
	              <p class="text font-weight-bolder mb-2"> وقت تحضير الطلب    
	              </p>
	             
	              <p class="text2 opacity-70">
	                {{$order->preparation_time ? \Carbon\Carbon::parse($order->preparation_time)->format('g:i A') : null}}
	              </p>

	         </div><div class="col-md-6">
	              <p class="text font-weight-bolder mb-2"> وقت وصول  السائق للمطعم   
	              </p>
	             
	              <p class="text2 opacity-70">
	                {{$order->driver_waiting_order ? \Carbon\Carbon::parse($order->driver_waiting_order)->format('g:i A') : null}}
	              </p>

	         </div><div class="col-md-6">
	              <p class="text font-weight-bolder mb-2"> وقت استلام السائق للطلب من المطعم    
	              </p>
	             
	              <p class="text2 opacity-70">
	                  {{$order->driver_pickup ? \Carbon\Carbon::parse($order->driver_pickup)->format('g:i A') : null}}
	              </p>

	         </div>
	         <div class="col-md-6">
	              <p class="text font-weight-bolder mb-2"> وقت وصول الطلب للعميل     
	              </p>
	             
	              <p class="text2 opacity-70">
	                  {{$order->delivery_time ? \Carbon\Carbon::parse($order->delivery_time)->format('g:i A') : null}}
	              </p>

	         </div>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
      </div>

    </div>
  </div>
</div>



	    <!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary  col-md-3 m-3" data-toggle="modal" data-target="#myModal445">
   احصائيه اوقات الطلب  
</button>

<!-- The Modal -->
<div class="modal fade" role="dialog" id="myModal445">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">اوقات الطلب </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
     <div class="row">
             <div class="col-md-6">
	              <p class="text font-weight-bolder mb-2"> وقت قبول الطلب   
	              </p>
	             
	              <p class="text2 opacity-70">{{$order->time_accept}}</p>

	         </div>
	         
	         <div class="col-md-6">
	              <p class="text font-weight-bolder mb-2"> وقت قبول المطعم   
	              </p>
	             
	              <p class="text2 opacity-70">{{$order->seller_accept_time}}</p>

	         </div> <div class="col-md-6">
	              <p class="text font-weight-bolder mb-2"> وقت  ادراج الطلب للسائق   
	              </p>
	             
	              <p class="text2 opacity-70">{{$order->insert_order_driver}}</p>

	         </div><div class="col-md-6">
	              <p class="text font-weight-bolder mb-2"> وقت قبول السائق   
	              </p>
	             
	              <p class="text2 opacity-70">{{$order->driver_accept_time}}</p>

	         </div>
	         <div class="col-md-6">
	              <p class="text font-weight-bolder mb-2"> وقت تحضير الطلب    
	              </p>
	             
	              <p class="text2 opacity-70">{{$order->time_preparation}}</p>

	         </div><div class="col-md-6">
	              <p class="text font-weight-bolder mb-2"> وقت وصول  السائق للمطعم   
	              </p>
	             
	              <p class="text2 opacity-70">{{$order->driver_waiting_order_time}}</p>

	         </div><div class="col-md-6">
	              <p class="text font-weight-bolder mb-2"> وقت استلام السائق للطلب من المطعم    
	              </p>
	             
	              <p class="text2 opacity-70">{{$order->driver_pickup_time}}</p>

	         </div>
	         <div class="col-md-6">
	              <p class="text font-weight-bolder mb-2"> وقت وصول الطلب للعميل     
	              </p>
	             
	              <p class="text2 opacity-70">{{$order->driver_waiting_client_time}}</p>

	         </div>
	         
	         <div class="col-md-6">
	              <p class="text font-weight-bolder mb-2"> وقت تسليم الطلب    
	              </p>
	             
	              <p class="text2 opacity-70">
	             {{$order->accepted_at ? \Carbon\Carbon::parse($order->accepted_at)->format('g:i A') : null}}
	              </p>

	         </div>
     </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
      </div>

    </div>
  </div>
</div>



	    <!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary  col-md-3 m-3" data-toggle="modal" data-target="#myModal447">
 احصائيه اوقات الطلب بالترتيب
</button>

<!-- The Modal -->
<div class="modal fade" role="dialog" id="myModal447">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">اوقات الطلب </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
     <div class="row">
             <div class="col-md-6">
	              <p class="text font-weight-bolder mb-2"> وقت قبول الطلب   
	              </p>
	             
	              <p class="text2 opacity-70">{{$order->time_accept}}</p>

	         </div>
	         
	         <div class="col-md-6">
	              <p class="text font-weight-bolder mb-2">  وقت قبول المطعم   
	              </p>
	             
	              <p class="text2 opacity-70">{{$order->seller_accept_after}}</p>

	         </div> <div class="col-md-6">
	              <p class="text font-weight-bolder mb-2"> وقت قبول السائق بعد الادراج   
	              </p>
	             
	              <p class="text2 opacity-70">{{$order->driver_accept_after}}</p>

	         </div><div class="col-md-6">
	              <p class="text font-weight-bolder mb-2"> وقت تحضير المطعم للطلب     
	              </p>
	             
	              <p class="text2 opacity-70">{{$order->preparation_after}}</p>

	         </div>
	         <div class="col-md-6">
	              <p class="text font-weight-bolder mb-2"> وقت  وصول السائق للمطعم بعد قبوله الطلب    
	              </p>
	             
	              <p class="text2 opacity-70">{{$order->driver_reach_seller}}</p>

	         </div><div class="col-md-6">
	              <p class="text font-weight-bolder mb-2"> وقت استلام السائق للطلب بعد وصوله للمطعم       
	              </p>
	             
	              <p class="text2 opacity-70">{{$order->driver_pick_seller}}</p>

	         </div><div class="col-md-6">
	              <p class="text font-weight-bolder mb-2"> وقت  وصول السائق للعميل بعد استلامه الطلب     
	              </p>
	             
	              <p class="text2 opacity-70">{{$order->driver_reach_client}}</p>

	         </div>
	         <div class="col-md-6">
	              <p class="text font-weight-bolder mb-2"> وقت تسليم السائق للعميل بعد وصوله        
	              </p>
	             
	              <p class="text2 opacity-70">{{$order->driver_pick_client}}</p>

	         </div>
	         
	   
     </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
      </div>

    </div>
  </div>
</div>
</div>
	    <hr style="width:70%" />
	    <div class="row" id="rowing">
	       <?php 
$drivers = \App\Models\Driver::where("available",1)->whereHas("company",function($q) use ($order){
  
     $q->where("master",1)->whereHas("zones",function($q1) use ($order){
  
    return $q1->whereIn("zones.id",[$order->zone_id]);
});
})->get();
$reasons = \App\Models\RefusedReason::all();
$orderstatus = \App\Models\OrderStatus::all();
?>
 <span class="" style="cursor:pointer;" data-toggle="modal" data-target="#myModalp{{$order->id}}" ><img src="{{asset('dollar.png')}}"style="width:25px;height:25px;"></span>
                            <div id="myModalp{{$order->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">السعر</h4>
      </div>
      <div class="modal-body">
       <div class="row">
            <div class="col-6">
            <label>السعر </label>
        <input type="number" min="0" class="form-control" id="price{{$order->id}}" value="{{$order->price}}">
        </div>    <div class="col-6">
            <label>الخصم </label>
        <input type="number" min="0" class="form-control" id="discount{{$order->id}}" value="{{$order->price -$order->priceafterdiscount}}">
        </div>
        </div>
        <div class="row">
            <button class="btn btn-primary mx-auto mt-4" 
           onclick="editprice({{$order->id}})" >حفظ</button>
            </div>
      </div>
     
    </div>

  </div>
</div>
<?php
$companies = \App\Models\Driver::where("is_company",1)->whereHas("zones",function($q) use ($order){
  
    return $q->whereIn("zones.id",[$order->zone_id]);
})->get();?>
  @if($order->status == 1)
  
   <span class="btn btn-success"data-toggle="modal" data-target="#myModaleee{{$order->id}}" >{{ $order->company ?  $order->company->name : 'شركات التوصيل'}} </span>
                            <div id="myModaleee{{$order->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">شركات التوصيل</h4>
      </div>
      <div class="modal-body">
       <div class="row">
            <div class="col-6">
            <label>شركات التوصيل</label>
            <select class="form-control"  style="display:block;" id="companyw{{$order->id}}" data-live-search="true">
                @foreach($companies as $company)
                <?php 
                $company_drivers = \App\Models\Driver::where("driver_id",$company->id)->where("available",1)->get();

                ?>
                <option value="{{$company->id}}" @if($order->company_id == $company->id) selected @endif>{{$company->name}} <span class="badge badge-secondary">{{count($company_drivers)}}</span></option>
                @endforeach
            </select>
        </div>
        </div>
        <div class="row">
            <button class="btn btn-primary mx-auto mt-4" 
           onclick="choosecompany({{$order->id}})" >حفظ</button>
            </div>
      </div>
     
    </div>

  </div>
</div>
     <span class="btn btn-success"data-toggle="modal" data-target="#myModalw{{$order->id}}" >{{ $order->driver ?  $order->driver->name : 'الدليفري'}} </span>
                            <div id="myModalw{{$order->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">الدليفري</h4>
      </div>
      <div class="modal-body">
       <div class="row">
            <div class="col-6">
            <label>الدليفري</label>
            <select class="form-control"  style="display:block;" id="driver_idw{{$order->id}}" data-live-search="true">
                @foreach($drivers as $driver)
                <option value="{{$driver->id}}" @if($order->driver_id == $driver->id) selected @endif>{{$driver->name}}</option>
                @endforeach
            </select>
        </div>
        </div>
        <div class="row">
            <button class="btn btn-primary mx-auto mt-4" 
           onclick="choosedriver({{$order->id}})" >حفظ</button>
            </div>
      </div>
     
    </div>

  </div>
</div>
@endif
     
@if($order->cancel == 1)
 <span class="label label-lg font-weight-bold label-light-danger label-inline">ملغى</span>
                        @endif
                                                      <span class="label label-lg font-weight-bold label-light-success label-inline"> {{$order->seller_status_name}}</span>

                        <!--@if($order->seller_status == 0)-->
                        <!-- <span class="label label-lg font-weight-bold label-light-danger label-inline">لم يقبل المطعم بعد</span>-->
                        <!--@else-->
                        <!--      <span class="label label-lg font-weight-bold label-light-success label-inline">المطعم قبل الطلب</span>-->
                        <!--@endif-->
                          @if($order->status == 0)
                            <span onclick="orderstatus({{$order->id}},1)" 
                            style="cursor:pointer;" class="label label-lg
                            font-weight-bold label-light-success label-inline">قبول</span>
                         
                            <!--<span class="btn btn-success"data-toggle="modal" data-target="#myModal{{$order->id}}" >قبول</span>-->
     
         <span class="label label-lg font-weight-bold label-light-danger label-inline"  
         data-toggle="modal" data-target="#myModale{{$order->id}}" style="cursor:pointer;">رفض</span>
                                 <div id="myModale{{$order->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">اسباب الرفض</h4>
      </div>
      <div class="modal-body">
       <div class="row">
            <div class="col-6">
            <label>السبب</label>
            <select class="form-control"  style="display:block;" id="refusedreason_id{{$order->id}}" data-live-search="true">
                @foreach($reasons as $reason)
                <option value="{{$reason->id}}">{{$reason->text}}</option>
                @endforeach
            </select>
        </div>
        </div>
        <div class="row">
            <button class="label label-lg font-weight-bold label-light-danger label-inline  mx-auto mt-4" 
           onclick="orderstatus({{$order->id}},2)" >رفض</button>
            </div>
      </div>
     
    </div>

  </div>
</div>
                           
                           @elseif($order->status == 1)
                            <span class="label label-lg font-weight-bold label-light-primary label-inline"  
         data-toggle="modal" data-target="#myModalos{{$order->id}}">حاله الطلب</span>
         
          <div id="myModalos{{$order->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">حاله الطلب</h4>
      </div>
      <div class="modal-body">
       <div class="row">
           <div class="col-6">
            <label>حاله الطلب</label>
            <select class="form-control"  style="display:block;" id="orderstatus_id{{$order->id}}" data-live-search="true">
               
                <option value="1" @if($order->status == 1) selected @endif>
                المطعم استلم الطلب</option>   
                 <option value="2" @if($order->status == 2) selected @endif>
                تم التحضير
                  </option>
                 <option value="3" @if($order->status == 3) selected @endif>
                تم تسليم الطلب
                </option>
               
            </select>
        </div>
        </div>
        <div class="row">
            <button class="btn btn-primary mx-auto mt-4" 
           onclick="changeorderstatus_id({{$order->id}})" >حفظ</button>
            </div>
      </div>
     
    </div>

  </div>
                          
	    </div>
                           <span class="label label-lg font-weight-bold label-light-success label-inline" 
         data-toggle="modal" data-target="#myModalstatus{{$order->id}}">حاله الدليفري </span>
         <!--delivery status --->
	    
          <div id="myModalstatus{{$order->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">حاله الدليفري</h4>
      </div>
      <div class="modal-body">
       <div class="row">
           <div class="col-6">
            <label>حاله الدليفري</label>
            <select class="form-control"  style="display:block;" id="delivery_status{{$order->id}}" data-live-search="true">
               
                <option value="1" @if($order->delivery_status == 1) selected @endif>
                  قبول السائق</option>   
                 <option value="2" @if($order->delivery_status == 2) selected @endif>
                   السائق وصل للمنقد 
                  </option>
                 <option value="3" @if($order->delivery_status == 3) selected @endif>
                السائق استلم الطلب
                </option>
                        <option value="4" @if($order->delivery_status == 4) selected @endif>
                السائق  وصل للعميل
                </option>
                 <option value="5" @if($order->delivery_status == 5) selected @endif>
              تم توصيل الطلب
                </option>
               
            </select>
        </div>
        </div>
        <div class="row">
            <button class="btn btn-primary mx-auto mt-4" 
           onclick="change_delivery_status({{$order->id}})" >حفظ</button>
            </div>
      </div>
     
    </div>

  </div>
                          
	    </div>
<span class="label label-lg font-weight-bold label-light-primary label-inline">
   قيد التحضير 
</span>

<div  id="myModalaa{{$order->id}}"  class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

   
      <div class="modal-header">
        <h4 class="modal-title">الطيارين </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
    
      
      <div class="modal-body">
       <div class="row">
           <div class="col-6">
               <select class="form-control" data-live-search="true" 
               title="اختر طيار" id="driver_id{{$order->id}}">
           @foreach($drivers as $driver)
           <option value="{{$driver->id}}">{{$driver->name}}</option>
           @endforeach
               </select>
</div>
</div>
<div class="mt-4 row">
<button type="button" class="btn btn-success mx-auto"  onclick="choosedriver({{$order->id}})" >ارسال</button>
</div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
                            
                            @elseif($order->status == 2)
                         <span class="label label-lg font-weight-bold label-light-success label-inline" 
         data-toggle="modal" data-target="#myModalstatus{{$order->id}}">حاله الدليفري </span>
         <!--delivery status --->
	    
          <div id="myModalstatus{{$order->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">حاله الدليفري</h4>
      </div>
      <div class="modal-body">
       <div class="row">
           <div class="col-6">
            <label>حاله الدليفري</label>
            <select class="form-control"  style="display:block;" id="delivery_status{{$order->id}}" data-live-search="true">
               
                <option value="1" @if($order->delivery_status == 1) selected @endif>
                  قبول السائق</option>   
                 <option value="2" @if($order->delivery_status == 2) selected @endif>
                   السائق وصل للمنقد 
                  </option>
                 <option value="3" @if($order->delivery_status == 3) selected @endif>
                السائق استلم الطلب
                </option>
                        <option value="4" @if($order->delivery_status == 4) selected @endif>
                السائق  وصل للعميل
                </option>
                 <option value="5" @if($order->delivery_status == 5) selected @endif>
              تم توصيل الطلب
                </option>
               
            </select>
        </div>
        </div>
        <div class="row">
            <button class="btn btn-primary mx-auto mt-4" 
           onclick="change_delivery_status({{$order->id}})" >حفظ</button>
            </div>
      </div>
     
    </div>

  </div>
                          
	    </div>
                            <span class="label label-lg font-weight-bold label-light-primary label-inline">  تم التحضير</span>
                            @elseif($order->status == 3)
                            <span class="label label-lg font-weight-bold label-light-success label-inline">تم تسليم الطلب</span>
                            @endif
               
                                
	    
	    
	    
	    <!-- end delivery status-->
	    
	     <!--<span class="btn btn-primary btn-sm" style="cursor:pointer;" data-toggle="modal" data-target="#myModalde{{$order->id}}">-->
	     <!--    سعر الدليفري</span>-->
                            <div id="myModalde{{$order->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">السعر</h4>
      </div>
      <div class="modal-body">
       <div class="row">
            <div class="col-6">
            <label>سعر الدليفري </label>
        <input type="number" min="0" class="form-control"  id="delivery_fee{{$order->id}}" value="{{$order->delivery_fee}}">
        </div>   
        </div>
        <div class="row">
            <button class="btn btn-primary mx-auto mt-4" 
           onclick="delivery_fee({{$order->id}})" >حفظ</button>
            </div>
      </div>
     
    </div>

  </div>
</div>
</div>
                </div>
                
                
                
                <!-- end: Invoice header-->
                
                <!-- begin: Invoice body-->
                <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                    
                    <div class="col-md-9">
                        
                        <div class="table-responsive">
                          {!! $dataTable->table([
                    
                     ],true) !!}
                        </div>
                    </div>
                </div>
                <!-- end: Invoice body-->
         
            </div>
        </div>
        <!-- end::Card-->
    
@endsection
@section('scripts')   
{{$dataTable->scripts()}} 
      <script>       
       function orderstatus(sel,status){
    let id = sel;
 console.log(sel);

 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
      
    $.ajax({
       type:"post",
       url: `../orderstatus`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       data:{
           "id":sel,
           "status":status,
           'driver_id':$(`#driver_id${id}`).val(),
           'refusedreason_id':$(`#refusedreason_id${id}`).val(),
       },
       success: function(result){
     if(result.type == "accept"){
         $(`#myModal${id}`).modal('hide');
         Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'تم قبول الطلب بنجاح',
  showConfirmButton: false,
  timer: 1500
})
location.reload();

     }else if(result.type == "refused"){
         $(`#myModale${id}`).modal('hide');
                  Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'تم رفض الطلب بنجاح',
  showConfirmButton: false,
  timer: 1500
})
location.reload();

     }
       // $("#new").load(`https://fodex.dawena.net/public/showorders/${id} #new`);
           }
 
  })
}   
  function editprice(sel){
    let id = sel;
 console.log(sel);
 var table = $('.dataTable').DataTable();
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
      
    $.ajax({
       type:"post",
       url: `../editprice`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       data:{
           "id":sel,
           "price":$(`#price${id}`).val(),
           'discount':$(`#discount${id}`).val()
       },
       success: function(result){
     if(result.status == true){
         $(`#myModalp${id}`).modal('hide');
           Swal.fire(
      'done!',
      'تم تغيير السعر بنحاح',
      'success'
         )
      //    $("#new").load(`https://fodex.dawena.net/public/showorders/${id} #new`);
      location.reload();

     }
       
           }
 
  })
}
function choosedriver(sel){
    let id = sel;
 console.log(sel);
 var table = $('.dataTable').DataTable();
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
      
    $.ajax({
       type:"post",
       url: `../choosedriver`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       data:{
           "id":sel,
           'driver_id':$(`#driver_id${id}`).val()
       },
       success: function(result){
         $(`#myModalaa${id}`).modal('hide');
      Swal.fire(
      'done!',
        result.message,
      'success'
         )
         location.reload();

    //   $("#new").load(`https://fodex.dawena.net/public/showorders/${id} #new`);
           }
 
  })
}function choosecompany(sel){
    let id = sel;
 console.log(sel);
 var table = $('.dataTable').DataTable();
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
      
    $.ajax({
       type:"post",
       url: `../choosecompany`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       data:{
           "id":sel,
           'company_id':$(`#companyw${id}`).val()
       },
       success: function(result){
         $(`#myModaleee${id}`).modal('hide');
      Swal.fire(
      'done!',
        result.message,
      'success'
         )
       //$("#new").load(`https://fodex.dawena.net/public/showorders/${id} #new`);
       location.reload();
           }
 
  })
}function changeorderstatus_id(sel){
    let id = sel;
 console.log(sel);
 var table = $('.dataTable').DataTable();
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
      
    $.ajax({
       type:"post",
       url: `../changeorderstatus_id`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       data:{
           "id":sel,
           'orderstatus_id':$(`#orderstatus_id${id}`).val()
       },
       success: function(result){
         $(`#myModalos${id}`).modal('hide');
        //  $(`#myModalew${id}`).modal('hide');
             Swal.fire(
      'done!',
       'تم تغييرالحاله بنجاح',
      'success'
         )
      // $("#new").load(`https://fodex.dawena.net/public/showorders/${id} #new`);
       location.reload();
           }
 
  })
}
function change_delivery_status(sel){
    let id = sel;
 console.log(sel);
 var table = $('.dataTable').DataTable();
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
      
    $.ajax({
       type:"post",
       url: `../change_delivery_status`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       data:{
           "id":sel,
           'orderstatus_id':$(`#delivery_status${id}`).val()
       },
       success: function(result){
         $(`#myModalstatus${id}`).modal('hide');
        //  $(`#myModalew${id}`).modal('hide');
             Swal.fire(
      'done!',
       'تم تغييرالحاله بنجاح',
      'success'
         )
         location.reload();
      // $("#new").load(`https://fodex.dawena.net/public/showorders/${id} #new`);
           }
 
  })
}
//
function delivery_fee(sel){
    let id = sel;
 console.log(sel);
 var table = $('.dataTable').DataTable();
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
      
    $.ajax({
       type:"post",
       url: `../delivery_fee`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       data:{
           "order_id":sel,
           'delivery_fee':$(`#delivery_fee${id}`).val()
       },
       success: function(result){
         $(`#myModalde${id}`).modal('hide');
        //  $(`#myModalew${id}`).modal('hide');
             Swal.fire(
      'done!',
        'تم تغيير سعر الدليفري بنجاح',
      'success'
         )
         location.reload();
     //  $("#new").load(`https://fodex.dawena.net/public/showorders/${id} #new`);
           }
 
  })
}
        </script>
@endsection