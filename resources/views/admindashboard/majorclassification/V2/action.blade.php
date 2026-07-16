<?php
$homeseller = \App\Models\MajorClassification::where('id', $id)->first();
?>

@once
    <style>
        .mc-actions-inline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            direction: rtl;
            margin: auto;
            flex-wrap: wrap;
            min-width: 190px;
        }

        .mc-action-btn {
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
            transition: .15s;
        }

        .mc-action-btn:hover {
            background: #eaf4ff !important;
            border-color: #b5d9ff !important;
            color: #3699ff !important;
            transform: translateY(-1px);
        }

        .mc-action-btn i {
            font-size: 13px;
            color: #3699ff !important;
        }

        .mc-action-danger {
            color: #f64e60 !important;
        }

        .mc-action-danger i {
            color: #f64e60 !important;
        }

        .mc-action-danger:hover {
            background: #fff5f6 !important;
            border-color: #ffd0d6 !important;
            color: #f64e60 !important;
        }

        .mc-action-pill {
            height: 34px !important;
            min-width: 62px;
            padding: 0 12px !important;
            border-radius: 8px !important;
            background: #e8fff3 !important;
            border: 1px solid #bdf4d5 !important;
            color: #1bc56e !important;
            font-size: 12px !important;
            font-weight: 800 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            text-decoration: none !important;
            transition: .15s;
        }

        .mc-action-pill:hover {
            background: #d9ffec !important;
            color: #13a95b !important;
            transform: translateY(-1px);
            text-decoration: none !important;
        }

        .mc-action-modal .modal-content {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 14px 34px rgba(0, 0, 0, .18);
        }

        .mc-action-modal .modal-header {
            border-bottom: 1px solid #edf0f5;
            background: #fff;
            padding: 18px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .mc-action-modal .modal-title {
            margin: 0;
            font-size: 17px;
            font-weight: 900;
            color: #181c32;
        }

        .mc-action-modal .close {
            margin: 0;
            padding: 0;
            opacity: 1;
            color: #7e8299;
            font-size: 26px;
        }

        .mc-action-modal .modal-body {
            padding: 24px;
            background: #fbfcfe;
        }

        .mc-action-modal .modal-footer {
            border-top: 1px solid #edf0f5;
            background: #fff;
            padding: 14px 22px;
        }

        .mc-action-modal label {
            font-weight: 800;
            color: #3f4254;
            margin-bottom: 8px;
        }

        .mc-action-modal .form-control {
            min-height: 44px;
            border-radius: 10px !important;
            border: 1px solid #e4e6ef !important;
            box-shadow: none !important;
        }

        .mc-save-order-btn {
            min-width: 120px;
            height: 42px;
            border-radius: 10px !important;
            background: #3699ff !important;
            border: 0 !important;
            color: #fff !important;
            font-weight: 900 !important;
            box-shadow: 0 8px 18px rgba(54, 153, 255, .22);
        }
    </style>
@endonce

<div class="mc-actions-inline">
    @if($homeseller->type == 1)
        <a href="{{ route('majorclassificationselect.edit', $id) }}" class="mc-action-btn" title="تعديل"><i
                class="fas fa-pen"></i></a>
    @else
        <a href="{{ route('majorclassification.edit', $id) }}" class="mc-action-btn" title="تعديل"><i
                class="fas fa-pen"></i></a>
    @endif

    <div onclick="deletemajorclassification({{ $id }})" class="mc-action-btn mc-action-danger" title="حذف"><i
            class="fas fa-trash"></i></div>

    <a href="{{ route('majoroffers', $id) }}" class="mc-action-pill">الاعلانات</a>

    <span class="mc-action-pill" data-toggle="modal" data-target="#myModals{{ $id }}">الترتيب</span>

    <a href="{{ route('majorcontents', $id) }}" class="mc-action-pill">content</a>
</div>

<div id="myModals{{ $id }}" class="modal fade mc-action-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">الترتيب</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <label>الترتيب</label>
                        <input type="number" required min="0" value="{{ $homeseller->order_number }}"
                               name="order_number" id="order_number{{ $id }}" class="form-control">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-4 col-md-6">
                        <input type="button" onclick="order_numberres({{ $id }})" value="حفظ"
                               class="form-control btn mc-save-order-btn">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light font-weight-bold" data-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>

@once
    <script>
        function deletemajorclassification(sel) {
            let id = sel;
            var table = $('.dataTable').DataTable();
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
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
                        url: `majorclassification/${id}`,
                        dataType: "Json",
                        success: function (result) {
                            if (result.status == true) {
                                Swal.fire('Deleted!', 'تم المسح بنجاح', 'success');
                            }
                            table.ajax.reload();
                        }
                    });
                }
            });
        }

        function order_numberres(sel) {
            let id = sel;
            var table = $('.dataTable').DataTable();
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                type: "post",
                url: `order_numbersellerclass1`,
                dataType: "Json",
                data: {'id': sel, 'order_number': $(`#order_number${id}`).val()},
                success: function (result) {
                    if (result.status == true) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'تم اضافه الترتيب بنجاح',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $(`#myModals${id}`).modal('hide');
                        table.ajax.reload();
                    }
                }
            });
        }
    </script>
@endonce
