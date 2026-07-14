<!DOCTYPE html>

<html direction="rtl" dir="rtl" style="direction: rtl">
<head>
    <base href="">
    <meta charset="utf-8" />

    <title>Order Station</title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="Order Station admin dashboard" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://keenthemes.com/metronic" />

    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/3/3a/Order_station.png" type="image">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">

    {{-- Metronic RTL --}}
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/newstyle.css') }}" rel="stylesheet" type="text/css" />

    {{-- Layout Themes --}}
    <link href="{{ asset('assets/css/themes/layout/header/base/light.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/header/menu/light.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/brand/light.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/aside/light.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />

    {{-- Plugins --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">

    {{-- Custom --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom/adminindex.css') }}">

    <style>
        html,
        body {
            direction: rtl;
            font-family: 'Tajawal', sans-serif !important;
            background: #f3f6f9 !important;
            color: #3f4254;
        }

        body {
            margin: 0;
        }

        a,
        button,
        .btn {
            transition: all 0.15s ease;
        }

        #preloader {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100vh;
            z-index: 999999;
            display: flex;
            align-items: center;
            justify-content: center;
            background:
                radial-gradient(circle at top right, rgba(255, 184, 0, 0.10), transparent 30%),
                radial-gradient(circle at bottom left, rgba(54, 153, 255, 0.10), transparent 30%),
                #f8fafc;
        }

        .delivery-loader-card {
            width: 360px;
            min-height: 330px;
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid #edf2f7;
            border-radius: 28px;
            box-shadow: 0 25px 70px rgba(15, 23, 42, 0.12);
            backdrop-filter: blur(12px);
            padding: 30px 26px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            overflow: hidden;
            position: relative;
        }

        .delivery-loader-card::before {
            content: "";
            position: absolute;
            width: 160px;
            height: 160px;
            top: -65px;
            right: -65px;
            border-radius: 50%;
            background: rgba(255, 168, 0, 0.08);
        }

        .delivery-loader-card::after {
            content: "";
            position: absolute;
            width: 140px;
            height: 140px;
            bottom: -60px;
            left: -60px;
            border-radius: 50%;
            background: rgba(54, 153, 255, 0.08);
        }

        .delivery-scene {
            width: 260px;
            height: 150px;
            position: relative;
            margin-bottom: 20px;
            z-index: 2;
        }

        .delivery-road {
            position: absolute;
            bottom: 18px;
            left: 0;
            width: 100%;
            height: 10px;
            background: #dfe6ee;
            border-radius: 999px;
            box-shadow: inset 0 2px 3px rgba(0, 0, 0, 0.05);
        }

        .delivery-road-lines {
            position: absolute;
            left: 0;
            bottom: 21px;
            width: 100%;
            height: 4px;
            overflow: hidden;
        }

        .delivery-road-lines span {
            position: absolute;
            width: 38px;
            height: 4px;
            background: #ffffff;
            border-radius: 999px;
            animation: roadMove 0.9s linear infinite;
        }

        .delivery-road-lines span:nth-child(1) { left: 0; animation-delay: 0s; }
        .delivery-road-lines span:nth-child(2) { left: 70px; animation-delay: 0.18s; }
        .delivery-road-lines span:nth-child(3) { left: 140px; animation-delay: 0.36s; }
        .delivery-road-lines span:nth-child(4) { left: 210px; animation-delay: 0.54s; }

        .delivery-bike {
            position: absolute;
            bottom: 26px;
            left: 78px;
            width: 120px;
            height: 90px;
            animation: bikeFloat 0.45s ease-in-out infinite alternate;
        }

        /* smoke */
        .bike-smoke {
            position: absolute;
            left: -8px;
            bottom: 26px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(148, 163, 184, 0.35);
            animation: smokeMove 1.4s ease-out infinite;
        }

        .smoke-2 {
            left: -18px;
            bottom: 22px;
            animation-delay: 0.35s;
        }

        .smoke-3 {
            left: -28px;
            bottom: 18px;
            animation-delay: 0.7s;
        }

        /* bike parts */
        .bike-box {
            position: absolute;
            top: 6px;
            left: 18px;
            width: 34px;
            height: 28px;
            border-radius: 8px;
            background: #ffb800;
            box-shadow: 0 6px 12px rgba(255, 184, 0, 0.25);
        }

        .bike-box::before {
            content: "";
            position: absolute;
            top: 11px;
            left: 6px;
            width: 22px;
            height: 2px;
            background: rgba(255,255,255,0.8);
        }

        .bike-seat {
            position: absolute;
            top: 26px;
            left: 45px;
            width: 24px;
            height: 8px;
            background: #181c32;
            border-radius: 8px;
        }

        .bike-body {
            position: absolute;
            top: 34px;
            left: 38px;
            width: 48px;
            height: 16px;
            background: #3699ff;
            border-radius: 14px 12px 10px 10px;
        }

        .bike-front {
            position: absolute;
            top: 36px;
            left: 77px;
            width: 22px;
            height: 10px;
            background: #1bc5bd;
            border-radius: 0 12px 12px 0;
            transform: skewX(-18deg);
        }

        .bike-glass {
            position: absolute;
            top: 28px;
            left: 76px;
            width: 14px;
            height: 10px;
            background: rgba(54, 153, 255, 0.20);
            border: 2px solid rgba(54, 153, 255, 0.35);
            border-radius: 4px 6px 2px 2px;
            transform: skewX(-20deg);
        }

        .bike-handle {
            position: absolute;
            top: 25px;
            left: 70px;
            width: 18px;
            height: 4px;
            background: #181c32;
            border-radius: 999px;
            transform: rotate(-20deg);
            transform-origin: right center;
        }

        .bike-handle::after {
            content: "";
            position: absolute;
            top: -9px;
            left: 12px;
            width: 4px;
            height: 12px;
            background: #181c32;
            border-radius: 999px;
        }

        /* rider */
        .bike-rider-head {
            position: absolute;
            top: 10px;
            left: 56px;
            width: 16px;
            height: 16px;
            background: #181c32;
            border-radius: 50%;
        }

        .bike-rider-body {
            position: absolute;
            top: 22px;
            left: 58px;
            width: 10px;
            height: 20px;
            background: #f64e60;
            border-radius: 999px;
            transform: rotate(18deg);
            transform-origin: top center;
        }

        .bike-rider-arm {
            position: absolute;
            top: 25px;
            left: 62px;
            width: 18px;
            height: 4px;
            background: #181c32;
            border-radius: 999px;
            transform-origin: left center;
            animation: riderArm 0.45s ease-in-out infinite alternate;
        }

        .bike-rider-leg {
            position: absolute;
            top: 40px;
            left: 53px;
            width: 26px;
            height: 5px;
            background: #181c32;
            border-radius: 999px;
            transform-origin: left center;
            animation: riderLeg 0.45s ease-in-out infinite alternate;
        }

        /* wheels */
        .bike-wheel {
            position: absolute;
            bottom: 0;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: 4px solid #181c32;
            background: #fff;
            box-shadow: inset 0 0 0 4px #dbe4ee;
            animation: wheelSpin 0.45s linear infinite;
        }

        .bike-wheel::before,
        .bike-wheel::after {
            content: "";
            position: absolute;
            background: #181c32;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        .bike-wheel::before {
            width: 2px;
            height: 18px;
        }

        .bike-wheel::after {
            width: 18px;
            height: 2px;
        }

        .bike-wheel-left {
            left: 24px;
        }

        .bike-wheel-right {
            right: 8px;
        }

        .delivery-loader-card h4 {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            color: #181c32;
            z-index: 2;
            position: relative;
        }

        .delivery-loader-card p {
            margin: 10px 0 18px;
            font-size: 13px;
            font-weight: 600;
            color: #7e8299;
            z-index: 2;
            position: relative;
        }

        .delivery-loader-progress {
            width: 210px;
            height: 7px;
            background: #edf2f7;
            border-radius: 999px;
            overflow: hidden;
            position: relative;
            z-index: 2;
        }

        .delivery-loader-progress span {
            display: block;
            width: 40%;
            height: 100%;
            border-radius: 999px;
            background: linear-gradient(90deg, #ffb800, #3699ff, #1bc5bd);
            animation: progressSlide 1.2s ease-in-out infinite;
        }

        /* animations */
        @keyframes roadMove {
            from {
                transform: translateX(260px);
            }
            to {
                transform: translateX(-80px);
            }
        }

        @keyframes bikeFloat {
            from {
                transform: translateY(0);
            }
            to {
                transform: translateY(-6px);
            }
        }

        @keyframes wheelSpin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes smokeMove {
            0% {
                opacity: 0.45;
                transform: translate(0, 0) scale(0.5);
            }
            100% {
                opacity: 0;
                transform: translate(-22px, -18px) scale(1.8);
            }
        }

        @keyframes riderArm {
            from {
                transform: rotate(-18deg);
            }
            to {
                transform: rotate(12deg);
            }
        }

        @keyframes riderLeg {
            from {
                transform: rotate(18deg);
            }
            to {
                transform: rotate(-8deg);
            }
        }

        @keyframes progressSlide {
            0% {
                transform: translateX(150%);
            }
            100% {
                transform: translateX(-250%);
            }
        }
        .loader-card {
            width: 280px;
            min-height: 280px;
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 28px;
            box-shadow: 0 20px 55px rgba(15, 23, 42, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 8px;
            text-align: center;
        }

        .loader-card-title {
            font-size: 16px;
            font-weight: 900;
            color: #181c32;
            margin-top: -20px;
        }

        .loader-card-subtitle {
            font-size: 12px;
            font-weight: 700;
            color: #7e8299;
        }

        .brand {
            background: #ffffff !important;
            border-bottom: 1px solid #edf0f5;
            padding: 16px 12px;
        }

        .brand-logo {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .brand-logo img {
            width: 72% !important;
            max-height: 90px;
            object-fit: contain;
            margin: 0 auto;
        }

        .brand-toggle {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: #f3f6f9 !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .brand-toggle:hover {
            background: #eaf4ff !important;
        }

        .brand-toggle svg path {
            fill: #3699ff !important;
        }

        #kt_header_mobile {
            background: #ffffff !important;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.07);
            border-bottom: 1px solid #edf0f5;
            height: 64px;
        }

        #kt_header_mobile .btn {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #f3f6f9;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        #kt_header_mobile .btn:hover {
            background: #eaf4ff;
        }

        #kt_header_mobile .burger-icon span,
        #kt_header_mobile .burger-icon span::before,
        #kt_header_mobile .burger-icon span::after {
            background-color: #3699ff !important;
        }

        #kt_header_mobile .svg-icon svg path {
            fill: #3699ff !important;
        }

        #kt_header {
            background: #ffffff !important;
            border-bottom: 1px solid #edf0f5;
            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
        }

        .topbar .btn-clean {
            border-radius: 12px;
        }

        .topbar .symbol img {
            border-radius: 10px;
            object-fit: cover;
        }

        .aside {
            background: #ffffff !important;
            box-shadow: 0 8px 28px rgba(15, 23, 42, 0.06);
        }

        .aside-menu-wrapper {
            background: #ffffff !important;
        }

        .wrapper,
        .content {
            background: #f3f6f9 !important;
        }

        .footer {
            border-top: 1px solid #edf0f5;
            box-shadow: 0 -4px 18px rgba(15, 23, 42, 0.03);
        }

        .card.card-custom {
            border: 0;
            border-radius: 16px;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
        }

        .card.card-custom > .card-header {
            border-bottom: 1px solid #edf0f5;
        }

        .btning {
            min-width: 130px;
            height: 42px;
            border-radius: 10px !important;
            background: #3699ff !important;
            border: 0 !important;
            color: #ffffff !important;
            font-size: 14px;
            font-weight: 800 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 18px rgba(54, 153, 255, 0.22);
        }

        .btning:hover {
            color: #ffffff !important;
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(54, 153, 255, 0.28);
        }

        .form-control,
        .bootstrap-select > .dropdown-toggle,
        .select2-container .select2-selection--single {
            border-radius: 10px !important;
            border: 1px solid #e4e6ef !important;
            box-shadow: none !important;
            min-height: 42px;
        }

        .form-control:focus,
        .bootstrap-select.show > .dropdown-toggle {
            border-color: #3699ff !important;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
        }

        .bootstrap-select .filter-option {
            text-align: right !important;
        }

        .dropdown-menu {
            border-radius: 12px;
            border: 1px solid #edf0f5;
            box-shadow: 0 10px 26px rgba(0, 0, 0, 0.12);
        }

        .dataTables_wrapper .dataTables_filter input {
            border-radius: 10px;
            border: 1px solid #e4e6ef;
            min-height: 38px;
            padding: 6px 12px;
            margin-right: 8px;
            box-shadow: none !important;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #3699ff;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
            outline: none;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #3699ff !important;
            color: #ffffff !important;
            border-radius: 8px !important;
            border: 0 !important;
        }

        .scrolltop {
            background: #3699ff !important;
            border-radius: 12px;
            box-shadow: 0 8px 18px rgba(54, 153, 255, 0.25);
        }

        .scrolltop svg path,
        .scrolltop svg rect {
            fill: #ffffff !important;
        }

        @media (max-width: 991px) {
            #kt_header_mobile {
                padding: 0 14px;
            }

            .loader-card {
                width: 230px;
                min-height: 230px;
            }
        }
    </style>

    @yield('styles')

</head>

<body id="kt_body"
      class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

{{--<div id="preloader">--}}{{--    <div class="loader-card">--}}{{--        <lottie-player src="{{ asset('67226-food-app-interaction.json') }}"--}}{{--                       background="transparent"--}}{{--                       speed="1"--}}{{--                       style="width: 190px; height: 190px;"--}}{{--                       loop--}}{{--                       autoplay>--}}{{--        </lottie-player>--}}{{--        <div class="loader-card-title">Order Station</div>--}}{{--        <div class="loader-card-subtitle">جاري تحميل لوحة التحكم...</div>--}}{{--    </div>--}}{{--</div>--}}

{{--<div id="preloader">--}}{{--    <div class="modern-loader-card">--}}{{--        <div class="modern-loader-logo">--}}{{--            <img src="https://upload.wikimedia.org/wikipedia/commons/3/3a/Order_station.png" alt="Order Station">--}}{{--        </div>--}}

{{--        <div class="modern-loader-ring">--}}{{--            <span></span>--}}{{--            <span></span>--}}{{--            <span></span>--}}{{--        </div>--}}

{{--        <h4>Order Station</h4>--}}{{--        <p>جاري تحميل لوحة التحكم...</p>--}}{{--    </div>--}}{{--</div>--}}

{{--<div id="preloader">--}}{{--    <div class="run-loader-card">--}}{{--        <div class="run-scene">--}}{{--            <div class="run-road">--}}{{--                <span></span>--}}{{--                <span></span>--}}{{--                <span></span>--}}{{--            </div>--}}

{{--            <div class="runner">--}}{{--                <div class="runner-head"></div>--}}{{--                <div class="runner-body"></div>--}}{{--                <div class="runner-arm runner-arm-one"></div>--}}{{--                <div class="runner-arm runner-arm-two"></div>--}}{{--                <div class="runner-leg runner-leg-one"></div>--}}{{--                <div class="runner-leg runner-leg-two"></div>--}}{{--            </div>--}}{{--        </div>--}}

{{--        <h4>Order Station</h4>--}}{{--        <p>جاري تحميل لوحة التحكم...</p>--}}

{{--        <div class="loader-progress">--}}{{--            <span></span>--}}{{--        </div>--}}{{--    </div>--}}{{--</div>--}}

<div id="preloader">
    <div class="delivery-loader-card">
        <div class="delivery-scene">
            <div class="delivery-road"></div>

            <div class="delivery-road-lines">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>

            <div class="delivery-bike">
                <div class="bike-smoke smoke-1"></div>
                <div class="bike-smoke smoke-2"></div>
                <div class="bike-smoke smoke-3"></div>

                <div class="bike-box"></div>
                <div class="bike-seat"></div>
                <div class="bike-body"></div>
                <div class="bike-front"></div>
                <div class="bike-glass"></div>
                <div class="bike-handle"></div>

                <div class="bike-rider-head"></div>
                <div class="bike-rider-body"></div>
                <div class="bike-rider-arm"></div>
                <div class="bike-rider-leg"></div>

                <div class="bike-wheel bike-wheel-left"></div>
                <div class="bike-wheel bike-wheel-right"></div>
            </div>
        </div>

        <h4>OrderStation Delivery</h4>
        <p>جاري تحميل لوحة التحكم وتجهيز الطلبات...</p>

        <div class="delivery-loader-progress">
            <span></span>
        </div>
    </div>

</div>

<div id="preloader1">
    <div class="loader-card">
        <lottie-player src="{{ asset('72168-loading-food.json') }}"
                       background="transparent"
                       speed="1"
                       style="width: 190px; height: 190px;"
                       loop
                       autoplay>
        </lottie-player>
        <div class="loader-card-title">برجاء الانتظار</div>
        <div class="loader-card-subtitle">جاري حفظ البيانات...</div>
    </div>
</div>

<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
    <div class="d-flex align-items-center">
        <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
            <span></span>
        </button>

        <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
        <span class="svg-icon svg-icon-xl">
            <svg xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink"
                 width="24px"
                 height="24px"
                 viewBox="0 0 24 24"
                 version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <polygon points="0 0 24 0 24 24 0 24" />
                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                          fill="#000000"
                          fill-rule="nonzero"
                          opacity="0.3" />
                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                          fill="#000000"
                          fill-rule="nonzero" />
                </g>
            </svg>
        </span>
        </button>
    </div>

</div>

<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-row flex-column-fluid page">

        <div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
            <div class="brand flex-column-auto" id="kt_brand" kt-hidden-height="65">
                <a href="{{ route('dashboard') }}" class="brand-logo">
                    <img alt="Logo"
                         src="https://upload.wikimedia.org/wikipedia/commons/3/3a/Order_station.png">
                </a>

                <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
                <span class="svg-icon svg-icon svg-icon-xl">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink"
                         width="24px"
                         height="24px"
                         viewBox="0 0 24 24"
                         version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                            <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                  fill="#000000"
                                  fill-rule="nonzero"
                                  transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)">
                            </path>
                            <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                                  fill="#000000"
                                  fill-rule="nonzero"
                                  opacity="0.3"
                                  transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)">
                            </path>
                        </g>
                    </svg>
                </span>
                </button>
            </div>

            <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
                <div id="kt_header" class="header header-fixed">
                    <div class="container-fluid d-flex align-items-stretch justify-content-between">
                        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper"></div>

                        <div class="topbar">
                            <div class="dropdown">
                                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1"></div>
                                </div>

                                <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                                    <ul class="navi navi-hover py-4"></ul>
                                </div>
                            </div>

                            <div class="topbar-item">
                                <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2"
                                     id="kt_quick_user_toggle">
                                    <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">مرحبا</span>

                                    <lottie-player src="{{ asset('6542-handup.json') }}"
                                                   background="transparent"
                                                   speed="1"
                                                   style="width: 70px; height:70px;"
                                                   loop
                                                   autoplay>
                                    </lottie-player>

                                    <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">
                                    {{ auth()->user()->name }}
                                </span>

                                    <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                                    <img src="{{ asset('uploads/' . auth()->user()->image) }}">
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('layouts.company_includes.v2.__adminsidebar')
            </div>
        </div>

        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            @yield('content')

            <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
                <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <div class="text-dark order-2 order-md-1">
                        <span class="text-muted font-weight-bold mr-2">{{ date('Y') }}©</span>
                        <span class="text-dark-75 text-hover-primary">Order Station</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div id="kt_scrolltop" class="scrolltop">
    <span class="svg-icon">
        <svg xmlns="http://www.w3.org/2000/svg"
             xmlns:xlink="http://www.w3.org/1999/xlink"
             width="24px"
             height="24px"
             viewBox="0 0 24 24"
             version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <polygon points="0 0 24 0 24 24 0 24" />
                <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z"
                      fill="#000000"
                      fill-rule="nonzero" />
            </g>
        </svg>
    </span>
</div>

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
        "font-family": "Tajawal"
    };
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>

<script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>

<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script src="{{ asset('btn.js') }}"></script>

<script src="{{ asset('/vendor/datatables/buttons.server-side.js') }}"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.min.js"></script>

<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>

<script src="{{ asset('js/app.js') }}"></script>

<script>
    $(document).ready(function() {
        if ($('select.selectpicker').length) {
            $('select.selectpicker').selectpicker();
        }

        $(window).on('load', function() {
            $('#preloader').fadeOut(250);
        });

        setTimeout(function() {
            $('#preloader').fadeOut(250);
        }, 1200);

        $("form").on("submit", function() {
            $('#preloader1').css('display', 'flex');
        });
    });
</script>

<script>
    if (typeof tinymce !== 'undefined') {
        tinymce.init({
            selector: 'textarea',
            plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
            toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
            toolbar_mode: 'floating',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
        });
    }
</script>

<script>
    @if (session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: "{{ session('error') }}",
    });
    @endif

    @if (session('success'))
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 1500
    });
    @endif
</script>

@yield('scripts')

</body>
</html>
