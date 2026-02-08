<!--begin::Page-->
<div class="d-flex flex-row flex-column-fluid page">
	<!--begin::Aside-->
	<!--begin::Aside-->
	<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
		<!--begin::Brand-->
		<div class="brand flex-column-auto" id="kt_brand">
			<!--begin::Logo-->
			<a href="" class="brand-logo">
               
                <img alt="Logo" src=" https://upload.wikimedia.org/wikipedia/commons/3/3a/Order_station.png" style="width: 143px;
    height: 58px;"/>
				<!-- <img alt="Logo" src="{{asset('fodexlogo.jpg')}}" style="width: 143px;
    height: 58px;"/> -->
			</a>
			<!--end::Logo-->
			<!--begin::Toggle-->
			<button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
				<span class="svg-icon svg-icon svg-icon-xl">
					<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
						<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
							<polygon points="0 0 24 0 24 24 0 24" />
							<path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
							<path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
						</g>
					</svg>
					<!--end::Svg Icon-->
				</span>
			</button>
			<!--end::Toolbar-->
		</div>
		<!--end::Brand-->
		<!--begin::Aside Menu-->
		<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
			<!--begin::Menu Container-->
			<div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
				<!--begin::Menu Nav-->
				<ul class="menu-nav">
						 	<li class="menu-section">
									<h4 class="menu-text"> الطلبات</h4>
									<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
								</li>
								
				<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
									    
										<span class="svg-icon menu-icon"><i class="fas fa-archive"></i></span>

										
								<span class="menu-text">الطلبات</span>
										<i class="menu-arrow"></i>
									</a>
						<div class="menu-submenu">
							<i class="menu-arrow"></i>
							<ul class="menu-subnav">
								<li class="menu-item menu-item-parent" aria-haspopup="true">
									<span class="menu-link">
										<span class="menu-text">Applications</span>
									</span>
								</li>
								
								
							<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="{{route('your_orders.index')}}" class="menu-link">
										<span class="menu-text">الطلبات</span>
									</a>
								</li>
							
							
							
						
							</ul>
						</div>
					</li>
		
				
														<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
									    
										<span class="svg-icon menu-icon">
			<i class="fas fa-biking"></i>

										    </span>

										
								<span class="menu-text">كباتن التوصيل</span>
										<i class="menu-arrow"></i>
									</a>
						<div class="menu-submenu">
							<i class="menu-arrow"></i>
							<ul class="menu-subnav">
								<li class="menu-item menu-item-parent" aria-haspopup="true">
									<span class="menu-link">
										<span class="menu-text">Applications</span>
									</span>
								</li>
							
								
		<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="{{route('company_captions.index')}}" class="menu-link">
										<span class="menu-text">السائقين</span>
									</a>
								</li>
							</ul>
						</div>
					</li>
	<li class="menu-item" aria-haspopup="true">
									<a href="{{route('adminlogout')}}" class="menu-link">
										<span class="svg-icon menu-icon"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-12-28-020759/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Sign-out.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M14.0069431,7.00607258 C13.4546584,7.00607258 13.0069431,6.55855153 13.0069431,6.00650634 C13.0069431,5.45446114 13.4546584,5.00694009 14.0069431,5.00694009 L15.0069431,5.00694009 C17.2160821,5.00694009 19.0069431,6.7970243 19.0069431,9.00520507 L19.0069431,15.001735 C19.0069431,17.2099158 17.2160821,19 15.0069431,19 L3.00694311,19 C0.797804106,19 -0.993056895,17.2099158 -0.993056895,15.001735 L-0.993056895,8.99826498 C-0.993056895,6.7900842 0.797804106,5 3.00694311,5 L4.00694793,5 C4.55923268,5 5.00694793,5.44752105 5.00694793,5.99956624 C5.00694793,6.55161144 4.55923268,6.99913249 4.00694793,6.99913249 L3.00694311,6.99913249 C1.90237361,6.99913249 1.00694311,7.89417459 1.00694311,8.99826498 L1.00694311,15.001735 C1.00694311,16.1058254 1.90237361,17.0008675 3.00694311,17.0008675 L15.0069431,17.0008675 C16.1115126,17.0008675 17.0069431,16.1058254 17.0069431,15.001735 L17.0069431,9.00520507 C17.0069431,7.90111468 16.1115126,7.00607258 15.0069431,7.00607258 L14.0069431,7.00607258 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.006943, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-9.006943, -12.000000) "/>
                                                <rect fill="#000000" opacity="0.3" transform="translate(14.000000, 12.000000) rotate(-270.000000) translate(-14.000000, -12.000000) " x="13" y="6" width="2" height="12" rx="1"/>
                                                <path d="M21.7928932,9.79289322 C22.1834175,9.40236893 22.8165825,9.40236893 23.2071068,9.79289322 C23.5976311,10.1834175 23.5976311,10.8165825 23.2071068,11.2071068 L20.2071068,14.2071068 C19.8165825,14.5976311 19.1834175,14.5976311 18.7928932,14.2071068 L15.7928932,11.2071068 C15.4023689,10.8165825 15.4023689,10.1834175 15.7928932,9.79289322 C16.1834175,9.40236893 16.8165825,9.40236893 17.2071068,9.79289322 L19.5,12.0857864 L21.7928932,9.79289322 Z" fill="#000000" fill-rule="nonzero" transform="translate(19.500000, 12.000000) rotate(-90.000000) translate(-19.500000, -12.000000) "/>
                                            </g>
                                        </svg><!--end::Svg Icon--></span>
										<span class="menu-text">تسجيل الخروج</span>
									</a>
									</li>
						
				</ul>
				<!--end::Menu Nav-->
			</div>
			<!--end::Menu Container-->
		</div>
		<!--end::Aside Menu-->
	</div>
	<!--end::Aside-->
	<!--begin::Wrapper-->
	<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

		<!--begin::Header-->
		<div id="kt_header" class="header header-fixed">
			<!--begin::Container-->
			<div class="container-fluid d-flex align-items-stretch justify-content-between">
				<!--begin::Header Menu Wrapper-->
				<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
					<!--begin::Header Menu-->
					<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
						<!--begin::Header Nav-->
						<ul class="menu-nav">
						</ul>
						<!--end::Header Nav-->
					</div>
					<!--end::Header Menu-->
				</div>
				<!--end::Header Menu Wrapper-->
				<!--begin::Topbar-->
				<div class="topbar">
					<!--begin::Languages-->
					<div class="dropdown">
						<!--begin::Toggle-->
						<!--<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">-->
						<!--	<div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">-->
						<!--	@if(app()->getLocale() == "en")-->
						<!--		<img class="h-20px w-20px rounded-sm" src="{{asset('assets/media/svg/flags/226-united-states.svg')}}" alt="" />-->
						<!--		@else-->
						<!--		<img class="h-20px w-20px rounded-sm" src="{{asset('assets/media/svg/flags/133-saudi-arabia.svg')}}" alt="" />-->
						<!--		@endif-->
						<!--	</div>-->
						<!--</div>-->
						<!--end::Toggle-->
						<!--begin::Dropdown-->
						<div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
							<!--begin::Nav-->
						
							<!--end::Nav--> 
						</div> 
						<!--end::Dropdown-->
					</div>
					<!--end::Languages-->
					<!--begin::User-->
					<div class="dropdown">
						<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
							<div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
								<span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">
								مرحبا  
								{{auth()->user()->name}}
								
								</span>
								<span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">
								</span>
								<span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
									<img alt="Logo" src="{{asset('fodexlogo.jpg')}}" /></span>
								
							</div>
						</div>
						<div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
							<ul class="navi navi-hover py-4">
								<!--begin::Item-->
								<li class="navi-item">
									<a href="{{route('companylogout')}}" class="navi-link">
										<span class="navi-text">{{__('messages.logout')}}</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<!--end::User-->
				</div>
				<!--end::Topbar-->
			</div>
			<!--end::Container-->
		</div>
		<!--end::Header-->

		<!--begin::Content-->
		<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
			@yield("content")
		</div>
		<!--end::Content--> 

	
