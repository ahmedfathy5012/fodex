<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 10 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html direction="rtl" dir="rtl" style="direction: rtl">
<!--begin::Head-->

<head>
    <base href="">
    <meta charset="utf-8" />
    <!-- <link rel="icon" href="{{ asset('fodexlogo.jpg') }}" type="image">
 <title>fodex</title> -->
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/3/3a/Order_station.png" type="image">
    <title>Order Station</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description"
        content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <!--begin::Fonts-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com"> -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@800&display=swap" rel="stylesheet"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap"
        rel="stylesheet">
    <!--end::Fonts-->


    <!--begin::Page Vendors Styles(used by this page)-->
    <!-- 	<scriptc src="https://cdn.tiny.cloud/1/drwqh7e3jxearaep4ekf9iltoq9m407nkdpz0qr2a9m4ighn/tinymce/5/tinymce.min.js"
        referrerpolicy="origin">
        </script> -->
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.rtl.css') }}" rel="stylesheet"
        type="text/css" />
    <!--end::Page Vendors Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    {{-- @if (app()->getlocale() == 'en' || app()->getlocale() == 'tr')
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/newstyle.ltr.css') }}" rel="stylesheet" type="text/css" />
	@else
    @endif --}}
    <link href="{{ asset('assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/newstyle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="{{ asset('assets/css/themes/layout/header/base/light.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/header/menu/light.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/brand/light.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/aside/light.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />

    <!--end::Layout Themes-->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>

    <script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>

    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">


    <!-- <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
 -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <!--<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>-->
    <!--<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>-->
    <script src="{{ asset('btn.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">

    <script src="{{ asset('/vendor/datatables/buttons.server-side.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.min.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    {{-- custom style --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom/adminindex.css') }}">

    <!--  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
    <!--<link rel="stylesheet" href="/resources/demos/style.css">-->
    <!--<link href="https://trentrichardson.com/examples/timepicker/jquery-ui-timepicker-addon.css">-->
    <!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
    <!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js">
    </script>-->
    <!--<script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/i18n/jquery-ui-timepicker-addon-i18n.min.js">
    </script>-->
</head>
<!--end::Head-->
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body"
    class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed 
	aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!--begin::Main-->
    <!--begin::Header Mobile-->
    <div id="preloader"><lottie-player src="{{ asset('67226-food-app-interaction.json') }}" background="transparent"
            speed="1" style="width: 400px; height: 400px;" loop autoplay></lottie-player></div>
    <div id="preloader1"><lottie-player src="{{ asset('72168-loading-food.json') }}" background="transparent"
            speed="1" style="width: 400px; height: 400px;" loop autoplay></lottie-player></div>
    <div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
        <!--begin::Logo-->
        <!--end::Logo-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Aside Mobile Toggle-->
            <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
                <span></span>
            </button>
            <!--end::Aside Mobile Toggle-->
            <!--begin::Header Menu Mobile Toggle-->
            <!--<button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">-->
            <!--	<span></span>-->
            <!--</button>-->
            <!--end::Header Menu Mobile Toggle-->
            <!--begin::Topbar Mobile Toggle-->
            <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
                <span class="svg-icon svg-icon-xl">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <path
                                d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                            <path
                                d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                fill="#000000" fill-rule="nonzero" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
            </button>
            <!--end::Topbar Mobile Toggle-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header Mobile-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">
            <!--begin::Aside-->
            <div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
                <!--begin::Brand-->


                <div class="brand flex-column-auto" id="kt_brand" kt-hidden-height="65"
                    style="height: fit-content">
                    <!--begin::Logo-->
                    <a href="{{ route('dashboard') }}" class="brand-logo">
                        <!-- <img alt="Logo" src="{{ asset('fodexlogo2.jpg') }}" style="width:80%; margin: 0 auto;"> -->
                        <img alt="Logo"
                            src="https://upload.wikimedia.org/wikipedia/commons/3/3a/Order_station.png"
                            style="width:80%; margin: 0 auto;">
                    </a>
                    <!--end::Logo-->
                    <!--begin::Toggle-->
                    <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
                        <span class="svg-icon svg-icon svg-icon-xl">
                            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Navigation/Angle-double-left.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                    <path
                                        d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                        fill="#000000" fill-rule="nonzero"
                                        transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)">
                                    </path>
                                    <path
                                        d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                                        fill="#000000" fill-rule="nonzero" opacity="0.3"
                                        transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)">
                                    </path>
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



                    <div id="kt_header" class="header header-fixed">
                        <!--begin::Container-->
                        <div class="container-fluid d-flex align-items-stretch justify-content-between">
                            <!--begin::Header Menu Wrapper-->
                            <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">

                            </div>
                            <!--end::Header Menu Wrapper-->
                            <!--begin::Topbar-->
                            <div class="topbar">
                                <!--begin::Languages-->
                                <div class="dropdown">
                                    <!--begin::Toggle-->
                                    <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                                        <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                                            <!--<img class="h-20px w-20px rounded-sm" src="{{ asset('/public/assets') }}/media/svg/flags/158-egypt.svg" alt="">-->
                                        </div>
                                    </div>
                                    <!--end::Toggle-->
                                    <!--begin::Dropdown-->
                                    <div
                                        class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                                        <!--begin::Nav-->
                                        <ul class="navi navi-hover py-4">

                                        </ul>
                                        <!--end::Nav-->
                                    </div>
                                    <!--end::Dropdown-->
                                </div>
                                <!--end::Languages-->

                                <!--begin::User-->
                                <div class="topbar-item">
                                    <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2"
                                        id="kt_quick_user_toggle">
                                        <span
                                            class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">مرحبا</span>
                                        <lottie-player src="{{ asset('6542-handup.json') }}" background="transparent"
                                            speed="1" style="width: 70px; height:70px;" loop
                                            autoplay></lottie-player>
                                        <span
                                            class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ auth()->user()->name }}</span>
                                        <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                                            <img src="{{ asset('uploads/' . auth()->user()->image) }}">
                                            <!--<span class="symbol-label font-size-h5 font-weight-bold">Qeno</span>-->
                                        </span>
                                    </div>
                                </div>
                                <!--end::User-->

                            </div>
                            <!--end::Topbar-->
                        </div>
                        <!--end::Container-->
                    </div>



                    <!--begin::Menu Container-->
                   @include('layouts.__adminsidebar')
                    <!--end::Menu Container-->

                </div>
                <!--end::Aside Menu-->
            </div>
            <!--end::Aside-->
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

                @yield('content')
                <!--begin::Footer-->
                <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
                    <!--begin::Container-->
                    <div
                        class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <!--begin::Copyright-->
                        <div class="text-dark order-2 order-md-1">

                            <!--<div class="item text-center">-->
                            <!--                            <a href="http://crazyideaco.com/" target="_blank">-->
                            <!--                                <h6 class="text-dark-75 text-hover-primary">Made with <img class="my-heart" src="http://qethara.crazyideaco.com/icon/heart.svg" alt="icon heart"> by Crazy Idea</h6>-->
                            <!--                            </a>-->
                            <!--                            <span class="text-muted font-weight-bold">Think Out Of The Box</span>-->
                            <!--                        </div>-->
                        </div>
                        <!--end::Copyright-->

                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>

    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #eef0f8;
        }

        body.loaded {
            overflow-y: auto;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 100000000;
        }

        .overlay .overlayDoor:before,
        .overlay .overlayDoor:after {
            content: "";
            position: absolute;
            width: 50%;
            height: 100%;
            background: #628395;
            opacity: .6;
            transition: 0.5s cubic-bezier(0.77, 0, 0.18, 1);
            transition-delay: 0.8s;
        }

        .overlay .overlayDoor:before {
            left: 0;
        }

        .overlay .overlayDoor:after {
            right: 0;
        }

        .overlay.loaded .overlayDoor:before {
            left: -50%;
        }

        .overlay.loaded .overlayDoor:after {
            right: -50%;
        }

        .overlay.loaded .overlayContent {
            opacity: 0;
            margin-top: -15px;
            z-index: -13;
        }

        .overlay .overlayContent {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            transition: 0.5s cubic-bezier(0.77, 0, 0.18, 1);
        }

        .overlay .overlayContent .skip {
            display: block;
            width: 130px;
            text-align: center;
            margin: 50px auto 0;
            cursor: pointer;
            color: #fff;
            font-family: "Nunito";
            font-weight: 700;
            padding: 12px 0;
            border: 2px solid #fff;
            border-radius: 3px;
            transition: 0.2s ease;
        }

        .overlay .overlayContent .skip:hover {
            background: #ddd;
            color: #444;
            border-color: #ddd;
        }

        @-webkit-keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @-webkit-keyframes spinInner {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(-720deg);
            }
        }

        @keyframes spinInner {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(-720deg);
            }
        }
    </style>
    <!--end::Main-->
    <!-- begin::User Panel-->
    <!--<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">-->
    <!--begin::Header-->
    <!--	<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">-->
    <!--		<h3 class="font-weight-bold m-0">الملف الشخصي-->
    <!--			<small class="text-muted font-size-sm ml-2">12 رسالة</small></h3>-->
    <!--		<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">-->
    <!--			<i class="ki ki-close icon-xs text-muted"></i>-->
    <!--		</a>-->
    <!--	</div>-->
    <!--end::Header-->
    <!--begin::Content-->
    <!--	<div class="offcanvas-content pr-5 mr-n5">-->
    <!--begin::Header-->
    <!--		<div class="d-flex align-items-center mt-5">-->
    <!--			<div class="symbol symbol-100 mr-5">-->
    <!--				<div class="symbol-label" style="background-image:url(https://wordpresstest.crazyideaco.com/wp-content/uploads/2020/12/qeno.jpg)"></div>-->
    <!--				<i class="symbol-badge bg-success"></i>-->
    <!--			</div>-->
    <!--			<div class="d-flex flex-column">-->
    <!--				<a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">محمود أحمد</a>-->
    <!--				<div class="text-muted mt-1">Full Stack Web Developer</div>-->
    <!--				<div class="navi mt-2">-->
    <!--					<a href="#" class="navi-item">-->
    <!--						<span class="navi-link p-0 pb-2">-->
    <!--							<span class="navi-icon mr-1">-->
    <!--								<span class="svg-icon svg-icon-lg svg-icon-primary">-->
    <!--begin::Svg Icon | path:../assets/media/svg/icons/Communication/Mail-notification.svg-->
    <!--									<svg xmlns="http://www.w3.org/2000/svg"-->
    <!--										xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"-->
    <!--										viewBox="0 0 24 24" version="1.1">-->
    <!--										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">-->
    <!--											<rect x="0" y="0" width="24" height="24" />-->
    <!--											<path-->
    <!--												d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z"-->
    <!--												fill="#000000" />-->
    <!--											<circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />-->
    <!--										</g>-->
    <!--									</svg>-->
    <!--end::Svg Icon-->
    <!--								</span>-->
    <!--							</span>-->
    <!--							<span class="navi-text text-muted text-hover-primary">qeno.work@gmail.com</span>-->
    <!--						</span>-->
    <!--					</a>-->
    <!--					<a href="#" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">تسجيل الخروج</a>-->
    <!--				</div>-->
    <!--			</div>-->
    <!--		</div>-->
    <!--end::Header-->
    <!--begin::Separator-->
    <!--		<div class="separator separator-dashed mt-8 mb-5"></div>-->
    <!--end::Separator-->
    <!--begin::Nav-->
    <!--		<div class="navi navi-spacer-x-0 p-0">-->
    <!--begin::Item-->
    <!--			<a href="../custom/apps/user/profile-1/personal-information.html" class="navi-item">-->
    <!--				<div class="navi-link">-->
    <!--					<div class="symbol symbol-40 bg-light mr-3">-->
    <!--						<div class="symbol-label">-->
    <!--							<span class="svg-icon svg-icon-md svg-icon-success">-->
    <!--begin::Svg Icon | path:../assets/media/svg/icons/General/Notification2.svg-->
    <!--								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"-->
    <!--									width="24px" height="24px" viewBox="0 0 24 24" version="1.1">-->
    <!--									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">-->
    <!--										<rect x="0" y="0" width="24" height="24" />-->
    <!--										<path-->
    <!--											d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z"-->
    <!--											fill="#000000" />-->
    <!--										<circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5" />-->
    <!--									</g>-->
    <!--								</svg>-->
    <!--end::Svg Icon-->
    <!--							</span>-->
    <!--						</div>-->
    <!--					</div>-->
    <!--					<div class="navi-text">-->
    <!--						<div class="font-weight-bold">ملفي الشخصي</div>-->
    <!--						<div class="text-muted">إعدادات الملف الشخصي والمذيد-->
    <!--							<span class="label label-light-danger label-inline font-weight-bold">تحديث</span></div>-->
    <!--					</div>-->
    <!--				</div>-->
    <!--			</a>-->
    <!--end:Item-->
    <!--begin::Item-->
    <!--			<a href="../custom/apps/user/profile-3.html" class="navi-item">-->
    <!--				<div class="navi-link">-->
    <!--					<div class="symbol symbol-40 bg-light mr-3">-->
    <!--						<div class="symbol-label">-->
    <!--							<span class="svg-icon svg-icon-md svg-icon-warning">-->
    <!--begin::Svg Icon | path:../assets/media/svg/icons/Shopping/Chart-bar1.svg-->
    <!--								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"-->
    <!--									width="24px" height="24px" viewBox="0 0 24 24" version="1.1">-->
    <!--									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">-->
    <!--										<rect x="0" y="0" width="24" height="24" />-->
    <!--										<rect fill="#000000" opacity="0.3" x="12" y="4" width="3" height="13"-->
    <!--											rx="1.5" />-->
    <!--										<rect fill="#000000" opacity="0.3" x="7" y="9" width="3" height="8"-->
    <!--											rx="1.5" />-->
    <!--										<path-->
    <!--											d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z"-->
    <!--											fill="#000000" fill-rule="nonzero" />-->
    <!--										<rect fill="#000000" opacity="0.3" x="17" y="11" width="3" height="6"-->
    <!--											rx="1.5" />-->
    <!--									</g>-->
    <!--								</svg>-->
    <!--end::Svg Icon-->
    <!--							</span>-->
    <!--						</div>-->
    <!--					</div>-->
    <!--					<div class="navi-text">-->
    <!--						<div class="font-weight-bold">My Messages</div>-->
    <!--						<div class="text-muted">Inbox and tasks</div>-->
    <!--					</div>-->
    <!--				</div>-->
    <!--			</a>-->
    <!--end:Item-->
    <!--begin::Item-->
    <!--			<a href="../custom/apps/user/profile-2.html" class="navi-item">-->
    <!--				<div class="navi-link">-->
    <!--					<div class="symbol symbol-40 bg-light mr-3">-->
    <!--						<div class="symbol-label">-->
    <!--							<span class="svg-icon svg-icon-md svg-icon-danger">-->
    <!--begin::Svg Icon | path:../assets/media/svg/icons/Files/Selected-file.svg-->
    <!--								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"-->
    <!--									width="24px" height="24px" viewBox="0 0 24 24" version="1.1">-->
    <!--									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">-->
    <!--										<polygon points="0 0 24 0 24 24 0 24" />-->
    <!--										<path-->
    <!--											d="M4.85714286,1 L11.7364114,1 C12.0910962,1 12.4343066,1.12568431 12.7051108,1.35473959 L17.4686994,5.3839416 C17.8056532,5.66894833 18,6.08787823 18,6.52920201 L18,19.0833333 C18,20.8738751 17.9795521,21 16.1428571,21 L4.85714286,21 C3.02044787,21 3,20.8738751 3,19.0833333 L3,2.91666667 C3,1.12612489 3.02044787,1 4.85714286,1 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z"-->
    <!--											fill="#000000" fill-rule="nonzero" opacity="0.3" />-->
    <!--										<path-->
    <!--											d="M6.85714286,3 L14.7364114,3 C15.0910962,3 15.4343066,3.12568431 15.7051108,3.35473959 L20.4686994,7.3839416 C20.8056532,7.66894833 21,8.08787823 21,8.52920201 L21,21.0833333 C21,22.8738751 20.9795521,23 19.1428571,23 L6.85714286,23 C5.02044787,23 5,22.8738751 5,21.0833333 L5,4.91666667 C5,3.12612489 5.02044787,3 6.85714286,3 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z"-->
    <!--											fill="#000000" fill-rule="nonzero" />-->
    <!--									</g>-->
    <!--								</svg>-->
    <!--end::Svg Icon-->
    <!--							</span>-->
    <!--						</div>-->
    <!--					</div>-->
    <!--					<div class="navi-text">-->
    <!--						<div class="font-weight-bold">My Activities</div>-->
    <!--						<div class="text-muted">Logs and notifications</div>-->
    <!--					</div>-->
    <!--				</div>-->
    <!--			</a>-->
    <!--end:Item-->
    <!--begin::Item-->
    <!--			<a href="../custom/apps/userprofile-1/overview.html" class="navi-item">-->
    <!--				<div class="navi-link">-->
    <!--					<div class="symbol symbol-40 bg-light mr-3">-->
    <!--						<div class="symbol-label">-->
    <!--							<span class="svg-icon svg-icon-md svg-icon-primary">-->
    <!--begin::Svg Icon | path:../assets/media/svg/icons/Communication/Mail-opened.svg-->
    <!--								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"-->
    <!--									width="24px" height="24px" viewBox="0 0 24 24" version="1.1">-->
    <!--									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">-->
    <!--										<rect x="0" y="0" width="24" height="24" />-->
    <!--										<path-->
    <!--											d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M7.5,5 C7.22385763,5 7,5.22385763 7,5.5 C7,5.77614237 7.22385763,6 7.5,6 L13.5,6 C13.7761424,6 14,5.77614237 14,5.5 C14,5.22385763 13.7761424,5 13.5,5 L7.5,5 Z M7.5,7 C7.22385763,7 7,7.22385763 7,7.5 C7,7.77614237 7.22385763,8 7.5,8 L10.5,8 C10.7761424,8 11,7.77614237 11,7.5 C11,7.22385763 10.7761424,7 10.5,7 L7.5,7 Z"-->
    <!--											fill="#000000" opacity="0.3" />-->
    <!--										<path-->
    <!--											d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z"-->
    <!--											fill="#000000" />-->
    <!--									</g>-->
    <!--								</svg>-->
    <!--end::Svg Icon-->
    <!--							</span>-->
    <!--						</div>-->
    <!--					</div>-->
    <!--					<div class="navi-text">-->
    <!--						<div class="font-weight-bold">My Tasks</div>-->
    <!--						<div class="text-muted">latest tasks and projects</div>-->
    <!--					</div>-->
    <!--				</div>-->
    <!--			</a>-->
    <!--end:Item-->
    <!--		</div>-->
    <!--end::Nav-->
    <!--begin::Separator-->
    <!--		<div class="separator separator-dashed my-7"></div>-->
    <!--end::Separator-->
    <!--begin::Notifications-->
    <!--		<div>-->
    <!--begin:Heading-->
    <!--			<h5 class="mb-5">Recent Notifications</h5>-->
    <!--end:Heading-->
    <!--begin::Item-->
    <!--			<div class="d-flex align-items-center bg-light-warning rounded p-5 gutter-b">-->
    <!--				<span class="svg-icon svg-icon-warning mr-5">-->
    <!--					<span class="svg-icon svg-icon-lg">-->
    <!--begin::Svg Icon | path:../assets/media/svg/icons/Home/Library.svg-->
    <!--						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"-->
    <!--							width="24px" height="24px" viewBox="0 0 24 24" version="1.1">-->
    <!--							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">-->
    <!--								<rect x="0" y="0" width="24" height="24" />-->
    <!--								<path-->
    <!--									d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z"-->
    <!--									fill="#000000" />-->
    <!--								<rect fill="#000000" opacity="0.3"-->
    <!--									transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)"-->
    <!--									x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />-->
    <!--							</g>-->
    <!--						</svg>-->
    <!--end::Svg Icon-->
    <!--					</span>-->
    <!--				</span>-->
    <!--				<div class="d-flex flex-column flex-grow-1 mr-2">-->
    <!--					<a href="#" class="font-weight-normal text-dark-75 text-hover-primary font-size-lg mb-1">Another-->
    <!--						purpose persuade</a>-->
    <!--					<span class="text-muted font-size-sm">Due in 2 Days</span>-->
    <!--				</div>-->
    <!--				<span class="font-weight-bolder text-warning py-1 font-size-lg">+28%</span>-->
    <!--			</div>-->
    <!--end::Item-->
    <!--begin::Item-->
    <!--			<div class="d-flex align-items-center bg-light-success rounded p-5 gutter-b">-->
    <!--				<span class="svg-icon svg-icon-success mr-5">-->
    <!--					<span class="svg-icon svg-icon-lg">-->
    <!--begin::Svg Icon | path:../assets/media/svg/icons/Communication/Write.svg-->
    <!--						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"-->
    <!--							width="24px" height="24px" viewBox="0 0 24 24" version="1.1">-->
    <!--							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">-->
    <!--								<rect x="0" y="0" width="24" height="24" />-->
    <!--								<path-->
    <!--									d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"-->
    <!--									fill="#000000" fill-rule="nonzero"-->
    <!--									transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />-->
    <!--								<path-->
    <!--									d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"-->
    <!--									fill="#000000" fill-rule="nonzero" opacity="0.3" />-->
    <!--							</g>-->
    <!--						</svg>-->
    <!--end::Svg Icon-->
    <!--					</span>-->
    <!--				</span>-->
    <!--				<div class="d-flex flex-column flex-grow-1 mr-2">-->
    <!--					<a href="#" class="font-weight-normal text-dark-75 text-hover-primary font-size-lg mb-1">Would-->
    <!--						be to people</a>-->
    <!--					<span class="text-muted font-size-sm">Due in 2 Days</span>-->
    <!--				</div>-->
    <!--				<span class="font-weight-bolder text-success py-1 font-size-lg">+50%</span>-->
    <!--			</div>-->
    <!--end::Item-->
    <!--begin::Item-->
    <!--			<div class="d-flex align-items-center bg-light-danger rounded p-5 gutter-b">-->
    <!--				<span class="svg-icon svg-icon-danger mr-5">-->
    <!--					<span class="svg-icon svg-icon-lg">-->
    <!--begin::Svg Icon | path:../assets/media/svg/icons/Communication/Group-chat.svg-->
    <!--						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"-->
    <!--							width="24px" height="24px" viewBox="0 0 24 24" version="1.1">-->
    <!--							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">-->
    <!--								<rect x="0" y="0" width="24" height="24" />-->
    <!--								<path-->
    <!--									d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z"-->
    <!--									fill="#000000" />-->
    <!--								<path-->
    <!--									d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z"-->
    <!--									fill="#000000" opacity="0.3" />-->
    <!--							</g>-->
    <!--						</svg>-->
    <!--end::Svg Icon-->
    <!--					</span>-->
    <!--				</span>-->
    <!--				<div class="d-flex flex-column flex-grow-1 mr-2">-->
    <!--					<a href="#" class="font-weight-normel text-dark-75 text-hover-primary font-size-lg mb-1">Purpose-->
    <!--						would be to persuade</a>-->
    <!--					<span class="text-muted font-size-sm">Due in 2 Days</span>-->
    <!--				</div>-->
    <!--				<span class="font-weight-bolder text-danger py-1 font-size-lg">-27%</span>-->
    <!--			</div>-->
    <!--end::Item-->
    <!--begin::Item-->
    <!--			<div class="d-flex align-items-center bg-light-info rounded p-5">-->
    <!--				<span class="svg-icon svg-icon-info mr-5">-->
    <!--					<span class="svg-icon svg-icon-lg">-->
    <!--begin::Svg Icon | path:../assets/media/svg/icons/General/Attachment2.svg-->
    <!--						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"-->
    <!--							width="24px" height="24px" viewBox="0 0 24 24" version="1.1">-->
    <!--							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">-->
    <!--								<rect x="0" y="0" width="24" height="24" />-->
    <!--								<path-->
    <!--									d="M11.7573593,15.2426407 L8.75735931,15.2426407 C8.20507456,15.2426407 7.75735931,15.6903559 7.75735931,16.2426407 C7.75735931,16.7949254 8.20507456,17.2426407 8.75735931,17.2426407 L11.7573593,17.2426407 L11.7573593,18.2426407 C11.7573593,19.3472102 10.8619288,20.2426407 9.75735931,20.2426407 L5.75735931,20.2426407 C4.65278981,20.2426407 3.75735931,19.3472102 3.75735931,18.2426407 L3.75735931,14.2426407 C3.75735931,13.1380712 4.65278981,12.2426407 5.75735931,12.2426407 L9.75735931,12.2426407 C10.8619288,12.2426407 11.7573593,13.1380712 11.7573593,14.2426407 L11.7573593,15.2426407 Z"-->
    <!--									fill="#000000" opacity="0.3"-->
    <!--									transform="translate(7.757359, 16.242641) rotate(-45.000000) translate(-7.757359, -16.242641)" />-->
    <!--								<path-->
    <!--									d="M12.2426407,8.75735931 L15.2426407,8.75735931 C15.7949254,8.75735931 16.2426407,8.30964406 16.2426407,7.75735931 C16.2426407,7.20507456 15.7949254,6.75735931 15.2426407,6.75735931 L12.2426407,6.75735931 L12.2426407,5.75735931 C12.2426407,4.65278981 13.1380712,3.75735931 14.2426407,3.75735931 L18.2426407,3.75735931 C19.3472102,3.75735931 20.2426407,4.65278981 20.2426407,5.75735931 L20.2426407,9.75735931 C20.2426407,10.8619288 19.3472102,11.7573593 18.2426407,11.7573593 L14.2426407,11.7573593 C13.1380712,11.7573593 12.2426407,10.8619288 12.2426407,9.75735931 L12.2426407,8.75735931 Z"-->
    <!--									fill="#000000"-->
    <!--									transform="translate(16.242641, 7.757359) rotate(-45.000000) translate(-16.242641, -7.757359)" />-->
    <!--								<path-->
    <!--									d="M5.89339828,3.42893219 C6.44568303,3.42893219 6.89339828,3.87664744 6.89339828,4.42893219 L6.89339828,6.42893219 C6.89339828,6.98121694 6.44568303,7.42893219 5.89339828,7.42893219 C5.34111353,7.42893219 4.89339828,6.98121694 4.89339828,6.42893219 L4.89339828,4.42893219 C4.89339828,3.87664744 5.34111353,3.42893219 5.89339828,3.42893219 Z M11.4289322,5.13603897 C11.8194565,5.52656326 11.8194565,6.15972824 11.4289322,6.55025253 L10.0147186,7.96446609 C9.62419433,8.35499039 8.99102936,8.35499039 8.60050506,7.96446609 C8.20998077,7.5739418 8.20998077,6.94077682 8.60050506,6.55025253 L10.0147186,5.13603897 C10.4052429,4.74551468 11.0384079,4.74551468 11.4289322,5.13603897 Z M0.600505063,5.13603897 C0.991029355,4.74551468 1.62419433,4.74551468 2.01471863,5.13603897 L3.42893219,6.55025253 C3.81945648,6.94077682 3.81945648,7.5739418 3.42893219,7.96446609 C3.0384079,8.35499039 2.40524292,8.35499039 2.01471863,7.96446609 L0.600505063,6.55025253 C0.209980772,6.15972824 0.209980772,5.52656326 0.600505063,5.13603897 Z"-->
    <!--									fill="#000000" opacity="0.3"-->
    <!--									transform="translate(6.014719, 5.843146) rotate(-45.000000) translate(-6.014719, -5.843146)" />-->
    <!--								<path-->
    <!--									d="M17.9142136,15.4497475 C18.4664983,15.4497475 18.9142136,15.8974627 18.9142136,16.4497475 L18.9142136,18.4497475 C18.9142136,19.0020322 18.4664983,19.4497475 17.9142136,19.4497475 C17.3619288,19.4497475 16.9142136,19.0020322 16.9142136,18.4497475 L16.9142136,16.4497475 C16.9142136,15.8974627 17.3619288,15.4497475 17.9142136,15.4497475 Z M23.4497475,17.1568542 C23.8402718,17.5473785 23.8402718,18.1805435 23.4497475,18.5710678 L22.0355339,19.9852814 C21.6450096,20.3758057 21.0118446,20.3758057 20.6213203,19.9852814 C20.2307961,19.5947571 20.2307961,18.9615921 20.6213203,18.5710678 L22.0355339,17.1568542 C22.4260582,16.76633 23.0592232,16.76633 23.4497475,17.1568542 Z M12.6213203,17.1568542 C13.0118446,16.76633 13.6450096,16.76633 14.0355339,17.1568542 L15.4497475,18.5710678 C15.8402718,18.9615921 15.8402718,19.5947571 15.4497475,19.9852814 C15.0592232,20.3758057 14.4260582,20.3758057 14.0355339,19.9852814 L12.6213203,18.5710678 C12.2307961,18.1805435 12.2307961,17.5473785 12.6213203,17.1568542 Z"-->
    <!--									fill="#000000" opacity="0.3"-->
    <!--									transform="translate(18.035534, 17.863961) scale(1, -1) rotate(45.000000) translate(-18.035534, -17.863961)" />-->
    <!--							</g>-->
    <!--						</svg>-->
    <!--end::Svg Icon-->
    <!--					</span>-->
    <!--				</span>-->
    <!--				<div class="d-flex flex-column flex-grow-1 mr-2">-->
    <!--					<a href="#" class="font-weight-normel text-dark-75 text-hover-primary font-size-lg mb-1">The-->
    <!--						best product</a>-->
    <!--					<span class="text-muted font-size-sm">Due in 2 Days</span>-->
    <!--				</div>-->
    <!--				<span class="font-weight-bolder text-info py-1 font-size-lg">+8%</span>-->
    <!--			</div>-->
    <!--end::Item-->
    <!--		</div>-->
    <!--end::Notifications-->
    <!--	</div>-->
    <!--end::Content-->
    <!--</div>-->
    <!-- end::User Panel-->
    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop">
        <span class="svg-icon">
            <!--begin::Svg Icon | path:../assets/media/svg/icons/Navigation/Up-2.svg-->
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <polygon points="0 0 24 0 24 24 0 24" />
                    <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10"
                        rx="1" />
                    <path
                        d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z"
                        fill="#000000" fill-rule="nonzero" />
                </g>
            </svg>
            <!--end::Svg Icon-->
        </span>
    </div>
    <!--end::Scrolltop-->
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>
        var KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1400
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#3699FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#E4E6EF",
                        "dark": "#181C32"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1F0FF",
                        "secondary": "#EBEDF3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#3F4254",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#EBEDF3",
                    "gray-300": "#E4E6EF",
                    "gray-400": "#D1D3E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#7E8299",
                    "gray-700": "#5E6278",
                    "gray-800": "#3F4254",
                    "gray-900": "#181C32"
                }
            },
            "font-family": "Poppins"
        };
    </script>
    <!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <!-- 	<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
 <script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
 <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
 
   
 <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
 <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script> -->

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
    <!--<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFE8D11s7CnPik7kvJsMXW4fVdgpmSDHc&amp;callback=initMap&amp;libraries=&amp;v=weekly"
        defer=""></script>-->
    <!--<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>-->
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        $('select.selectpicker').selectpicker();
        $(document).ready(function() {
            // Users can skip the loading process if they want.
            $('.skip').click(function() {
                $('.overlay, body').addClass('loaded');
                $('.overlay').css({
                    'display': 'none'
                });
                $('.overlay').css({
                    'z-index': -100
                })
            })

            // Will wait for everything on the page to load.
            $(window).bind('load', function() {
                $('.overlay, body').addClass('loaded');
                setTimeout(function() {
                    $('.overlay').css({
                        'display': 'none'
                    });
                    $('.overlay').css({
                        'z-index': -100
                    });
                }, 200)
            });

            // Will remove overlay after 1min for users cannnot load properly.
            setTimeout(function() {
                $('.overlay, body').addClass('loaded');
                $('.overlay').css({
                    'display': 'none'
                });
                $('.overlay').css({
                    'z-index': -100
                });
            }, 60);
        })
    </script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
            toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
            toolbar_mode: 'floating',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
        });
    </script>
    <script>
        var KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1400
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#3699FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#E4E6EF",
                        "dark": "#181C32"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1F0FF",
                        "secondary": "#EBEDF3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#3F4254",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#EBEDF3",
                    "gray-300": "#E4E6EF",
                    "gray-400": "#D1D3E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#7E8299",
                    "gray-700": "#5E6278",
                    "gray-800": "#3F4254",
                    "gray-900": "#181C32"
                }
            },
            "font-family": "Poppins"
        };
    </script>
</body>
<script>
    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "{{ session('error') }}",
        })
    @endif
    @if (session('success'))
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 1500
        })
    @endif
    let loader = document.getElementById('preloader');
    //	var loader1 = document.getElementById('preloader1');
    window.addEventListener('load', function() {
        loader.style.display = 'none';
        // loader1.style.display = 'none';
    });

    var loader1 = document.getElementById('preloader1');
    $("form").on("submit", function() {

        //e.preventDefault();
        loader1.style.display = 'flex';

    });
</script>
<!--end::Body-->
@yield('scripts')

</html>
