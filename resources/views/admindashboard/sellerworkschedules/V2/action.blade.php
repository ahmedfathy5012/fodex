@once
    <style>
        .work-schedule-actions-inline {
            width: 75px;
            display: grid;
            grid-template-columns: 34px 34px;
            align-items: center;
            justify-content: center;
            gap: 7px;
            direction: rtl;
            margin: auto;
        }

        .work-schedule-action-btn {
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

        .work-schedule-action-btn:hover {
            background: #eaf4ff !important;
            border-color: #b5d9ff !important;
            color: #3699ff !important;
        }

        .work-schedule-action-btn i {
            font-size: 13px;
            color: #3699ff !important;
        }

        .work-schedule-action-btn svg {
            width: 15px !important;
            height: 15px !important;
        }

        .work-schedule-action-btn svg path,
        .work-schedule-action-btn svg rect {
            fill: #3699ff !important;
        }

        .work-schedule-action-danger:hover {
            background: #fff5f6 !important;
            border-color: #ffd0d6 !important;
            color: #f64e60 !important;
        }

        .work-schedule-action-danger:hover i {
            color: #f64e60 !important;
        }
    </style>
@endonce

<div class="work-schedule-actions-inline">
    <a href="{{ route('sellerworkschedule.edit', $id) }}"
       class="work-schedule-action-btn"
       title="تعديل">
        <i class="fas fa-pen"></i>
    </a>

    <div onclick="deleteworkschedule({{ $id }})"
         class="work-schedule-action-btn work-schedule-action-danger"
         title="حذف">
        <i class="fas fa-trash"></i>
    </div>
</div>

@once
    <script>
        function deleteworkschedule(sel) {
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
                        url: `../workschedule/${id}`,
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
