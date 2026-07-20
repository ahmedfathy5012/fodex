@extends('layouts.adminindex')

@section('content')
    <style>
        .location-analytics-page {
            direction: rtl;
        }

        .location-analytics-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
        }

        .location-analytics-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 22px 26px;
        }

        .location-analytics-card .card-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .location-analytics-card .card-label {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            color: #181c32;
        }

        .location-analytics-card .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .location-analytics-card .card-icon svg path,
        .location-analytics-card .card-icon svg rect {
            fill: #3699ff !important;
        }

        .location-analytics-body {
            padding: 28px;
            background: #ffffff;
        }

        .location-section {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 22px;
        }

        .location-section-title {
            font-size: 16px;
            font-weight: 800;
            color: #181c32;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .location-section-title::before {
            content: "";
            width: 5px;
            height: 18px;
            border-radius: 10px;
            background: #3699ff;
            display: inline-block;
        }

        .location-filter-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .location-date-wrapper {
            position: relative;
            max-width: 360px;
            width: 100%;
        }

        .location-date-wrapper .datepicker {
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

        .location-date-icon {
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

        .location-search-btn {
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
            box-shadow: 0 8px 18px rgba(54, 153, 255, 0.22);
            transition: all 0.15s ease;
            cursor: pointer;
        }

        .location-search-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(54, 153, 255, 0.28);
            color: #ffffff !important;
        }

        .location-charts-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        .location-chart-card {
            position: relative;
            background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
            border: 1px solid #e8eef7;
            border-radius: 20px;
            padding: 20px;
            min-height: 390px;
            box-shadow: 0 14px 35px rgba(24, 28, 50, 0.07);
            overflow: hidden;
        }

        .location-chart-card::before {
            content: "";
            position: absolute;
            top: -70px;
            left: -70px;
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: rgba(54, 153, 255, 0.10);
        }

        .location-chart-card::after {
            content: "";
            position: absolute;
            bottom: -90px;
            right: -90px;
            width: 190px;
            height: 190px;
            border-radius: 50%;
            background: rgba(54, 153, 255, 0.07);
        }

        .location-chart-title {
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

        .location-chart-title::before {
            content: "";
            width: 38px;
            height: 6px;
            border-radius: 20px;
            background: linear-gradient(90deg, #3699ff, rgba(54, 153, 255, 0.2));
            display: inline-block;
            order: 2;
        }

        .location-chart-box {
            position: relative;
            z-index: 2;
            height: 320px;
            width: 100%;
            background: rgba(255, 255, 255, 0.68);
            border-radius: 16px;
            padding: 12px;
        }

        .location-chart-box canvas {
            width: 100% !important;
            height: 100% !important;
        }

        @media (max-width: 992px) {
            .location-charts-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .location-analytics-body {
                padding: 18px;
            }

            .location-section {
                padding: 16px;
            }

            .location-search-btn,
            .location-date-wrapper {
                width: 100%;
            }
        }
    </style>

    <div class="location-analytics-page">
        <div class="card card-custom gutter-b location-analytics-card">
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
                                <path
                                    d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L18.5,10 C19.3284271,10 20,10.6715729 20,11.5 C20,12.3284271 19.3284271,13 18.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z"
                                    fill="#000000"
                                    opacity="0.3"/>
                            </g>
                        </svg>
                    </span>
                </span>

                    <h3 class="card-label">إحصائيات المناطق والطلبات</h3>
                </div>
            </div>

            <div class="card-body location-analytics-body">
                <div class="location-section">
                    <div class="location-section-title">فلتر التاريخ</div>

                    <div class="location-filter-actions">
                        <div class="location-date-wrapper">
                        <span class="location-date-icon">
                            <i class="fa fa-calendar"></i>
                        </span>

                            <input type="text"
                                   id="datepicker"
                                   name="datepicker"
                                   class="datepicker"
                                   readonly>
                        </div>

                        <span id="btn"
                              class="btn btn-primary location-search-btn"
                              onclick="filtercharts()">
                        بحث
                    </span>
                    </div>
                </div>

                <div class="location-section">
                    <div class="location-section-title">الدول</div>

                    <div class="location-charts-grid">
                        <div class="location-chart-card">
                            <div class="location-chart-title">أكثر الدول طلبات</div>
                            <div class="location-chart-box">
                                <canvas id="myChart4"></canvas>
                            </div>
                        </div>

                        <div class="location-chart-card">
                            <div class="location-chart-title">أكثر الدول سعراً للطلبات</div>
                            <div class="location-chart-box">
                                <canvas id="myChart5"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="location-section">
                    <div class="location-section-title">المحافظات</div>

                    <div class="location-charts-grid">
                        <div class="location-chart-card">
                            <div class="location-chart-title">أكثر المحافظات طلبات</div>
                            <div class="location-chart-box">
                                <canvas id="myChart6"></canvas>
                            </div>
                        </div>

                        <div class="location-chart-card">
                            <div class="location-chart-title">أكثر المحافظات سعراً للطلبات</div>
                            <div class="location-chart-box">
                                <canvas id="myChart7"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="location-section">
                    <div class="location-section-title">المدن</div>

                    <div class="location-charts-grid">
                        <div class="location-chart-card">
                            <div class="location-chart-title">أكثر المدن طلبات</div>
                            <div class="location-chart-box">
                                <canvas id="myChart8"></canvas>
                            </div>
                        </div>

                        <div class="location-chart-card">
                            <div class="location-chart-title">أكثر المدن سعراً للطلبات</div>
                            <div class="location-chart-box">
                                <canvas id="myChart9"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="location-section">
                    <div class="location-section-title">المناطق</div>

                    <div class="location-charts-grid">
                        <div class="location-chart-card">
                            <div class="location-chart-title">أكثر المناطق طلبات</div>
                            <div class="location-chart-box">
                                <canvas id="myChart10"></canvas>
                            </div>
                        </div>

                        <div class="location-chart-card">
                            <div class="location-chart-title">أكثر المناطق سعراً للطلبات</div>
                            <div class="location-chart-box">
                                <canvas id="myChart11"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    @section("scripts")
        <script>
            var locationCharts = {};

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
                    daysOfWeek: ["ح", "ن", "ث", "ر", "خ", "ج", "س"],
                    monthNames: [
                        "يناير", "فبراير", "مارس", "أبريل", "مايو", "يونيو",
                        "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"
                    ],
                },
            });

            function filterValue(selector) {
                return $(selector).length ? $(selector).val() : 0;
            }

            function hasRealData(labels, numbers) {
                labels = Array.isArray(labels) ? labels : [];
                numbers = Array.isArray(numbers) ? numbers : [];

                return labels.length > 0 && numbers.length > 0 && numbers.some(function (value) {
                    return Number(value) > 0;
                });
            }

            function getChartOptions(hasData) {
                return {
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
                        enabled: hasData,
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
                                suggestedMax: hasData ? undefined : 10,
                                fontColor: '#7e8299',
                                fontSize: 12,
                                padding: 8
                            }
                        }]
                    },
                    animation: {
                        duration: 650
                    }
                };
            }

            function drawEmptyText(chart, text) {
                var ctx = chart.chart.ctx;
                var chartArea = chart.chartArea;

                if (!chartArea) {
                    return;
                }

                var centerX = (chartArea.left + chartArea.right) / 2;
                var centerY = (chartArea.top + chartArea.bottom) / 2;

                ctx.save();
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.font = 'bold 16px Arial';
                ctx.fillStyle = '#7e8299';
                ctx.fillText(text, centerX, centerY);
                ctx.restore();
            }

            function renderBarChart(canvasId, labels, numbers, labelText) {
                var canvas = document.getElementById(canvasId);

                if (!canvas) {
                    return;
                }

                if (locationCharts[canvasId]) {
                    locationCharts[canvasId].destroy();
                    locationCharts[canvasId] = null;
                }

                labels = Array.isArray(labels) ? labels : [];
                numbers = Array.isArray(numbers) ? numbers : [];

                var hasData = hasRealData(labels, numbers);
                var ctx = canvas.getContext('2d');

                var gradient = ctx.createLinearGradient(0, 0, 0, 320);
                gradient.addColorStop(0, 'rgba(54, 153, 255, 0.95)');
                gradient.addColorStop(1, 'rgba(54, 153, 255, 0.18)');

                locationCharts[canvasId] = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: hasData ? labels : [''],
                        datasets: [{
                            label: labelText,
                            data: hasData ? numbers : [0],
                            fill: false,
                            borderColor: hasData ? 'rgba(54, 153, 255, 1)' : 'rgba(0, 0, 0, 0)',
                            backgroundColor: hasData ? gradient : 'rgba(0, 0, 0, 0)',
                            hoverBackgroundColor: hasData ? 'rgba(54, 153, 255, 0.9)' : 'rgba(0, 0, 0, 0)',
                            borderWidth: 0,
                            borderRadius: 14,
                            maxBarThickness: 36,
                            categoryPercentage: 0.62,
                            barPercentage: 0.82
                        }]
                    },
                    options: getChartOptions(hasData),
                    plugins: [{
                        afterDraw: function (chart) {
                            if (!hasData) {
                                drawEmptyText(chart, 'لا توجد بيانات متاحة');
                            }
                        }
                    }]
                });
            }

            function renderEmptyAllCharts() {
                renderBarChart('myChart4', [], [], 'اكثر الدول طلبات');
                renderBarChart('myChart5', [], [], 'اكثر الدول سعر للطلبات');

                renderBarChart('myChart6', [], [], 'اكثر المحافظات طلبات');
                renderBarChart('myChart7', [], [], 'اكثر المحافظات سعر للطلبات');

                renderBarChart('myChart8', [], [], 'اكثر المدن طلبات');
                renderBarChart('myChart9', [], [], 'اكثر المدن سعر للطلبات');

                renderBarChart('myChart10', [], [], 'اكثر المناطق طلبات');
                renderBarChart('myChart11', [], [], 'اكثر المناطق سعر للطلبات');
            }

            function loadChart(url, canvasId, labelText) {
                $.ajax({
                    type: "GET",
                    url: url,
                    contentType: "application/json; charset=utf-8",
                    dataType: "Json",
                    success: function (result) {
                        if (result && result.data) {
                            renderBarChart(canvasId, result.data.names, result.data.numbers, labelText);
                        } else {
                            renderBarChart(canvasId, [], [], labelText);
                        }
                    },
                    error: function () {
                        renderBarChart(canvasId, [], [], labelText);
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
                    beforeSend: function () {
                        $('#btn').text('جاري البحث...');
                        renderEmptyAllCharts();
                    },
                    success: function (result) {
                        if (result.status == true && result.data) {
                            renderBarChart('myChart4', result.data.names5, result.data.numbers5, 'اكثر الدول طلبات');
                            renderBarChart('myChart5', result.data.names6, result.data.numbers6, 'اكثر الدول سعر للطلبات');

                            renderBarChart('myChart6', result.data.names7, result.data.numbers7, 'اكثر المحافظات طلبات');
                            renderBarChart('myChart7', result.data.names8, result.data.numbers8, 'اكثر المحافظات سعر للطلبات');

                            renderBarChart('myChart8', result.data.names9, result.data.numbers9, 'اكثر المدن طلبات');
                            renderBarChart('myChart9', result.data.names10, result.data.numbers10, 'اكثر المدن سعر للطلبات');

                            renderBarChart('myChart10', result.data.names11, result.data.numbers11, 'اكثر المناطق طلبات');
                            renderBarChart('myChart11', result.data.names12, result.data.numbers12, 'اكثر المناطق سعر للطلبات');
                        } else {
                            renderEmptyAllCharts();
                        }
                    },
                    error: function () {
                        renderEmptyAllCharts();
                    },
                    complete: function () {
                        $('#btn').text('بحث');
                    }
                });
            }

            window.onload = function () {
                renderEmptyAllCharts();

                loadChart(`mostcountryorder`, 'myChart4', 'اكثر الدول طلبات');
                loadChart(`mostcountryprice`, 'myChart5', 'اكثر الدول سعر للطلبات');

                loadChart(`moststateorder`, 'myChart6', 'اكثر المحافظات طلبات');
                loadChart(`moststateprice`, 'myChart7', 'اكثر المحافظات سعر للطلبات');

                loadChart(`mostcityorder`, 'myChart8', 'اكثر المدن طلبات');
                loadChart(`mostcityprice`, 'myChart9', 'اكثر المدن سعر للطلبات');

                loadChart(`mostzoneorder`, 'myChart10', 'اكثر المناطق طلبات');
                loadChart(`mostzoneprice`, 'myChart11', 'اكثر المناطق سعر للطلبات');
            }
        </script>
    @endsection

