@once
    <style>
        .driver-company-actions-inline {
            width: 115px;
            display: grid;
            grid-template-columns: 34px 34px 34px;
            align-items: center;
            justify-content: center;
            gap: 7px;
            direction: rtl;
            margin: auto;
        }

        .driver-company-action-btn {
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

        .driver-company-action-btn:hover {
            background: #eaf4ff !important;
            border-color: #b5d9ff !important;
            color: #3699ff !important;
            text-decoration: none !important;
        }

        .driver-company-action-btn i {
            font-size: 13px;
            color: #3699ff !important;
        }

        .driver-company-action-danger:hover {
            background: #fff5f6 !important;
            border-color: #ffd0d6 !important;
            color: #f64e60 !important;
        }

        .driver-company-action-danger:hover i {
            color: #f64e60 !important;
        }

        .driver-company-action-success:hover {
            background: #e8fff3 !important;
            border-color: #bdf4dd !important;
            color: #1bc5bd !important;
        }

        .driver-company-action-success:hover i {
            color: #1bc5bd !important;
        }
    </style>
@endonce

<div class="driver-company-actions-inline">
    <a href="{{ route('driver_companies.edit', $id) }}"
       class="driver-company-action-btn"
       title="تعديل">
        <i class="fas fa-pen"></i>
    </a>

    <div onclick="deletedriver({{ $id }})"
         class="driver-company-action-btn driver-company-action-danger"
         title="حذف">
        <i class="fas fa-trash"></i>
    </div>

    <a href="{{ route('company_drivers.index', $id) }}"
       class="driver-company-action-btn driver-company-action-success"
       title="السائقين">
        <i class="fas fa-biking"></i>
    </a>
</div>

@once
    <script>
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
                        url: `driver_companies/${id}`,
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
