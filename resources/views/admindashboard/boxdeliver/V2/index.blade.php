@extends('layouts.adminindex')

@section('content')
    <style>
        .box-deliver-page {
            direction: rtl;
        }

        .box-deliver-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
        }

        .box-deliver-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 22px 26px;
        }

        .box-deliver-card .card-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .box-deliver-card .card-label {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            color: #181c32;
        }

        .box-deliver-card .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /*.box-deliver-card .card-icon svg rect,*/
        /*.box-deliver-card .card-icon svg path {*/
        /*    fill: #3699ff !important;*/
        /*}*/

        .box-deliver-toolbar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 18px 26px 0;
        }

        .box-deliver-add-btn {
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
            transition: all 0.15s ease;
        }

        .box-deliver-add-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(54, 153, 255, 0.28);
            color: #ffffff !important;
        }

        .box-deliver-body {
            padding: 28px;
            background: #ffffff;
        }

        .box-deliver-table-section {
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 18px;
            overflow-x: auto;
        }

        .box-deliver-page table.dataTable {
            width: 100% !important;
            border-collapse: separate !important;
            border-spacing: 0 8px !important;
            margin-top: 0 !important;
        }

        .box-deliver-page table.dataTable thead th {
            background: #f3f6f9;
            color: #3f4254;
            font-weight: 800;
            border: 0 !important;
            padding: 14px 12px !important;
            white-space: nowrap;
            text-align: center;
        }

        .box-deliver-page table.dataTable thead th:first-child {
            border-radius: 0 10px 10px 0;
        }

        .box-deliver-page table.dataTable thead th:last-child {
            border-radius: 10px 0 0 10px;
        }

        .box-deliver-page table.dataTable tbody tr {
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        }

        .box-deliver-page table.dataTable tbody td {
            border-top: 1px solid #edf0f5 !important;
            border-bottom: 1px solid #edf0f5 !important;
            padding: 13px 12px !important;
            vertical-align: middle !important;
            text-align: center;
            color: #3f4254;
        }

        .box-deliver-page table.dataTable tbody td:first-child {
            border-right: 1px solid #edf0f5 !important;
            border-radius: 0 10px 10px 0;
        }

        .box-deliver-page table.dataTable tbody td:last-child {
            border-left: 1px solid #edf0f5 !important;
            border-radius: 10px 0 0 10px;
        }

        .box-deliver-page .dataTables_wrapper .dataTables_filter input {
            border-radius: 10px;
            border: 1px solid #e4e6ef;
            min-height: 38px;
            padding: 6px 12px;
            margin-right: 8px;
            box-shadow: none !important;
        }

        .box-deliver-page .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #3699ff;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
            outline: none;
        }

        .box-deliver-page .dataTables_wrapper .dataTables_length select {
            border-radius: 8px;
            border: 1px solid #e4e6ef;
            min-height: 36px;
            padding: 12px 24px;
        }

        .box-deliver-page .dataTables_wrapper .dataTables_info {
            color: #7e8299;
            font-weight: 600;
            padding-top: 16px;
        }

        .box-deliver-page .dataTables_wrapper .dataTables_paginate {
            padding-top: 14px;
        }

        .box-deliver-page .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 8px !important;
            border: 0 !important;
            margin: 0 2px;
            padding: 6px 12px !important;
            color: #3f4254 !important;
            background: transparent !important;
        }

        .box-deliver-page .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #3699ff !important;
            color: #ffffff !important;
        }

        .box-deliver-page .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #eaf4ff !important;
            color: #3699ff !important;
        }

        .btn-dating {
            position: relative;
            overflow: hidden;
        }

        .btn-dating label {
            position: absolute;
            top: 5px;
            right: 32px;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            background: #2b6ba4;
            color: #555;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.5s;
            margin: 0;
            z-index: 1;
        }

        .fa-calendar {
            padding-right: 10px;
        }

        #fsq {
            padding-left: 6px;
        }

        @media (max-width: 768px) {
            .box-deliver-toolbar {
                padding: 16px 18px 0;
            }

            .box-deliver-add-btn {
                width: 100%;
            }

            .box-deliver-body {
                padding: 18px;
            }

            .box-deliver-table-section {
                padding: 14px;
            }
        }
    </style>

    <div class="box-deliver-page">
        <div class="card card-custom gutter-b box-deliver-card">
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

                    <h3 class="card-label">تسليم الصناديق</h3>
                </div>
            </div>

            <div class="box-deliver-toolbar">
                <a class="btn btn-sm btning box-deliver-add-btn"
                   href="{{ route('boxdeliver.create') }}">
                    اضافه
                </a>
            </div>

            <div class="card-body box-deliver-body">
                <div class="box-deliver-table-section">
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

        $("#btn").on("click", function () {
            var table = $('#dataTableBuilder').DataTable();
            table.ajax.reload();
            return false;
        });

        $("#btn").on("click", function () {
            $('#dataTableBuilder').on('preXhr.dt', function (e, settings, data) {
                data.datepicker1 = $('#datepicker').val();
            });
        });
    </script>
@endsection
