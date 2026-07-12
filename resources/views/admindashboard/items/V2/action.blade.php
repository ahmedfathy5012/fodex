<?php
$item = \App\Models\Item::where('id', $id)->first();
?>

{{--<style>--}}
{{--    .item-actions-inline {--}}
{{--        width: 112px;--}}
{{--        display: inline-flex;--}}
{{--        flex-direction: column;--}}
{{--        align-items: stretch;--}}
{{--        justify-content: center;--}}
{{--        gap: 7px;--}}
{{--        direction: rtl;--}}
{{--    }--}}

{{--    .item-action-btn {--}}
{{--        width: 100% !important;--}}
{{--        height: 34px;--}}
{{--        min-width: 100% !important;--}}
{{--        min-height: 34px;--}}
{{--        padding: 0 10px !important;--}}
{{--        margin: 0 !important;--}}
{{--        border-radius: 8px !important;--}}
{{--        display: inline-flex !important;--}}
{{--        align-items: center;--}}
{{--        justify-content: center;--}}
{{--        gap: 6px;--}}
{{--        font-size: 12px !important;--}}
{{--        font-weight: 700;--}}
{{--        cursor: pointer;--}}
{{--        border: 1px solid #e4e6ef !important;--}}
{{--        background: #f3f6f9 !important;--}}
{{--        color: #3699FF !important;--}}
{{--        line-height: 1;--}}
{{--        white-space: nowrap;--}}
{{--    }--}}

{{--    .item-action-btn i {--}}
{{--        font-size: 13px;--}}
{{--        color: #3699FF !important;--}}
{{--    }--}}

{{--    .item-action-btn:hover {--}}
{{--        background: #eaf4ff !important;--}}
{{--        border-color: #b5d9ff !important;--}}
{{--        color: #3699FF !important;--}}
{{--    }--}}

{{--    .item-action-primary {--}}
{{--        background: #eaf4ff !important;--}}
{{--        color: #3699FF !important;--}}
{{--        border-color: #b5d9ff !important;--}}
{{--    }--}}

{{--    .item-action-danger {--}}
{{--        background: #fff5f6 !important;--}}
{{--        color: #f64e60 !important;--}}
{{--        border-color: #ffd0d6 !important;--}}
{{--    }--}}

{{--    .item-action-danger:hover {--}}
{{--        background: #f64e60 !important;--}}
{{--        color: #fff !important;--}}
{{--        border-color: #f64e60 !important;--}}
{{--    }--}}

{{--    .item-action-switch {--}}
{{--        width: 100% !important;--}}
{{--        min-height: 38px;--}}
{{--        margin: 0 !important;--}}
{{--        padding: 4px 8px !important;--}}
{{--        border-radius: 8px;--}}
{{--        border: 1px solid #e4e6ef;--}}
{{--        background: #ffffff;--}}
{{--        display: inline-flex !important;--}}
{{--        align-items: center;--}}
{{--        justify-content: center;--}}
{{--    }--}}

{{--    .item-action-switch label {--}}
{{--        width: 100%;--}}
{{--        margin: 0;--}}
{{--        display: inline-flex !important;--}}
{{--        align-items: center;--}}
{{--        justify-content: space-between;--}}
{{--        gap: 8px;--}}
{{--    }--}}

{{--    .item-action-switch h4 {--}}
{{--        margin: 0 !important;--}}
{{--        font-size: 12px;--}}
{{--        font-weight: 700;--}}
{{--        color: #3f4254;--}}
{{--        white-space: nowrap;--}}
{{--    }--}}

{{--    .item-action-switch input {--}}
{{--        margin: 0;--}}
{{--    }--}}

{{--    .item-action-switch > label > span {--}}
{{--        margin: 0 !important;--}}
{{--    }--}}
{{--</style>--}}
<style>
    .item-actions-inline {
        width: 235px;
        display: grid;
        grid-template-columns: 34px 34px 112px 50px;
        align-items: center;
        justify-content: center;
        gap: 7px;
        direction: rtl;
        margin: auto;
    }

    .item-action-btn {
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
        white-space: nowrap;
        font-size: 12px !important;
        font-weight: 700;
    }

    .item-action-btn i {
        font-size: 13px;
        color: #3699FF !important;
    }

    .item-action-btn:hover {
        background: #eaf4ff !important;
        border-color: #b5d9ff !important;
        color: #3699FF !important;
    }

    .item-action-switch {
        width: 112px !important;
        height: 38px !important;
        min-width: 112px !important;
        min-height: 38px !important;
        margin: 0 !important;
        padding: 4px 8px !important;
        border-radius: 8px;
        border: 1px solid #e4e6ef;
        background: #ffffff;
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
    }

    .item-action-switch label {
        width: 100%;
        margin: 0;
        display: inline-flex !important;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }

    .item-action-switch h4 {
        width: 52px;
        margin: 0 !important;
        font-size: 12px;
        font-weight: 700;
        color: #3f4254;
        white-space: nowrap;
        text-align: right;
    }

    .item-action-switch input {
        margin: 0;
    }

    .item-action-switch > label > span {
        margin: 0 !important;
    }

    .item-action-primary,
    .item-action-danger {
        width: 50px !important;
        min-width: 50px !important;
        height: 34px !important;
        padding: 0 6px !important;
    }

    .item-action-primary {
        background: #eaf4ff !important;
        color: #3699FF !important;
        border-color: #b5d9ff !important;
    }

    .item-action-danger {
        background: #f3f6f9 !important;
        color: #3699FF !important;
        border-color: #e4e6ef !important;
    }

    .item-action-danger:hover {
        background: #eaf4ff !important;
        color: #3699FF !important;
        border-color: #b5d9ff !important;
    }
</style>
<div class="item-actions-inline">
    <a href="{{ route('item.edit', $id) }}" class="btn btn-sm item-action-btn" title="تعديل">
        <i class="fas fa-pen"></i>
    </a>

    <div onclick="deleteitem({{ $id }})" class="btn btn-sm item-action-btn" title="حذف">
        <i class="fas fa-trash"></i>
    </div>

    <span class="switch btn btns-m switch-outline switch-icon switch-primary item-action-switch">
        <label>
            <h4>{{ $item->available == 1 ? 'متاح' : 'غير متاح' }}</h4>

            <input
                type="checkbox"
                name="available"
                onchange="availableitem({{ $id }})"
                @if($item->available == 1) checked @endif
                value="1"
            />

            <span title="{{ $item->available == 1 ? 'متاح' : 'غير متاح' }}"></span>
        </label>
    </span>

    @if($item->appear == 0)
        <span class="btn btn-sm item-action-btn item-action-primary" onclick="hide({{ $id }})">
            ظهور
        </span>
    @else
        <button
            type="button"
            class="btn btn-sm item-action-btn item-action-danger"
            data-toggle="modal"
            data-target="#myModal{{ $id }}"
        >
            اخفاء
        </button>

        <div id="myModal{{ $id }}" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">اسباب الاخفاء</h4>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <label>السبب</label>
                                <input type="text" class="form-control" id="not_appear_reason{{ $id }}">
                            </div>
                        </div>

                        <div class="row">
                            <input
                                type="button"
                                onclick="hide({{ $id }})"
                                class="btn btn-sm btn-primary mr-4"
                                value="حفظ"
                            >
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endif
</div>

<script>
    function deleteitem(sel) {
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
                    url: `item/${id}`,
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

    function hide(sel) {
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
            url: `hideitem`,
            dataType: "Json",
            data: {
                'id': id,
                'not_appear_reason': $(`#not_appear_reason${id}`).val(),
            },
            success: function(result) {
                if (result.status == true) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: result.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    $(`#myModal${id}`).modal('hide');
                    table.ajax.reload();
                }
            }
        });
    }

    function availableitem(sel) {
        let id = sel;
        console.log(sel);

        var table = $('.dataTable').DataTable();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'get',
            url: `availableitem/${id}`,
            dataType: "Json",
            success: function(result) {
                if (result.status == true) {
                    // table.ajax.reload();
                }
            }
        });
    }
</script>
