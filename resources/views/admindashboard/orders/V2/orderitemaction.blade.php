<?php
$orderitem = \App\Models\OrderItem::where('id', $id)->first();
?>

<style>
    .order-item-actions-inline {
        width: 125px;
        display: grid;
        grid-template-columns: 34px 84px;
        align-items: center;
        justify-content: center;
        gap: 7px;
        direction: rtl;
        margin: auto;
    }

    .order-item-action-icon {
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

    .order-item-action-icon i {
        font-size: 13px;
        color: #3699FF !important;
    }

    .order-item-action-icon:hover {
        background: #eaf4ff !important;
        border-color: #b5d9ff !important;
        color: #3699FF !important;
    }

    .order-item-action-btn {
        width: 84px !important;
        height: 34px !important;
        min-height: 34px !important;
        padding: 0 10px !important;
        margin: 0 !important;
        border-radius: 8px !important;
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
        font-size: 12px !important;
        font-weight: 800 !important;
        white-space: nowrap;
        cursor: pointer;
        line-height: 1;
        border: 1px solid #ffd0d6 !important;
        background: #fff5f6 !important;
        color: #f64e60 !important;
    }

    .order-item-action-btn:hover {
        background: #f64e60 !important;
        color: #ffffff !important;
        border-color: #f64e60 !important;
    }

    .order-item-modal .modal-content {
        border: 0;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.18);
    }

    .order-item-modal .modal-header {
        border-bottom: 1px solid #edf0f5;
        background: #ffffff;
        padding: 18px 22px;
    }

    .order-item-modal .modal-title {
        margin: 0;
        font-size: 18px;
        font-weight: 800;
        color: #181c32;
    }

    .order-item-modal .modal-body {
        padding: 22px;
        direction: rtl;
    }

    .order-item-modal label {
        font-size: 14px;
        font-weight: 700;
        color: #3f4254;
        margin-bottom: 8px;
    }

    .order-item-modal .form-control,
    .order-item-quantity-input {
        width: 100%;
        min-height: 44px;
        border-radius: 10px;
        border: 1px solid #e4e6ef;
        color: #3f4254;
        padding: 8px 12px;
        outline: none;
        box-shadow: none !important;
    }

    .order-item-modal .form-control:focus,
    .order-item-quantity-input:focus {
        border-color: #3699FF;
        box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
    }

    .order-item-save-btn {
        min-width: 120px;
        height: 40px;
        border-radius: 10px !important;
        background: #3699FF !important;
        border: 0 !important;
        color: #ffffff !important;
        font-weight: 800 !important;
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
    }
</style>

<div class="order-item-actions-inline">
    <div onclick="deleteitemorder({{ $id }})" class="btn btn-sm order-item-action-icon" title="حذف">
        <i class="fas fa-trash"></i>
    </div>

    <span class="btn btn-sm order-item-action-btn" data-toggle="modal" data-target="#myModale{{ $id }}">
        الكميه
    </span>
</div>

<div id="myModale{{ $id }}" class="modal fade order-item-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">الكميه</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label>الكميه</label>
                        <input
                            type="number"
                            value="{{ $orderitem->quantity }}"
                            min="1"
                            id="quantity{{ $id }}"
                            class="order-item-quantity-input"
                        >
                    </div>
                </div>

                <div class="row">
                    <button class="btn order-item-save-btn mx-auto mt-4" onclick="changequantity({{ $id }})">
                        حفظ
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function deleteitemorder(sel) {
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
                    url: `../deleteitemorder/${id}`,
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
                        $(".mt-5").load(`https://fodex.dawena.net/public/showorders/${result.order_id} .mt-5`);
                    }
                });
            }
        });
    }

    function changequantity(sel) {
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
            url: `../changequantity`,
            dataType: "Json",
            data: {
                "id": sel,
                "quantity": $(`#quantity${id}`).val()
            },
            success: function(result) {
                $(`#myModale${id}`).modal('hide');

                table.ajax.reload();
                $(".mt-5").load(`https://fodex.dawena.net/public/showorders/${result.order_id} .mt-5`);
            }
        });
    }
</script>
