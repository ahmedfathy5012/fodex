<?php
$seller = \App\Models\Seller::withoutGlobalScope(\App\Scopes\CentralRestaurantVisibilityScope::class)
    ->where('id', $id)
    ->first();

$sellers = \App\Models\WebsiteSeller::get();
?>

@once
    <style>
        :root {
            --seller-action-main: #3699FF;
            --seller-action-success: #1BC5BD;
            --seller-action-danger: #F64E60;
            --seller-action-warning: #FFA800;
            --seller-action-border: #E4E6EF;
            --seller-action-bg: #F3F6F9;
        }

        .seller-actions-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            direction: rtl;
        }

        .seller-actions-trigger {
            width: 34px !important;
            height: 34px !important;
            min-width: 34px !important;
            min-height: 34px !important;
            padding: 0 !important;
            margin: auto !important;
            border-radius: 8px !important;
            background: var(--seller-action-bg) !important;
            border: 1px solid var(--seller-action-border) !important;
            color: var(--seller-action-main) !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .seller-actions-trigger i {
            font-size: 14px !important;
            color: var(--seller-action-main) !important;
        }

        .seller-actions-trigger:hover {
            background: #eaf4ff !important;
            border-color: #b5d9ff !important;
        }

        .seller-actions-dropdown {
            display: none;
            position: fixed;
            z-index: 99999;
            width: 270px;
            max-height: 75vh;
            overflow-y: auto;
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 12px;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.16);
            direction: rtl;
        }

        .seller-actions-dropdown.is-open {
            display: block;
        }

        .seller-actions-title {
            font-size: 13px;
            font-weight: 900;
            color: #181c32;
            padding: 4px 6px 10px;
            border-bottom: 1px solid #edf0f5;
            margin-bottom: 10px;
            text-align: right;
        }

        .seller-actions-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 8px;
        }

        .seller-action-btn {
            min-height: 36px;
            border-radius: 9px !important;
            border: 1px solid var(--seller-action-border) !important;
            background: #ffffff !important;
            color: #3f4254 !important;
            font-size: 12px !important;
            font-weight: 800 !important;
            padding: 6px 8px !important;
            margin: 0 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            gap: 6px;
            cursor: pointer;
            text-align: center;
            white-space: nowrap;
            width: 100%;
            line-height: 1;
        }

        .seller-action-btn:hover {
            background: #eaf4ff !important;
            color: var(--seller-action-main) !important;
            border-color: #b5d9ff !important;
            text-decoration: none !important;
        }

        .seller-action-btn i,
        .seller-action-btn .font_icon {
            font-size: 12px !important;
            color: var(--seller-action-main) !important;
            margin: 0 !important;
        }

        .seller-action-btn svg {
            width: 14px !important;
            height: 14px !important;
        }

        .seller-action-btn svg path,
        .seller-action-btn svg rect {
            fill: var(--seller-action-main) !important;
            stroke: var(--seller-action-main) !important;
        }

        .seller-action-btn img {
            width: 14px !important;
            height: 14px !important;
            object-fit: contain;
        }

        .seller-action-primary {
            background: #eaf4ff !important;
            color: var(--seller-action-main) !important;
            border-color: #b5d9ff !important;
        }

        .seller-action-success {
            background: #e8fff3 !important;
            color: var(--seller-action-success) !important;
            border-color: #bdf4dd !important;
        }

        .seller-action-danger {
            background: #fff5f6 !important;
            color: var(--seller-action-danger) !important;
            border-color: #ffd0d6 !important;
        }

        .seller-action-full {
            grid-column: 1 / -1;
        }

        .seller-action-switch-row {
            grid-column: 1 / -1;
            display: grid;
            grid-template-columns: 1fr 44px;
            align-items: center;
            gap: 8px;
            min-height: 38px;
            border: 1px solid var(--seller-action-border);
            border-radius: 9px;
            padding: 6px 8px;
            background: #fbfcfe;
        }

        .seller-action-switch-title {
            font-size: 12px;
            font-weight: 800;
            color: #3f4254;
            text-align: right;
        }

        .seller-action-switch-row .switch {
            margin: 0 !important;
            padding: 0 !important;
            min-width: auto !important;
            width: 44px !important;
            height: 24px !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
        }

        .seller-action-switch-row label {
            margin: 0 !important;
            display: flex !important;
            align-items: center;
            justify-content: center;
        }

        .seller-action-switch-row input {
            margin: 0 !important;
        }

        .seller-action-modal .modal-content {
            border: 0;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.18);
        }

        .seller-action-modal .modal-header {
            border-bottom: 1px solid #edf0f5;
            background: #ffffff;
            padding: 18px 22px;
        }

        .seller-action-modal .modal-title {
            margin: 0;
            font-size: 18px;
            font-weight: 900;
            color: #181c32;
        }

        .seller-action-modal .modal-body {
            padding: 22px;
            direction: rtl;
        }

        .seller-action-modal label {
            font-size: 14px;
            font-weight: 700;
            color: #3f4254;
            margin-bottom: 8px;
        }

        .seller-action-modal .form-control {
            min-height: 44px;
            border-radius: 10px;
            border: 1px solid #e4e6ef;
            box-shadow: none !important;
        }

        .seller-action-modal .form-control:focus {
            border-color: var(--seller-action-main);
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
        }

        .seller-action-modal-save {
            min-width: 120px;
            height: 40px;
            border-radius: 10px !important;
            background: var(--seller-action-main) !important;
            border: 0 !important;
            color: #ffffff !important;
            font-weight: 800 !important;
        }
    </style>
@endonce

<div class="seller-actions-wrapper">
    <button type="button"
            class="seller-actions-trigger"
            onclick="toggle_btns({{ $id }}, event)"
            title="الإجراءات">
        <i class="fas fa-ellipsis-v"></i>
    </button>

    <div class="btns{{ $id }} seller-actions-dropdown">
        <div class="seller-actions-title">إجراءات البائع</div>

        @php
            $collect = \App\Models\AllCollection::where('seller_id', $id)->latest()->first();

            if (isset($collect)) {
                $orders = \App\Models\Order::where('seller_id', $id)
                    ->where('status', 1)
                    ->whereBetween('created_at', [$collect->created_at, now()]);
                $countorders = $orders->count();
                $money = $orders->sum('priceafterdiscount');
                $value = $money * ($seller->commission / 100) + $collect->money_left;
            } else {
                $orders = \App\Models\Order::where('seller_id', $id)->where('status', 1);
                $countorders = $orders->count();
                $money = $orders->sum('priceafterdiscount');
                $value = $money * ($seller->commission / 100);
            }
        @endphp

        <div class="seller-actions-grid">
            <a href="{{ route('seller.show', $id) }}" class="seller-action-btn">
                <i class="fas fa-eye"></i>
                عرض
            </a>

            <a href="{{ route('seller.edit', $id) }}" class="seller-action-btn">
                <i class="fas fa-pen"></i>
                تعديل
            </a>

            <div onclick="deleteseller({{ $id }})" class="seller-action-btn seller-action-danger">
                <i class="fas fa-trash"></i>
                حذف
            </div>

            <a href="{{ route('sellerworkschedule.index', $id) }}" class="seller-action-btn">
                <img src="{{ asset('workse.png') }}">
                المواعيد
            </a>

            <a class="seller-action-btn seller-action-success" href="{{ route('sellerzones', $id) }}">
                اسعار المناطق
            </a>

            <a href="{{ route('seller_extras.index', $id) }}" class="seller-action-btn seller-action-primary">
                الاكسترا
            </a>

            <a href="{{ route('sellercategory', $id) }}" class="seller-action-btn seller-action-primary">
                الاقسام
            </a>

            <a href="{{ route('sellercontracts', $id) }}" class="seller-action-btn seller-action-primary">
                العقود
            </a>

            <a href="{{ route('selleremployees.index', $id) }}" class="seller-action-btn seller-action-primary">
                الموظفين
            </a>

            <a href="{{ route('seller_items', $id) }}" class="seller-action-btn seller-action-primary">
                المنتجات
            </a>

            <a href="{{ route('seller.menu_types.index', $id) }}" class="seller-action-btn seller-action-primary seller-action-full">
                <span class="svg-icon svg-icon-primary m-0 p-0 svg-icon-md">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         width="18"
                         height="18"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         stroke-linecap="round"
                         stroke-linejoin="round">
                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"></path>
                        <path d="M8 7h6"></path>
                        <path d="M8 11h8"></path>
                        <path d="M8 15h4"></path>
                    </svg>
                </span>
                أنواع قوائم الطعام
            </a>

            @if ($block == 1)
                <span class="seller-action-btn seller-action-primary seller-action-full" onclick="blockseller({{ $id }})">
                    الغاء البلوك
                </span>
            @else
                <button type="button"
                        class="seller-action-btn seller-action-danger seller-action-full"
                        data-toggle="modal"
                        data-target="#myModal{{ $id }}">
                    بلوك
                </button>
            @endif

            <span class="seller-action-btn seller-action-success seller-action-full"
                  data-toggle="modal"
                  data-target="#myModale{{ $id }}">
                تحصيل
            </span>

            <div class="seller-action-switch-row">
                <span class="seller-action-switch-title">
                    {{ $availability == 1 ? 'متاح' : 'غير متاح' }}
                </span>

                <span class="switch btn btns-m switch-outline switch-icon switch-primary">
                    <label>
                        <input type="checkbox"
                               name="active"
                               onchange="openseller({{ $id }})"
                               @if ($availability == 1) checked @endif
                               value="1" />
                        <span title="{{ $availability == 1 ? 'متاح' : 'غير متاح' }}"></span>
                    </label>
                </span>
            </div>

            <div class="seller-action-switch-row">
                <span class="seller-action-switch-title">ظهور في الموقع</span>

                <span class="switch btn btns-m switch-outline switch-icon switch-primary">
                    <label>
                        <input type="checkbox"
                               name="active"
                               onchange="choose_seller_website({{ $id }})"
                               @if (in_array($id, $sellers->pluck('seller_id')->toArray())) checked @endif
                               value="1" />
                        <span title="ظهور المطعم فى الموقع"></span>
                    </label>
                </span>
            </div>
        </div>
    </div>
</div>

@if ($block != 1)
    <div id="myModal{{ $id }}" class="modal fade seller-action-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">اسباب البلوك</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label>السبب</label>
                            <input type="text" class="form-control" id="block_reason{{ $id }}">
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12 text-center">
                            <input type="button"
                                   onclick="blockseller({{ $id }})"
                                   class="btn seller-action-modal-save"
                                   value="حفظ">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<div id="myModale{{ $id }}" class="modal fade seller-action-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">تحصيل</h4>
            </div>

            <div class="modal-body">
                <div class="mb-4 font-weight-bold text-dark">
                    @if (isset($collect))
                        اخر تحصيل منذ
                        {{ \Carbon\Carbon::parse($collect->created_at)->format('Y-m-d') }}
                    @else
                        لم يحصل بعد
                    @endif
                </div>

                <div class="row">
                    <div class="col-6">
                        <label>عدد الطلبات</label>
                        <input type="number"
                               required
                               value="{{ $countorders }}"
                               min="1"
                               name="orders"
                               id="orders{{ $id }}"
                               class="form-control">
                    </div>

                    <div class="col-6">
                        <label>المبلغ + المتبقى</label>
                        <input type="hidden"
                               id="total{{ $id }}"
                               value="{{ $value }}"
                               class="form-control">

                        <input type="text"
                               id="money_taken{{ $id }}"
                               value="{{ $value }}"
                               class="form-control">
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <input type="button"
                               onclick="addcollection({{ $id }})"
                               value="حفظ"
                               class="btn seller-action-modal-save">
                    </div>
                </div>

                <div class="modal-footer mt-4">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@once
    <script>
        function closeSellerActionsDropdowns() {
            $('.seller-actions-dropdown').removeClass('is-open');
        }

        function positionSellerActionsDropdown($dropdown, trigger) {
            const rect = trigger.getBoundingClientRect();
            const dropdownWidth = $dropdown.outerWidth();
            const dropdownHeight = $dropdown.outerHeight();

            let top = rect.bottom + 8;
            let left = rect.left - dropdownWidth + rect.width;

            if (left < 8) {
                left = 8;
            }

            if (left + dropdownWidth > window.innerWidth - 8) {
                left = window.innerWidth - dropdownWidth - 8;
            }

            if (top + dropdownHeight > window.innerHeight - 8) {
                top = rect.top - dropdownHeight - 8;
            }

            if (top < 8) {
                top = 8;
            }

            $dropdown.css({
                top: top + 'px',
                left: left + 'px'
            });
        }

        function toggle_btns(id, event) {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }

            const $dropdown = $(`.btns${id}`);
            const isOpen = $dropdown.hasClass('is-open');

            closeSellerActionsDropdowns();

            if (!isOpen) {
                $dropdown.addClass('is-open');
                positionSellerActionsDropdown($dropdown, event.currentTarget);
            }
        }

        $(document).on('click', function(e) {
            if (!$(e.target).closest('.seller-actions-dropdown, .seller-actions-trigger').length) {
                closeSellerActionsDropdowns();
            }
        });

        $(window).on('scroll resize', function() {
            closeSellerActionsDropdowns();
        });

        function addcollection(id) {
            var table = $('.dataTable').DataTable();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: `addcollection`,
                dataType: "Json",
                data: {
                    'total': $(`#total${id}`).val(),
                    'money_taken': $(`#money_taken${id}`).val(),
                    'id': id
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

                        $(`#myModale${id}`).modal('hide');
                        table.ajax.reload();
                    }
                }
            });
        }

        function deleteseller(sel) {
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
                        url: `seller/${id}`,
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

        function blockseller(sel) {
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
                url: `blockseller`,
                dataType: "Json",
                data: {
                    'id': id,
                    'block_reason': $(`#block_reason${id}`).val(),
                },
                success: function(result) {
                    if (result.status == true) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'تمت بنجاح ',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        $(`#myModal${id}`).modal('hide');
                        table.ajax.reload();
                    }
                }
            });
        }

        function openseller(sel) {
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
                url: `openseller/${id}`,
                dataType: "Json",
                success: function(result) {
                    if (result.status == true) {
                        table.ajax.reload();
                    }
                }
            });
        }

        function choose_seller_website(sel) {
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
                url: `choose_seller_website/${id}`,
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
