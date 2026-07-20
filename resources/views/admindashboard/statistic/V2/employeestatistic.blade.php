@extends('layouts.adminindex')

@section('content')
    <style>
        .fast-employee-page {
            direction: rtl;
        }

        .fast-employee-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
        }

        .fast-employee-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 22px 26px;
        }

        .fast-employee-card .card-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .fast-employee-card .card-label {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            color: #181c32;
        }

        .fast-employee-card .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .fast-employee-card .card-icon svg path,
        .fast-employee-card .card-icon svg rect {
            fill: #3699ff !important;
        }

        .fast-employee-body {
            padding: 28px;
            background: #ffffff;
        }

        .fast-employee-section {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 22px;
        }

        .fast-employee-section-title {
            font-size: 16px;
            font-weight: 800;
            color: #181c32;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .fast-employee-section-title::before {
            content: "";
            width: 5px;
            height: 18px;
            border-radius: 10px;
            background: #3699ff;
            display: inline-block;
        }

        .fast-employee-page .form-group label {
            font-weight: 700;
            color: #3f4254;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .fast-employee-page .form-control,
        .fast-employee-page .bootstrap-select > .dropdown-toggle {
            min-height: 44px;
            border-radius: 10px !important;
            border: 1px solid #e4e6ef !important;
            color: #3f4254 !important;
            background: #ffffff !important;
            box-shadow: none !important;
            transition: all 0.15s ease;
        }

        .fast-employee-page .form-control:focus,
        .fast-employee-page .bootstrap-select.show > .dropdown-toggle {
            border-color: #3699ff !important;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
        }

        .fast-employee-page .bootstrap-select .filter-option {
            text-align: right !important;
        }

        .fast-employee-page .dropdown-menu {
            border-radius: 12px;
            border: 1px solid #edf0f5;
            box-shadow: 0 10px 26px rgba(0, 0, 0, 0.12);
        }

        .fast-employee-filter-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 8px;
        }

        .fast-employee-date-wrapper {
            position: relative;
            max-width: 360px;
            width: 100%;
        }

        .fast-employee-date-wrapper .datepicker {
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

        .fast-employee-date-icon {
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

        .fast-employee-search-btn {
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

        .fast-employee-search-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(54, 153, 255, 0.28);
            color: #ffffff !important;
        }

        .fast-employee-chart-wrap {
            max-width: 760px;
            margin: auto;
        }

        .fast-employee-chart-card {
            position: relative;
            background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
            border: 1px solid #e8eef7;
            border-radius: 20px;
            padding: 20px;
            min-height: 420px;
            box-shadow: 0 14px 35px rgba(24, 28, 50, 0.07);
            overflow: hidden;
        }

        .fast-employee-chart-card::before {
            content: "";
            position: absolute;
            top: -70px;
            left: -70px;
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: rgba(54, 153, 255, 0.10);
        }

        .fast-employee-chart-card::after {
            content: "";
            position: absolute;
            bottom: -90px;
            right: -90px;
            width: 190px;
            height: 190px;
            border-radius: 50%;
            background: rgba(54, 153, 255, 0.07);
        }

        .fast-employee-chart-title {
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

        .fast-employee-chart-title::before {
            content: "";
            width: 38px;
            height: 6px;
            border-radius: 20px;
            background: linear-gradient(90deg, #3699ff, rgba(54, 153, 255, 0.2));
            display: inline-block;
            order: 2;
        }

        .fast-employee-chart-box {
            position: relative;
            z-index: 2;
            height: 340px;
            width: 100%;
            background: rgba(255, 255, 255, 0.68);
            border-radius: 16px;
            padding: 12px;
        }

        .fast-employee-chart-box canvas {
            width: 100% !important;
            height: 100% !important;
        }

        @media (max-width: 768px) {
            .fast-employee-body {
                padding: 18px;
            }

            .fast-employee-section {
                padding: 16px;
            }

            .fast-employee-search-btn,
            .fast-employee-date-wrapper {
                width: 100%;
            }
        }
    </style>

    <div class="fast-employee-page">
        <div class="card card-custom gutter-b fast-employee-card">
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

                    <h3 class="card-label">أسرع الموظفين قبول طلبات</h3>
                </div>
            </div>

            <div class="card-body fast-employee-body">
                <div class="fast-employee-section">
                    <div class="fast-employee-section-title">فلاتر البحث</div>

                    <div class="row">
                        <x-filter-component
                            states-url="{{ url('getstates') }}"
                            cities-url="{{ url('getcities') }}"
                            zones-url="{{ url('getzones') }}"
                        />
                    </div>

                    <div class="fast-employee-filter-actions">
                        <div class="fast-employee-date-wrapper">
                        <span class="fast-employee-date-icon">
                            <i class="fa fa-calendar"></i>
                        </span>

                            <input type="text"
                                   id="datepicker"
                                   name="datepicker"
                                   class="datepicker"
                                   readonly>
                        </div>

                        <span id="btn"
                              class="btn btn-primary fast-employee-search-btn"
                              onclick="filtercharts()">
                        بحث
                    </span>
                    </div>
                </div>

                <div class="fast-employee-section">
                    <div class="fast-employee-section-title">الرسم البياني</div>

                    <div class="fast-employee-chart-wrap">
                        <div class="fast-employee-chart-card">
                            <div class="fast-employee-chart-title">أسرع الموظفين قبول طلبات</div>

                            <div class="fast-employee-chart-box">
                                <canvas id="myChart12"></canvas>
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
        var fastEmployeeCharts = {};

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

        // function hasRealData(labels, numbers) {
        //     labels = Array.isArray(labels) ? labels : [];
        //     numbers = Array.isArray(numbers) ? numbers : [];
        //
        //     return labels.length > 0 && numbers.length > 0 && numbers.some(function(value) {
        //         return Number(value) > 0;
        //     });
        // }

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

        // function renderBarChart(canvasId, labels, numbers, labelText) {
        //     var canvas = document.getElementById(canvasId);
        //
        //     if (!canvas) {
        //         return;
        //     }
        //
        //     if (fastEmployeeCharts[canvasId]) {
        //         fastEmployeeCharts[canvasId].destroy();
        //         fastEmployeeCharts[canvasId] = null;
        //     }
        //
        //     labels = Array.isArray(labels) ? labels : [];
        //     numbers = Array.isArray(numbers) ? numbers : [];
        //
        //     var hasData = hasRealData(labels, numbers);
        //     var ctx = canvas.getContext('2d');
        //
        //     var gradient = ctx.createLinearGradient(0, 0, 0, 340);
        //     gradient.addColorStop(0, 'rgba(54, 153, 255, 0.95)');
        //     gradient.addColorStop(1, 'rgba(54, 153, 255, 0.18)');
        //
        //     fastEmployeeCharts[canvasId] = new Chart(ctx, {
        //         type: 'bar',
        //         data: {
        //             labels: hasData ? labels : [''],
        //             datasets: [{
        //                 label: labelText,
        //                 data: hasData ? numbers : [50],
        //                 fill: false,
        //                 borderColor: hasData ? 'rgba(54, 153, 255, 1)' : 'rgba(0, 0, 0, 0)',
        //                 backgroundColor: hasData ? gradient : 'rgba(0, 0, 0, 0)',
        //                 hoverBackgroundColor: hasData ? 'rgba(54, 153, 255, 0.9)' : 'rgba(0, 0, 0, 0)',
        //                 borderWidth: 0,
        //                 borderRadius: 14,
        //                 maxBarThickness: 36,
        //                 categoryPercentage: 0.62,
        //                 barPercentage: 0.82
        //             }]
        //         },
        //         options: {
        //             responsive: true,
        //             maintainAspectRatio: false,
        //             layout: {
        //                 padding: {
        //                     top: 8,
        //                     right: 8,
        //                     left: 8,
        //                     bottom: 4
        //                 }
        //             },
        //             legend: {
        //                 display: false
        //             },
        //             tooltips: {
        //                 enabled: hasData,
        //                 backgroundColor: '#181c32',
        //                 titleFontColor: '#ffffff',
        //                 bodyFontColor: '#ffffff',
        //                 titleFontSize: 13,
        //                 bodyFontSize: 13,
        //                 cornerRadius: 10,
        //                 xPadding: 12,
        //                 yPadding: 10,
        //                 displayColors: false
        //             },
        //             scales: {
        //                 xAxes: [{
        //                     gridLines: {
        //                         display: false,
        //                         drawBorder: false
        //                     },
        //                     ticks: {
        //                         fontColor: '#7e8299',
        //                         fontSize: 12,
        //                         padding: 8
        //                     }
        //                 }],
        //                 yAxes: [{
        //                     gridLines: {
        //                         color: 'rgba(228, 230, 239, 0.8)',
        //                         drawBorder: false,
        //                         zeroLineColor: 'rgba(228, 230, 239, 1)'
        //                     },
        //                     ticks: {
        //                         beginAtZero: true,
        //                         suggestedMax: hasData ? undefined : 10,
        //                         fontColor: '#7e8299',
        //                         fontSize: 12,
        //                         padding: 8
        //                     }
        //                 }]
        //             }
        //         },
        //         // plugins: [{
        //         //     afterDraw: function(chart) {
        //         //         if (!hasData) {
        //         //             drawEmptyText(chart, 'لا توجد بيانات متاحة');
        //         //         }
        //         //     }
        //         // }]
        //     });
        // }
        function hasRealData(labels, numbers) {
            labels = Array.isArray(labels) ? labels : [];
            numbers = Array.isArray(numbers) ? numbers : [];

            return labels.length > 0 && numbers.length > 0 && numbers.some(function(value) {
                return Number(value) > 0;
            });
        }

        function renderBarChart(canvasId, labels, numbers, labelText) {
            var canvas = document.getElementById(canvasId);

            if (!canvas) {
                return;
            }

            if (fastEmployeeCharts[canvasId]) {
                fastEmployeeCharts[canvasId].destroy();
                fastEmployeeCharts[canvasId] = null;
            }

            labels = Array.isArray(labels) ? labels : [];
            numbers = Array.isArray(numbers) ? numbers : [];

            var hasLabels = labels.length > 0;
            var hasData = hasRealData(labels, numbers);

            if (hasLabels && numbers.length === 0) {
                numbers = labels.map(function () {
                    return 0;
                });
            }

            var ctx = canvas.getContext('2d');

            var gradient = ctx.createLinearGradient(0, 0, 0, 340);
            gradient.addColorStop(0, 'rgba(54, 153, 255, 0.95)');
            gradient.addColorStop(1, 'rgba(54, 153, 255, 0.18)');

            fastEmployeeCharts[canvasId] = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: hasLabels ? labels : [''],
                    datasets: [{
                        label: labelText,
                        data: hasLabels ? numbers : [0],
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
                                padding: 8,
                                autoSkip: false,
                                maxRotation: 45,
                                minRotation: 25
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
                    }
                },
                plugins: [{
                    afterDraw: function(chart) {
                        if (hasData) {
                            return;
                        }

                        var chartCtx = chart.chart.ctx;
                        var chartArea = chart.chartArea;

                        if (!chartArea) {
                            return;
                        }

                        var centerX = (chartArea.left + chartArea.right) / 2;
                        var centerY = (chartArea.top + chartArea.bottom) / 2;

                        chartCtx.save();
                        chartCtx.textAlign = 'center';
                        chartCtx.textBaseline = 'middle';
                        chartCtx.font = 'bold 16px Arial';
                        chartCtx.fillStyle = '#7e8299';
                        chartCtx.fillText('لا توجد بيانات متاحة', centerX, centerY);
                        chartCtx.restore();
                    }
                }]
            });
        }
        function renderEmptyChart() {
            renderBarChart('myChart12', [], [], 'اسرع الموظفين قبول طلبات');
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
                    renderEmptyChart();
                },
                success: function(result) {
                    if (result.status == true && result.data) {
                        renderBarChart('myChart12', result.data.names13, result.data.numbers13, 'اسرع الموظفين قبول طلبات');
                    } else {
                        renderEmptyChart();
                    }
                },
                error: function() {
                    renderEmptyChart();
                },
                complete: function() {
                    $('#btn').text('بحث');
                }
            });
        }

        window.onload = function() {
            renderEmptyChart();

            $.ajax({
                type: "GET",
                url: `fastemployeeorder`,
                contentType: "application/json; charset=utf-8",
                dataType: "Json",
                success: function(result) {
                    if (result && result.data) {
                        renderBarChart('myChart12', result.data.names, result.data.numbers, 'اسرع الموظفين قبول طلبات');
                    } else {
                        renderEmptyChart();
                    }
                },
                error: function() {
                    renderEmptyChart();
                }
            });
        }
    </script>
@endsectionغ
