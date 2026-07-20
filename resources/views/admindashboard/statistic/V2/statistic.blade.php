@extends('layouts.adminindex')

@section('content')
    <style>
        .analytics-dashboard-page {
            direction: rtl;
        }

        .analytics-dashboard-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
        }

        .analytics-dashboard-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 22px 26px;
        }

        .analytics-dashboard-card .card-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .analytics-dashboard-card .card-label {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            color: #181c32;
        }

        .analytics-dashboard-card .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /*.analytics-dashboard-card .card-icon svg path,*/
        /*.analytics-dashboard-card .card-icon svg rect {*/
        /*    fill: #3699ff !important;*/
        /*}*/

        .analytics-dashboard-body {
            padding: 28px;
            background: #ffffff;
        }

        .analytics-section {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 22px;
        }

        .analytics-section-title {
            font-size: 16px;
            font-weight: 800;
            color: #181c32;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .analytics-section-title::before {
            content: "";
            width: 5px;
            height: 18px;
            border-radius: 10px;
            background: #3699ff;
            display: inline-block;
        }

        .analytics-dashboard-page .form-group label {
            font-weight: 700;
            color: #3f4254;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .analytics-dashboard-page .form-control,
        .analytics-dashboard-page .bootstrap-select > .dropdown-toggle {
            min-height: 44px;
            border-radius: 10px !important;
            border: 1px solid #e4e6ef !important;
            color: #3f4254 !important;
            background: #ffffff !important;
            box-shadow: none !important;
            transition: all 0.15s ease;
        }

        .analytics-dashboard-page .form-control:focus,
        .analytics-dashboard-page .bootstrap-select.show > .dropdown-toggle {
            border-color: #3699ff !important;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
        }

        .analytics-dashboard-page .bootstrap-select .filter-option {
            text-align: right !important;
        }

        .analytics-dashboard-page .dropdown-menu {
            border-radius: 12px;
            border: 1px solid #edf0f5;
            box-shadow: 0 10px 26px rgba(0, 0, 0, 0.12);
        }

        .analytics-filter-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 8px;
        }

        .analytics-date-wrapper {
            position: relative;
            max-width: 360px;
            width: 100%;
        }

        .analytics-date-wrapper .datepicker {
            width: 100%;
            min-height: 44px;
            border-radius: 10px;
            border: 1px solid #e4e6ef;
            background: #ffffff;
            padding: 10px 46px 10px 14px;
            color: #3f4254;
            font-weight: 700;
            cursor: pointer;
            text-align: center;
        }

        .analytics-date-icon {
            position: absolute;
            top: 5px;
            right: 6px;
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: #eaf4ff;
            color: #3699ff;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
        }

        .analytics-search-btn {
            min-width: 140px;
            height: 44px;
            border-radius: 10px !important;
            background: #3699ff !important;
            border: 0 !important;
            color: #ffffff !important;
            font-size: 14px;
            font-weight: 800 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 8px 18px rgba(54, 153, 255, 0.22);
            transition: all 0.15s ease;
            cursor: pointer;
        }

        .analytics-search-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(54, 153, 255, 0.28);
            color: #ffffff !important;
        }

        .analytics-charts-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        .analytics-chart-card {
            position: relative;
            background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
            border: 1px solid #e8eef7;
            border-radius: 20px;
            padding: 20px;
            min-height: 390px;
            box-shadow: 0 14px 35px rgba(24, 28, 50, 0.07);
            overflow: hidden;
        }

        .analytics-chart-card::before {
            content: "";
            position: absolute;
            top: -70px;
            left: -70px;
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: rgba(54, 153, 255, 0.10);
        }

        .analytics-chart-card::after {
            content: "";
            position: absolute;
            bottom: -90px;
            right: -90px;
            width: 190px;
            height: 190px;
            border-radius: 50%;
            background: rgba(54, 153, 255, 0.07);
        }

        .analytics-chart-title {
            position: relative;
            z-index: 2;
            font-size: 15px;
            font-weight: 900;
            color: #181c32;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .analytics-chart-title::before {
            content: "";
            width: 38px;
            height: 6px;
            border-radius: 20px;
            background: linear-gradient(90deg, #3699ff, rgba(54, 153, 255, 0.2));
            display: inline-block;
            order: 2;
        }

        .analytics-chart-box {
            position: relative;
            z-index: 2;
            height: 320px;
            width: 100%;
            background: rgba(255, 255, 255, 0.68);
            border-radius: 16px;
            padding: 12px;
        }

        .analytics-chart-box canvas {
            width: 100% !important;
            height: 100% !important;
        }

        @media (max-width: 992px) {
            .analytics-charts-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .analytics-dashboard-body {
                padding: 18px;
            }

            .analytics-section {
                padding: 16px;
            }

            .analytics-search-btn,
            .analytics-date-wrapper {
                width: 100%;
            }
        }
    </style>

    <div class="analytics-dashboard-page">
        <div class="card card-custom gutter-b analytics-dashboard-card">
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

                    <h3 class="card-label">الإحصائيات والتقارير</h3>
                </div>
            </div>

            <div class="card-body analytics-dashboard-body">
                <div class="analytics-section">
                    <div class="analytics-section-title">فلاتر البحث</div>

                    <div class="row">
                        <x-filter-component />
                    </div>

                    <div class="analytics-filter-actions">
                        <div class="analytics-date-wrapper">
                        <span class="analytics-date-icon">
                            <i class="fa fa-calendar"></i>
                        </span>

                            <input type="text"
                                   id="datepicker"
                                   name="datepicker"
                                   class="datepicker"
                                   readonly>
                        </div>

                        <span id="btn"
                              class="btn btn-primary analytics-search-btn"
                              onclick="filtercharts()">
                        بحث
                    </span>
                    </div>
                </div>

                <div class="analytics-section">
                    <div class="analytics-section-title">الرسوم البيانية</div>

                    <div class="analytics-charts-grid">
                        <div class="analytics-chart-card">
                            <div class="analytics-chart-title">أكثر البائعين منتجات</div>
                            <div class="analytics-chart-box">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>

                        <div class="analytics-chart-card">
                            <div class="analytics-chart-title">أكثر البائعين طلبات</div>
                            <div class="analytics-chart-box">
                                <canvas id="myChart1"></canvas>
                            </div>
                        </div>

                        <div class="analytics-chart-card">
                            <div class="analytics-chart-title">أكثر السائقين توصيل طلبات</div>
                            <div class="analytics-chart-box">
                                <canvas id="myChart2"></canvas>
                            </div>
                        </div>

                        <div class="analytics-chart-card">
                            <div class="analytics-chart-title">أكثر المنتجات مبيعاً</div>
                            <div class="analytics-chart-box">
                                <canvas id="myChart3"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script>
        var dashboardCharts = {};

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

        function filterValue(selector) {
            return $(selector).length ? $(selector).val() : 0;
        }

        function renderBarChart(canvasId, labels, numbers, labelText) {
            var canvas = document.getElementById(canvasId);

            if (!canvas) {
                return;
            }

            if (dashboardCharts[canvasId]) {
                dashboardCharts[canvasId].destroy();
            }

            var ctx = canvas.getContext('2d');

            var gradient = ctx.createLinearGradient(0, 0, 0, 320);
            gradient.addColorStop(0, 'rgba(54, 153, 255, 0.95)');
            gradient.addColorStop(1, 'rgba(54, 153, 255, 0.18)');

            dashboardCharts[canvasId] = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels || [],
                    datasets: [{
                        label: labelText,
                        data: numbers || [],
                        fill: false,
                        borderColor: 'rgba(54, 153, 255, 1)',
                        backgroundColor: gradient,
                        hoverBackgroundColor: 'rgba(54, 153, 255, 0.9)',
                        borderWidth: 0,
                        borderRadius: 14,
                        maxBarThickness: 36,
                        categoryPercentage: 0.62,
                        barPercentage: 0.82
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            top: 8,
                            right: 8,
                            left: 8,
                            bottom: 4
                        }
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        backgroundColor: '#181c32',
                        titleFontColor: '#ffffff',
                        bodyFontColor: '#ffffff',
                        titleFontSize: 13,
                        bodyFontSize: 13,
                        cornerRadius: 10,
                        xPadding: 12,
                        yPadding: 10,
                        displayColors: false
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                fontColor: '#7e8299',
                                fontSize: 12,
                                padding: 8
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                color: 'rgba(228, 230, 239, 0.8)',
                                drawBorder: false,
                                zeroLineColor: 'rgba(228, 230, 239, 1)'
                            },
                            ticks: {
                                beginAtZero: true,
                                fontColor: '#7e8299',
                                fontSize: 12,
                                padding: 8
                            }
                        }]
                    }
                }
            });
        }

        function filtercharts() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: `filtercharts`,
                data: {
                    'datepicker': $("#datepicker").val(),
                    'country_id': filterValue("#country"),
                    'state_id': filterValue("#state"),
                    'city_id': filterValue("#city"),
                    'zone_id': filterValue("#zone")
                },
                dataType: "Json",
                beforeSend: function() {
                    $('#btn').text('جاري البحث...');
                },
                success: function(result) {
                    if (result.status == true) {
                        renderBarChart('myChart', result.data.names1, result.data.numbers1, 'اكثر البائعين منتجات');
                        renderBarChart('myChart1', result.data.names2, result.data.numbers2, 'اكثر البائعين طلبات');
                        renderBarChart('myChart2', result.data.names3, result.data.numbers3, 'اكثر السائقين توصيل طلبات');
                        renderBarChart('myChart3', result.data.names4, result.data.numbers4, 'اكثر المنتجات مبيعا');
                    }
                },
                complete: function() {
                    $('#btn').text('بحث');
                }
            });
        }

        window.onload = function() {
            $.ajax({
                type: "GET",
                url: `mostresitems`,
                contentType: "application/json; charset=utf-8",
                dataType: "Json",
                success: function(result) {
                    renderBarChart('myChart', result.data.names, result.data.numbers, 'اكثر البائعين منتجات');
                }
            });

            $.ajax({
                type: "GET",
                url: `mostsellerorder`,
                contentType: "application/json; charset=utf-8",
                dataType: "Json",
                success: function(result) {
                    renderBarChart('myChart1', result.data.names, result.data.numbers, 'اكثر البائعين طلبات');
                }
            });

            $.ajax({
                type: "GET",
                url: `mostdriverorder`,
                contentType: "application/json; charset=utf-8",
                dataType: "Json",
                success: function(result) {
                    renderBarChart('myChart2', result.data.names, result.data.numbers, 'اكثر السائقين توصيل طلبات');
                }
            });

            $.ajax({
                type: "GET",
                url: `mostitemorder`,
                contentType: "application/json; charset=utf-8",
                dataType: "Json",
                success: function(result) {
                    renderBarChart('myChart3', result.data.names, result.data.numbers, 'اكثر المنتجات مبيعا');
                }
            });
        }
    </script>
@endsection
