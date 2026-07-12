<?php
$order = \App\Models\Order::where('id', $id)->first();
$drivers = \App\Models\Driver::get();
$reasons = \App\Models\RefusedReason::all();
?>

<style>
    .order-actions-inline {
        width: 360px;
        display: grid;
        grid-template-columns: 34px 34px 92px 170px;
        align-items: center;
        justify-content: center;
        gap: 7px;
        direction: rtl;
        margin: auto;
    }

    .order-action-icon-btn {
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
        color: #3699FF !important;
        cursor: pointer;
        line-height: 1;
    }

    .order-action-icon-btn:hover {
        background: #eaf4ff !important;
        border-color: #b5d9ff !important;
        color: #3699FF !important;
    }

    .order-action-icon-btn i {
        font-size: 13px;
        color: #3699FF !important;
    }

    .order-action-icon-btn img {
        width: 16px !important;
        height: 16px !important;
        object-fit: contain;
    }

    .order-action-icon-btn svg {
        width: 16px !important;
        height: 16px !important;
    }

    .order-action-icon-btn svg path,
    .order-action-icon-btn svg rect {
        fill: #3699FF !important;
    }

    .order-action-label {
        width: 100% !important;
        height: 34px !important;
        min-height: 34px !important;
        margin: 0 !important;
        padding: 0 10px !important;
        border-radius: 8px !important;
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
        font-size: 12px !important;
        font-weight: 800 !important;
        white-space: nowrap;
        cursor: pointer;
        border: 1px solid transparent !important;
        line-height: 1;
    }

    .order-action-rating {
        background: #eaf4ff !important;
        color: #3699FF !important;
        border-color: #b5d9ff !important;
    }

    .order-action-success {
        background: #e8fff3 !important;
        color: #1bc5bd !important;
        border-color: #bdf4dd !important;
    }

    .order-action-primary {
        background: #eaf4ff !important;
        color: #3699FF !important;
        border-color: #b5d9ff !important;
    }

    .order-action-danger {
        background: #fff5f6 !important;
        color: #f64e60 !important;
        border-color: #ffd0d6 !important;
    }

    .order-action-warning {
        background: #fff8dd !important;
        color: #ffa800 !important;
        border-color: #ffe7a0 !important;
    }

    .order-action-status {
        width: 170px !important;
    }

    .order-action-status-group {
        width: 170px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 6px;
    }

    .order-action-status-group .order-action-label {
        width: 100% !important;
        padding: 0 6px !important;
    }

    .order-modal-btn {
        border: 0 !important;
    }

    .fa-star.checked {
        color: orange;
    }

    .order-rate-box {
        background: #fbfcfe;
        border: 1px solid #edf0f5;
        border-radius: 12px;
        padding: 16px;
        text-align: center;
    }

    .order-rate-title {
        font-weight: 800;
        color: #3f4254;
        margin-bottom: 8px;
    }
</style>

<div class="order-actions-inline">

    <a href="{{ route('showorders', $id) }}" class="order-action-icon-btn" title="عرض">
        <i class="fas fa-eye"></i>
    </a>

    <div onclick="deleteorder({{ $id }})" class="order-action-icon-btn" title="حذف">
        <i class="fas fa-trash"></i>
    </div>

    <span class="order-action-label order-action-rating" data-toggle="modal" data-target="#myModals{{ $id }}">
        التقييم
    </span>

    @if($order->cancel == 1)
        <span class="order-action-label order-action-danger order-action-status">
            ملغى
        </span>

    @elseif($order->status == 0)
        <div class="order-action-status-group">
            <span onclick="orderstatus({{ $id }}, 1)" class="order-action-label order-action-success">
                قبول
            </span>

            <span class="order-action-label order-action-danger"
                  data-toggle="modal"
                  data-target="#myModale{{ $id }}">
                رفض
            </span>
        </div>

    @elseif($order->status == 1)
        <span class="order-action-label order-action-warning order-action-status"
              data-toggle="modal"
              data-target="#myModalaa{{ $id }}">
            قيد التحضير
        </span>

    @elseif($order->status == 2)
        <span class="order-action-label order-action-primary order-action-status">
            تم التحضير
        </span>

    @elseif($order->status == 3)
        <span class="order-action-label order-action-success order-action-status">
            تم تسليم الطلب
        </span>
    @endif
</div>

<div id="myModalp{{ $id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">السعر</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <label>السعر</label>
                        <input type="number" min="0" class="form-control" id="price{{ $id }}" value="{{ $order->price }}">
                    </div>

                    <div class="col-6">
                        <label>الخصم</label>
                        <input type="number" min="0" class="form-control" id="discount{{ $id }}" value="{{ $order->price - $order->priceafterdiscount }}">
                    </div>
                </div>

                <div class="row">
                    <button class="btn btn-primary mx-auto mt-4" onclick="editprice({{ $id }})">
                        حفظ
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" role="dialog" id="myModals{{ $id }}">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">التقييم</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="order-rate-box">
                            <p class="order-rate-title">تقييم السائق</p>

                            <p class="text2 opacity-70">
                                <?php
                                if ($order->rate) {
                                    $s = 5;
                                    $j = $s - $order->rate->delivery_rate;
                                    $e = $order->rate->delivery_rate;
                                    ?>
                                @for($i = 0; $i < $e; $i++)
                                    <span class="fa fa-star checked"></span>
                                @endfor

                                @for($i = 0; $i < $j; $i++)
                                    <span class="fa fa-star"></span>
                                @endfor

                                <span>{{ $order->rate->delivery_rate }}</span>
                                    <?php
                                } else {
                                    echo "لا يوجد تقييم";
                                }
                                ?>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="order-rate-box">
                            <p class="order-rate-title">تقييم المطعم</p>

                            <p class="text2 opacity-70">
                                <?php
                                if ($order->rate) {
                                    $s = 5;
                                    $j = $s - $order->rate->seller_rate;
                                    $e = $order->rate->seller_rate;
                                    ?>
                                @for($i = 0; $i < $e; $i++)
                                    <span class="fa fa-star checked"></span>
                                @endfor

                                @for($i = 0; $i < $j; $i++)
                                    <span class="fa fa-star"></span>
                                @endfor

                                <span>{{ $order->rate->seller_rate }}</span>
                                    <?php
                                } else {
                                    echo "لا يوجد تقييم";
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@if($order->status == 0)
    <div id="myModale{{ $id }}" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">اسباب الرفض</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <label>السبب</label>
                            <select class="form-control" style="display:block;" id="refusedreason_id{{ $id }}" data-live-search="true">
                                @foreach($reasons as $reason)
                                    <option value="{{ $reason->id }}">{{ $reason->text }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <button class="order-action-label order-action-danger order-modal-btn mx-auto mt-4"
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
    <div id="myModalaa{{ $id }}" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">الطيارين</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <select class="form-control" data-live-search="true" title="اختر طيار" id="driver_id{{ $id }}">
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-4 row">
                        <button type="button" class="btn btn-success mx-auto" onclick="choosedriver({{ $id }})">
                            ارسال
                        </button>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        Close
                    </button>
                </div>

            </div>
        </div>
    </div>
@endif

<script>
    function deleteorder(sel) {
        let id = sel;
        console.log(sel);
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
                console.log(id);

                $.ajax({
                    type: "delete",
                    url: `orders/${id}`,
                    dataType: "Json",
                    success: function(result) {
                        if (result.status == true) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
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
        console.log(sel);
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
                'driver_id': $(`#driver_id${id}`).val(),
                'refusedreason_id': $(`#refusedreason_id${id}`).val(),
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
        console.log(sel);
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
                'discount': $(`#discount${id}`).val()
            },
            success: function(result) {
                if (result.status == true) {
                    $(`#myModalp${id}`).modal('hide');

                    Swal.fire(
                        'done!',
                        'تم تغيير السعر بنحاح',
                        'success'
                    );

                    table.ajax.reload();
                }
            }
        });
    }

    function choosedriver(sel) {
        let id = sel;
        console.log(sel);
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
                'driver_id': $(`#driver_id${id}`).val()
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
        console.log(sel);
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
