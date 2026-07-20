@extends('layouts.adminindex')

@section('content')
    <style>
        .state-income-page {
            direction: rtl;
        }

        .state-income-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
        }

        .state-income-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 22px 26px;
        }

        .state-income-card .card-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .state-income-card .card-label {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            color: #181c32;
        }

        .state-income-card .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /*.state-income-card .card-icon svg rect,*/
        /*.state-income-card .card-icon svg path {*/
        /*    fill: #3699ff !important;*/
        /*}*/

        .state-income-body {
            padding: 28px;
            background: #ffffff;
        }

        .state-income-filter-box {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 16px;
            padding: 22px;
            margin-bottom: 28px;
        }

        .state-income-section-title {
            font-size: 16px;
            font-weight: 800;
            color: #181c32;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .state-income-section-title::before {
            content: "";
            width: 5px;
            height: 18px;
            border-radius: 10px;
            background: #3699ff;
            display: inline-block;
        }

        .state-income-page .form-group label {
            font-weight: 700;
            color: #3f4254;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .state-income-page .form-control,
        .state-income-page .bootstrap-select > .dropdown-toggle {
            min-height: 44px;
            border-radius: 10px !important;
            border: 1px solid #e4e6ef !important;
            color: #3f4254 !important;
            background: #ffffff !important;
            box-shadow: none !important;
            transition: all 0.15s ease;
        }

        .state-income-page .form-control:focus,
        .state-income-page .bootstrap-select.show > .dropdown-toggle {
            border-color: #3699ff !important;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
        }

        .state-income-page .bootstrap-select .filter-option {
            text-align: right !important;
        }

        .state-income-page .dropdown-menu {
            border-radius: 12px;
            border: 1px solid #edf0f5;
            box-shadow: 0 10px 26px rgba(0, 0, 0, 0.12);
        }

        .state-date-wrapper {
            width: 100%;
        }

        .state-date-group {
            width: 100%;
            height: 44px;
            display: flex;
            align-items: stretch;
            direction: rtl;
        }

        .state-date-button {
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

        .state-date-button:hover {
            background: #187de4;
            border-color: #187de4;
        }

        .state-date-button i {
            color: #ffffff !important;
            font-size: 16px;
            padding: 0 !important;
            margin: 0 !important;
        }

        .state-date-group .datepicker {
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

        .state-date-group .datepicker:focus {
            border-color: #e4e6ef !important;
            box-shadow: none !important;
        }

        .state-date-clear {
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

        .state-date-clear:hover {
            background: #fff5f6;
            color: #f64e60;
        }

        .daterangepicker {
            direction: rtl;
            text-align: right;
            z-index: 999999 !important;
        }

        .state-search-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 16px;
        }

        .state-search-btn {
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

        .state-search-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(54, 153, 255, 0.32);
            color: #ffffff !important;
        }

        .income-stat-card {
            position: relative;
            min-height: 160px;
            border-radius: 20px;
            padding: 22px;
            margin-bottom: 22px;
            overflow: hidden;
            box-shadow: 0 14px 32px rgba(24, 28, 50, 0.10);
            transition: all 0.18s ease;
        }

        .income-stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 38px rgba(24, 28, 50, 0.14);
        }

        .income-stat-card::before {
            content: "";
            position: absolute;
            top: -55px;
            left: -55px;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.16);
        }

        .income-stat-card::after {
            content: "";
            position: absolute;
            bottom: -70px;
            right: -70px;
            width: 170px;
            height: 170px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.12);
        }

        .income-stat-total {
            background: linear-gradient(135deg, #1C6DD0, #3699ff);
        }

        .income-stat-seller {
            background: linear-gradient(135deg, #16C79A, #20d8aa);
        }

        .income-stat-driver {
            background: linear-gradient(135deg, #e54e6b, #f06b84);
        }

        .income-stat-orders {
            background: linear-gradient(135deg, #495371, #657091);
        }

        .income-stat-content {
            position: relative;
            z-index: 2;
            height: 100%;
        }

        .income-stat-title {
            margin: 0 0 20px;
            color: #ffffff;
            font-size: 17px;
            font-weight: 900;
        }

        .income-stat-value {
            color: #ffffff;
            font-size: 28px;
            font-weight: 900;
            line-height: 1;
            word-break: break-word;
        }

        .income-stat-icon {
            position: absolute;
            left: 22px;
            bottom: 22px;
            width: 54px;
            height: 54px;
            object-fit: contain;
            filter: brightness(0) invert(1);
            opacity: 0.95;
        }

        @media (max-width: 768px) {
            .state-income-body {
                padding: 18px;
            }

            .state-income-filter-box {
                padding: 16px;
            }

            .state-search-btn {
                width: 100%;
            }

            .income-stat-card {
                min-height: 145px;
                padding: 18px;
            }

            .income-stat-value {
                font-size: 24px;
            }

            .income-stat-icon {
                width: 46px;
                height: 46px;
            }
        }
    </style>

    <div class="state-income-page">
        <div class="card card-custom gutter-b state-income-card">
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

                    <h3 class="card-label">الإيرادات الخاصة بالمحافظات</h3>
                </div>
            </div>

            <div class="card-body state-income-body">
                <div class="state-income-filter-box">
                    <div class="state-income-section-title">فلترة التقرير</div>

                    <div class="row">
                        <div class="form-group col-lg-4 col-md-6">
                            <label>المحافظة <span class="text-danger">*</span></label>
                            <select name="state_id"
                                    class="form-control selectpicker"
                                    id="state"
                                    required="required"
                                    data-live-search="true">
                                <option value="0">الكل</option>
                                @foreach(auth()->user()->states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-4 col-md-6">
                            <label>القسم العام</label>
                            <select name="major_id"
                                    class="form-control selectpicker"
                                    id="major"
                                    data-live-search="true">
                                <option value="0">الكل</option>
                                @foreach($majors as $major)
                                    <option value="{{ $major->id }}">{{ $major->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-4 col-md-12">
                            <label>فترة التقرير</label>

                            <div class="state-date-wrapper">
                                <div class="state-date-group">
                                    <button type="button"
                                            class="state-date-button"
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
                                            class="state-date-clear"
                                            id="clearDate"
                                            title="مسح التاريخ">
                                        ×
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="state-search-wrapper">
                    <span id="btn" class="btn btn-sm state-search-btn">
                        <i class="fa fa-search"></i>
                        بحث
                    </span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="income-stat-card income-stat-total">
                            <div class="income-stat-content">
                                <h3 class="income-stat-title">المبلغ الكلي</h3>
                                <div class="income-stat-value" id="total">{{ $total }}</div>
                                <img src="{{ asset('money-bag.png') }}" class="income-stat-icon" alt="total">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="income-stat-card income-stat-seller">
                            <div class="income-stat-content">
                                <h3 class="income-stat-title">النسبة من المطعم</h3>
                                <div class="income-stat-value" id="seller_commission">{{ $seller_commission }}</div>
                                <img src="{{ asset('revenue.png') }}" class="income-stat-icon" alt="seller commission">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="income-stat-card income-stat-driver">
                            <div class="income-stat-content">
                                <h3 class="income-stat-title">النسبة من الدليفري</h3>
                                <div class="income-stat-value" id="driver_commission">{{ $driver_commission }}</div>
                                <img src="{{ asset('revenue.png') }}" class="income-stat-icon" alt="driver commission">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="income-stat-card income-stat-orders">
                            <div class="income-stat-content">
                                <h3 class="income-stat-title">عدد الطلبات</h3>
                                <div class="income-stat-value" id="order_count">{{ $order_count }}</div>
                                <img src="{{ asset('order.png') }}" class="income-stat-icon" alt="orders">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
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

            $("#btn").on("click", function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "post",
                    url: `filterstate_icomes`,
                    dataType: "Json",
                    data: {
                        "datepicker": String($("#datepicker").val()),
                        "state_id": $('#state').val(),
                        "major_id": $('#major').val()
                    },
                    success: function(result) {
                        if (result.status == true) {
                            $("#total").empty();
                            $("#total").text(result.total);

                            $("#driver_commission").empty();
                            $("#driver_commission").text(result.driver_commission);

                            $("#seller_commission").empty();
                            $("#seller_commission").text(result.seller_commission);

                            $("#order_count").empty();
                            $("#order_count").text(result.order_count);
                        }
                    }
                });
            });
        });
    </script>
@endsection
