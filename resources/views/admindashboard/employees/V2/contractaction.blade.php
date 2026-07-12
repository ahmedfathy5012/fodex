<?php
$contract = \App\Models\Employeescontract::where('id', $id)->first();
?>

@once
    <style>
        .employee-contract-actions-inline {
            width: 185px;
            display: grid;
            grid-template-columns: 34px 34px 105px;
            align-items: center;
            justify-content: center;
            gap: 7px;
            direction: rtl;
            margin: auto;
        }

        .employee-contract-action-icon-btn {
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
        }

        .employee-contract-action-icon-btn:hover {
            background: #eaf4ff !important;
            border-color: #b5d9ff !important;
            color: #3699ff !important;
        }

        .employee-contract-action-icon-btn i {
            font-size: 13px;
            color: #3699ff !important;
        }

        .employee-contract-action-status-btn {
            width: 105px !important;
            height: 34px !important;
            min-height: 34px !important;
            margin: 0 !important;
            padding: 0 10px !important;
            border-radius: 8px !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            font-size: 12px !important;
            font-weight: 800 !important;
            white-space: nowrap;
            cursor: pointer;
            border: 1px solid transparent !important;
            line-height: 1;
        }

        .employee-contract-action-active {
            background: #fff5f6 !important;
            color: #f64e60 !important;
            border-color: #ffd0d6 !important;
        }

        .employee-contract-action-active:hover {
            background: #f64e60 !important;
            color: #ffffff !important;
        }

        .employee-contract-action-inactive {
            background: #eaf4ff !important;
            color: #3699ff !important;
            border-color: #b5d9ff !important;
        }

        .employee-contract-action-inactive:hover {
            background: #3699ff !important;
            color: #ffffff !important;
        }
    </style>
@endonce

<div class="employee-contract-actions-inline">
    <a href="{{ route('editemployeecontract', $id) }}"
       class="employee-contract-action-icon-btn"
       title="تعديل">
        <i class="fas fa-pen"></i>
    </a>

    <div onclick="deleteemployeecontract({{ $id }})"
         class="employee-contract-action-icon-btn"
         title="حذف">
        <i class="fas fa-trash"></i>
    </div>

    @if($contract->active == 1)
        <span class="employee-contract-action-status-btn employee-contract-action-active"
              onclick="activeemployeecontract({{ $id }})">
            الغاء التفعيل
        </span>
    @else
        <span class="employee-contract-action-status-btn employee-contract-action-inactive"
              onclick="activeemployeecontract({{ $id }})">
            تفعيل
        </span>
    @endif
</div>

@once
    <script>
        function deleteemployeecontract(sel) {
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
                        url: `../deleteemployeecontract/${id}`,
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

        function activeemployeecontract(sel) {
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
                url: `../activeemployeecontract/${id}`,
                dataType: "Json",
                success: function(result) {
                    if (result.status == true) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: result.message,
                            showConfirmButton: false,
                            timer: 1500
                        });

                        table.ajax.reload();
                    }
                }
            });
        }
    </script>
@endonce
