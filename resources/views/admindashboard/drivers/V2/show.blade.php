@extends('layouts.adminindex')

@section('content')
    <style>
        .driver-show-page {
            direction: rtl;
        }

        .driver-show-header {
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 16px;
            padding: 22px 26px;
            margin-bottom: 22px;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
        }

        .driver-show-title {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .driver-show-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf4ff;
            color: #3699ff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .driver-show-title h3 {
            margin: 0;
            font-size: 21px;
            font-weight: 900;
            color: #181c32;
        }

        .driver-show-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .driver-show-action-btn {
            min-width: 105px;
            height: 38px;
            border-radius: 10px !important;
            font-size: 13px;
            font-weight: 900 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            gap: 7px;
            text-decoration: none !important;
            border: 1px solid transparent !important;
        }

        .driver-show-action-primary {
            background: #eaf4ff !important;
            color: #3699ff !important;
            border-color: #b5d9ff !important;
        }

        .driver-show-action-success {
            background: #e8fff3 !important;
            color: #1bc5bd !important;
            border-color: #bdf4dd !important;
        }

        .driver-show-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
            margin-bottom: 22px;
        }

        .driver-profile-box {
            padding: 26px;
            background: linear-gradient(135deg, #f3f9ff 0%, #ffffff 100%);
            border-bottom: 1px solid #edf0f5;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .driver-profile-main {
            display: flex;
            align-items: center;
            gap: 18px;
            flex-wrap: wrap;
        }

        .driver-avatar {
            width: 112px;
            height: 112px;
            border-radius: 50%;
            background: #ffffff;
            border: 4px solid #ffffff;
            box-shadow: 0 8px 24px rgba(54, 153, 255, 0.18);
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #7e8299;
            font-size: 13px;
            font-weight: 800;
            flex-shrink: 0;
        }

        .driver-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .driver-profile-info h4 {
            margin: 0;
            font-size: 23px;
            font-weight: 900;
            color: #181c32;
        }

        .driver-profile-meta {
            margin-top: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .driver-meta-badge {
            min-height: 34px;
            border-radius: 9px;
            background: #ffffff;
            color: #3f4254;
            font-size: 13px;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 12px;
            border: 1px solid #edf0f5;
        }

        .driver-description {
            margin-top: 10px;
            color: #7e8299;
            font-weight: 700;
            font-size: 13px;
        }

        .driver-stats-grid {
            padding: 24px;
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
        }

        .driver-stat-card {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 18px;
            display: flex;
            align-items: center;
            gap: 12px;
            min-height: 86px;
        }

        .driver-stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 17px;
        }

        .driver-stat-blue {
            background: #eaf4ff;
            color: #3699ff;
        }

        .driver-stat-green {
            background: #e8fff3;
            color: #1bc5bd;
        }

        .driver-stat-red {
            background: #fff5f6;
            color: #f64e60;
        }

        .driver-stat-yellow {
            background: #fff8dd;
            color: #ffa800;
        }

        .driver-stat-content span {
            display: block;
            color: #7e8299;
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .driver-stat-content strong {
            display: block;
            color: #181c32;
            font-size: 18px;
            font-weight: 900;
        }

        .driver-payment-section {
            padding: 0 24px 24px;
        }

        .driver-section-title {
            font-size: 16px;
            font-weight: 900;
            color: #181c32;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .driver-section-title::before {
            content: "";
            width: 5px;
            height: 18px;
            border-radius: 10px;
            background: #3699ff;
            display: inline-block;
        }

        .driver-months-wrapper {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .driver-month-badge {
            min-width: 74px;
            height: 30px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 900;
            cursor: pointer;
            padding: 0 10px;
            border: 1px solid transparent;
            transition: all 0.15s ease;
        }

        .driver-month-new {
            background: #e8fff3;
            color: #1bc5bd;
            border-color: #bdf4dd;
        }

        .driver-month-new:hover {
            background: #1bc5bd;
            color: #ffffff;
        }

        .driver-month-old {
            background: #eaf4ff;
            color: #3699ff;
            border-color: #b5d9ff;
        }

        .driver-month-old:hover {
            background: #3699ff;
            color: #ffffff;
        }

        .driver-payment-modal .modal-content {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 14px 40px rgba(0, 0, 0, 0.18);
            direction: rtl;
        }

        .driver-payment-modal .modal-header {
            background: #fbfcfe;
            border-bottom: 1px solid #edf0f5;
            padding: 18px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .driver-payment-modal .modal-title {
            margin: 0;
            font-size: 17px;
            font-weight: 900;
            color: #181c32;
        }

        .driver-payment-modal .close {
            margin: 0;
            padding: 0;
            color: #7e8299;
            opacity: 1;
            font-size: 26px;
            font-weight: 700;
        }

        .driver-payment-modal .modal-body {
            padding: 22px;
            background: #ffffff;
        }

        .driver-payment-modal .modal-footer {
            border-top: 1px solid #edf0f5;
            padding: 14px 22px;
            display: flex;
            justify-content: flex-start;
        }

        .driver-payment-modal label {
            font-weight: 800;
            color: #3f4254;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .driver-payment-modal .form-control {
            min-height: 42px;
            border-radius: 10px !important;
            border: 1px solid #e4e6ef !important;
            color: #3f4254 !important;
            box-shadow: none !important;
            text-align: center;
            font-weight: 700;
        }

        .driver-payment-save-btn {
            min-width: 120px;
            height: 42px;
            border-radius: 10px !important;
            background: #1bc5bd !important;
            border: 0 !important;
            color: #ffffff !important;
            font-weight: 900 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 8px 18px rgba(27, 197, 189, 0.22);
        }

        .driver-payment-close-btn {
            min-width: 100px;
            height: 40px;
            border-radius: 10px !important;
            background: #f3f6f9 !important;
            color: #3f4254 !important;
            border: 1px solid #e4e6ef !important;
            font-weight: 800 !important;
        }

        @media (max-width: 992px) {
            .driver-stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 576px) {
            .driver-show-header,
            .driver-profile-box {
                padding: 18px;
            }

            .driver-profile-main {
                justify-content: center;
                text-align: center;
                width: 100%;
            }

            .driver-show-actions {
                width: 100%;
            }

            .driver-show-action-btn {
                width: 100%;
            }

            .driver-stats-grid {
                grid-template-columns: 1fr;
                padding: 18px;
            }

            .driver-payment-section {
                padding: 0 18px 18px;
            }
        }
    </style>

    @php
        $paid = array_sum($driver->expenses->pluck('value')->toArray());
        $discountsTotal = array_sum($driver->expenses->pluck('discounts')->toArray());
        $awardsTotal = array_sum($driver->expenses->pluck('awards')->toArray());
        $acceptedOrders = count($driver->acceptorders);
        $refusedOrders = count($driver->refusedorders);
    @endphp

    <div class="driver-show-page">
        <div class="driver-show-header">
            <div class="driver-show-title">
            <span class="driver-show-icon">
                <i class="fas fa-motorcycle"></i>
            </span>
                <h3>{{ $driver->name }}</h3>
            </div>

            <div class="driver-show-actions">
                <a href="{{ route('driver.edit', $driver->id) }}" class="driver-show-action-btn driver-show-action-primary">
                    <i class="fas fa-pen"></i>
                    تعديل
                </a>

                <a href="{{ route('drivercontracts', $driver->id) }}" class="driver-show-action-btn driver-show-action-success">
                    <i class="fas fa-file-contract"></i>
                    العقود
                </a>
            </div>
        </div>

        <section id="new">
            <div class="driver-show-card">
                <div class="driver-profile-box">
                    <div class="driver-profile-main">
                        <div class="driver-avatar">
                            @if(isset($driver->image) && $driver->image)
                                <img src="{{ asset('uploads/' . $driver->image) }}" alt="driver image">
                            @else
                                لا يوجد صورة
                            @endif
                        </div>

                        <div class="driver-profile-info">
                            <h4>{{ $driver->name }}</h4>

                            <div class="driver-profile-meta">
                            <span class="driver-meta-badge">
                                <i class="fas fa-user"></i>
                                {{ $driver->name }}
                            </span>

                                <span class="driver-meta-badge">
                                <i class="fas fa-phone"></i>
                                {{ $driver->phone }}
                            </span>
                            </div>

                            @if($driver->description)
                                <div class="driver-description">{{ $driver->description }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="driver-stats-grid">
                    <div class="driver-stat-card">
                    <span class="driver-stat-icon driver-stat-green">
                        <i class="fas fa-money-bill-wave"></i>
                    </span>
                        <div class="driver-stat-content">
                            <span>المدفوع</span>
                            <strong>{{ $paid }}</strong>
                        </div>
                    </div>

                    <div class="driver-stat-card">
                    <span class="driver-stat-icon driver-stat-red">
                        <i class="fas fa-minus-circle"></i>
                    </span>
                        <div class="driver-stat-content">
                            <span>الخصومات</span>
                            <strong>{{ $discountsTotal }}</strong>
                        </div>
                    </div>

                    <div class="driver-stat-card">
                    <span class="driver-stat-icon driver-stat-yellow">
                        <i class="fas fa-gift"></i>
                    </span>
                        <div class="driver-stat-content">
                            <span>المكافأة</span>
                            <strong>{{ $awardsTotal }}</strong>
                        </div>
                    </div>

                    <div class="driver-stat-card">
                    <span class="driver-stat-icon driver-stat-blue">
                        <i class="fas fa-wallet"></i>
                    </span>
                        <div class="driver-stat-content">
                            <span>المرتب</span>
                            <strong>{{ $contract->sallary ?? '' }}</strong>
                        </div>
                    </div>

                    <div class="driver-stat-card">
                    <span class="driver-stat-icon driver-stat-blue">
                        <i class="fas fa-coins"></i>
                    </span>
                        <div class="driver-stat-content">
                            <span>أقل سعر</span>
                            <strong>{{ $contract->least_price ?? '' }}</strong>
                        </div>
                    </div>

                    <div class="driver-stat-card">
                    <span class="driver-stat-icon driver-stat-blue">
                        <i class="fas fa-percent"></i>
                    </span>
                        <div class="driver-stat-content">
                            <span>النسبة</span>
                            <strong>{{ $contract->commission ?? '' }}</strong>
                        </div>
                    </div>

                    <div class="driver-stat-card">
                    <span class="driver-stat-icon driver-stat-green">
                        <i class="fas fa-check-circle"></i>
                    </span>
                        <div class="driver-stat-content">
                            <span>الطلبات المقبولة</span>
                            <strong>{{ $acceptedOrders }}</strong>
                        </div>
                    </div>

                    <div class="driver-stat-card">
                    <span class="driver-stat-icon driver-stat-red">
                        <i class="fas fa-times-circle"></i>
                    </span>
                        <div class="driver-stat-content">
                            <span>الطلبات المرفوضة</span>
                            <strong>{{ $refusedOrders }}</strong>
                        </div>
                    </div>
                </div>

                <div class="driver-payment-section">
                    <div class="driver-section-title">دفعات الشهور</div>

                    <div class="driver-months-wrapper">
                        @php
                            $freshDriver = \App\Models\Driver::where('id', $driver->id)->first();
                            $date2 = \Carbon\Carbon::now()->subMonth()->format('Y-m-d');
                            $date1 = \Carbon\Carbon::parse($freshDriver->created_at)->format('Y-m-d');
                            $period = \Carbon\CarbonPeriod::create($date1, '1 month', $date2);
                            $months = [];

                            foreach ($period as $dt) {
                                $months[] = $dt->format("Y-m");
                            }
                        @endphp

                        @foreach($months as $month)
                            @php
                                $modalKey = str_replace('-', '', $month);

                                $expense = \App\Models\ExpenseDriver::where('driver_id', $freshDriver->id)
                                    ->where('month_date', $month)
                                    ->first();
                            @endphp

                            @if($expense)
                                @if($expense->money_left != 0)
                                    <span class="driver-month-badge driver-month-old"
                                          data-toggle="modal"
                                          data-target="#driverPaymentOld{{ $modalKey }}">
                                    {{ $month }}
                                </span>

                                    <div id="driverPaymentOld{{ $modalKey }}" class="modal fade driver-payment-modal" role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">دفع شهر {{ $month }}</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="form-group col-lg-4 col-md-6">
                                                            <label>المبلغ الكلي</label>
                                                            <input type="number" disabled value="{{ $expense->total }}" id="total{{ $modalKey }}" class="form-control">
                                                        </div>

                                                        <div class="form-group col-lg-4 col-md-6">
                                                            <label>المبلغ المدفوع</label>
                                                            <input type="number" disabled value="{{ $expense->value }}" class="form-control">
                                                        </div>

                                                        <div class="form-group col-lg-4 col-md-6">
                                                            <label>المتبقي</label>
                                                            <input type="number" disabled value="{{ $expense->money_left }}" class="form-control">
                                                        </div>

                                                        <div class="form-group col-lg-4 col-md-6">
                                                            <label>الخصم</label>
                                                            <input type="number" disabled value="{{ $expense->discounts }}" id="discounts{{ $modalKey }}" class="form-control">
                                                        </div>

                                                        <div class="form-group col-lg-4 col-md-6">
                                                            <label>المكافأة</label>
                                                            <input type="number" disabled value="{{ $expense->awards }}" id="awards{{ $modalKey }}" class="form-control">
                                                        </div>

                                                        <div class="form-group col-lg-4 col-md-6">
                                                            <label>عدد الطلبات</label>
                                                            <input type="number" disabled value="{{ $expense->ordersnumber }}" class="form-control">
                                                        </div>

                                                        <div class="form-group col-12">
                                                            <label>المبلغ</label>
                                                            <input type="number"
                                                                   required
                                                                   value="{{ $expense->money_left }}"
                                                                   max="{{ $expense->money_left }}"
                                                                   min="1"
                                                                   id="value{{ $modalKey }}"
                                                                   class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="text-center mt-3">
                                                        <input type="button"
                                                               onclick="addemplyeeexpense({{ $freshDriver->id }}, '{{ $month }}', '{{ $modalKey }}')"
                                                               value="حفظ"
                                                               class="btn driver-payment-save-btn">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn driver-payment-close-btn" data-dismiss="modal">إغلاق</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @else
                                @php
                                    $activeContract = \App\Models\DriverContract::where('driver_id', $freshDriver->id)
                                        ->where("active", 1)
                                        ->latest()
                                        ->first();

                                    $discounts = array_sum(\App\Models\Discount::where('driver_id', $freshDriver->id)
                                        ->whereYear('created_at', \Carbon\Carbon::parse($month))
                                        ->whereMonth('created_at', \Carbon\Carbon::parse($month))
                                        ->get()
                                        ->pluck('value')
                                        ->toArray());

                                    $awards = array_sum(\App\Models\Award::where('driver_id', $freshDriver->id)
                                        ->whereYear('created_at', \Carbon\Carbon::parse($month))
                                        ->whereMonth('created_at', \Carbon\Carbon::parse($month))
                                        ->get()
                                        ->pluck('value')
                                        ->toArray());

                                    $orders = $freshDriver->acceptorders()
                                        ->whereYear('created_at', \Carbon\Carbon::parse($month))
                                        ->whereMonth('created_at', \Carbon\Carbon::parse($month))
                                        ->get();

                                    $money = 0;

                                    if ($activeContract != null) {
                                        if (count($orders)) {
                                            foreach ($orders as $order) {
                                                if ($order->delivery_fee > $activeContract->least_price) {
                                                    $money += $order->delivery_fee * ($activeContract->commission / 100);
                                                } else {
                                                    $money += $activeContract->least_price;
                                                }
                                            }
                                        }
                                    }

                                    $total = $activeContract ? ($activeContract->sallary + $money) : 0;
                                    $payable = $activeContract ? (($activeContract->sallary + $awards + $money) - $discounts) : 0;
                                @endphp

                                @if($activeContract != null)
                                    <span class="driver-month-badge driver-month-new"
                                          data-toggle="modal"
                                          data-target="#driverPaymentNew{{ $modalKey }}">
                                    {{ $month }}
                                </span>

                                    <div id="driverPaymentNew{{ $modalKey }}" class="modal fade driver-payment-modal" role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">دفع شهر {{ $month }}</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="form-group col-lg-4 col-md-6">
                                                            <label>المبلغ الكلي</label>
                                                            <input type="number" disabled value="{{ $total }}" id="total{{ $modalKey }}" class="form-control">
                                                        </div>

                                                        <div class="form-group col-lg-4 col-md-6">
                                                            <label>المبلغ المدفوع</label>
                                                            <input type="number" disabled value="0" class="form-control">
                                                        </div>

                                                        <div class="form-group col-lg-4 col-md-6">
                                                            <label>الخصم</label>
                                                            <input type="number" disabled value="{{ $discounts }}" id="discounts{{ $modalKey }}" class="form-control">
                                                        </div>

                                                        <div class="form-group col-lg-4 col-md-6">
                                                            <label>المكافأة</label>
                                                            <input type="number" disabled value="{{ $awards }}" id="awards{{ $modalKey }}" class="form-control">
                                                        </div>

                                                        <div class="form-group col-lg-4 col-md-6">
                                                            <label>عدد الطلبات</label>
                                                            <input type="number" disabled value="{{ count($orders) }}" class="form-control">
                                                        </div>

                                                        <div class="form-group col-12">
                                                            <label>المبلغ</label>
                                                            <input type="number"
                                                                   required
                                                                   value="{{ $payable }}"
                                                                   max="{{ $payable }}"
                                                                   min="1"
                                                                   id="value{{ $modalKey }}"
                                                                   class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="text-center mt-3">
                                                        <input type="button"
                                                               onclick="addemplyeeexpense({{ $freshDriver->id }}, '{{ $month }}', '{{ $modalKey }}')"
                                                               value="حفظ"
                                                               class="btn driver-payment-save-btn">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn driver-payment-close-btn" data-dismiss="modal">إغلاق</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    {{ $dataTable->scripts() }}

    <script>
        function addemplyeeexpense(id, date, modalKey) {
            var table = $('.dataTable').length ? $('.dataTable').DataTable() : null;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: `../adddriverexpense`,
                dataType: "Json",
                data: {
                    'total': $(`#total${modalKey}`).val(),
                    'discounts': $(`#discounts${modalKey}`).val(),
                    'awards': $(`#awards${modalKey}`).val(),
                    'value': $(`#value${modalKey}`).val(),
                    'date': date,
                    'id': id
                },
                success: function(result) {
                    if (result.status == true) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'تم الدفع بنجاح',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        $(".modal-backdrop").remove();

                        $(`#driverPaymentOld${modalKey}`).modal('hide');
                        $(`#driverPaymentNew${modalKey}`).modal('hide');

                        $("#new").load(window.location.href + " #new > *");

                        if (table) {
                            table.ajax.reload();
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'عفوا لاتملك مال كفايه فى المحفظه',
                        });
                    }
                }
            });
        }
    </script>
@endsection
