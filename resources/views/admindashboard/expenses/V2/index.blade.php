@extends('layouts.adminindex')

@section('content')
    <style>
        .expenses-page {
            direction: rtl;
        }

        .expenses-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
        }

        .expenses-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 22px 26px;
        }

        .expenses-card .card-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .expenses-card .card-label {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            color: #181c32;
        }

        .expenses-card .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /*.expenses-card .card-icon svg rect,*/
        /*.expenses-card .card-icon svg path {*/
        /*    fill: #3699ff !important;*/
        /*}*/

        .expenses-body {
            padding: 28px;
            background: #ffffff;
        }

        .expenses-filter-box {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 16px;
            padding: 22px;
            margin-bottom: 26px;
        }

        .expenses-section-title {
            font-size: 16px;
            font-weight: 800;
            color: #181c32;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .expenses-section-title::before {
            content: "";
            width: 5px;
            height: 18px;
            border-radius: 10px;
            background: #3699ff;
            display: inline-block;
        }

        .expenses-page .form-group label {
            font-weight: 700;
            color: #3f4254;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .expenses-page .form-control,
        .expenses-page .bootstrap-select > .dropdown-toggle {
            min-height: 44px;
            border-radius: 10px !important;
            border: 1px solid #e4e6ef !important;
            color: #3f4254 !important;
            background: #ffffff !important;
            box-shadow: none !important;
            transition: all 0.15s ease;
        }

        .expenses-page .form-control:focus,
        .expenses-page .bootstrap-select.show > .dropdown-toggle {
            border-color: #3699ff !important;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
        }

        .expenses-page .bootstrap-select .filter-option {
            text-align: right !important;
        }

        .expenses-page .dropdown-menu {
            border-radius: 12px;
            border: 1px solid #edf0f5;
            box-shadow: 0 10px 26px rgba(0, 0, 0, 0.12);
        }

        .expense-date-wrapper {
            width: 100%;
        }

        .expense-date-group {
            width: 100%;
            height: 44px;
            display: flex;
            align-items: stretch;
            direction: rtl;
        }

        .expense-date-button {
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

        .expense-date-button:hover {
            background: #187de4;
            border-color: #187de4;
        }

        .expense-date-button i {
            color: #ffffff !important;
            font-size: 16px;
            padding: 0 !important;
            margin: 0 !important;
        }

        .expense-date-group .datepicker {
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

        .expense-date-group .datepicker:focus {
            border-color: #e4e6ef !important;
            box-shadow: none !important;
        }

        .expense-date-clear {
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

        .expense-date-clear:hover {
            background: #fff5f6;
            color: #f64e60;
        }

        .daterangepicker {
            direction: rtl;
            text-align: right;
            z-index: 999999 !important;
        }

        .expenses-actions-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 22px;
        }

        .expenses-search-btn,
        .expenses-add-btn {
            min-width: 150px;
            height: 44px;
            border-radius: 12px !important;
            border: 0 !important;
            color: #ffffff !important;
            font-size: 14px;
            font-weight: 900 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            text-decoration: none !important;
            transition: all 0.15s ease;
        }

        .expenses-search-btn {
            background: #3699ff !important;
            box-shadow: 0 8px 18px rgba(54, 153, 255, 0.25);
        }

        .expenses-add-btn {
            background: #1bc5bd !important;
            box-shadow: 0 8px 18px rgba(27, 197, 189, 0.22);
        }

        .expenses-search-btn:hover,
        .expenses-add-btn:hover {
            transform: translateY(-1px);
            color: #ffffff !important;
        }

        .expenses-table-section {
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 18px;
            overflow-x: auto;
        }

        .expenses-page table.dataTable {
            width: 100% !important;
            border-collapse: separate !important;
            border-spacing: 0 8px !important;
            margin-top: 0 !important;
        }

        .expenses-page table.dataTable thead th {
            background: #f3f6f9;
            color: #3f4254;
            font-weight: 800;
            border: 0 !important;
            padding: 14px 12px !important;
            white-space: nowrap;
            text-align: center;
        }

        .expenses-page table.dataTable thead th:first-child {
            border-radius: 0 10px 10px 0;
        }

        .expenses-page table.dataTable thead th:last-child {
            border-radius: 10px 0 0 10px;
        }

        .expenses-page table.dataTable tbody tr {
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        }

        .expenses-page table.dataTable tbody td {
            border-top: 1px solid #edf0f5 !important;
            border-bottom: 1px solid #edf0f5 !important;
            padding: 13px 12px !important;
            vertical-align: middle !important;
            text-align: center;
            color: #3f4254;
        }

        .expenses-page table.dataTable tbody td:first-child {
            border-right: 1px solid #edf0f5 !important;
            border-radius: 0 10px 10px 0;
        }

        .expenses-page table.dataTable tbody td:last-child {
            border-left: 1px solid #edf0f5 !important;
            border-radius: 10px 0 0 10px;
        }

        .expenses-page .dataTables_wrapper .dataTables_filter input {
            border-radius: 10px;
            border: 1px solid #e4e6ef;
            min-height: 38px;
            padding: 6px 12px;
            margin-right: 8px;
            box-shadow: none !important;
        }

        .expenses-page .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #3699ff;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
            outline: none;
        }

        .expenses-page .dataTables_wrapper .dataTables_length select {
            border-radius: 8px;
            border: 1px solid #e4e6ef;
            min-height: 36px;
            padding: 12px 24px;
        }

        .expenses-page .dataTables_wrapper .dataTables_info {
            color: #7e8299;
            font-weight: 600;
            padding-top: 16px;
        }

        .expenses-page .dataTables_wrapper .dataTables_paginate {
            padding-top: 14px;
        }

        .expenses-page .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 8px !important;
            border: 0 !important;
            margin: 0 2px;
            padding: 6px 12px !important;
            color: #3f4254 !important;
            background: transparent !important;
        }

        .expenses-page .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #3699ff !important;
            color: #ffffff !important;
        }

        .expenses-page .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #eaf4ff !important;
            color: #3699ff !important;
        }

        @media (max-width: 768px) {
            .expenses-body {
                padding: 18px;
            }

            .expenses-filter-box {
                padding: 16px;
            }

            .expenses-actions-row {
                flex-direction: column;
                align-items: stretch;
            }

            .expenses-search-btn,
            .expenses-add-btn {
                width: 100%;
            }

            .expenses-table-section {
                padding: 14px;
            }
        }
    </style>

    <div class="expenses-page">
        <div class="card card-custom gutter-b expenses-card">
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

                    <h3 class="card-label">المصروفات</h3>
                </div>
            </div>

            <div class="card-body expenses-body">
                <div class="expenses-filter-box">
                    <div class="expenses-section-title">فلترة المصروفات</div>

                    <div class="row">
                        <div class="form-group col-lg-3 col-md-6">
                            <label>الدولة <span class="text-danger">*</span></label>
                            <select name="country_id"
                                    class="form-control selectpicker"
                                    onchange="getstates(this)"
                                    id="country"
                                    required="required"
                                    data-live-search="true">
                                <option value="0">الكل</option>
                                @foreach(auth()->user()->countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-3 col-md-6">
                            <label>المحافظة <span class="text-danger">*</span></label>
                            <select name="state_id"
                                    class="form-control selectpicker"
                                    id="state"
                                    onchange="getcities(this)"
                                    required="required"
                                    data-live-search="true">
                                <option value="0">الكل</option>
                                @foreach(auth()->user()->states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-3 col-md-6">
                            <label>المدينة <span class="text-danger">*</span></label>
                            <select name="city_id"
                                    class="form-control selectpicker"
                                    onchange="getzones(this)"
                                    id="city"
                                    required="required"
                                    data-live-search="true">
                                <option value="0">الكل</option>
                                @foreach(auth()->user()->cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-3 col-md-6">
                            <label>المنطقة <span class="text-danger">*</span></label>
                            <select name="zone_id"
                                    class="form-control selectpicker"
                                    id="zone"
                                    required="required"
                                    data-live-search="true">
                                <option value="0">الكل</option>
                                @foreach(auth()->user()->zones as $zone)
                                    <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-4 col-md-8 mx-auto">
                            <label>فترة التقرير</label>

                            <div class="expense-date-wrapper">
                                <div class="expense-date-group">
                                    <button type="button"
                                            class="expense-date-button"
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
                                            class="expense-date-clear"
                                            id="clearDate"
                                            title="مسح التاريخ">
                                        ×
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="expenses-actions-row">
                    <span id="btn" class="btn btn-sm expenses-search-btn">
                        <i class="fa fa-search"></i>
                        بحث
                    </span>

                        <a class="btn btn-sm expenses-add-btn"
                           href="{{ route('expenses.create') }}">
                            <i class="fa fa-plus"></i>
                            إضافة
                        </a>
                    </div>
                </div>

                <div class="expenses-table-section">
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
                $('#dataTableBuilder').DataTable().ajax.reload();
            });

            $('#dataTableBuilder').on('preXhr.dt', function(e, settings, data) {
                data.datepicker1 = $('#datepicker').val();
                data.country_id = $('#country').val();
                data.state_id = $('#state').val();
                data.city_id = $('#city').val();
                data.zone_id = $('#zone').val();
            });

            $("#btn").on("click", function() {
                $('#dataTableBuilder').DataTable().ajax.reload();
                return false;
            });
        });

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
                success: function(result) {
                    if (result.status == true) {
                        $('#state').empty();
                        $('#state').append(result.data);
                        $('select#state').selectpicker("refresh");
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
                success: function(result) {
                    if (result.status == true) {
                        $('#city').empty();
                        $('#city').append(result.data);
                        $('select#city').selectpicker("refresh");
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
                success: function(result) {
                    if (result.status == true) {
                        $('#zone').empty();
                        $('#zone').append(result.data);
                        $('select#zone').selectpicker("refresh");
                    }
                }
            });
        }
    </script>
@endsection
