@once
    <style>
        .driver-actions-wrapper {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            direction: rtl;
        }

        .driver-actions-trigger {
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
        }

        .driver-actions-trigger:hover {
            background: #eaf4ff !important;
            border-color: #b5d9ff !important;
            color: #3699ff !important;
        }

        .driver-actions-trigger i {
            font-size: 15px;
            color: #3699ff !important;
        }

        .driver-actions-dropdown {
            display: none;
            position: fixed;
            z-index: 99999;
            width: 245px;
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 12px;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.16);
            direction: rtl;
        }

        .driver-actions-dropdown.is-open {
            display: block;
        }

        .driver-actions-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 8px;
        }

        .driver-action-btn {
            min-height: 36px;
            border-radius: 9px !important;
            border: 1px solid #e4e6ef !important;
            background: #ffffff !important;
            color: #3f4254 !important;
            font-size: 12px !important;
            font-weight: 800 !important;
            padding: 6px 8px !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            gap: 6px;
            width: 100%;
            cursor: pointer;
            text-decoration: none !important;
            white-space: nowrap;
            line-height: 1;
        }

        .driver-action-btn:hover {
            background: #f3f6f9 !important;
            color: #3699ff !important;
            border-color: #b5d9ff !important;
            text-decoration: none !important;
        }

        .driver-action-btn i {
            font-size: 13px;
            color: inherit !important;
        }

        .driver-action-btn img {
            width: 16px !important;
            height: 16px !important;
            object-fit: contain;
        }

        .driver-action-primary {
            background: #eaf4ff !important;
            color: #3699ff !important;
            border-color: #b5d9ff !important;
        }

        .driver-action-success {
            background: #e8fff3 !important;
            color: #1bc5bd !important;
            border-color: #bdf4dd !important;
        }

        .driver-action-warning {
            background: #fff8dd !important;
            color: #ffa800 !important;
            border-color: #ffe7a0 !important;
        }

        .driver-action-danger {
            background: #fff5f6 !important;
            color: #f64e60 !important;
            border-color: #ffd0d6 !important;
        }

        .driver-action-full {
            grid-column: 1 / -1;
        }
    </style>
@endonce

<div class="driver-actions-wrapper">
    <button type="button"
            class="driver-actions-trigger"
            title="الإجراءات"
            onclick="toggleDriverActions({{ $id }}, event)">
        <i class="fas fa-ellipsis-h"></i>
    </button>

    <div class="driver-actions-dropdown driver-actions-{{ $id }}">
        <div class="driver-actions-grid">
            <a href="{{ route('driver.edit', $id) }}"
               class="driver-action-btn driver-action-primary">
                <i class="fas fa-pen"></i>
                تعديل
            </a>

            <button type="button"
                    onclick="deletedriver({{ $id }})"
                    class="driver-action-btn driver-action-danger">
                <i class="fas fa-trash"></i>
                حذف
            </button>

            <a href="{{ route('drivercontracts', $id) }}"
               class="driver-action-btn driver-action-success">
                <i class="fas fa-file-contract"></i>
                العقود
            </a>

            <a href="{{ route('driverorders', $id) }}"
               class="driver-action-btn">
                <img src="{{ asset('order-food.png') }}" alt="orders">
                الطلبات
            </a>

            <a href="{{ route('driver_cuurent_orders', $id) }}"
               class="driver-action-btn driver-action-warning">
                <img src="{{ asset('order-food.png') }}" alt="current orders">
                الحالية
            </a>

            <a href="{{ route('driver_map', $id) }}"
               class="driver-action-btn driver-action-full">
                <img src="{{ asset('location.png') }}" alt="map">
                موقع السائق
            </a>
        </div>
    </div>
</div>

@once
    <script>
        function closeDriverActionsDropdowns() {
            $('.driver-actions-dropdown').removeClass('is-open');
        }

        function positionDriverActionsDropdown($dropdown, trigger) {
            var rect = trigger.getBoundingClientRect();
            var dropdownWidth = $dropdown.outerWidth();
            var dropdownHeight = $dropdown.outerHeight();

            var top = rect.bottom + 8;
            var left = rect.right - dropdownWidth;

            if (left < 10) {
                left = 10;
            }

            if ((top + dropdownHeight) > window.innerHeight) {
                top = rect.top - dropdownHeight - 8;
            }

            if (top < 10) {
                top = 10;
            }

            $dropdown.css({
                top: top + 'px',
                left: left + 'px'
            });
        }

        function toggleDriverActions(id, event) {
            event.preventDefault();
            event.stopPropagation();

            var $dropdown = $('.driver-actions-' + id);
            var isOpen = $dropdown.hasClass('is-open');

            closeDriverActionsDropdowns();

            if (!isOpen) {
                $dropdown.addClass('is-open');
                positionDriverActionsDropdown($dropdown, event.currentTarget);
            }
        }

        $(document).on('click', function() {
            closeDriverActionsDropdowns();
        });

        $(document).on('click', '.driver-actions-dropdown', function(event) {
            event.stopPropagation();
        });

        $(window).on('scroll resize', function() {
            closeDriverActionsDropdowns();
        });

        function deletedriver(sel) {
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
                        url: `driver/${id}`,
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
    </script>
@endonce
