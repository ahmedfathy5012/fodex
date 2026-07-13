<?php
$item = \App\Models\Item::where('id', $id)->first();
?>

@once
    <style>
        .seller-item-actions-inline {
            width: 245px;
            display: grid;
            grid-template-columns: 34px 34px 98px 58px;
            align-items: center;
            justify-content: center;
            gap: 7px;
            direction: rtl;
            margin: auto;
        }

        .seller-item-action-btn {
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

        .seller-item-action-btn:hover {
            background: #eaf4ff !important;
            border-color: #b5d9ff !important;
            color: #3699ff !important;
            transform: translateY(-1px);
        }

        .seller-item-action-btn i {
            font-size: 13px;
            color: #3699ff !important;
        }

        .seller-item-action-danger {
            color: #f64e60 !important;
        }

        .seller-item-action-danger i {
            color: #f64e60 !important;
        }

        .seller-item-action-danger:hover {
            background: #fff5f6 !important;
            border-color: #ffd0d6 !important;
            color: #f64e60 !important;
        }

        .seller-item-action-switch {
            width: 98px !important;
            height: 34px !important;
            min-width: 98px !important;
            min-height: 34px !important;
            margin: 0 !important;
            padding: 4px 8px !important;
            border-radius: 8px;
            border: 1px solid #e4e6ef;
            background: #ffffff;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
        }

        .seller-item-action-switch label {
            width: 100%;
            margin: 0;
            display: inline-flex !important;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .seller-item-action-switch h4 {
            margin: 0 !important;
            font-size: 11px;
            font-weight: 800;
            color: #3f4254;
            white-space: nowrap;
        }

        .seller-item-appear-btn {
            width: 58px !important;
            height: 34px !important;
            min-width: 58px !important;
            min-height: 34px !important;
            padding: 0 8px !important;
            margin: 0 !important;
            border-radius: 8px !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            font-size: 12px !important;
            font-weight: 900 !important;
            cursor: pointer;
            line-height: 1;
            white-space: nowrap;
            border: 1px solid transparent !important;
        }

        .seller-item-appear-show {
            background: #eaf4ff !important;
            color: #3699ff !important;
            border-color: #b5d9ff !important;
        }

        .seller-item-appear-hide {
            background: #fff5f6 !important;
            color: #f64e60 !important;
            border-color: #ffd0d6 !important;
        }

        .seller-item-reason-modal .modal-content {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 14px 40px rgba(0, 0, 0, 0.18);
            direction: rtl;
        }

        .seller-item-reason-modal .modal-header {
            background: #fbfcfe;
            border-bottom: 1px solid #edf0f5;
            padding: 18px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .seller-item-reason-modal .modal-title {
            margin: 0;
            font-size: 17px;
            font-weight: 900;
            color: #181c32;
        }

        .seller-item-reason-modal .close {
            margin: 0;
            padding: 0;
            color: #7e8299;
            opacity: 1;
            font-size: 26px;
            font-weight: 700;
        }

        .seller-item-reason-modal .modal-body {
            padding: 22px;
            background: #ffffff;
        }

        .seller-item-reason-modal label {
            font-weight: 800;
            color: #3f4254;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .seller-item-reason-modal .form-control {
            min-height: 42px;
            border-radius: 10px !important;
            border: 1px solid #e4e6ef !important;
            box-shadow: none !important;
        }

        .seller-item-modal-save {
            min-width: 110px;
            height: 40px;
            border-radius: 10px !important;
            background: #3699ff !important;
            border: 0 !important;
            color: #ffffff !important;
            font-weight: 900 !important;
            margin-top: 14px;
        }
    </style>
@endonce

<div class="seller-item-actions-inline">
    <a href="{{ route('edit_seller_items', $id) }}"
       class="seller-item-action-btn"
       title="تعديل">
        <i class="fas fa-pen"></i>
    </a>

    <div onclick="deleteitem({{ $id }})"
         class="seller-item-action-btn seller-item-action-danger"
         title="حذف">
        <i class="fas fa-trash"></i>
    </div>

    <span class="switch btn btns-m switch-outline switch-icon switch-primary seller-item-action-switch">
        <label>
            <h4>{{ $item->available == 1 ? 'متاح' : 'غير متاح' }}</h4>

            <input type="checkbox"
                   name="available"
                   onchange="availableitem({{ $id }})"
                   @if($item->available == 1) checked @endif
                   value="1"/>

            <span title="{{ $item->available == 1 ? 'متاح' : 'غير متاح' }}"></span>
        </label>
    </span>

    @if($item->appear == 0)
        <span class="seller-item-appear-btn seller-item-appear-show"
              onclick="hide({{ $id }})">
            ظهور
        </span>
    @else
        <button type="button"
                class="seller-item-appear-btn seller-item-appear-hide"
                data-toggle="modal"
                data-target="#myModal{{ $id }}">
            اخفاء
        </button>
    @endif
</div>

@if($item->appear != 0)
    <div id="myModal{{ $id }}" class="modal fade seller-item-reason-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">اسباب الاخفاء</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>السبب</label>
                        <input type="text" class="form-control" id="not_appear_reason{{ $id }}">
                    </div>

                    <input type="button"
                           onclick="hide({{ $id }})"
                           class="btn seller-item-modal-save"
                           value="حفظ">
                </div>
            </div>
        </div>
    </div>
@endif

@once
    <script>
        function deleteitem(sel) {
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
                        url: `../delete_seller_items/${id}`,
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
            var table = $('.dataTable').DataTable();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: `../hideitem`,
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

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'get',
                url: `../availableitem/${id}`,
                dataType: "Json",
                success: function(result) {
                    if (result.status == true) {
                        // table reload مش مطلوب هنا حسب اللوجيك القديم
                    }
                }
            });
        }
    </script>
@endonce
