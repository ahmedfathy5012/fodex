@once
    <style>
        .state-actions-inline {
            width: 115px;
            display: grid;
            grid-template-columns: 34px 34px 34px;
            align-items: center;
            justify-content: center;
            gap: 7px;
            direction: rtl;
            margin: auto;
        }

        .state-action-btn {
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

        .state-action-btn:hover {
            background: #eaf4ff !important;
            border-color: #b5d9ff !important;
            color: #3699ff !important;
            transform: translateY(-1px);
        }

        .state-action-btn i {
            font-size: 13px;
            color: #3699ff !important;
        }

        .state-action-danger {
            color: #f64e60 !important;
        }

        .state-action-danger i {
            color: #f64e60 !important;
        }

        .state-action-danger:hover {
            background: #fff5f6 !important;
            border-color: #ffd0d6 !important;
            color: #f64e60 !important;
        }

        .state-action-cities img {
            width: 18px !important;
            height: 18px !important;
            object-fit: contain;
            border-radius: 0 !important;
        }

        .state-action-cities:hover {
            background: #e8fff3 !important;
            border-color: #bdf4dd !important;
        }
    </style>
@endonce

<div class="state-actions-inline">
    <a href="{{ route('state.edit', $id) }}"
       class="state-action-btn"
       title="تعديل">
        <i class="fas fa-pen"></i>
    </a>

    <div onclick="deletestate({{ $id }})"
         class="state-action-btn state-action-danger"
         title="حذف">
        <i class="fas fa-trash"></i>
    </div>

    <a href="{{ route('state_cities', $id) }}"
       class="state-action-btn state-action-cities"
       title="المدن">
        <img src="{{ asset('city.png') }}" alt="cities">
    </a>
</div>

@once
    <script>
        function deletestate(sel) {
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
                        url: `state/${id}`,
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
