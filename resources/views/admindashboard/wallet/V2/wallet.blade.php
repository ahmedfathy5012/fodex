@extends('layouts.adminindex')

@section('content')
    <style>
        .wallet-page {
            direction: rtl;
        }

        .wallet-card {
            border: 0;
            border-radius: 16px;
            overflow: visible !important;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
        }

        .wallet-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 22px 26px;
        }

        .wallet-card .card-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .wallet-card .card-label {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            color: #181c32;
        }

        .wallet-card .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /*.wallet-card .card-icon svg rect,*/
        /*.wallet-card .card-icon svg path {*/
        /*    fill: #3699ff !important;*/
        /*}*/

        .wallet-body {
            padding: 28px;
            background: #ffffff;
            overflow: visible !important;
        }

        .wallet-stat-card {
            position: relative;
            min-height: 160px;
            border-radius: 20px;
            padding: 22px;
            margin-bottom: 22px;
            overflow: hidden;
            box-shadow: 0 14px 32px rgba(24, 28, 50, 0.10);
            transition: all 0.18s ease;
        }

        .wallet-stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 38px rgba(24, 28, 50, 0.14);
        }

        .wallet-stat-card::before {
            content: "";
            position: absolute;
            top: -55px;
            left: -55px;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.16);
        }

        .wallet-stat-card::after {
            content: "";
            position: absolute;
            bottom: -70px;
            right: -70px;
            width: 170px;
            height: 170px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.12);
        }

        .wallet-stat-expenses {
            background: linear-gradient(135deg, #1C6DD0, #3699ff);
        }

        .wallet-stat-collections {
            background: linear-gradient(135deg, #16C79A, #20d8aa);
        }

        .wallet-stat-rest {
            background: linear-gradient(135deg, #e54e6b, #f06b84);
        }

        .wallet-stat-content {
            position: relative;
            z-index: 2;
            height: 100%;
        }

        .wallet-stat-title {
            margin: 0 0 20px;
            color: #ffffff;
            font-size: 18px;
            font-weight: 900;
        }

        .wallet-stat-value {
            color: #ffffff;
            font-size: 28px;
            font-weight: 900;
            line-height: 1;
            word-break: break-word;
        }

        .wallet-stat-icon {
            position: absolute;
            left: 22px;
            bottom: 22px;
            width: 54px;
            height: 54px;
            object-fit: contain;
            filter: brightness(0) invert(1);
            opacity: 0.95;
        }

        .wallet-filter-box {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 16px;
            padding: 22px;
            margin: 8px 0 26px;
            overflow: visible !important;
            position: relative;
            z-index: 5;
        }

        .wallet-section-title {
            font-size: 16px;
            font-weight: 800;
            color: #181c32;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .wallet-section-title::before {
            content: "";
            width: 5px;
            height: 18px;
            border-radius: 10px;
            background: #3699ff;
            display: inline-block;
        }

        .wallet-page .form-group label {
            font-weight: 700;
            color: #3f4254;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .wallet-date-wrapper {
            width: 100%;
        }

        .wallet-date-group {
            width: 100%;
            height: 44px;
            display: flex;
            align-items: stretch;
            direction: rtl;
        }

        .wallet-date-button {
            width: 46px;
            min-width: 46px;
            height: 44px;
            border: 1px solid #3699ff;
            border-left: 0;
            border-radius: 0 10px 10px 0;
            background: #3699ff;
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            padding: 0;
            transition: all 0.15s ease;
        }

        .wallet-date-button:hover {
            background: #187de4;
            border-color: #187de4;
        }

        .wallet-date-button i {
            color: #ffffff !important;
            font-size: 16px;
            padding: 0 !important;
            margin: 0 !important;
        }

        .wallet-date-group .datepicker {
            width: 100% !important;
            height: 44px !important;
            min-height: 44px !important;
            border-radius: 0 !important;
            border: 1px solid #e4e6ef !important;
            border-right: 0 !important;
            border-left: 0 !important;
            background: #ffffff !important;
            color: #3f4254 !important;
            padding: 10px 14px !important;
            cursor: pointer;
            box-shadow: none !important;
            text-align: center;
        }

        .wallet-date-group .datepicker:focus {
            border-color: #e4e6ef !important;
            box-shadow: none !important;
        }

        .wallet-date-clear {
            width: 44px;
            min-width: 44px;
            height: 44px;
            border: 1px solid #e4e6ef;
            border-right: 0;
            border-radius: 10px 0 0 10px;
            background: #f3f6f9;
            color: #7e8299;
            font-size: 22px;
            font-weight: 900;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            padding: 0;
            transition: all 0.15s ease;
        }

        .wallet-date-clear:hover {
            background: #fff5f6;
            color: #f64e60;
        }

        .daterangepicker {
            direction: rtl;
            text-align: right;
            z-index: 999999 !important;
        }

        .wallet-search-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 16px;
        }

        .wallet-search-btn {
            min-width: 180px;
            height: 46px;
            border-radius: 12px !important;
            background: #3699ff !important;
            border: 0 !important;
            color: #ffffff !important;
            font-size: 15px;
            font-weight: 900 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            box-shadow: 0 8px 18px rgba(54, 153, 255, 0.25);
            transition: all 0.15s ease;
        }

        .wallet-search-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(54, 153, 255, 0.32);
            color: #ffffff !important;
        }

        .wallet-table-card {
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 16px;
            padding: 18px;
            margin-top: 24px;
        }

        .wallet-page .table {
            margin: 0;
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        .wallet-page .table thead th {
            background: #f3f6f9;
            color: #3f4254;
            font-weight: 900;
            border: 0 !important;
            padding: 14px 12px !important;
            text-align: center;
            white-space: nowrap;
        }

        .wallet-page .table thead th:first-child {
            border-radius: 0 10px 10px 0;
        }

        .wallet-page .table thead th:last-child {
            border-radius: 10px 0 0 10px;
        }

        .wallet-page .table tbody td {
            background: #ffffff;
            border-top: 1px solid #edf0f5 !important;
            border-bottom: 1px solid #edf0f5 !important;
            padding: 16px 12px !important;
            color: #3f4254;
            font-weight: 900;
            text-align: center;
            vertical-align: middle;
        }

        .wallet-page .table tbody td:first-child {
            border-right: 1px solid #edf0f5 !important;
            border-radius: 0 10px 10px 0;
        }

        .wallet-page .table tbody td:last-child {
            border-left: 1px solid #edf0f5 !important;
            border-radius: 10px 0 0 10px;
        }

        @media (max-width: 768px) {
            .wallet-body {
                padding: 18px;
            }

            .wallet-filter-box {
                padding: 16px;
            }

            .wallet-stat-card {
                min-height: 145px;
                padding: 18px;
            }

            .wallet-stat-value {
                font-size: 24px;
            }

            .wallet-stat-icon {
                width: 46px;
                height: 46px;
            }

            .wallet-search-btn {
                width: 100%;
            }
        }
    </style>

    <div class="wallet-page">
        <div class="card card-custom gutter-b wallet-card">
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

                    <h3 class="card-label">المحفظة</h3>
                </div>
            </div>

            <div class="card-body wallet-body">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="wallet-stat-card wallet-stat-expenses">
                            <div class="wallet-stat-content">
                                <h3 class="wallet-stat-title">المصروفات</h3>
                                <div class="wallet-stat-value" id="expenses_card">{{ $expenses }}</div>
                                <img src="{{ asset('expenses.png') }}" class="wallet-stat-icon" alt="expenses">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="wallet-stat-card wallet-stat-collections">
                            <div class="wallet-stat-content">
                                <h3 class="wallet-stat-title">التحصيلات</h3>
                                <div class="wallet-stat-value" id="collections_card">{{ $allcolletions }}</div>
                                <img src="{{ asset('revenue.png') }}" class="wallet-stat-icon" alt="collections">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="wallet-stat-card wallet-stat-rest">
                            <div class="wallet-stat-content">
                                <h3 class="wallet-stat-title">المتبقي</h3>
                                <div class="wallet-stat-value" id="rest_card">{{ $rest }}</div>
                                <img src="{{ asset('money-bag.png') }}" class="wallet-stat-icon" alt="rest">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wallet-filter-box">
                    <div class="wallet-section-title">فلترة المحفظة</div>

                    <div class="row">
                        <div class="form-group col-lg-4 col-md-8 mx-auto">
                            <label>فترة التقرير</label>

                            <div class="wallet-date-wrapper">
                                <div class="wallet-date-group">
                                    <button type="button"
                                            class="wallet-date-button"
                                            id="openDatePicker">
                                        <i class="fa fa-calendar"></i>
                                    </button>

                                    <input type="text"
                                           id="datepicker"
                                           name="datepicker"
                                           class="form-control datepicker"
                                           readonly
                                           placeholder="اختر فترة التقرير">

                                    <button type="button"
                                            class="wallet-date-clear"
                                            id="clearDate"
                                            title="مسح التاريخ">
                                        ×
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wallet-search-wrapper">
                        <button type="button"
                                id="btn"
                                class="btn btn-primary wallet-search-btn"
                                onclick="walletfilter()">
                            <i class="fa fa-search"></i>
                            بحث
                        </button>
                    </div>
                </div>

                <div class="wallet-table-card">
                    <div class="table-responsive">
                        <table class="table" id="invoice_table">
                            <thead>
                            <tr>
                                <th>المصروفات</th>
                                <th>التحصيلات</th>
                                <th>المتبقي</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr>
                                <td><span id="expenses"></span></td>
                                <td><span id="collections"></span></td>
                                <td><span id="rest"></span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script>
        function walletfilter() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: `walletfilter`,
                dataType: "Json",
                data: {
                    'datepicker': $("#datepicker").val(),
                },
                success: function(result) {
                    if (result.status == true) {
                        $("#expenses").empty();
                        $("#expenses").text(result.expenses);

                        $("#rest").empty();
                        $("#rest").text(result.rest);

                        $("#collections").empty();
                        $("#collections").text(result.collections);

                        $("#expenses_card").empty();
                        $("#expenses_card").text(result.expenses);

                        $("#rest_card").empty();
                        $("#rest_card").text(result.rest);

                        $("#collections_card").empty();
                        $("#collections_card").text(result.collections);
                    }
                }
            });
        }

        $(document).ready(function() {
            $("#datepicker").val('');

            $('.datepicker').daterangepicker({
                autoApply: true,
                autoUpdateInput: false,
                opens: "center",
                drops: "down",
                parentEl: "body",
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

            $("#openDatePicker").on("click", function() {
                $("#datepicker").trigger("click");
            });

            $('#datepicker').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(
                    picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD')
                );
            });

            $('#clearDate').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                $('#datepicker').val('');

                if ($('#datepicker').data('daterangepicker')) {
                    $('#datepicker').data('daterangepicker').setStartDate(moment());
                    $('#datepicker').data('daterangepicker').setEndDate(moment());
                }

                walletfilter();
            });
        });
    </script>
@endsection
