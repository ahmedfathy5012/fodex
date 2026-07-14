<?php
$major = \App\Models\Major::where("id", $id)->first();
?>

@once
    <style>
        .major-actions-inline {
            width: 190px;
            display: grid;
            grid-template-columns: 34px 34px 58px 58px;
            align-items: center;
            justify-content: center;
            gap: 7px;
            direction: rtl;
            margin: auto;
        }

        .major-action-btn {
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

        .major-action-btn:hover {
            background: #eaf4ff !important;
            border-color: #b5d9ff !important;
            color: #3699ff !important;
            transform: translateY(-1px);
        }

        .major-action-btn i {
            font-size: 13px;
            color: #3699ff !important;
        }

        .major-action-danger {
            color: #f64e60 !important;
        }

        .major-action-danger i {
            color: #f64e60 !important;
        }

        .major-action-danger:hover {
            background: #fff5f6 !important;
            border-color: #ffd0d6 !important;
            color: #f64e60 !important;
        }

        .major-action-text-btn {
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
            font-size: 11px !important;
            font-weight: 900 !important;
            cursor: pointer;
            line-height: 1;
            white-space: nowrap;
            text-decoration: none !important;
            transition: all 0.15s ease;
        }

        .major-action-offers {
            background: #eaf4ff !important;
            color: #3699ff !important;
            border: 1px solid #b5d9ff !important;
        }

        .major-action-offers:hover {
            background: #3699ff !important;
            color: #ffffff !important;
            transform: translateY(-1px);
        }

        .major-action-order {
            background: #e8fff3 !important;
            color: #1bc5bd !important;
            border: 1px solid #bdf4dd !important;
        }

        .major-action-order:hover {
            background: #1bc5bd !important;
            color: #ffffff !important;
            transform: translateY(-1px);
        }

        .major-order-modal .modal-content {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 14px 40px rgba(0, 0, 0, 0.18);
            direction: rtl;
        }

        .major-order-modal .modal-header {
            background: #fbfcfe;
            border-bottom: 1px solid #edf0f5;
            padding: 18px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .major-order-modal .modal-title {
            margin: 0;
            font-size: 17px;
            font-weight: 900;
            color: #181c32;
        }

        .major-order-modal .close {
            margin: 0;
            padding: 0;
            color: #7e8299;
            opacity: 1;
            font-size: 26px;
            font-weight: 700;
        }

        .major-order-modal .modal-body {
            padding: 22px;
            background: #ffffff;
        }

        .major-order-modal label {
            font-weight: 800;
            color: #3f4254;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .major-order-modal .form-control {
            min-height: 42px;
            border-radius: 10px !important;
            border: 1px solid #e4e6ef !important;
            box-shadow: none !important;
        }

        .major-order-modal .form-control:focus {
            border-color: #3699ff !important;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
        }

        .major-order-modal-save {
            min-width: 115px;
            height: 40px;
            border-radius: 10px !important;
            background: #1bc5bd !important;
            border: 0 !important;
            color: #ffffff !important;
            font-weight: 900 !important;
            margin-top: 14px;
        }

        .major-order-modal-close {
            min-width: 95px;
            height: 38px;
            border-radius: 10px !important;
            background: #f3f6f9 !important;
            border: 1px solid #e4e6ef !important;
            color: #3f4254 !important;
            font-weight: 800 !important;
            margin-top: 14px;
        }
    </style>
@endonce

<div class="major-actions-inline">
    <a href="{{ route('major.edit', $id) }}"
       class="major-action-btn"
       title="تعديل">
        <i class="fas fa-pen"></i>
    </a>

    <div onclick="deletemajor({{ $id }})"
         class="major-action-btn major-action-danger"
         title="حذف">
        <i class="fas fa-trash"></i>
    </div>

    <a class="major-action-text-btn major-action-offers"
       href="{{ route('majoroffers.index', $id) }}"
       title="الإعلانات">
        الاعلانات
    </a>

    <span class="major-action-text-btn major-action-order"
          data-toggle="modal"
          data-target="#myModals{{ $id }}"
          title="الترتيب">
        الترتيب
    </span>
</div>

<div id="myModals{{ $id }}" class="modal fade major-order-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ترتيب القسم</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>الترتيب</label>
                    <input type="number"
                           required
                           min="0"
                           value="{{ $major->order_number }}"
                           name="order_number"
                           id="order_number{{ $id }}"
                           class="form-control">
                </div>

                <input type="button"
                       onclick="major_order({{ $id }})"
                       value="حفظ"
                       class="btn major-order-modal-save">

                <button type="button"
                        class="btn major-order-modal-close"
                        data-dismiss="modal">
                    إغلاق
                </button>
            </div>
        </div>
    </div>
</div>

@once
    <script>
        function deletemajor(sel) {
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
                        url: `major/${id}`,
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

        function major_order(id) {
            var table = $('.dataTable').DataTable();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: `../major_order`,
                dataType: "Json",
                data: {
                    'major_id': id,
                    'order_number': $(`#order_number${id}`).val()
                },
                success: function(result) {
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
