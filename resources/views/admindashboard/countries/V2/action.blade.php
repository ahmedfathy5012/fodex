@once
    <style>
        .country-actions-inline {
            width: 115px;
            display: grid;
            grid-template-columns: 34px 34px 34px;
            align-items: center;
            justify-content: center;
            gap: 7px;
            direction: rtl;
            margin: auto;
        }

        .country-action-btn {
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

        .country-action-btn:hover {
            background: #eaf4ff !important;
            border-color: #b5d9ff !important;
            color: #3699ff !important;
            transform: translateY(-1px);
        }

        .country-action-btn i {
            font-size: 13px;
            color: #3699ff !important;
        }

        .country-action-danger {
            color: #f64e60 !important;
        }

        .country-action-danger i {
            color: #f64e60 !important;
        }

        .country-action-danger:hover {
            background: #fff5f6 !important;
            border-color: #ffd0d6 !important;
            color: #f64e60 !important;
        }

        .country-action-states img {
            width: 18px !important;
            height: 18px !important;
            object-fit: contain;
            border-radius: 0 !important;
        }

        .country-action-states:hover {
            background: #e8fff3 !important;
            border-color: #bdf4dd !important;
        }
    </style>
@endonce

<div class="country-actions-inline">
    <a href="{{ route('country.edit', $id) }}"
       class="country-action-btn"
       title="تعديل">
        <i class="fas fa-pen"></i>
    </a>

    <div onclick="deletecountry({{ $id }})"
         class="country-action-btn country-action-danger"
         title="حذف">
        <i class="fas fa-trash"></i>
    </div>

    <a href="{{ route('country_states', $id) }}"
       class="country-action-btn country-action-states"
       title="المحافظات">
        <img src="{{ asset('state.png') }}" alt="states">
    </a>
</div>

@once
    <script>
        function deletecountry(sel) {
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
                        url: `country/${id}`,
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
