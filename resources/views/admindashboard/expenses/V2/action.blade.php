@once
    <style>
        .expenses-actions-inline {
            width: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            direction: rtl;
            margin: auto;
        }

        .expenses-action-btn {
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
            color: #f64e60 !important;
            cursor: pointer;
            line-height: 1;
            text-decoration: none !important;
            transition: all 0.15s ease;
        }

        .expenses-action-btn:hover {
            background: #fff5f6 !important;
            border-color: #ffd0d6 !important;
            color: #f64e60 !important;
            transform: translateY(-1px);
        }

        .expenses-action-btn i {
            font-size: 13px;
            color: #f64e60 !important;
        }
    </style>
@endonce

<div class="expenses-actions-inline">
    <div onclick="deleteexpense({{ $id }})"
         class="expenses-action-btn"
         title="حذف">
        <i class="fas fa-trash"></i>
    </div>
</div>

@once
    <script>
        function deleteexpense(sel) {
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
                        url: `expenses/${id}`,
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
