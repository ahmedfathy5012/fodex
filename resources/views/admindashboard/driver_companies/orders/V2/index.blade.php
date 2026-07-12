@extends('layouts.adminindex')

@section('content')
    <style>
        .company-orders-page {
            direction: rtl;
        }

        .company-orders-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
        }

        .company-orders-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 22px 26px;
        }

        .company-orders-card .card-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .company-orders-card .card-label {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            color: #181c32;
        }

        .company-orders-card .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .company-orders-card .card-icon svg path,
        .company-orders-card .card-icon svg rect {
            fill: #3699ff !important;
        }

        .company-orders-body {
            padding: 28px;
            background: #ffffff;
        }

        .company-orders-filter-section {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 22px;
        }

        .company-orders-section-title {
            font-size: 16px;
            font-weight: 800;
            color: #181c32;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .company-orders-section-title::before {
            content: "";
            width: 5px;
            height: 18px;
            border-radius: 10px;
            background: #3699ff;
            display: inline-block;
        }

        .company-orders-date-wrapper {
            max-width: 360px;
            margin: 0 auto;
            position: relative;
        }

        .company-orders-date-wrapper label {
            width: 46px;
            height: 44px;
            border-radius: 0 10px 10px 0;
            background: #3699ff;
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            right: 0;
            top: 0;
            z-index: 2;
            margin: 0;
        }

        .company-orders-date-wrapper .datepicker {
            width: 100%;
            height: 44px;
            border-radius: 10px !important;
            border: 1px solid #e4e6ef !important;
            background: #ffffff !important;
            color: #3f4254 !important;
            font-weight: 800;
            text-align: center;
            padding: 0 58px 0 14px;
            box-shadow: none !important;
            cursor: pointer;
        }

        .company-orders-date-wrapper .datepicker:focus {
            border-color: #3699ff !important;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
            outline: none;
        }

        .company-orders-search-row {
            display: flex;
            justify-content: center;
            margin-top: 18px;
        }

        .company-orders-search-btn {
            min-width: 150px;
            height: 42px;
            border-radius: 10px !important;
            background: #1bc5bd !important;
            border: 0 !important;
            color: #ffffff !important;
            font-size: 14px;
            font-weight: 800 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 8px 18px rgba(27, 197, 189, 0.22);
            transition: all 0.15s ease;
        }

        .company-orders-search-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(27, 197, 189, 0.28);
            color: #ffffff !important;
        }

        .company-orders-status-section {
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 18px;
            margin-bottom: 22px;
        }

        .company-orders-status-grid {
            display: grid;
            grid-template-columns: repeat(6, minmax(0, 1fr));
            gap: 10px;
        }

        .company-orders-status-btn {
            height: 42px;
            border-radius: 10px !important;
            border: 1px solid transparent !important;
            font-size: 13px;
            font-weight: 900 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.15s ease;
            width: 100%;
        }

        .company-orders-status-all {
            background: #eaf4ff !important;
            color: #3699ff !important;
            border-color: #b5d9ff !important;
        }

        .company-orders-status-new,
        .company-orders-status-delivered {
            background: #e8fff3 !important;
            color: #1bc5bd !important;
            border-color: #bdf4dd !important;
        }

        .company-orders-status-normal {
            background: #f3f6f9 !important;
            color: #3f4254 !important;
            border-color: #e4e6ef !important;
        }

        .company-orders-status-cancel {
            background: #fff5f6 !important;
            color: #f64e60 !important;
            border-color: #ffd0d6 !important;
        }

        .company-orders-status-btn:hover,
        .company-orders-status-btn.is-active {
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.08);
        }

        .company-orders-table-section {
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 18px;
            overflow-x: auto;
        }

        .company-orders-page table.dataTable {
            width: 100% !important;
            border-collapse: separate !important;
            border-spacing: 0 8px !important;
            margin-top: 0 !important;
        }

        .company-orders-page table.dataTable thead th {
            background: #f3f6f9;
            color: #3f4254;
            font-weight: 800;
            border: 0 !important;
            padding: 14px 12px !important;
            white-space: nowrap;
            text-align: center;
        }

        .company-orders-page table.dataTable thead th:first-child {
            border-radius: 0 10px 10px 0;
        }

        .company-orders-page table.dataTable thead th:last-child {
            border-radius: 10px 0 0 10px;
        }

        .company-orders-page table.dataTable tbody tr {
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        }

        .company-orders-page table.dataTable tbody td {
            border-top: 1px solid #edf0f5 !important;
            border-bottom: 1px solid #edf0f5 !important;
            padding: 13px 12px !important;
            vertical-align: middle !important;
            text-align: center;
            color: #3f4254;
        }

        .company-orders-page table.dataTable tbody td:first-child {
            border-right: 1px solid #edf0f5 !important;
            border-radius: 0 10px 10px 0;
        }

        .company-orders-page table.dataTable tbody td:last-child {
            border-left: 1px solid #edf0f5 !important;
            border-radius: 10px 0 0 10px;
        }

        .company-orders-page .dataTables_wrapper .dataTables_filter input {
            border-radius: 10px;
            border: 1px solid #e4e6ef;
            min-height: 38px;
            padding: 6px 12px;
            margin-right: 8px;
            box-shadow: none !important;
        }

        .company-orders-page .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #3699ff;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
            outline: none;
        }

        .company-orders-page .dataTables_wrapper .dataTables_length select {
            border-radius: 8px;
            border: 1px solid #e4e6ef;
            min-height: 36px;
            padding: 4px 8px;
        }

        .company-orders-page .dataTables_wrapper .dataTables_info {
            color: #7e8299;
            font-weight: 600;
            padding-top: 16px;
        }

        .company-orders-page .dataTables_wrapper .dataTables_paginate {
            padding-top: 14px;
        }

        .company-orders-page .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 8px !important;
            border: 0 !important;
            margin: 0 2px;
            padding: 6px 12px !important;
            color: #3f4254 !important;
            background: transparent !important;
        }

        .company-orders-page .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #3699ff !important;
            color: #ffffff !important;
        }

        .company-orders-page .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #eaf4ff !important;
            color: #3699ff !important;
        }

        @media (max-width: 992px) {
            .company-orders-status-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 576px) {
            .company-orders-body {
                padding: 18px;
            }

            .company-orders-filter-section,
            .company-orders-status-section,
            .company-orders-table-section {
                padding: 14px;
            }

            .company-orders-status-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .company-orders-search-btn {
                width: 100%;
            }
        }
    </style>

    <div class="company-orders-page">
        <div class="card card-custom gutter-b company-orders-card">
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

                    <h3 class="card-label">الطلبات</h3>
                </div>
            </div>

            <div class="card-body company-orders-body">
                <div class="company-orders-filter-section">
                    <div class="company-orders-section-title">فلترة التاريخ</div>

                    <div class="company-orders-date-wrapper">
                        <label for="datepicker">
                            <i class="fa fa-calendar"></i>
                        </label>

                        <input type="text"
                               id="datepicker"
                               name="datepicker"
                               class="datepicker"
                               readonly
                               placeholder="اختر فترة التاريخ">
                    </div>

                    <div class="company-orders-search-row">
                        <span id="btn" class="btn btn-sm btning company-orders-search-btn">بحث</span>
                    </div>
                </div>

                <div class="company-orders-status-section">
                    <div class="company-orders-section-title">حالة الطلب</div>

                    <div class="company-orders-status-grid">
                        <button type="button"
                                onclick="filterstatus('', this)"
                                class="btn company-orders-status-btn company-orders-status-all is-active">
                            الكل
                        </button>

                        <button type="button"
                                onclick="filterstatus(0, this)"
                                class="btn company-orders-status-btn company-orders-status-new">
                            جديده
                        </button>

                        <button type="button"
                                onclick="filterstatus(1, this)"
                                class="btn company-orders-status-btn company-orders-status-normal">
                            مقبوله
                        </button>

                        <button type="button"
                                onclick="filterstatus(2, this)"
                                class="btn company-orders-status-btn company-orders-status-normal">
                            تم التحضير
                        </button>

                        <button type="button"
                                onclick="filterstatus(3, this)"
                                class="btn company-orders-status-btn company-orders-status-delivered">
                            تم التسليم
                        </button>

                        <button type="button"
                                onclick="filterstatus(5, this)"
                                class="btn company-orders-status-btn company-orders-status-cancel">
                            ملغيه
                        </button>
                    </div>
                </div>

                <div class="company-orders-table-section">
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
        let selectedStatus = '';

        window.onload = function() {
            $("#datepicker").val('');
        };

        $('.datepicker').daterangepicker({
            autoApply: true,
            autoUpdateInput: false,
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

        $('.datepicker').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(
                picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD')
            );
        });

        $('.datepicker').on('cancel.daterangepicker', function() {
            $(this).val('');
        });

        function applyCompanyOrderFilters() {
            $('#dataTableBuilder').off('preXhr.dt').on('preXhr.dt', function(e, settings, data) {
                data.status = selectedStatus;
                data.from = $('#from').val();
                data.to = $('#to').val();
                data.datepicker1 = $('#datepicker').val();

                data.country_id = $('#country').val();
                data.state_id = $('#state').val();
                data.city_id = $('#city').val();
                data.zone_id = $('#zone').val();
            });

            $('#dataTableBuilder').DataTable().ajax.reload();
        }

        $("#btn").on("click", function() {
            applyCompanyOrderFilters();
            return false;
        });

        function filterstatus(status, element) {
            selectedStatus = status;

            $('.company-orders-status-btn').removeClass('is-active');

            if (element) {
                $(element).addClass('is-active');
            }

            applyCompanyOrderFilters();
        }

        function getstates(selected) {
            let id = selected.value;
            console.log(id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "get",
                url: `getstates/${id}`,
                dataType: "Json",
                success: function(result) {
                    if (result.status == true) {
                        $('#state').empty();
                        $('#state').append(result.data);
                        $('select#state').selectpicker("refresh");
                        console.log(result);
                    }
                }
            });
        }

        function getcities(selected) {
            let id = selected.value;
            console.log(id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "get",
                url: `getcities/${id}`,
                dataType: "Json",
                success: function(result) {
                    if (result.status == true) {
                        $('#city').empty();
                        $('#city').append(result.data);
                        $('select#city').selectpicker("refresh");
                        console.log(result);
                    }
                }
            });
        }

        function getzones(selected) {
            let id = selected.value;
            console.log(id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "get",
                url: `getzones/${id}`,
                dataType: "Json",
                success: function(result) {
                    if (result.status == true) {
                        $('#zone').empty();
                        $('#zone').append(result.data);
                        $('select#zone').selectpicker("refresh");
                        console.log(result);
                    }
                }
            });
        }
    </script>
@endsection
