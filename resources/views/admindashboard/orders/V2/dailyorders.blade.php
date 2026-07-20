@extends('layouts.adminindex')

@section('content')
    <style>
        .orders-index-page {
            direction: rtl;
        }

        .orders-index-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
        }

        .orders-index-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 22px 26px;
        }

        .orders-index-card .card-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .orders-index-card .card-label {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            color: #181c32;
        }

        .orders-index-card .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /*.orders-index-card .card-icon svg path,*/
        /*.orders-index-card .card-icon svg rect {*/
        /*    fill: #3699ff !important;*/
        /*}*/

        .orders-index-body {
            padding: 28px;
            background: #ffffff;
        }

        .orders-filter-section {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 22px;
        }

        .orders-section-title {
            font-size: 16px;
            font-weight: 700;
            color: #181c32;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .orders-section-title::before {
            content: "";
            width: 5px;
            height: 18px;
            border-radius: 10px;
            background: #3699ff;
            display: inline-block;
        }

        .orders-index-page .form-group label {
            font-weight: 600;
            color: #3f4254;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .orders-index-page .form-control,
        .orders-index-page .bootstrap-select > .dropdown-toggle {
            min-height: 44px;
            border-radius: 10px !important;
            border: 1px solid #e4e6ef !important;
            color: #3f4254 !important;
            background-color: #ffffff !important;
            box-shadow: none !important;
            transition: all 0.15s ease;
        }

        .orders-index-page .form-control:focus,
        .orders-index-page .bootstrap-select.show > .dropdown-toggle {
            border-color: #3699ff !important;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
        }

        .orders-index-page .bootstrap-select .filter-option {
            text-align: right !important;
        }

        .orders-index-page .dropdown-menu {
            border-radius: 12px;
            border: 1px solid #edf0f5;
            box-shadow: 0 10px 26px rgba(0, 0, 0, 0.12);
        }

        .orders-date-wrapper {
            display: flex;
            justify-content: center;
            margin: 8px 0 18px;
        }

        .orders-date-group {
            width: 100%;
            max-width: 360px;
            height: 44px;
            display: flex;
            align-items: stretch;
            direction: rtl;
        }

        .orders-date-button {
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
            padding: 0;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .orders-date-button:hover {
            background: #187de4;
            border-color: #187de4;
        }

        .orders-date-button i {
            color: #ffffff !important;
            font-size: 16px;
            padding: 0 !important;
            margin: 0 !important;
        }

        .orders-date-group .datepicker {
            width: 100% !important;
            height: 44px !important;
            min-height: 44px !important;
            border-radius: 0 !important;
            border: 1px solid #e4e6ef !important;
            border-right: 0 !important;
            border-left: 0 !important;
            padding: 10px 14px !important;
            color: #3f4254 !important;
            background: #ffffff !important;
            box-shadow: none !important;
            cursor: pointer;
            text-align: center;
        }

        .orders-date-group .datepicker:focus {
            border-color: #e4e6ef !important;
            box-shadow: none !important;
        }

        .orders-date-clear {
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

        .orders-date-clear:hover {
            background: #fff5f6;
            color: #f64e60;
        }

        .orders-search-row {
            display: flex;
            justify-content: center;
            margin-top: 6px;
        }

        .orders-search-btn {
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

        .orders-search-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(27, 197, 189, 0.28);
            color: #ffffff !important;
        }

        .orders-status-section {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 18px;
            margin-bottom: 22px;
        }

        .orders-status-btn {
            min-height: 42px;
            border-radius: 10px !important;
            border: 0 !important;
            font-weight: 800 !important;
            font-size: 13px;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.08);
            transition: all 0.15s ease;
        }

        .orders-status-btn:hover {
            transform: translateY(-1px);
            color: #ffffff !important;
        }

        .orders-table-section {
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 18px;
            overflow-x: auto;
        }

        .orders-index-page table.dataTable {
            width: 100% !important;
            border-collapse: separate !important;
            border-spacing: 0 8px !important;
            margin-top: 0 !important;
        }

        .orders-index-page table.dataTable thead th {
            background: #f3f6f9;
            color: #3f4254;
            font-weight: 800;
            border: 0 !important;
            padding: 14px 12px !important;
            white-space: nowrap;
            text-align: center;
        }

        .orders-index-page table.dataTable thead th:first-child {
            border-radius: 0 10px 10px 0;
        }

        .orders-index-page table.dataTable thead th:last-child {
            border-radius: 10px 0 0 10px;
        }

        .orders-index-page table.dataTable tbody tr {
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        }

        .orders-index-page table.dataTable tbody td {
            border-top: 1px solid #edf0f5 !important;
            border-bottom: 1px solid #edf0f5 !important;
            padding: 13px 12px !important;
            vertical-align: middle !important;
            text-align: center;
            color: #3f4254;
        }

        .orders-index-page table.dataTable tbody td:first-child {
            border-right: 1px solid #edf0f5 !important;
            border-radius: 0 10px 10px 0;
        }

        .orders-index-page table.dataTable tbody td:last-child {
            border-left: 1px solid #edf0f5 !important;
            border-radius: 10px 0 0 10px;
        }

        .orders-index-page .dataTables_wrapper .dataTables_filter input {
            border-radius: 10px;
            border: 1px solid #e4e6ef;
            min-height: 38px;
            padding: 6px 12px;
            margin-right: 8px;
            box-shadow: none !important;
        }

        .orders-index-page .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #3699ff;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
        }

        .orders-index-page .dataTables_wrapper .dataTables_length select {
            border-radius: 8px;
            border: 1px solid #e4e6ef;
            min-height: 36px;
            padding: 4px 8px;
        }

        .orders-index-page .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 8px !important;
            border: 0 !important;
            margin: 0 2px;
            padding: 6px 12px !important;
            color: #3f4254 !important;
        }

        .orders-index-page .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #3699ff !important;
            color: #ffffff !important;
        }

        .orders-index-page .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #eaf4ff !important;
            color: #3699ff !important;
        }

        @media (max-width: 768px) {
            .orders-index-body {
                padding: 18px;
            }

            .orders-filter-section,
            .orders-status-section {
                padding: 16px;
            }

            .orders-search-btn {
                width: 100%;
            }
        }
    </style>

    <div class="orders-index-page">
        <div class="card card-custom gutter-b orders-index-card">
            <div class="card-header">
                <div class="card-title">
                <span class="card-icon">
                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5"/>
                                <path d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L18.5,10 C19.3284271,10 20,10.6715729 20,11.5 C20,12.3284271 19.3284271,13 18.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z" fill="#000000" opacity="0.3"/>
                            </g>
                        </svg>
                    </span>
                </span>

                    <h3 class="card-label">طلبات اليوم</h3>
                </div>
            </div>

            <div class="card-body orders-index-body">
                <div class="orders-filter-section">
                    <div class="orders-section-title">فلترة طلبات اليوم</div>

                    <div class="row">
                        <x-filter-component :states-url="url('getstates')" :cities-url="url('getcities')" :zones-url="url('getzones')" />

                        <div class="form-group col-lg-3 col-md-6">
                            <label>القسم العام</label>
                            <select name="major_id" class="form-control selectpicker" id="major" data-live-search="true">
                                <option value="0">الكل</option>
                                @foreach($majors as $major)
                                    <option value="{{$major->id}}">{{$major->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="orders-date-wrapper">
                        <div class="orders-date-group">
                            <button type="button" class="orders-date-button" id="openDatePicker">
                                <i class="fa fa-calendar"></i>
                            </button>

                            <input type="text" id="datepicker" name="datepicker"
                                   class="form-control datepicker" readonly
                                   placeholder="اختر فترة التقرير">

                            <button type="button" class="orders-date-clear" id="clearDate" title="مسح التاريخ">
                                ×
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 orders-search-row">
                            <span id="btn" class="btn btn-sm mt-4 btning orders-search-btn">بحث</span>
                        </div>
                    </div>
                </div>

                <div class="orders-status-section">
                    <div class="orders-section-title">حالة الطلب</div>

                    <div class="row">
                        <div class="col-md-2 col-sm-4 mb-3">
                            <button type="button" onclick="filterstatus('')" class="btn btn-primary w-100 d-flex justify-content-center align-items-center orders-status-btn">
                                الكل
                            </button>
                        </div>

                        <div class="col-md-2 col-sm-4 mb-3">
                            <button type="button" onclick="filterstatus(0)" class="btn btn-success w-100 d-flex justify-content-center align-items-center orders-status-btn">
                                جديده
                            </button>
                        </div>

                        <div class="col-md-2 col-sm-4 mb-3">
                            <button type="button" onclick="filterstatus(1)" class="btn btn-primary w-100 d-flex justify-content-center align-items-center orders-status-btn">
                                مقبوله
                            </button>
                        </div>

                        <div class="col-md-2 col-sm-4 mb-3">
                            <button type="button" onclick="filterstatus(2)" class="btn btn-primary w-100 d-flex justify-content-center align-items-center orders-status-btn">
                                تم التحضير
                            </button>
                        </div>

                        <div class="col-md-2 col-sm-4 mb-3">
                            <button type="button" onclick="filterstatus(3)" class="btn btn-success w-100 d-flex justify-content-center align-items-center orders-status-btn">
                                تم التسليم
                            </button>
                        </div>

                        <div class="col-md-2 col-sm-4 mb-3">
                            <button type="button" onclick="filterstatus(5)" class="btn btn-danger w-100 d-flex justify-content-center align-items-center orders-status-btn">
                                ملغيه
                            </button>
                        </div>
                    </div>
                </div>

                <div class="orders-table-section">
                    {!! $dataTable->table([

                    ],true) !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{$dataTable->scripts()}}

    <script>
        window.onload = function(){
            $("#datepicker").val('');
        }

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
                daysOfWeek: ["ح", "ن", "ث", "ر", "خ", "ج", "س"],
                monthNames: [
                    "يناير", "فبراير", "مارس", "أبريل", "مايو", "يونيو",
                    "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"
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

        function getstates(selected){
            let id = selected.value;
            console.log(id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:"get",
                url: `getstates/${id}`,
                dataType: "Json",
                success: function(result){
                    if(result.status == true){
                        $('#state').empty();
                        $('#state').append(result.data);
                        $('select#state').selectpicker("refresh");
                        console.log(result);
                    }
                }
            });
        }

        function getcities(selected){
            let id = selected.value;
            console.log(id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:"get",
                url: `getcities/${id}`,
                dataType: "Json",
                success: function(result){
                    if(result.status == true){
                        $('#city').empty();
                        $('#city').append(result.data);
                        $('select#city').selectpicker("refresh");
                        console.log(result);
                    }
                }
            });
        }

        function getzones(selected){
            let id = selected.value;
            console.log(id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:"get",
                url: `getzones/${id}`,
                dataType: "Json",
                success: function(result){
                    if(result.status == true){
                        $('#zone').empty();
                        $('#zone').append(result.data);
                        $('select#zone').selectpicker("refresh");
                        console.log(result);
                    }
                }
            });
        }

        $("#btn").on("click",function(){
            $('#dataTableBuilder').off('preXhr.dt').on('preXhr.dt', function ( e, settings, data ) {
                data.from = $('#from').val();
                data.to = $('#to').val();
                data.datepicker1 = $('#datepicker').val();

                console.log($('#datepicker').val());

                data.country_id = $('#country').val();
                data.state_id = $('#state').val();
                data.city_id = $('#city').val();
                data.zone_id = $('#zone').val();
                data.major_id = $('#major').val();
            });

            $('#dataTableBuilder').DataTable().ajax.reload();
        });

        function filterstatus(status) {
            $('#dataTableBuilder').off('preXhr.dt').on('preXhr.dt', function(e, settings, data) {
                data.status = status;
                data.from = $('#from').val();
                data.to = $('#to').val();
                data.datepicker1 = $('#datepicker').val();

                console.log($('#datepicker').val());

                data.country_id = $('#country').val();
                data.state_id = $('#state').val();
                data.city_id = $('#city').val();
                data.zone_id = $('#zone').val();
                data.major_id = $('#major').val();
            });

            $('#dataTableBuilder').DataTable().ajax.reload();
        }
    </script>
@endsection
