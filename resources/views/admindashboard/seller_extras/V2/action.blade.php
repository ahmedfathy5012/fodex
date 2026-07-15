<style>
    .sellerextra-inline-actions {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .sellerextra-inline-btn {
        width: 34px;
        height: 34px;
        border: 1px solid #e4e6ef;
        border-radius: 8px;
        background: #f8f9fc;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.15s ease;
    }

    .sellerextra-inline-btn:hover {
        background: #eef4ff;
        border-color: #c9ddff;
    }

    .sellerextra-inline-btn i {
        color: #3699ff;
        font-size: 13px;
    }

    .sellerextra-inline-btn.is-delete i {
        color: #f64e60;
    }
</style>

<div class="sellerextra-inline-actions">
    <a href="{{ route('seller_extras.edit', $id) }}" class="sellerextra-inline-btn" title="تعديل">
        <i class="fas fa-edit"></i>
    </a>

    <button type="button" onclick="deletecoins({{ $id }})" class="sellerextra-inline-btn is-delete" title="حذف">
        <i class="fas fa-trash"></i>
    </button>
</div>

<script>
    function deletecoins(sel) {
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
                    type: 'delete',
                    url: `deleteseller_extras/${id}`,
                    dataType: 'Json',
                    success: function(result) {
                        if (result.status === true) {
                            Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
                        }

                        table.ajax.reload();
                    }
                });
            }
        });
    }
</script>
