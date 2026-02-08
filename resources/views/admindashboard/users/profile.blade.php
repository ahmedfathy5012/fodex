@extends('layouts.adminindex')
@section('content')
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
    			
    			<h3 class="card-label">{{$user->name}}</h3>
    			
    		</div>
	    </div>
	
	    
        <div class="card-body">
               <div class="page-content page-container mb-4" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center  mb-4">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div>
                            @if($user->image)
                            <img 
                      src="{{asset($user->image)}}" 
                      class="img-lgmb-4" style="    height: 111px;
    width: 111px;
    max-height: 100%;
    max-width: 100%;
    border-radius: 50%;"
                       alt="profile image">
                            @else
                             <img 
                      src="{{asset('user.png')}}"         class="img-lgmb-4" style="height: 111px;
    width: 111px;
    max-height: 100%;
    max-width: 100%;
    border-radius: 50%;"alt="profile image">
                          @endif
                             <h4 class="mt-4">{{$user->name}}</h4>
                            
                            <p class="text-muted mt-3 ">{{$user->phone}} </p>
                            <div class="text-center mt-3"> 
                            @if($user->block == 0)
                                <span class="bg-success p-1 px-4 rounded text-white">مفعل</span>
                                @elseif($user->block == 1)
                                <span class="bg-danger p-1 px-4 rounded text-white">غير مفعل</span>
                                @endif
                        </div>
                        <div class="mt-4 pt-3">
                            <div class="row">
                                  <div class="col-4"></div>
                                <div class="col-4">
                                    <h6>{{count($user->done_orders)}}</h6>
                                    <p>عدد الطلبات</p>
                                </div>
                                 <div class="col-4"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    {!! $dataTable->table([
                    
                     ],true) !!}
            <!--end: Datatable-->
            <!--end: Datatable-->
        </div>
    <!--end::Card-->
   
  


@endsection
@section('scripts')   
{{$dataTable->scripts()}} 
@endsection
