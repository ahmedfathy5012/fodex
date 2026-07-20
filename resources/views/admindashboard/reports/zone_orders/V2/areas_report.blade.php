@extends('layouts.adminindex')

@section('content')
    <style>
        .area-reports-page {
            direction: rtl;
        }

        .area-reports-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
        }

        .area-reports-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 22px 26px;
        }

        .area-reports-card .card-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .area-reports-card .card-label {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            color: #181c32;
        }

        .area-reports-card .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /*.area-reports-card .card-icon svg rect,*/
        /*.area-reports-card .card-icon svg path {*/
        /*    fill: #3699ff !important;*/
        /*}*/

        .area-reports-body {
            padding: 28px;
            background: #ffffff;
        }

        .area-report-box {
            position: relative;
            min-height: 180px;
            border-radius: 22px;
            padding: 22px;
            overflow: hidden;
            box-shadow: 0 14px 32px rgba(24, 28, 50, 0.10);
            transition: all 0.18s ease;
            margin-bottom: 22px;
        }

        .area-report-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 38px rgba(24, 28, 50, 0.14);
        }

        .area-report-box::before {
            content: "";
            position: absolute;
            top: -55px;
            left: -55px;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.16);
        }

        .area-report-box::after {
            content: "";
            position: absolute;
            bottom: -70px;
            right: -70px;
            width: 170px;
            height: 170px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.12);
        }

        .area-report-country {
            background: linear-gradient(135deg, #0A81AB, #0c9fd1);
        }

        .area-report-state {
            background: linear-gradient(135deg, #16C79A, #21d8aa);
        }

        .area-report-city {
            background: linear-gradient(135deg, #e54e6b, #f06b84);
        }

        .area-report-zone {
            background: linear-gradient(135deg, #38A3A5, #4fc0c2);
        }

        .area-report-title {
            position: relative;
            z-index: 2;
            margin: 0;
            color: #ffffff;
            font-size: 22px;
            font-weight: 900;
            text-align: center;
            margin-bottom: 34px;
        }

        .area-report-actions {
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .area-report-action {
            min-height: 64px;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.16);
            border: 1px solid rgba(255, 255, 255, 0.28);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            color: #ffffff !important;
            font-size: 14px;
            font-weight: 800;
            text-decoration: none !important;
            transition: all 0.15s ease;
            backdrop-filter: blur(8px);
        }

        .area-report-action:hover {
            background: rgba(255, 255, 255, 0.25);
            color: #ffffff !important;
            transform: translateY(-1px);
        }

        .area-report-action img {
            width: 34px;
            height: 34px;
            object-fit: contain;
            filter: brightness(0) invert(1);
        }

        @media (max-width: 768px) {
            .area-reports-body {
                padding: 18px;
            }

            .area-report-box {
                min-height: 170px;
                padding: 18px;
            }

            .area-report-actions {
                grid-template-columns: 1fr;
            }

            .area-report-action {
                min-height: 56px;
            }
        }
    </style>

    <div class="area-reports-page">
        <div class="card card-custom gutter-b area-reports-card">
            <div class="card-header">
                <div class="card-title">
                <span class="card-icon">
                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink"
                             width="24px"
                             height="24px"
                             viewBox="0 0 24 24"
                             version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5"/>
                                <path d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L18.5,10 C19.3284271,10 20,10.6715729 20,11.5 C20,12.3284271 19.3284271,13 18.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z"
                                      fill="#000000"
                                      opacity="0.3"/>
                            </g>
                        </svg>
                    </span>
                </span>

                    <h3 class="card-label">تقارير المناطق</h3>
                </div>
            </div>

            <div class="card-body area-reports-body">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="area-report-box area-report-country">
                            <h3 class="area-report-title">الدول</h3>

                            <div class="area-report-actions">
                                <a href="{{ route('country_icomes') }}" class="area-report-action">
                                    <img src="{{ asset('money-bag.png') }}" alt="income">
                                    <span>الإيرادات</span>
                                </a>

                                <a href="{{ route('country_orders') }}" class="area-report-action">
                                    <img src="{{ asset('order.png') }}" alt="orders">
                                    <span>الطلبات</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="area-report-box area-report-state">
                            <h3 class="area-report-title">المحافظات</h3>

                            <div class="area-report-actions">
                                <a href="{{ route('state_icomes') }}" class="area-report-action">
                                    <img src="{{ asset('money-bag.png') }}" alt="income">
                                    <span>الإيرادات</span>
                                </a>

                                <a href="{{ route('state_orders') }}" class="area-report-action">
                                    <img src="{{ asset('order.png') }}" alt="orders">
                                    <span>الطلبات</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="area-report-box area-report-city">
                            <h3 class="area-report-title">المدن</h3>

                            <div class="area-report-actions">
                                <a href="{{ route('city_icomes') }}" class="area-report-action">
                                    <img src="{{ asset('money-bag.png') }}" alt="income">
                                    <span>الإيرادات</span>
                                </a>

                                <a href="{{ route('city_orders') }}" class="area-report-action">
                                    <img src="{{ asset('order.png') }}" alt="orders">
                                    <span>الطلبات</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="area-report-box area-report-zone">
                            <h3 class="area-report-title">المناطق</h3>

                            <div class="area-report-actions">
                                <a href="{{ route('zone_icomes') }}" class="area-report-action">
                                    <img src="{{ asset('money-bag.png') }}" alt="income">
                                    <span>الإيرادات</span>
                                </a>

                                <a href="{{ route('zone_orders') }}" class="area-report-action">
                                    <img src="{{ asset('order.png') }}" alt="orders">
                                    <span>الطلبات</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
@endsection
