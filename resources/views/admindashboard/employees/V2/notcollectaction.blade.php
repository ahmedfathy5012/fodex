<?php
$employee = \App\Models\Employee::where('id', $id)->first();

$date2 = \Carbon\Carbon::now()->subMonth()->format('Y-m-d');
$date1 = \Carbon\Carbon::parse($employee->created_at)->format('Y-m-d');

$period = \Carbon\CarbonPeriod::create($date1, '1 month', $date2);

$aa = [];

foreach ($period as $dt) {
    $aa[] = $dt->format("Y-m");
}
?>

@once
    <style>
        .employee-expense-months-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 7px;
            direction: rtl;
            max-width: 260px;
            margin: auto;
        }

        .employee-expense-badge {
            min-width: 76px;
            height: 32px;
            border-radius: 8px !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            font-size: 12px !important;
            font-weight: 800 !important;
            cursor: pointer;
            margin: 0 !important;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.08);
            transition: all 0.15s ease;
        }

        .employee-expense-badge:hover {
            transform: translateY(-1px);
        }

        .employee-expense-badge-primary {
            background: #eaf4ff !important;
            color: #3699ff !important;
            border: 1px solid #b5d9ff !important;
        }

        .employee-expense-badge-success {
            background: #e8fff3 !important;
            color: #1bc5bd !important;
            border: 1px solid #bdf4dd !important;
        }

        .employee-expense-modal .modal-content {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.18);
        }

        .employee-expense-modal .modal-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 18px 22px;
        }

        .employee-expense-modal .modal-title {
            margin: 0;
            font-size: 18px;
            font-weight: 900;
            color: #181c32;
        }

        .employee-expense-modal .modal-body {
            padding: 22px;
            direction: rtl;
        }

        .employee-expense-modal label {
            font-size: 14px;
            font-weight: 800;
            color: #3f4254;
            margin-bottom: 8px;
        }

        .employee-expense-modal .form-control {
            min-height: 44px;
            border-radius: 10px;
            border: 1px solid #e4e6ef;
            color: #3f4254;
            box-shadow: none !important;
        }

        .employee-expense-modal .form-control:focus {
            border-color: #3699ff;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
        }

        .employee-expense-modal input[disabled] {
            background: #f3f6f9 !important;
            color: #7e8299 !important;
            font-weight: 800;
        }

        .employee-expense-save-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 18px;
        }

        .employee-expense-save-btn {
            min-width: 120px;
            height: 40px;
            border-radius: 10px !important;
            background: #1bc5bd !important;
            border: 0 !important;
            color: #ffffff !important;
            font-weight: 800 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
        }

        .employee-expense-save-btn:hover {
            color: #ffffff !important;
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(27, 197, 189, 0.25);
        }

        .employee-expense-modal .modal-footer {
            border-top: 1px solid #edf0f5;
            padding: 14px 22px;
        }

        .employee-expense-close-btn {
            min-width: 90px;
            height: 38px;
            border-radius: 9px !important;
            background: #f3f6f9 !important;
            border: 1px solid #e4e6ef !important;
            color: #3f4254 !important;
            font-weight: 800 !important;
        }

        @media (max-width: 768px) {
            .employee-expense-modal .modal-body {
                padding: 16px;
            }

            .employee-expense-modal .col-3,
            .employee-expense-modal .col-12 {
                flex: 0 0 100%;
                max-width: 100%;
                margin-bottom: 12px;
            }
        }
    </style>
@endonce

<div class="employee-expense-months-wrapper">
    @foreach($aa as $a)
            <?php
            $date3 = \Carbon\Carbon::parse($a)->format('Y-m');

            $expense = \App\Models\ExpenseEmployee::where('employee_id', $id)
                ->where('month_date', $a)
                ->first();
            ?>

        @if($expense)
            @if($expense->money_left == 0)
            @else
                <span class="badge employee-expense-badge employee-expense-badge-primary"
                      data-toggle="modal"
                      data-target="#myModale{{ $a }}">
                    {{ $a }}
                </span>

                <div id="myModale{{ $a }}" class="modal fade employee-expense-modal" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">دفع راتب شهر {{ $a }}</h4>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-3">
                                        <label>المبلغ الكلى</label>
                                        <input type="number"
                                               disabled
                                               required
                                               value="{{ $expense->total }}"
                                               id="total{{ $a }}"
                                               min="1"
                                               name="orders"
                                               class="form-control">
                                    </div>

                                    <div class="col-3">
                                        <label>المبلغ المدفوع</label>
                                        <input type="number"
                                               disabled
                                               required
                                               value="{{ $expense->value }}"
                                               min="1"
                                               name="orders"
                                               class="form-control">
                                    </div>

                                    <div class="col-3">
                                        <label>المتبقى</label>
                                        <input type="number"
                                               disabled
                                               required
                                               value="{{ $expense->money_left }}"
                                               min="1"
                                               name="orders"
                                               class="form-control">
                                    </div>

                                    <div class="col-3">
                                        <label>الخصم</label>
                                        <input type="number"
                                               required
                                               disabled
                                               value="{{ $expense->discounts }}"
                                               max="{{ $expense->discounts }}"
                                               min="1"
                                               name="orders"
                                               id="discounts{{ $a }}"
                                               class="form-control">
                                    </div>

                                    <div class="col-3 mt-4">
                                        <label>المكافأه</label>
                                        <input type="number"
                                               required
                                               disabled
                                               value="{{ $expense->awards ?? $expense->award }}"
                                               max="{{ $expense->awards ?? $expense->award }}"
                                               min="1"
                                               name="orders"
                                               id="awards{{ $a }}"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <label>المبلغ</label>
                                        <input type="number"
                                               required
                                               value="{{ $expense->money_left }}"
                                               max="{{ $expense->money_left }}"
                                               min="1"
                                               name="orders"
                                               id="value{{ $a }}"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="employee-expense-save-wrapper">
                                    <input type="button"
                                           onclick="addemplyeeexpense({{ $id }}, '{{ $a }}')"
                                           value="حفظ"
                                           class="form-control btn btn-success btn-sm employee-expense-save-btn">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button"
                                        class="btn employee-expense-close-btn"
                                        data-dismiss="modal">
                                    Close
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
        @else
                <?php
                $contract = \App\Models\Employeescontract::where('employee_id', $id)
                    ->where("active", 1)
                    ->latest()
                    ->first();

                $discounts = array_sum(
                    \App\Models\Discount::where('employee_id', $id)
                        ->whereYear('created_at', \Carbon\Carbon::parse($a))
                        ->whereMonth('created_at', \Carbon\Carbon::parse($a))
                        ->get()
                        ->pluck('value')
                        ->toArray()
                );

                $awards = array_sum(
                    \App\Models\Award::where('employee_id', $id)
                        ->whereYear('created_at', \Carbon\Carbon::parse($a))
                        ->whereMonth('created_at', \Carbon\Carbon::parse($a))
                        ->get()
                        ->pluck('value')
                        ->toArray()
                );
                ?>

            @if($contract == null)
            @else
                <span class="badge employee-expense-badge employee-expense-badge-success"
                      data-toggle="modal"
                      data-target="#myModal{{ $a }}">
                    {{ $a }}
                </span>

                <div id="myModal{{ $a }}" class="modal fade employee-expense-modal" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">دفع راتب شهر {{ $a }}</h4>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-3">
                                        <label>المبلغ الكلى</label>
                                        <input type="number"
                                               disabled
                                               required
                                               value="{{ $contract->sallary }}"
                                               min="1"
                                               name="orders"
                                               id="total{{ $a }}"
                                               class="form-control">
                                    </div>

                                    <div class="col-3">
                                        <label>المبلغ المدفوع</label>
                                        <input type="number"
                                               disabled
                                               required
                                               value="0"
                                               min="1"
                                               name="orders"
                                               class="form-control">
                                    </div>

                                    <div class="col-3">
                                        <label>الخصم</label>
                                        <input type="number"
                                               required
                                               disabled
                                               value="{{ $discounts }}"
                                               min="1"
                                               name="orders"
                                               id="discounts{{ $a }}"
                                               class="form-control">
                                    </div>

                                    <div class="col-3">
                                        <label>المكافأه</label>
                                        <input type="number"
                                               required
                                               disabled
                                               value="{{ $awards }}"
                                               min="1"
                                               name="orders"
                                               id="awards{{ $a }}"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <label>المبلغ</label>
                                        <input type="number"
                                               required
                                               value="{{ ($contract->sallary + $awards) - $discounts }}"
                                               max="{{ ($contract->sallary + $awards) - $discounts }}"
                                               min="1"
                                               name="orders"
                                               id="value{{ $a }}"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="employee-expense-save-wrapper">
                                    <input type="button"
                                           onclick="addemplyeeexpense({{ $id }}, '{{ $a }}')"
                                           value="حفظ"
                                           class="form-control btn btn-success btn-sm employee-expense-save-btn">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button"
                                        class="btn employee-expense-close-btn"
                                        data-dismiss="modal">
                                    Close
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
        function addemplyeeexpense(id, date) {
            var table = $('.dataTable').DataTable();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            console.log(date);

            $.ajax({
                type: "post",
                url: `addemplyeeexpense`,
                dataType: "Json",
                data: {
                    'total': $(`#total${date}`).val(),
                    'discounts': $(`#discounts${date}`).val(),
                    'awards': $(`#awards${date}`).val(),
                    'value': $(`#value${date}`).val(),
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

                        $(`#myModale${date}`).modal('hide');
                        $(`#myModal${date}`).modal('hide');

                        table.ajax.reload();
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
