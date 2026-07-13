<?php
$contract = \App\Models\DriverContract::where('id', $id)->first();
?>

@once
    <style>
        .driver-contract-actions-inline {
            width: 185px;
            display: grid;
            grid-template-columns: 34px 34px 105px;
            align-items: center;
            justify-content: center;
            gap: 7px;
            direction: rtl;
            margin: auto;
        }

        .driver-contract-action-icon-btn {
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

        .driver-contract-action-icon-btn:hover {
            background: #eaf4ff !important;
            border-color: #b5d9ff !important;
            color: #3699ff !important;
            text-decoration: none !important;
            transform: translateY(-1px);
        }

        .driver-contract-action-icon-btn i {
            font-size: 13px;
            color: #3699ff !important;
        }

        .driver-contract-action-danger:hover {
            background: #fff5f6 !important;
            border-color: #ffd0d6 !important;
            color: #f64e60 !important;
        }

        .driver-contract-action-danger:hover i {
            color: #f64e60 !important;
        }

        .driver-contract-action-status-btn {
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
            transition: all 0.15s ease;
        }

        .driver-contract-action-status-btn:hover {
            transform: translateY(-1px);
        }

        .driver-contract-action-active {
            background: #fff5f6 !important;
            color: #f64e60 !important;
            border-color: #ffd0d6 !important;
        }

        .driver-contract-action-inactive {
            background: #eaf4ff !important;
            color: #3699ff !important;
            border-color: #b5d9ff !important;
        }
    </style>
@endonce

<div class="driver-contract-actions-inline">
    <a href="{{ route('editdrivercontract', $id) }}"
       class="driver-contract-action-icon-btn"
       title="تعديل">
        <i class="fas fa-pen"></i>
    </a>

    <div onclick="deletedrivercontract({{ $id }})"
         class="driver-contract-action-icon-btn driver-contract-action-danger"
         title="حذف">
        <i class="fas fa-trash"></i>
    </div>

    @if($contract->active == 1)
        <span class="driver-contract-action-status-btn driver-contract-action-active"
              onclick="activedrivercontract({{ $id }})">
            الغاء التفعيل
        </span>
    @else
        <span class="driver-contract-action-status-btn driver-contract-action-inactive"
              onclick="activedrivercontract({{ $id }})">
            تفعيل
        </span>
    @endif
</div>

@once
    <script>
        function deletedrivercontract(sel) {
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
                        url: `../deletedrivercontract/${id}`,
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

        function activedrivercontract(sel) {
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
                url: `../activedrivercontract/${id}`,
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
