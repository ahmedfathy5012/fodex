<?php
$employee = \App\Models\Employee::where('id', $id)->first();
?>

@once
    <style>
        .employee-actions-wrapper {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            direction: rtl;
        }

        .employee-actions-trigger {
            width: 34px !important;
            height: 34px !important;
            min-width: 34px !important;
            min-height: 34px !important;
            padding: 0 !important;
            margin: auto !important;
            border-radius: 8px !important;
            background: #f3f6f9 !important;
            border: 1px solid #e4e6ef !important;
            color: #3699ff !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .employee-actions-trigger i {
            font-size: 14px;
            color: #3699ff !important;
        }

        .employee-actions-trigger:hover {
            background: #eaf4ff !important;
            border-color: #b5d9ff !important;
        }

        .employee-actions-dropdown {
            display: none;
            position: fixed;
            z-index: 99999;
            width: 280px;
            max-height: 75vh;
            overflow-y: auto;
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 12px;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.16);
            direction: rtl;
        }

        .employee-actions-dropdown.is-open {
            display: block;
        }

        .employee-actions-title {
            font-size: 13px;
            font-weight: 900;
            color: #181c32;
            padding: 4px 6px 10px;
            border-bottom: 1px solid #edf0f5;
            margin-bottom: 10px;
            text-align: right;
        }

        .employee-actions-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 8px;
        }

        .employee-action-btn {
            min-height: 36px;
            border-radius: 9px !important;
            border: 1px solid #e4e6ef !important;
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
            text-decoration: none !important;
        }

        .employee-action-btn:hover {
            background: #eaf4ff !important;
            color: #3699ff !important;
            border-color: #b5d9ff !important;
            text-decoration: none !important;
        }

        .employee-action-btn i {
            font-size: 12px !important;
            color: #3699ff !important;
            margin: 0 !important;
        }

        .employee-action-primary {
            background: #eaf4ff !important;
            color: #3699ff !important;
            border-color: #b5d9ff !important;
        }

        .employee-action-success {
            background: #e8fff3 !important;
            color: #1bc5bd !important;
            border-color: #bdf4dd !important;
        }

        .employee-action-success i {
            color: #1bc5bd !important;
        }

        .employee-action-warning {
            background: #fff8dd !important;
            color: #ffa800 !important;
            border-color: #ffe7a0 !important;
        }

        .employee-action-warning i {
            color: #ffa800 !important;
        }

        .employee-action-danger {
            background: #fff5f6 !important;
            color: #f64e60 !important;
            border-color: #ffd0d6 !important;
        }

        .employee-action-danger i {
            color: #f64e60 !important;
        }

        .employee-action-full {
            grid-column: 1 / -1;
        }

        .employee-action-modal .modal-content {
            border: 0;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.18);
        }

        .employee-action-modal .modal-header {
            border-bottom: 1px solid #edf0f5;
            background: #ffffff;
            padding: 18px 22px;
        }

        .employee-action-modal .modal-title {
            margin: 0;
            font-size: 18px;
            font-weight: 900;
            color: #181c32;
        }

        .employee-action-modal .modal-body {
            padding: 22px;
            direction: rtl;
        }

        .employee-action-modal label {
            font-size: 14px;
            font-weight: 800;
            color: #3f4254;
            margin-bottom: 8px;
        }

        .employee-action-modal .form-control {
            min-height: 44px;
            border-radius: 10px;
            border: 1px solid #e4e6ef;
            color: #3f4254;
            box-shadow: none !important;
        }

        .employee-action-modal .form-control:focus {
            border-color: #3699ff;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
        }

        .employee-action-modal-save {
            min-width: 120px;
            height: 40px;
            border-radius: 10px !important;
            background: #3699ff !important;
            border: 0 !important;
            color: #ffffff !important;
            font-weight: 800 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
        }
    </style>
@endonce

<div class="employee-actions-wrapper">
    <button type="button"
            class="employee-actions-trigger"
            onclick="toggleEmployeeActions({{ $id }}, event)"
            title="الإجراءات">
        <i class="fas fa-ellipsis-v"></i>
    </button>

    <div class="employee-actions-dropdown employee-actions-{{ $id }}">
        <div class="employee-actions-title">إجراءات الموظف</div>

        <div class="employee-actions-grid">
            <a href="{{ route('employee.edit', $id) }}"
               class="employee-action-btn employee-action-primary">
                <i class="fas fa-pen"></i>
                تعديل
            </a>

            <div onclick="deleteemployee({{ $id }})"
                 class="employee-action-btn employee-action-danger">
                <i class="fas fa-trash"></i>
                حذف
            </div>

            <a class="employee-action-btn employee-action-primary"
               href="{{ route('employeecontracts', $id) }}">
                <i class="fas fa-file-contract"></i>
                العقود
            </a>

            <a class="employee-action-btn employee-action-primary"
               href="{{ route('countriespermissions', $id) }}">
                <i class="fas fa-map-marker-alt"></i>
                صلاحيات المناطق
            </a>

            @if($employee->block == 1)
                <span class="employee-action-btn employee-action-success employee-action-full"
                      onclick="blockemployee({{ $id }})">
                    <i class="fas fa-unlock"></i>
                    الغاء البلوك
                </span>
            @else
                <button type="button"
                        class="employee-action-btn employee-action-danger employee-action-full"
                        data-toggle="modal"
                        data-target="#myModal{{ $id }}">
                    <i class="fas fa-ban"></i>
                    بلوك
                </button>
            @endif

            <span class="employee-action-btn employee-action-success"
                  data-toggle="modal"
                  data-target="#myModalaward{{ $id }}">
                <i class="fas fa-gift"></i>
                مكافأه
            </span>

            <span class="employee-action-btn employee-action-warning"
                  data-toggle="modal"
                  data-target="#myModaldiscount{{ $id }}">
                <i class="fas fa-minus-circle"></i>
                خصم
            </span>
        </div>
    </div>
</div>

@if($employee->block != 1)
    <div id="myModal{{ $id }}" class="modal fade employee-action-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">اسباب البلوك</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label>السبب</label>
                            <input type="text" class="form-control" id="block_reason{{ $id }}">
                        </div>

                        <div class="col-12">
                            <label>السبب المعلن</label>
                            <input type="text" class="form-control" id="display_block_reason{{ $id }}">
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12 text-center">
                            <input type="button"
                                   onclick="blockemployee({{ $id }})"
                                   class="btn employee-action-modal-save"
                                   value="حفظ">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<div id="myModalaward{{ $id }}" class="modal fade employee-action-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">سبب المكافأه</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-8 mb-3">
                        <label>القيمه</label>
                        <input type="number" class="form-control" id="value{{ $id }}">
                    </div>

                    <div class="col-12">
                        <label>السبب</label>
                        <input type="text" class="form-control" id="reason{{ $id }}">
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <input type="button"
                               onclick="awardemployee({{ $id }})"
                               class="btn employee-action-modal-save"
                               value="حفظ">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="myModaldiscount{{ $id }}" class="modal fade employee-action-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">سبب الخصم</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-8 mb-3">
                        <label>القيمه</label>
                        <input type="number" class="form-control" id="valuediscount{{ $id }}">
                    </div>

                    <div class="col-12">
                        <label>السبب</label>
                        <input type="text" class="form-control" id="reasondiscount{{ $id }}">
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <input type="button"
                               onclick="discountemployee({{ $id }})"
                               class="btn employee-action-modal-save"
                               value="حفظ">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@once
    <script>
        function closeEmployeeActionsDropdowns() {
            $('.employee-actions-dropdown').removeClass('is-open');
        }

        function positionEmployeeActionsDropdown($dropdown, trigger) {
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

        function toggleEmployeeActions(id, event) {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }

            const $dropdown = $(`.employee-actions-${id}`);
            const isOpen = $dropdown.hasClass('is-open');

            closeEmployeeActionsDropdowns();

            if (!isOpen) {
                $dropdown.addClass('is-open');
                positionEmployeeActionsDropdown($dropdown, event.currentTarget);
            }
        }

        $(document).on('click', function(e) {
            if (!$(e.target).closest('.employee-actions-dropdown, .employee-actions-trigger').length) {
                closeEmployeeActionsDropdowns();
            }
        });

        $(window).on('scroll resize', function() {
            closeEmployeeActionsDropdowns();
        });

        function deleteemployee(sel) {
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
                        url: `employee/${id}`,
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

        function blockemployee(sel) {
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
                url: `blockemployee`,
                dataType: "Json",
                data: {
                    'id': id,
                    'block_reason': $(`#block_reason${id}`).val(),
                    'display_block_reason': $(`#display_block_reason${id}`).val()
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

        function awardemployee(sel) {
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
                url: `awardemployee`,
                dataType: "Json",
                data: {
                    'id': id,
                    'reason': $(`#reason${id}`).val(),
                    'value': $(`#value${id}`).val()
                },
                success: function(result) {
                    if (result.status == true) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'تمت اضافه المكافأه بنجاح ',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        $(`#myModalaward${id}`).modal('hide');
                        table.ajax.reload();
                    }
                }
            });
        }

        function discountemployee(sel) {
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
                url: `discountemployee`,
                dataType: "Json",
                data: {
                    'id': id,
                    'reason': $(`#reasondiscount${id}`).val(),
                    'value': $(`#valuediscount${id}`).val()
                },
                success: function(result) {
                    if (result.status == true) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'تمت اضافه الخصم بنجاح ',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        $(`#myModaldiscount${id}`).modal('hide');
                        table.ajax.reload();
                    }
                }
            });
        }
    </script>
@endonce
