<?php
$employee = \App\Models\SellerEmployee::where('id', $id)->first();
//$att = \App\Models\Attendance::where('employee_id',$id)->whereDate('dateday',\Carbon\Carbon::now()->format('Y-m-d'))->first();
?>

<style>
    .selleremployee-menu-trigger {
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

    .selleremployee-menu-trigger:hover {
        background: #f3f6f9;
    }

    .selleremployee-menu-trigger i {
        font-size: 1rem !important;
        color: #3699FF !important;
    }

    .selleremployee-actions-dropdown {
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

    .selleremployee-actions-dropdown.is-open {
        display: flex;
    }

    .selleremployee-action-btn {
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

    .selleremployee-action-icon-btn {
        background: #f3f6f9 !important;
        color: #3f4254 !important;
        border: 1px solid #e4e6ef !important;
    }

    .selleremployee-action-icon-btn i {
        color: #3699FF !important;
    }

    .selleremployee-action-danger {
        background: #f64e60 !important;
        color: #fff !important;
    }

    .selleremployee-dropdown-divider {
        height: 1px;
        background: #edf0f5;
        margin: 2px 0;
    }
</style>

<button
    type="button"
    class="selleremployee-menu-trigger"
    title="الإعدادات"
    data-employee-id="{{ $id }}"
    onclick="toggleEmployeeBtns({{ $id }}, event)"
>
    <i class="fas fa-ellipsis-v"></i>
</button>

<div class="employee-btns{{ $id }} selleremployee-actions-dropdown" data-employee-id="{{ $id }}">
    <a href="{{ route('selleremployees.edit', $id) }}" class="selleremployee-action-btn selleremployee-action-icon-btn">
        <i class="fas fa-edit"></i>
        <span>تعديل</span>
    </a>

    <div class="selleremployee-dropdown-divider"></div>

    <div onclick="deleteemployee({{ $id }})" class="selleremployee-action-btn selleremployee-action-icon-btn">
        <i class="fas fa-trash" style="color:#f64e60;"></i>
        <span>حذف</span>
    </div>
</div>

<script>
    (function () {
        if (!window.__sellerEmployeeActionsDropdownInit) {
            window.__sellerEmployeeActionsDropdownInit = true;

            window.closeSellerEmployeeActionsDropdowns = function () {
                $('.selleremployee-actions-dropdown').removeClass('is-open');
            };

            window.positionSellerEmployeeActionsDropdown = function (id) {
                var $menu = $(`.selleremployee-actions-dropdown[data-employee-id="${id}"]`);
                var $trigger = $(`.selleremployee-menu-trigger[data-employee-id="${id}"]`);

                if (!$menu.length || !$trigger.length) {
                    return;
                }

                var trigger = $trigger[0];
                var menu = $menu[0];
                var rect = trigger.getBoundingClientRect();

                var padding = 8;
                var gap = 8;

                var menuWidth = menu.offsetWidth || 220;
                var menuHeight = menu.offsetHeight || 160;

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

            window.toggleEmployeeBtns = function (id, event) {
                if (event) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                var $menu = $(`.selleremployee-actions-dropdown[data-employee-id="${id}"]`);
                var isOpen = $menu.hasClass('is-open');

                closeSellerEmployeeActionsDropdowns();

                if (!isOpen) {
                    $menu.addClass('is-open');
                    positionSellerEmployeeActionsDropdown(id);
                }
            };

            $(document).on('click', function (event) {
                if (!$(event.target).closest('.selleremployee-actions-dropdown, .selleremployee-menu-trigger').length) {
                    closeSellerEmployeeActionsDropdowns();
                }
            });

            $(window).on('resize scroll', function () {
                $('.selleremployee-actions-dropdown.is-open').each(function () {
                    var id = $(this).data('employee-id');
                    positionSellerEmployeeActionsDropdown(id);
                });
            });
        }
    })();

    function deleteemployee(sel) {
        let id = sel;
        console.log(sel);
        var table = $('.dataTable').DataTable();

        closeSellerEmployeeActionsDropdowns();

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
                    url: `../deleteselleremployee/${id}`,
                    dataType: "Json",
                    success: function(result) {
                        if (result.status == true) {
                            Swal.fire(
                                'Deleted!',
                                'تم المسح بنجاح',
                                'success'
                            )
                        }
                        table.ajax.reload();
                    }
                });
            }
        })
    }
</script>
