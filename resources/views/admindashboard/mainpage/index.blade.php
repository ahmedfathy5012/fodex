@extends('layouts.adminindex')

@section('content')
    <style>
        .dashboard-page {
            direction: rtl;
            background: #f4f7fb;
            min-height: 100vh;
            padding-bottom: 30px;
        }
.chart-wrapper{
     display: grid;
    grid-template-columns: 1fr 1fr;
    width: 100%;
    gap: 24px;
    @media screen and (max-width: 768px) {
        grid-template-columns:  1fr;

    }
}
        .dashboard-filter-card,
        .dashboard-stat-card,
        .dashboard-panel-card,
        .dashboard-table-card,
        .dashboard-mini-card {
            background: #fff;
            border: 0;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
        }

        .dashboard-filter-card {
            padding: 24px;
            margin-bottom: 24px;
        }

        .dashboard-section-title {
            font-size: 18px;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dashboard-section-title::before {
            content: "";
            width: 6px;
            height: 22px;
            background: linear-gradient(180deg, #0ea5e9, #2563eb);
            border-radius: 999px;
            display: inline-block;
        }

        .dashboard-page .form-group label {
            font-size: 13px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 8px;
        }

        .dashboard-page .form-control,
        .dashboard-page .bootstrap-select > .dropdown-toggle {
            min-height: 46px;
            border-radius: 12px !important;
            border: 1px solid #dbe3ee !important;
            background: #fff !important;
            box-shadow: none !important;
            color: #334155 !important;
        }

        .dashboard-page .bootstrap-select .filter-option {
            text-align: right !important;
        }

        .dashboard-filter-btn {
            min-width: 160px;
            border-radius: 12px !important;
            background: linear-gradient(90deg, #2563eb, #0ea5e9) !important;
            color: #fff !important;
            font-weight: 800 !important;
            font-size: 14px;
            border: 0 !important;
            box-shadow: 0 12px 25px rgba(37, 99, 235, 0.22);
            transition: .2s ease;
        }

        .dashboard-filter-btn:hover {
            color: #fff !important;
            transform: translateY(-2px);
        }

        .dashboard-stat-card {
            padding: 22px;
            height: 140px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            overflow: hidden;
            position: relative;
            margin-bottom: 18px;
        }

        .dashboard-stat-card::after {
            content: "";
            position: absolute;
            width: 90px;
            height: 90px;
            background: rgba(37, 99, 235, 0.05);
            border-radius: 50%;
            left: -10px;
            bottom: -10px;
        }

        .dashboard-stat-info strong {
            display: block;
            font-size: 30px;
            font-weight: 900;
            color: #0f172a;
            line-height: 1;
            margin-bottom: 10px;
        }

        .dashboard-stat-info span {
            font-size: 14px;
            font-weight: 700;
            color: #64748b;
        }

        .dashboard-stat-icon {
            width: 64px;
            height: 64px;
            border-radius: 18px;
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 2;
        }

        .dashboard-stat-icon img {
            width: 36px;
            height: 36px;
            object-fit: contain;
        }

        .dashboard-mini-card {
            padding: 18px;
            margin-bottom: 18px;
            height: 110px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .dashboard-mini-label {
            font-size: 13px;
            font-weight: 700;
            color: #64748b;
            margin-bottom: 8px;
        }

        .dashboard-mini-value {
            font-size: 26px;
            font-weight: 900;
            color: #0f172a;
            line-height: 1;
        }

        .dashboard-mini-note {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 8px;
        }

        .dashboard-panel-card {
            padding: 0;
            overflow: hidden;
            margin-bottom: 24px;
            height: 100%;
        }

        .dashboard-panel-header {
            padding: 20px 22px 14px;
            border-bottom: 1px solid #edf2f7;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
        }

        .dashboard-panel-title {
            font-size: 16px;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
        }

        .dashboard-panel-subtitle {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 4px;
        }

        .dashboard-panel-badge {
            background: #eff6ff;
            color: #2563eb;
            border-radius: 999px;
            padding: 6px 12px;
            font-size: 12px;
            font-weight: 700;
        }

        .dashboard-chart-body {
            padding: 18px 22px 22px;
        }

        .dashboard-chart-wrap {
            position: relative;
            height: 320px;
        }

        .dashboard-chart-wrap canvas {
            width: 100% !important;
            height: 100% !important;
        }

        .dashboard-notification-body {
            padding: 18px 18px 22px;
            min-height: 390px;
            max-height: 390px;
            overflow-y: auto;
            background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
        }

        .dashboard-empty-state {
            min-height: 320px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 12px;
            text-align: center;
            color: #94a3b8;
        }

        .dashboard-empty-state p {
            margin: 0;
            font-size: 14px;
            font-weight: 600;
        }

        .dashboard-notification-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 14px;
            background: #fff;
            border: 1px solid #edf2f7;
            border-radius: 16px;
            margin-bottom: 12px;
            transition: .2s ease;
        }

        .dashboard-notification-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(15, 23, 42, 0.05);
        }

        .dashboard-notification-time {
            min-width: 66px;
            text-align: center;
            background: #eff6ff;
            color: #2563eb;
            padding: 8px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 800;
        }

        .dashboard-notification-dot {
            width: 12px;
            height: 12px;
            background: #f59e0b;
            border-radius: 50%;
            margin-top: 8px;
            box-shadow: 0 0 0 6px rgba(245, 158, 11, 0.12);
            flex-shrink: 0;
        }

        .dashboard-notification-text {
            font-size: 14px;
            line-height: 1.8;
            color: #475569;
            font-weight: 600;
            flex: 1;
        }

        .dashboard-table-card {
            padding: 0;
            overflow: hidden;
            margin-top: 10px;
        }

        .dashboard-table-card .card-header {
            background: #fff;
            border-bottom: 1px solid #edf2f7;
            padding: 20px 24px;
        }

        .dashboard-table-card .card-title {
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
        }

        .dashboard-table-card .card-body {
            padding: 20px;
        }

        .dashboard-coupon-table {
            margin: 0;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        .dashboard-coupon-table thead th {
            background: #f8fafc;
            color: #334155;
            font-weight: 800;
            border: 0 !important;
            padding: 14px 12px;
            text-align: center;
            white-space: nowrap;
        }

        .dashboard-coupon-table tbody tr {
            background: #fff;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.04);
        }

        .dashboard-coupon-table tbody td {
            border-top: 1px solid #edf2f7 !important;
            border-bottom: 1px solid #edf2f7 !important;
            padding: 14px 12px !important;
            text-align: center;
            vertical-align: middle !important;
            font-size: 14px;
            font-weight: 700;
            color: #475569;
        }

        .dashboard-coupon-table tbody td:first-child {
            border-right: 1px solid #edf2f7 !important;
            border-radius: 0 12px 12px 0;
        }

        .dashboard-coupon-table tbody td:last-child {
            border-left: 1px solid #edf2f7 !important;
            border-radius: 12px 0 0 12px;
        }

        @media (max-width: 991px) {
            .dashboard-chart-wrap {
                height: 280px;
            }

            .dashboard-notification-body {
                min-height: auto;
                max-height: none;
            }
        }

        @media (max-width: 767px) {
            .dashboard-filter-card,
            .dashboard-chart-body,
            .dashboard-notification-body,
            .dashboard-table-card .card-body {
                padding: 16px;
            }

            .dashboard-panel-header {
                padding: 16px;
            }

            .dashboard-filter-btn {
                width: 100%;
            }
        }
    </style>

    <div class="dashboard-page">
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
            <div class="d-flex flex-column-fluid">
                <div class="container-fluid">

                    {{-- Filter --}}
                    <div class="dashboard-filter-card">
                        <div class="dashboard-section-title">فلترة الداشبورد</div>

                        <div class="row">
                            @if(auth()->user()->type == 1)
                                <div class="form-group col-lg-3 col-md-6">
                                    <label>الدوله<span class="text-danger">*</span></label>
                                    <select name="country_id" class="form-control selectpicker" onchange="getstates(this)" id="country" required data-live-search="true">
                                        <option value="0">الكل</option>
                                        @foreach(auth()->user()->countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            @if(auth()->user()->type == 1 || auth()->user()->type == 2)
                                <div class="form-group col-lg-3 col-md-6">
                                    <label>المحافظه<span class="text-danger">*</span></label>
                                    <select name="state_id" class="form-control selectpicker" id="state" onchange="getcities(this)" required data-live-search="true">
                                        <option value="0">الكل</option>
                                        @foreach(auth()->user()->states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            @if(auth()->user()->type == 1 || auth()->user()->type == 2 || auth()->user()->type == 3)
                                <div class="form-group col-lg-3 col-md-6">
                                    <label>المدينه<span class="text-danger">*</span></label>
                                    <select name="city_id" class="form-control selectpicker" onchange="getzones(this)" id="city" required data-live-search="true">
                                        <option value="0">الكل</option>
                                        @foreach(auth()->user()->cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            @if(auth()->user()->type == 1 || auth()->user()->type == 2 || auth()->user()->type == 3 || auth()->user()->type == 4)
                                <div class="form-group col-lg-3 col-md-6">
                                    <label>المنطقه<span class="text-danger">*</span></label>
                                    <select name="zone_id" class="form-control selectpicker" id="zone" required data-live-search="true">
                                        <option value="0">الكل</option>
                                        @foreach(auth()->user()->zones as $zone)
                                            <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        </div>

                        <div class="text-center mt-3">
                            <span id="btn" class="btn dashboard-filter-btn" onclick="filter_dashboard()">بحث</span>
                        </div>
                    </div>

                    {{-- Top Stats --}}
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="dashboard-stat-card">
                                <div class="dashboard-stat-info">
                                    <strong id="daily_orders" class="counter" data-count="{{ $daily_orders }}">0</strong>
                                    <span>الطلبات الجديده</span>
                                </div>
                                <a href="{{ route('dailyorders') }}" class="dashboard-stat-icon">
                                    <img src="{{ asset('online-order.png') }}" alt="orders">
                                </a>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <div class="dashboard-stat-card">
                                <div class="dashboard-stat-info">
                                    <strong id="count_sellers" class="counter" data-count="{{ $count_sellers }}">0</strong>
                                    <span>المطاعم</span>
                                </div>
                                <a href="{{ route('seller.index') }}" class="dashboard-stat-icon">
                                    <img src="{{ asset('restaurant.png') }}" alt="sellers">
                                </a>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <div class="dashboard-stat-card">
                                <div class="dashboard-stat-info">
                                    <strong id="count_employees" class="counter" data-count="{{ $count_employees }}">0</strong>
                                    <span>الموظفين</span>
                                </div>
                                <a href="{{ route('employee.index') }}" class="dashboard-stat-icon">
                                    <img src="{{ asset('employee.png') }}" alt="employees">
                                </a>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <div class="dashboard-stat-card">
                                <div class="dashboard-stat-info">
                                    <strong id="count_drivers" class="counter" data-count="{{ $count_drivers }}">0</strong>
                                    <span>السائقين</span>
                                </div>
                                <a href="{{ route('driver.index') }}" class="dashboard-stat-icon">
                                    <img src="{{ asset('driver.png') }}" alt="drivers">
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- New Modern Analytics Section --}}
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="dashboard-mini-card">
                                <div class="dashboard-mini-label">إجمالي العناصر المعروضة</div>
                                <div class="dashboard-mini-value" id="summary_sellers">{{ $count_sellers }}</div>
                                <div class="dashboard-mini-note">عدد المطاعم الموجودة حالياً</div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 ">
                            <div class="dashboard-mini-card">
                                <div class="dashboard-mini-label">قوة التشغيل</div>
                                <div class="dashboard-mini-value" id="summary_drivers">{{ $count_drivers }}</div>
                                <div class="dashboard-mini-note">السائقين المتاحين داخل النظام</div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12">
                            <div class="dashboard-mini-card">
                                <div class="dashboard-mini-label">طلبات اليوم</div>
                                <div class="dashboard-mini-value" id="summary_orders">{{ $daily_orders }}</div>
                                <div class="dashboard-mini-note">إجمالي الطلبات الجديدة اليوم</div>
                            </div>
                        </div>
                    </div>

                    <div class="chart-wrapper">
                        {{-- Sellers Chart --}}
                        <div class="col-lg-12">
                            <div class="dashboard-panel-card">
                                <div class="dashboard-panel-header">
                                    <div>
                                        <h3 class="dashboard-panel-title">المطاعم / الطلبات</h3>
                                        <div class="dashboard-panel-subtitle">مقارنة بين عدد الطلبات لكل مطعم</div>
                                    </div>
                                    <span class="dashboard-panel-badge">Bar Chart</span>
                                </div>
                                <div class="dashboard-chart-body">
                                    <div class="dashboard-chart-wrap">
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Notifications --}}
                        <div class="col-lg-12">
                            <div class="dashboard-panel-card">
                                <div class="dashboard-panel-header">
                                    <div>
                                        <h3 class="dashboard-panel-title">إشعارات الطلبات اليومية</h3>
                                        <div class="dashboard-panel-subtitle">آخر التنبيهات الخاصة بالطلبات الجديدة</div>
                                    </div>
                                    <span class="dashboard-panel-badge">Live</span>
                                </div>

                                <div class="dashboard-notification-body" id="notifications">
                                    @if(count($notifications) > 0)
                                        @foreach($notifications as $notification)
                                            <div class="dashboard-notification-item subnoty">
                                                <div class="dashboard-notification-time">{{ $notification->time }}</div>
                                                <div class="dashboard-notification-dot"></div>
                                                <div class="dashboard-notification-text">{{ $notification->message }}</div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="dashboard-empty-state" id="lotto">
                                            <lottie-player src="{{ asset('85891-search.json') }}"
                                                           background="transparent"
                                                           speed="1"
                                                           style="width: 240px; height: 240px;"
                                                           loop
                                                           autoplay>
                                            </lottie-player>
                                            <p>لا توجد إشعارات جديدة حالياً</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Users Chart --}}
                        <div class="col-lg-12">
                            <div class="dashboard-panel-card">
                                <div class="dashboard-panel-header">
                                    <div>
                                        <h3 class="dashboard-panel-title">أكثر العملاء طلباً</h3>
                                        <div class="dashboard-panel-subtitle">العملاء الأعلى في عدد الطلبات</div>
                                    </div>
                                    <span class="dashboard-panel-badge">Doughnut</span>
                                </div>
                                <div class="dashboard-chart-body">
                                    <div class="dashboard-chart-wrap">
                                        <canvas id="myChart3"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Drivers Chart --}}
                        <div class="col-lg-12">
                            <div class="dashboard-panel-card">
                                <div class="dashboard-panel-header">
                                    <div>
                                        <h3 class="dashboard-panel-title">أكثر السائقين توصيلاً للطلبات</h3>
                                        <div class="dashboard-panel-subtitle">السائقين الأعلى نشاطاً في التوصيل</div>
                                    </div>
                                    <span class="dashboard-panel-badge">Doughnut</span>
                                </div>
                                <div class="dashboard-chart-body">
                                    <div class="dashboard-chart-wrap">
                                        <canvas id="myChart5"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Coupons --}}
                    <div class="dashboard-table-card">
                        <div class="card-header">
                            <h3 class="card-title">الكوبونات المتاحة</h3>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table dashboard-coupon-table">
                                    <thead>
                                    <tr>
                                        <th>الاسم</th>
                                        <th>الكود</th>
                                        <th>من</th>
                                        <th>إلى</th>
                                        <th>القيمة</th>
                                        <th>النوع</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($coupons as $coupon)
                                        <tr>
                                            <td>{{ $coupon->title }}</td>
                                            <td>{{ $coupon->name }}</td>
                                            <td>{{ $coupon->date_from }}</td>
                                            <td>{{ $coupon->date_to }}</td>
                                            <td>{{ $coupon->value }}</td>
                                            <td>
                                                @if($coupon->percentage == 0)
                                                    ثابت
                                                @else
                                                    نسبة مئوية
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <audio src="{{ asset('notification.mp3') }}"></audio>
    </div>
@endsection

@section("scripts")
    <script>
        let sellersChart = null;
        let usersChart = null;
        let driversChart = null;

        $(document).ready(function () {
            animateCounters();

            renderSellersChart(@json($sellers_names), @json($seller_order_numbers));
            renderUsersChart(@json($users_names), @json($user_order_numbers));
            renderDriversChart(@json($drivers_names), @json($driver_order_numbers));
        });

        function animateCounters() {
            $('.counter').each(function () {
                var $this = $(this);
                var countTo = parseInt($this.attr('data-count')) || 0;

                $({ countNum: 0 }).animate({
                    countNum: countTo
                }, {
                    duration: 1400,
                    easing: 'swing',
                    step: function () {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function () {
                        $this.text(this.countNum);
                    }
                });
            });
        }

        function chartCommonOptions() {
            return {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                family: 'Tajawal, sans-serif',
                                size: 12
                            },
                            color: '#334155'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        cornerRadius: 10,
                        padding: 12
                    }
                }
            };
        }

        function renderSellersChart(labels, data) {
            if (sellersChart) {
                sellersChart.destroy();
            }

            const ctx = document.getElementById('myChart').getContext('2d');

            sellersChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'عدد الطلبات',
                        data: data,
                        backgroundColor: ['#2563eb', '#0ea5e9', '#38bdf8', '#60a5fa', '#3b82f6', '#0284c7'],
                        borderRadius: 12,
                        borderSkipped: false,
                        maxBarThickness: 46
                    }]
                },
                options: {
                    ...chartCommonOptions(),
                    scales: {
                        x: {
                            ticks: {
                                color: '#64748b',
                                font: {
                                    family: 'Tajawal, sans-serif',
                                    size: 11
                                }
                            },
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: '#64748b'
                            },
                            grid: {
                                color: '#eaf0f6'
                            }
                        }
                    }
                }
            });
        }

        function renderUsersChart(labels, data) {
            if (usersChart) {
                usersChart.destroy();
            }

            const ctx = document.getElementById('myChart3').getContext('2d');

            usersChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'العملاء',
                        data: data,
                        backgroundColor: ['#2563eb', '#0ea5e9', '#14b8a6', '#8b5cf6', '#f59e0b', '#94a3b8'],
                        borderWidth: 0
                    }]
                },
                options: {
                    ...chartCommonOptions(),
                    cutout: '62%'
                }
            });
        }

        function renderDriversChart(labels, data) {
            if (driversChart) {
                driversChart.destroy();
            }

            const ctx = document.getElementById('myChart5').getContext('2d');

            driversChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'السائقين',
                        data: data,
                        backgroundColor: ['#0f172a', '#2563eb', '#0ea5e9', '#22c55e', '#f59e0b', '#cbd5e1'],
                        borderWidth: 0
                    }]
                },
                options: {
                    ...chartCommonOptions(),
                    cutout: '62%'
                }
            });
        }

        function getstates(selected) {
            let id = selected.value;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "get",
                url: `getstatesemployee/${id}`,
                dataType: "Json",
                success: function (result) {
                    if (result.status == true) {
                        $('#state').empty().append(result.data);
                        $('select#state').selectpicker("refresh");
                        getcities(document.getElementById('state'));
                    }
                }
            });
        }

        function getcities(selected) {
            let id = selected.value;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "get",
                url: `getcitiesemployee/${id}`,
                dataType: "Json",
                success: function (result) {
                    if (result.status == true) {
                        $('#city').empty().append(result.data);
                        $('select#city').selectpicker("refresh");
                        getzones(document.getElementById('city'));
                    }
                }
            });
        }

        function getzones(selected) {
            let id = selected.value;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "get",
                url: `getzonesemployee/${id}`,
                dataType: "Json",
                success: function (result) {
                    if (result.status == true) {
                        $('#zone').empty().append(result.data);
                        $('select#zone').selectpicker("refresh");
                    }
                }
            });
        }

        function updateCounter(id, value) {
            $(id).attr('data-count', value).text(value);
        }

        function filter_dashboard() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: `filter_dashboard`,
                dataType: "Json",
                data: {
                    country_id: $('#country').val(),
                    state_id: $('#state').val(),
                    city_id: $('#city').val(),
                    zone_id: $('#zone').val(),
                },
                success: function (result) {
                    if (result.status == true) {
                        updateCounter('#count_sellers', result.data.count_sellers);
                        updateCounter('#count_drivers', result.data.count_drivers);
                        updateCounter('#count_employees', result.data.count_employees);
                        updateCounter('#daily_orders', result.data.daily_orders);

                        $('#summary_sellers').text(result.data.count_sellers);
                        $('#summary_drivers').text(result.data.count_drivers);
                        $('#summary_orders').text(result.data.daily_orders);

                        renderSellersChart(result.data.sellers_names, result.data.seller_order_numbers);
                        renderUsersChart(result.data.users_names, result.data.user_order_numbers);
                        renderDriversChart(result.data.drivers_names, result.data.driver_order_numbers);
                    }
                }
            });
        }

        Echo.channel('FodexApp')
            .listen('GetOrder', (e) => {
                $("#lotto").remove();

                let length = $('#notifications .subnoty').length;
                if (length >= 10) {
                    $('#notifications .subnoty').last().remove();
                }

                let sound = new Audio('{{ asset('notification.mp3') }}');
                sound.play();

                $("#notifications").prepend(`
                <div class="dashboard-notification-item subnoty">
                    <div class="dashboard-notification-time">${e.time}</div>
                    <div class="dashboard-notification-dot"></div>
                    <div class="dashboard-notification-text">${e.message}</div>
                </div>
            `);

                Swal.fire(
                    'طلب جديد',
                    `${e.message}`
                );
            });
    </script>
@endsection
