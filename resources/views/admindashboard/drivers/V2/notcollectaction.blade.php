<?php
$driver = \App\Models\Driver::where('id', $id)->first();

$date2 = \Carbon\Carbon::now()->subMonth()->format('Y-m-d');
$date1 = \Carbon\Carbon::parse($driver->created_at)->format('Y-m-d');

$period = \Carbon\CarbonPeriod::create($date1, '1 month', $date2);

$aa = [];

foreach ($period as $dt) {
    $aa[] = $dt->format("Y-m");
}
?>

@once
    <style>
        .driver-payment-months-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            flex-wrap: wrap;
            direction: rtl;
        }

        .driver-payment-badge {
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

        .driver-payment-badge-new {
            background: #e8fff3;
            color: #1bc5bd;
            border-color: #bdf4dd;
        }

        .driver-payment-badge-new:hover {
            background: #1bc5bd;
            color: #ffffff;
        }

        .driver-payment-badge-old {
            background: #eaf4ff;
            color: #3699ff;
            border-color: #b5d9ff;
        }

        .driver-payment-badge-old:hover {
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
            gap: 10px;
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
    </style>
@endonce

<div class="driver-payment-months-wrapper">
    @foreach($aa as $a)
            <?php
            $modalKey = str_replace('-', '', $a);

            $expense = \App\Models\ExpenseDriver::where('driver_id', $id)
                ->where('month_date', $a)
                ->first();
            ?>

        @if($expense)
            @if($expense->money_left != 0)
                <span class="driver-payment-badge driver-payment-badge-old"
                      data-toggle="modal"
                      data-target="#driverPaymentOld{{ $modalKey }}">
                    {{ $a }}
                </span>

                <div id="driverPaymentOld{{ $modalKey }}" class="modal fade driver-payment-modal" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">دفع شهر {{ $a }}</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-lg-4 col-md-6">
                                        <label>المبلغ الكلى</label>
                                        <input type="number" disabled value="{{ $expense->total }}" id="total{{ $modalKey }}" class="form-control">
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6">
                                        <label>المبلغ المدفوع</label>
                                        <input type="number" disabled value="{{ $expense->value }}" class="form-control">
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6">
                                        <label>المتبقى</label>
                                        <input type="number" disabled value="{{ $expense->money_left }}" class="form-control">
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6">
                                        <label>الخصم</label>
                                        <input type="number" disabled value="{{ $expense->discounts }}" id="discounts{{ $modalKey }}" class="form-control">
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6">
                                        <label>المكافأه</label>
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
                                           onclick="addemplyeeexpense({{ $id }}, '{{ $a }}', '{{ $modalKey }}')"
                                           value="حفظ"
                                           class="btn driver-payment-save-btn">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn driver-payment-close-btn" data-dismiss="modal">
                                    إغلاق
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @else
                <?php
                $contract = \App\Models\DriverContract::where('driver_id', $id)
                    ->where("active", 1)
                    ->latest()
                    ->first();

                $discounts = array_sum(
                    \App\Models\Discount::where('driver_id', $id)
                        ->whereYear('created_at', \Carbon\Carbon::parse($a))
                        ->whereMonth('created_at', \Carbon\Carbon::parse($a))
                        ->get()
                        ->pluck('value')
                        ->toArray()
                );

                $awards = array_sum(
                    \App\Models\Award::where('driver_id', $id)
                        ->whereYear('created_at', \Carbon\Carbon::parse($a))
                        ->whereMonth('created_at', \Carbon\Carbon::parse($a))
                        ->get()
                        ->pluck('value')
                        ->toArray()
                );

                $orders = $driver->acceptorders()
                    ->whereYear('created_at', \Carbon\Carbon::parse($a))
                    ->whereMonth('created_at', \Carbon\Carbon::parse($a))
                    ->get();

                $money = 0;

                if ($contract != null) {
                    if (count($orders)) {
                        foreach ($orders as $order) {
                            if ($order->delivery_fee > $contract->least_price) {
                                $money += $order->delivery_fee * ($contract->commission / 100);
                            } else {
                                $money += $contract->least_price;
                            }
                        }
                    }
                }

                $total = $contract ? ($contract->sallary + $money) : 0;
                $payable = $contract ? (($contract->sallary + $awards + $money) - $discounts) : 0;
                ?>

            @if($contract != null)
                <span class="driver-payment-badge driver-payment-badge-new"
                      data-toggle="modal"
                      data-target="#driverPaymentNew{{ $modalKey }}">
                    {{ $a }}
                </span>

                <div id="driverPaymentNew{{ $modalKey }}" class="modal fade driver-payment-modal" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">دفع شهر {{ $a }}</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-lg-4 col-md-6">
                                        <label>المبلغ الكلى</label>
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
                                        <label>المكافأه</label>
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
                                           onclick="addemplyeeexpense({{ $id }}, '{{ $a }}', '{{ $modalKey }}')"
                                           value="حفظ"
                                           class="btn driver-payment-save-btn">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn driver-payment-close-btn" data-dismiss="modal">
                                    إغلاق
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    @endforeach
</div>

@once
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
                url: `adddriverexpense`,
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
@endonce
