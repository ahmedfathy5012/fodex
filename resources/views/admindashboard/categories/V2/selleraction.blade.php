<?php
use App\Models\Sellercategory;

$seller_id = request()->route('id');

$sel = Sellercategory::where([
    ['category_id', '=', $id],
    ['seller_id', '=', $seller_id],
])->first();
?>

@once
    <style>
        .seller-category-actions {
            width: 145px;
            display: grid;
            grid-template-columns: 36px 34px 64px;
            align-items: center;
            justify-content: center;
            gap: 7px;
            direction: rtl;
            margin: auto;
        }

        .seller-category-check-box {
            width: 36px;
            height: 34px;
            border-radius: 8px;
            background: #f3f6f9;
            border: 1px solid #e4e6ef;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .seller-category-check-box input {
            width: 17px;
            height: 17px;
            cursor: pointer;
            margin: 0;
        }

        .seller-category-heart-btn {
            width: 34px;
            height: 34px;
            min-width: 34px;
            min-height: 34px;
            border-radius: 8px;
            background: #fff5f6;
            border: 1px solid #ffd0d6;
            color: #b5b5c3;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .seller-category-heart-btn:hover,
        .seller-category-heart-btn.active {
            color: #f64e60;
            background: #fff0f2;
            border-color: #ffb8c1;
            transform: translateY(-1px);
        }

        .seller-category-heart-btn i {
            font-size: 15px;
        }

        .seller-category-order-btn {
            width: 64px !important;
            height: 34px !important;
            min-width: 64px !important;
            min-height: 34px !important;
            padding: 0 8px !important;
            margin: 0 !important;
            border-radius: 8px !important;
            background: #e8fff3 !important;
            color: #1bc5bd !important;
            border: 1px solid #bdf4dd !important;
            font-size: 12px !important;
            font-weight: 900 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            line-height: 1;
            white-space: nowrap;
        }

        .seller-category-order-btn:hover {
            background: #1bc5bd !important;
            color: #ffffff !important;
            transform: translateY(-1px);
        }

        .seller-category-modal .modal-content {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 14px 40px rgba(0, 0, 0, 0.18);
            direction: rtl;
        }

        .seller-category-modal .modal-header {
            background: #fbfcfe;
            border-bottom: 1px solid #edf0f5;
            padding: 18px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .seller-category-modal .modal-title {
            margin: 0;
            font-size: 17px;
            font-weight: 900;
            color: #181c32;
        }

        .seller-category-modal .close {
            margin: 0;
            padding: 0;
            color: #7e8299;
            opacity: 1;
            font-size: 26px;
            font-weight: 700;
        }

        .seller-category-modal .modal-body {
            padding: 22px;
            background: #ffffff;
        }

        .seller-category-modal label {
            font-weight: 800;
            color: #3f4254;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .seller-category-modal .form-control {
            min-height: 42px;
            border-radius: 10px !important;
            border: 1px solid #e4e6ef !important;
            box-shadow: none !important;
        }

        .seller-category-modal-save {
            min-width: 115px;
            height: 40px;
            border-radius: 10px !important;
            background: #1bc5bd !important;
            border: 0 !important;
            color: #ffffff !important;
            font-weight: 900 !important;
            margin-top: 14px;
        }

        .seller-category-modal-close {
            min-width: 95px;
            height: 38px;
            border-radius: 10px !important;
            background: #f3f6f9 !important;
            border: 1px solid #e4e6ef !important;
            color: #3f4254 !important;
            font-weight: 800 !important;
        }
    </style>
@endonce

<div class="seller-category-actions">
    <span class="seller-category-check-box" title="ربط القسم بالمطعم">
        <input type="checkbox"
               onchange="add_category_seller({{ $id }}, {{ $seller_id }})"
               @if($sel) checked @endif
               value="1">
    </span>

    @if($sel)
        <span class="seller-category-heart-btn @if($sel->fav == 1) active @endif"
              onclick="addfav({{ $sel->id }})"
              title="مفضل">
            <i class="fas fa-heart"></i>
        </span>

        <span class="seller-category-order-btn"
              data-toggle="modal"
              data-target="#myModals{{ $sel->id }}"
              title="ترتيب">
            الترتيب
        </span>
    @endif
</div>

@if($sel)
    <div id="myModals{{ $sel->id }}" class="modal fade seller-category-modal" role="dialog">
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
                               value="{{ $sel->order_number }}"
                               name="order_number"
                               id="order_number{{ $sel->id }}"
                               class="form-control">
                    </div>

                    <input type="button"
                           onclick="order_numberres({{ $sel->id }})"
                           value="حفظ"
                           class="btn seller-category-modal-save">

                    <button type="button"
                            class="btn seller-category-modal-close"
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
        function addfav(sel) {
            let id = sel;
            var table = $('.dataTable').DataTable();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "get",
                url: `../addfav1/${id}`,
                dataType: "Json",
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
                url: `../order_numbercategory`,
                dataType: "Json",
                data: {
                    'id': id,
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

        function add_category_seller(category_id, seller_id) {
            var table = $('.dataTable').DataTable();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: `../add_category_seller`,
                dataType: "Json",
                data: {
                    'seller_id': seller_id,
                    'category_id': category_id
                },
                success: function(result) {
                    if (result.status == true) {
                        table.ajax.reload();
                    }
                }
            });
        }
    </script>
@endonce
