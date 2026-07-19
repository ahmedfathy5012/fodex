@php
    $seller = \App\Models\Seller::where('id', $id)->first();
    $home_id = Route::current()->parameters['id'];
    $homeseller = \App\Models\MajorclassificationcontentSeller::where('id', $id)->first();
@endphp

@once
    <style>
        .major-content-seller-actions {
            width: 92px;
            display: grid;
            grid-template-columns: 34px 46px;
            align-items: center;
            justify-content: center;
            gap: 7px;
            direction: rtl;
            margin: auto;
        }

        .major-content-seller-action-btn {
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

        .major-content-seller-action-btn:hover {
            background: #eaf4ff !important;
            border-color: #b5d9ff !important;
            color: #3699ff !important;
            transform: translateY(-1px);
        }

        .major-content-seller-action-btn i {
            font-size: 13px;
            color: #3699ff !important;
        }

        .major-content-seller-action-danger {
            color: #f64e60 !important;
        }

        .major-content-seller-action-danger i {
            color: #f64e60 !important;
        }

        .major-content-seller-action-danger:hover {
            background: #fff5f6 !important;
            border-color: #ffd0d6 !important;
            color: #f64e60 !important;
        }

        .major-content-seller-order-btn {
            height: 34px !important;
            min-width: 46px;
            padding: 0 10px !important;
            border-radius: 8px !important;
            background: #1bc5bd !important;
            border: 1px solid #1bc5bd !important;
            color: #ffffff !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            font-size: 12px !important;
            font-weight: 800 !important;
            cursor: pointer;
            transition: all 0.15s ease;
            box-shadow: 0 6px 14px rgba(27, 197, 189, 0.2);
        }

        .major-content-seller-order-btn:hover {
            color: #ffffff !important;
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(27, 197, 189, 0.28);
        }

        .major-content-seller-modal .modal-content {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 18px 45px rgba(0, 0, 0, 0.18);
        }

        .major-content-seller-modal .modal-header {
            padding: 18px 22px;
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            display: flex;
            align-items: center;
            justify-content: space-between;
            direction: rtl;
        }

        .major-content-seller-modal .modal-title {
            margin: 0;
            color: #181c32;
            font-size: 18px;
            font-weight: 900;
        }

        .major-content-seller-modal .close {
            margin: 0;
            padding: 0;
            color: #7e8299;
            opacity: 1;
            font-size: 26px;
            line-height: 1;
        }

        .major-content-seller-modal .modal-body {
            padding: 24px;
            direction: rtl;
        }

        .major-content-seller-modal .modal-footer {
            border-top: 1px solid #edf0f5;
            padding: 14px 22px;
            justify-content: flex-start;
        }

        .major-content-seller-modal label {
            color: #3f4254;
            font-size: 14px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .major-content-seller-modal .form-control {
            min-height: 44px;
            border-radius: 10px !important;
            border: 1px solid #e4e6ef !important;
            box-shadow: none !important;
        }

        .major-content-seller-modal .form-control:focus {
            border-color: #3699ff !important;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
        }

        .major-content-seller-save-btn {
            min-width: 110px;
            height: 42px;
            border-radius: 10px !important;
            background: #1bc5bd !important;
            border: 0 !important;
            color: #ffffff !important;
            font-size: 14px;
            font-weight: 900 !important;
        }

        .major-content-seller-close-btn {
            min-width: 90px;
            height: 40px;
            border-radius: 10px !important;
            background: #f3f6f9 !important;
            border: 1px solid #e4e6ef !important;
            color: #3f4254 !important;
            font-weight: 800 !important;
        }
    </style>
@endonce

<div class="major-content-seller-actions">
    <div onclick="deletesellerhome({{ $id }})"
         class="major-content-seller-action-btn major-content-seller-action-danger"
         title="حذف">
        <i class="fas fa-trash"></i>
    </div>

    <span class="major-content-seller-order-btn"
          data-toggle="modal"
          data-target="#myModals{{ $id }}">
        الترتيب
    </span>
</div>

<div id="myModals{{ $id }}" class="modal fade major-content-seller-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">الترتيب</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-lg-6 col-md-8">
                        <label>الترتيب</label>
                        <input type="number"
                               required
                               min="0"
                               value="{{ $homeseller->order_number }}"
                               name="order_number"
                               id="order_number{{ $id }}"
                               class="form-control">
                    </div>
                </div>

                <button type="button"
                        onclick="order_numberres({{ $id }})"
                        class="btn major-content-seller-save-btn">
                    حفظ
                </button>
            </div>

            <div class="modal-footer">
                <button type="button"
                        class="btn major-content-seller-close-btn"
                        data-dismiss="modal">
                    إغلاق
                </button>
            </div>
        </div>
    </div>
</div>

@once
    <script>
        function deletesellerhome(sel) {
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
                        type: "get",
                        url: `../deletesellermajorcontent/${id}`,
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

        function changesellerstatus(sel) {
            let id = sel;
            var table = $('.dataTable').DataTable();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: `../changesellerstatus`,
                dataType: "Json",
                data: {
                    'id': id,
                },
                success: function(result) {
                    if (result.status == true) {
                        table.ajax.reload();
                    }
                }
            });
        }

        function order_numberres(sel) {
            let id = sel;
            var table = $('.dataTable').DataTable();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: `../order_numbersellermajorcontent`,
                dataType: "Json",
                data: {
                    'id': sel,
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
