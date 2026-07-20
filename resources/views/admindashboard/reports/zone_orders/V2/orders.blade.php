@extends('layouts.adminindex')

@section('content')
    <style>
        .zone-orders-page {
            direction: rtl;
        }

        .zone-orders-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
        }

        .zone-orders-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 22px 26px;
        }

        .zone-orders-card .card-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .zone-orders-card .card-label {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            color: #181c32;
        }

        .zone-orders-card .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /*.zone-orders-card .card-icon svg rect,*/
        /*.zone-orders-card .card-icon svg path {*/
        /*    fill: #3699ff !important;*/
        /*}*/

        .zone-orders-body {
            padding: 28px;
            background: #ffffff;
        }

        .zone-orders-filter-box {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 16px;
            padding: 22px;
            margin-bottom: 26px;
        }

        .zone-orders-section-title {
            font-size: 16px;
            font-weight: 800;
            color: #181c32;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .zone-orders-section-title::before {
            content: "";
            width: 5px;
            height: 18px;
            border-radius: 10px;
            background: #3699ff;
            display: inline-block;
        }

        .zone-orders-page .form-group label {
            font-weight: 700;
            color: #3f4254;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .zone-date-wrapper {
            width: 100%;
        }

        .zone-date-group {
            width: 100%;
            height: 44px;
            display: flex;
            align-items: stretch;
            direction: rtl;
        }

        .zone-date-button {
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

        .zone-date-button:hover {
            background: #187de4;
            border-color: #187de4;
        }

        .zone-date-button i {
            color: #ffffff !important;
            font-size: 16px;
            padding: 0 !important;
            margin: 0 !important;
        }

        .zone-date-group .datepicker {
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

        .zone-date-group .datepicker:focus {
            border-color: #e4e6ef !important;
            box-shadow: none !important;
        }

        .zone-date-clear {
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

        .zone-date-clear:hover {
            background: #fff5f6;
            color: #f64e60;
        }

        .daterangepicker {
            direction: rtl;
            text-align: right;
            z-index: 999999 !important;
        }

        .zone-search-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 16px;
        }

        .zone-search-btn {
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

        .zone-search-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(54, 153, 255, 0.32);
            color: #ffffff !important;
        }

        .zone-orders-table-section {
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 18px;
            overflow-x: auto;
        }

        .zone-orders-page table.dataTable {
            width: 100% !important;
            border-collapse: separate !important;
            border-spacing: 0 8px !important;
            margin-top: 0 !important;
        }

        .zone-orders-page table.dataTable thead th {
            background: #f3f6f9;
            color: #3f4254;
            font-weight: 800;
            border: 0 !important;
            padding: 14px 12px !important;
            white-space: nowrap;
            text-align: center;
        }

        .zone-orders-page table.dataTable thead th:first-child {
            border-radius: 0 10px 10px 0;
        }

        .zone-orders-page table.dataTable thead th:last-child {
            border-radius: 10px 0 0 10px;
        }

        .zone-orders-page table.dataTable tbody tr {
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        }

        .zone-orders-page table.dataTable tbody td {
            border-top: 1px solid #edf0f5 !important;
            border-bottom: 1px solid #edf0f5 !important;
            padding: 13px 12px !important;
            vertical-align: middle !important;
            text-align: center;
            color: #3f4254;
        }

        .zone-orders-page table.dataTable tbody td:first-child {
            border-right: 1px solid #edf0f5 !important;
            border-radius: 0 10px 10px 0;
        }

        .zone-orders-page table.dataTable tbody td:last-child {
            border-left: 1px solid #edf0f5 !important;
            border-radius: 10px 0 0 10px;
        }

        .zone-orders-page .dataTables_wrapper .dataTables_filter input {
            border-radius: 10px;
            border: 1px solid #e4e6ef;
            min-height: 38px;
            padding: 6px 12px;
            margin-right: 8px;
            box-shadow: none !important;
        }

        .zone-orders-page .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #3699ff;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
            outline: none;
        }

        .zone-orders-page .dataTables_wrapper .dataTables_length select {
            border-radius: 8px;
            border: 1px solid #e4e6ef;
            min-height: 36px;
            padding: 12px 24px;
        }

        .zone-orders-page .dataTables_wrapper .dataTables_info {
            color: #7e8299;
            font-weight: 600;
            padding-top: 16px;
        }

        .zone-orders-page .dataTables_wrapper .dataTables_paginate {
            padding-top: 14px;
        }

        .zone-orders-page .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 8px !important;
            border: 0 !important;
            margin: 0 2px;
            padding: 6px 12px !important;
            color: #3f4254 !important;
            background: transparent !important;
        }

        .zone-orders-page .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #3699ff !important;
            color: #ffffff !important;
        }

        .zone-orders-page .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #eaf4ff !important;
            color: #3699ff !important;
        }

        @media (max-width: 768px) {
            .zone-orders-body {
                padding: 18px;
            }

            .zone-orders-filter-box {
                padding: 16px;
            }

            .zone-search-btn {
                width: 100%;
            }

            .zone-orders-table-section {
                padding: 14px;
            }
        }
    </style>

    <div class="zone-orders-page">
        <div class="card card-custom gutter-b zone-orders-card">
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

                    <h3 class="card-label">طلبات المناطق</h3>
                </div>
            </div>

            <div class="card-body zone-orders-body">
                <div class="zone-orders-filter-box">
                    <div class="zone-orders-section-title">فلترة الطلبات</div>

                    <div class="row">
                        <div class="form-group col-lg-4 col-md-8 mx-auto">
                            <label>فترة التقرير</label>

                            <div class="zone-date-wrapper">
                                <div class="zone-date-group">
                                    <button type="button"
                                            class="zone-date-button"
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
                                            class="zone-date-clear"
                                            id="clearDate"
                                            title="مسح التاريخ">
                                        ×
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="zone-search-wrapper">
                    <span id="btn" class="btn btn-sm zone-search-btn">
                        <i class="fa fa-search"></i>
                        بحث
                    </span>
                    </div>
                </div>

                <div class="zone-orders-table-section">
                    {!! $dataTable->table([

                    ], true) !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{ $dataTable->scripts() }}

    <script>
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
            });

            $('#dataTableBuilder').on('preXhr.dt', function(e, settings, data) {
                data.datepicker1 = $('#datepicker').val();
            });

            $("#btn").on("click", function() {
                $('#dataTableBuilder').DataTable().ajax.reload();
            });
        });
    </script>
@endsection
