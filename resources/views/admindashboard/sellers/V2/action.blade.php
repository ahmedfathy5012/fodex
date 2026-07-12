<?php
$seller = \App\Models\Seller::where('id', $id)->first();
$sellers = \App\Models\WebsiteSeller::get();
$isWebsiteSeller = $sellers->pluck('seller_id')->contains($id);
?>

<style>
    .seller-menu-trigger {
        width: 36px;
        height: 36px;
        border: 0;
        outline: 0;
        background: transparent;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: auto;
        border-radius: 8px;
        transition: background 0.15s ease;
    }

    .seller-menu-trigger:hover {
        background: #f3f6f9;
    }

    .seller-menu-trigger i {
        font-size: 1rem !important;
        color: #3699FF !important;
    }

    .seller-actions-dropdown {
        width: 220px;
        display: none;
        position: fixed;
        z-index: 1040;
        flex-direction: column;
        gap: 7px;
        padding: 10px;
        background: #ffffff;
        border: 1px solid #e4e6ef;
        border-radius: 10px;
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.18);
        max-height: calc(100vh - 20px);
        overflow-y: auto;
        direction: rtl;
    }

    .seller-actions-dropdown.is-open {
        display: flex;
    }

    .seller-action-btn {
        width: 100% !important;
        min-height: 34px;
        margin: 0 !important;
        padding: 7px 10px !important;
        font-size: 13px !important;
        border-radius: 6px;
        display: flex !important;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-align: center;
        color: #fff !important;
        cursor: pointer;
        border: 0 !important;
        line-height: 1.4;
        white-space: nowrap;
    }

    .seller-action-icon-btn {
        background: #f3f6f9 !important;
        color: #3f4254 !important;
        border: 1px solid #e4e6ef !important;
    }

    .seller-action-icon-btn i {
        color: #3699FF !important;
    }

    .seller-action-danger {
        background: #ff3f5f !important;
        color: #fff !important;
    }

    .seller-action-success {
        background: #0abb87 !important;
        color: #fff !important;
    }

    .seller-action-primary {
        background: #0f9fe5 !important;
        color: #fff !important;
    }

    .seller-action-switch {
        width: 100%;
        min-height: 42px;
        margin: 0 !important;
        padding: 5px 8px !important;
        display: flex !important;
        align-items: center;
        background: #fff;
        border: 1px solid #e4e6ef;
        border-radius: 8px;
    }

    .seller-action-switch label {
        width: 100%;
        margin: 0;
        display: flex !important;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .seller-action-switch h4 {
        margin: 0 !important;
        font-size: 15px;
        font-weight: 500;
        color: #3f4254;
        white-space: nowrap;
        line-height: 1.4;
    }

    .seller-action-switch input {
        margin: 0;
    }

    .seller-action-switch > label > span {
        margin: 0 !important;
    }

    .seller-dropdown-divider {
        height: 1px;
        background: #edf0f5;
        margin: 2px 0;
    }

    .font_icon {
        font-size: 0.75rem !important;
        color: #3699FF !important;
        cursor: pointer;
    }

    .seller-action-icon-btn i,
    .seller-action-icon-btn .font_icon,
    .seller-action-icon-btn i[style] {
        font-size: 0.75rem !important;
        color: #3699FF !important;
    }

    .seller-action-icon-btn img {
        width: 11px !important;
        height: 11px !important;
        object-fit: contain;
        filter: brightness(0) saturate(100%) invert(52%) sepia(92%) saturate(2213%) hue-rotate(190deg) brightness(101%) contrast(101%);
    }
</style>

<button
    type="button"
    class="seller-menu-trigger"
    title="الإعدادات"
    data-seller-id="{{ $id }}"
    onclick="toggle_btns({{ $id }}, event)"
>
    <i class="fas fa-ellipsis-v"></i>
</button>

<div class="btns{{ $id }} seller-actions-dropdown" data-seller-id="{{ $id }}">
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

    <a href="{{ route('seller.show', $id) }}" class="seller-action-btn seller-action-icon-btn">
        <i class="fas fa-eye font_icon"></i>
        <span>عرض</span>
    </a>

    <a href="{{ route('sellerworkschedule.index', $id) }}" class="seller-action-btn seller-action-icon-btn">
        <img src="{{ asset('workse.png') }}" style="width:22px;height:22px;">
        <span>مواعيد العمل</span>
    </a>

    <a class="btn btn-success btn-sm seller-action-btn seller-action-success" href="{{ route('sellerzones', $id) }}">
        اسعار المناطق
    </a>

    <a href="{{ route('seller.edit', $id) }}" class="seller-action-btn seller-action-icon-btn">
        <i class="fas fa-edit font_icon"></i>
        <span>تعديل</span>
    </a>

    <div onclick="deleteseller({{ $id }})" class="seller-action-btn seller-action-icon-btn">
        <i class="fas fa-trash font_icon" style="color:#f64e60;"></i>
        <span>حذف</span>
    </div>

    <div class="seller-dropdown-divider"></div>

    <a href="{{ route('seller_extras.index', $id) }}" class="btn btn-sm btn-primary seller-action-btn seller-action-primary">
        الاكسترا
    </a>

    <a href="{{ route('sellercategory', $id) }}" class="btn btn-sm btn-primary seller-action-btn seller-action-primary">
        الاقسام
    </a>

    <a href="{{ route('sellercontracts', $id) }}" class="btn btn-sm btn-primary seller-action-btn seller-action-primary">
        العقود
    </a>

    <a href="{{ route('selleremployees.index', $id) }}" class="btn btn-sm btn-primary seller-action-btn seller-action-primary">
        الموظفين
    </a>

    @if ($block == 1)
        <span class="btn btn-primary seller-action-btn seller-action-primary" onclick="blockseller({{ $id }})">
            الغاء البلوك
        </span>
    @else
        <button
            type="button"
            class="btn btn-danger btn-sm seller-action-btn seller-action-danger"
            data-toggle="modal"
            data-target="#myModal{{ $id }}"
        >
            بلوك
        </button>
    @endif

    <div class="seller-dropdown-divider"></div>

    <span class="switch btn btns-m switch-outline switch-icon switch-primary seller-action-switch">
        <label>
            <h4>{{ $availability == 1 ? 'متاح' : 'غير متاح' }}</h4>

            <input
                type="checkbox"
                name="active"
                value="1"
                onchange="openseller({{ $id }})"
                @if ($availability == 1) checked @endif
            />

            <span title="{{ $availability == 1 ? 'متاح' : 'غير متاح' }}"></span>
        </label>
    </span>

    <a href="{{ route('seller_items', $id) }}" class="btn btn-sm btn-primary seller-action-btn seller-action-primary">
        المنتجات
    </a>

    <span
        class="btn btn-success btn-sm seller-action-btn seller-action-success"
        data-toggle="modal"
        data-target="#myModale{{ $id }}"
    >
        تحصيل
    </span>

    <span class="switch btn btns-m switch-outline switch-icon switch-primary seller-action-switch">
        <label>
            <h4>
                {{ $isWebsiteSeller ? 'ظاهر في الموقع' : 'غير ظاهر في الموقع' }}
            </h4>

            <input
                type="checkbox"
                name="active"
                value="1"
                onchange="choose_seller_website({{ $id }})"
                @if ($isWebsiteSeller) checked @endif
            />

            <span title="{{ $isWebsiteSeller ? 'ظاهر في الموقع' : 'غير ظاهر في الموقع' }}"></span>
        </label>
    </span>
</div>

@if ($block != 1)
    <div id="myModal{{ $id }}" class="modal fade" role="dialog">
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

                    <div class="row">
                        <input
                            type="button"
                            onclick="blockseller({{ $id }})"
                            class="btn btn-sm btn-primary mr-4"
                            value="حفظ"
                        >
                    </div>
                </div>

            </div>
        </div>
    </div>
@endif

<div id="myModale{{ $id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">تحصيل</h4>
            </div>

            <div class="modal-body">
                <div>
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
                        <input
                            type="number"
                            required
                            value="{{ $countorders }}"
                            min="1"
                            name="orders"
                            id="orders{{ $id }}"
                            class="form-control"
                        >
                    </div>

                    <div class="col-6">
                        <label>المبلغ + المتبقى</label>
                        <input type="hidden" id="total{{ $id }}" value="{{ $value }}" class="form-control">
                        <input type="text" id="money_taken{{ $id }}" value="{{ $value }}" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-3">
                        <input
                            type="button"
                            onclick="addcollection({{ $id }})"
                            value="حفظ"
                            class="form-control btn btn-success btn-sm m-4"
                        >
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    (function () {
        if (!window.__sellerActionsDropdownInit) {
            window.__sellerActionsDropdownInit = true;

            window.closeSellerActionsDropdowns = function () {
                $('.seller-actions-dropdown').removeClass('is-open');
            };

            window.positionSellerActionsDropdown = function (id) {
                var $menu = $(`.seller-actions-dropdown[data-seller-id="${id}"]`);
                var $trigger = $(`.seller-menu-trigger[data-seller-id="${id}"]`);

                if (!$menu.length || !$trigger.length) {
                    return;
                }

                var trigger = $trigger[0];
                var menu = $menu[0];
                var rect = trigger.getBoundingClientRect();

                var padding = 8;
                var gap = 8;

                var menuWidth = menu.offsetWidth || 220;
                var menuHeight = menu.offsetHeight || 300;

                var top = rect.bottom + gap;
                var left = rect.right - menuWidth;

                if (top + menuHeight > window.innerHeight - padding) {
                    top = rect.top - menuHeight - gap;
                }

                if (top < padding) {
                    top = padding;
                }

                if (left < padding) {
                    left = padding;
                }

                if (left + menuWidth > window.innerWidth - padding) {
                    left = window.innerWidth - menuWidth - padding;
                }

                menu.style.top = `${top}px`;
                menu.style.left = `${left}px`;
            };

            window.toggle_btns = function (id, event) {
                if (event) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                var $menu = $(`.seller-actions-dropdown[data-seller-id="${id}"]`);
                var isOpen = $menu.hasClass('is-open');

                closeSellerActionsDropdowns();

                if (!isOpen) {
                    $menu.addClass('is-open');
                    positionSellerActionsDropdown(id);
                }
            };

            $(document).on('click', function (event) {
                if (!$(event.target).closest('.seller-actions-dropdown, .seller-menu-trigger').length) {
                    closeSellerActionsDropdowns();
                }
            });

            $(document).on('click', '.seller-actions-dropdown [data-toggle="modal"]', function () {
                closeSellerActionsDropdowns();
            });

            $(window).on('resize scroll', function () {
                $('.seller-actions-dropdown.is-open').each(function () {
                    var id = $(this).data('seller-id');
                    positionSellerActionsDropdown(id);
                });
            });
        }
    })();

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
        var table = $('.dataTable').DataTable();

        closeSellerActionsDropdowns();

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
                        title: 'تمت بنجاح',
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
        var table = $('.dataTable').DataTable();

        closeSellerActionsDropdowns();

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
        var table = $('.dataTable').DataTable();

        closeSellerActionsDropdowns();

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
