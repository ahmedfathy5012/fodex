<?php
$order = \App\Models\Order::where('id', $id)->first();

$drivers = \App\Models\Driver::has('orders_ongoing', '=', 0)->get();

$reasons = \App\Models\RefusedReason::all();
?>

@once
    <style>
        .orders-actions-wrapper {
            min-width: 240px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            flex-wrap: wrap;
            direction: rtl;
        }

        .orders-action-btn {
            width: 34px !important;
            height: 34px !important;
            min-width: 34px !important;
            min-height: 34px !important;
            padding: 0 !important;
            margin: 0 !important;
            border-radius: 8px !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            background: #f3f6f9 !important;
            border: 1px solid #e4e6ef !important;
            color: #3699ff !important;
            cursor: pointer;
            line-height: 1;
            text-decoration: none !important;
            transition: all 0.15s ease;
        }

        .orders-action-btn:hover {
            background: #eaf4ff !important;
            border-color: #b5d9ff !important;
            color: #3699ff !important;
            transform: translateY(-1px);
        }

        .orders-action-btn i {
            font-size: 13px;
            color: #3699ff !important;
        }

        .orders-action-danger {
            color: #f64e60 !important;
        }

        .orders-action-danger i {
            color: #f64e60 !important;
        }

        .orders-action-danger:hover {
            background: #fff5f6 !important;
            border-color: #ffd0d6 !important;
            color: #f64e60 !important;
        }

        .orders-action-money {
            color: #1bc5bd !important;
        }

        .orders-action-money i {
            color: #1bc5bd !important;
        }

        .orders-action-money:hover {
            background: #e8fff8 !important;
            border-color: #b8f4e7 !important;
            color: #1bc5bd !important;
        }

        .orders-statuses-wrapper {
            margin-top: 8px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
            direction: rtl;
        }

        .orders-status-badge {
            min-height: 30px;
            border-radius: 8px !important;
            padding: 7px 10px !important;
            font-size: 12px !important;
            font-weight: 800 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
            cursor: default;
        }

        .orders-clickable-badge {
            cursor: pointer !important;
            transition: all 0.15s ease;
        }

        .orders-clickable-badge:hover {
            transform: translateY(-1px);
            opacity: 0.9;
        }

        .orders-modal .modal-content {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 18px 45px rgba(0, 0, 0, 0.16);
            direction: rtl;
        }

        .orders-modal .modal-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 18px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .orders-modal .modal-title {
            margin: 0;
            color: #181c32;
            font-size: 17px;
            font-weight: 900;
        }

        .orders-modal .close {
            margin: 0;
            padding: 0;
            color: #7e8299;
            opacity: 1;
            font-size: 26px;
            font-weight: 800;
            line-height: 1;
        }

        .orders-modal .modal-body {
            padding: 22px;
            background: #fbfcfe;
        }

        .orders-modal .modal-footer {
            border-top: 1px solid #edf0f5;
            padding: 14px 22px;
            background: #ffffff;
        }

        .orders-modal label {
            font-weight: 800;
            color: #3f4254;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .orders-modal .form-control,
        .orders-modal .bootstrap-select > .dropdown-toggle {
            min-height: 44px;
            border-radius: 10px !important;
            border: 1px solid #e4e6ef !important;
            color: #3f4254 !important;
            background: #ffffff !important;
            box-shadow: none !important;
        }

        .orders-modal .form-control:focus,
        .orders-modal .bootstrap-select.show > .dropdown-toggle {
            border-color: #3699ff !important;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
        }

        .orders-modal-save-btn {
            min-width: 140px;
            height: 42px;
            border-radius: 10px !important;
            background: #3699ff !important;
            border: 0 !important;
            color: #ffffff !important;
            font-size: 14px;
            font-weight: 900 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 18px rgba(54, 153, 255, 0.22);
        }

        .orders-modal-danger-btn {
            min-width: 140px;
            height: 42px;
            border-radius: 10px !important;
            background: #f64e60 !important;
            border: 0 !important;
            color: #ffffff !important;
            font-size: 14px;
            font-weight: 900 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 18px rgba(246, 78, 96, 0.22);
        }

        .orders-modal-close-btn {
            min-width: 110px;
            height: 40px;
            border-radius: 10px !important;
            font-weight: 800 !important;
        }
    </style>
@endonce

<div class="orders-actions-wrapper">
    <a href="{{ route('showorders', $id) }}"
       class="orders-action-btn"
       title="عرض الطلب">
        <i class="fas fa-eye"></i>
    </a>

    <div onclick="deleteorder({{ $id }})"
         class="orders-action-btn orders-action-danger"
         title="حذف">
        <i class="fas fa-trash"></i>
    </div>

    <span class="orders-action-btn orders-action-money"
          data-toggle="modal"
          data-target="#myModalp{{ $id }}"
          title="تعديل السعر">
        <i class="fas fa-dollar-sign"></i>
    </span>
</div>

<div class="orders-statuses-wrapper">
    @if($order->delivery_status == 0)
        <span class="label label-lg font-weight-bold label-light-success label-inline orders-status-badge">
            السائق لم يقبل الطلب بعد
        </span>
    @elseif($order->delivery_status == 1)
        <span class="label label-lg font-weight-bold label-light-success label-inline orders-status-badge">
            السائق قبل
        </span>
    @elseif($order->delivery_status == 2)
        <span class="label label-lg font-weight-bold label-light-success label-inline orders-status-badge">
            السائق وصل للمنفذ
        </span>
    @elseif($order->delivery_status == 3)
        <span class="label label-lg font-weight-bold label-light-success label-inline orders-status-badge">
            السائق استلم الطلب
        </span>
    @elseif($order->delivery_status == 4)
        <span class="label label-lg font-weight-bold label-light-success label-inline orders-status-badge">
            السائق وصل الطلب
        </span>
    @endif

    @if($order->cancel == 1)
        <span class="label label-lg font-weight-bold label-light-danger label-inline orders-status-badge">
            ملغى
        </span>
    @endif

    @if($order->status == 4)
        <span class="label label-lg font-weight-bold label-light-danger label-inline orders-status-badge">
            مرفوض
        </span>
    @endif

    @if($order->status == 0)
        <span onclick="orderstatus({{ $id }}, 1)"
              class="label label-lg font-weight-bold label-light-success label-inline orders-status-badge orders-clickable-badge">
            قبول
        </span>

        <span class="label label-lg font-weight-bold label-light-danger label-inline orders-status-badge orders-clickable-badge"
              data-toggle="modal"
              data-target="#myModale{{ $id }}">
            رفض
        </span>
    @elseif($order->status == 1)
        <span class="label label-lg font-weight-bold label-light-warning label-inline orders-status-badge orders-clickable-badge"
              data-toggle="modal"
              data-target="#myModalaa{{ $id }}">
            قيد التحضير
        </span>
    @elseif($order->status == 2)
        <span class="label label-lg font-weight-bold label-light-primary label-inline orders-status-badge">
            السائق استلم الطلب
        </span>
    @elseif($order->status == 3)
        <span class="label label-lg font-weight-bold label-light-success label-inline orders-status-badge">
            تم تسليم الطلب
        </span>
    @endif
</div>

<div id="myModalp{{ $id }}" class="modal fade orders-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">تعديل السعر</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-6">
                        <label>السعر</label>
                        <input type="number"
                               min="0"
                               class="form-control"
                               id="price{{ $id }}"
                               value="{{ $order->price }}">
                    </div>

                    <div class="form-group col-6">
                        <label>الخصم</label>
                        <input type="number"
                               min="0"
                               class="form-control"
                               id="discount{{ $id }}"
                               value="{{ $order->price - $order->priceafterdiscount }}">
                    </div>
                </div>

                <div class="row">
                    <button class="btn orders-modal-save-btn mx-auto mt-4"
                            onclick="editprice({{ $id }})">
                        حفظ
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@if($order->status == 0)
    <div id="myModale{{ $id }}" class="modal fade orders-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">أسباب الرفض</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label>السبب</label>
                            <select class="form-control selectpicker"
                                    style="display:block;"
                                    id="refusedreason_id{{ $id }}"
                                    data-live-search="true">
                                @foreach($reasons as $reason)
                                    <option value="{{ $reason->id }}">{{ $reason->text }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <button class="btn orders-modal-danger-btn mx-auto mt-4"
                                onclick="orderstatus({{ $id }}, 2)">
                            رفض
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if($order->status == 1)
    <div id="myModalaa{{ $id }}" class="modal fade orders-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">الطيارين</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label>اختر طيار</label>
                            <select class="form-control selectpicker"
                                    data-live-search="true"
                                    title="اختر طيار"
                                    id="driver_id{{ $id }}">
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-4 row">
                        <button type="button"
                                class="btn orders-modal-save-btn mx-auto"
                                onclick="choosedriver({{ $id }})">
                            إرسال
                        </button>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-light-danger orders-modal-close-btn"
                            data-dismiss="modal">
                        إغلاق
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

@once
    <script>
        function deleteorder(sel) {
            let id = sel;
            var table = $('.dataTable').DataTable();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "delete",
                        url: `orders/${id}`,
                        dataType: "Json",
                        success: function(result) {
                            if (result.status == true) {
                                Swal.fire(
                                    'Deleted!',
                                    'تم المسح بنجاح',
                                    'success'
                                );
                            }

                            table.ajax.reload();
                        }
                    });
                }
            });
        }

        function orderstatus(sel, status) {
            let id = sel;
            var table = $('.dataTable').DataTable();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: `orderstatus`,
                dataType: "Json",
                data: {
                    "id": sel,
                    "status": status,
                    "driver_id": $(`#driver_id${id}`).val(),
                    "refusedreason_id": $(`#refusedreason_id${id}`).val(),
                },
                success: function(result) {
                    if (result.type == "accept") {
                        $(`#myModal${id}`).modal('hide');

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'تم قبول الطلب بنجاح',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else if (result.type == "refused") {
                        $(`#myModale${id}`).modal('hide');

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'تم رفض الطلب بنجاح',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }

                    table.ajax.reload();
                }
            });
        }

        function editprice(sel) {
            let id = sel;
            var table = $('.dataTable').DataTable();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: `editprice`,
                dataType: "Json",
                data: {
                    "id": sel,
                    "price": $(`#price${id}`).val(),
                    "discount": $(`#discount${id}`).val()
                },
                success: function(result) {
                    if (result.status == true) {
                        $(`#myModalp${id}`).modal('hide');

                        Swal.fire(
                            'done!',
                            'تم تغيير السعر بنجاح',
                            'success'
                        );

                        table.ajax.reload();
                    }
                }
            });
        }

        function choosedriver(sel) {
            let id = sel;
            var table = $('.dataTable').DataTable();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: `choosedriver`,
                dataType: "Json",
                data: {
                    "id": sel,
                    "driver_id": $(`#driver_id${id}`).val()
                },
                success: function(result) {
                    $(`#myModalaa${id}`).modal('hide');

                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'تم قبول الطلب بنجاح',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    table.ajax.reload();
                }
            });
        }

        function checkres(sel) {
            let id = sel;
            var table = $('.dataTable').DataTable();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "get",
                url: `checkres/${id}`,
                dataType: "Json",
                success: function(result) {
                    if (result.status == true) {
                        table.ajax.reload();
                    }
                }
            });
        }
    </script>
@endonce
