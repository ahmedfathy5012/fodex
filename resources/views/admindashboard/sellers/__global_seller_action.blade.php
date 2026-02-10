<a href="{{ route('seller.show', $id) }}">
    <i class="fas fa-eye font_icon"></i></a>
<a href="{{ route('sellerworkschedule.index', $id) }}"><img
        src="{{ asset('workse.png') }}"style="width:25px;height:25px;"></a>
<a class="btn btn-success btn-sm m-0 span" href="{{ route('sellerzones', $id) }}">اسعار المناطق</a>
<a href="{{ route('seller.edit', $id) }}" class="btn btn-sm btn-hover-bg-light m-0 span">

    <span class="svg-icon svg-icon-primary m-0 p-0 svg-icon-md">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
            viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24" />
                <path
                    d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                    fill="#000000" fill-rule="nonzero"
                    transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) " />
                <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1" />
            </g>
        </svg>
    </span>

</a>

<div style="cursor:pointer;" onclick="deleteseller({{ $id }})"
    class="btn btn-sm btn-hover-bg-light mr-1 span">
    <span
        class="svg-icon svg-icon-danger m-0 p-0 svg-icon-md"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-12-28-020759/theme/html/demo8/dist/../src/media/svg/icons/Home/Trash.svg-->
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
            viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24" />
                <path
                    d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z"
                    fill="#000000" fill-rule="nonzero" />
                <path
                    d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                    fill="#000000" opacity="0.3" />
            </g>
        </svg><!--end::Svg Icon-->
    </span>
</div>


<a href="{{ route('seller_extras.index', $id) }}" class="btn btn-sm btn-primary m-0 span">الاكسترا</a>

<a href="{{ route('sellercategory', $id) }}" class="btn btn-sm btn-primary m-0 span">الاقسام</a>
<a href="{{ route('sellercontracts', $id) }}" class="btn btn-sm btn-primary m-0 span">العقود</a>
<a href="{{ route('selleremployees.index', $id) }}" class="btn btn-sm btn-primary m-0 span">الموظفين</a>
@if ($block == 1)
    <span class="btn btn-primary span" onclick="blockseller({{ $id }})">الغاء البلوك</span>
@else
    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-danger btn-sm span" data-toggle="modal"
        data-target="#myModal{{ $id }}">بلوك</button>

    <!-- Modal -->
    <div id="myModal{{ $id }}" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">اسباب البلوك</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label>
                                السبب
                            </label>
                            <input type="text" class="form-control" id="block_reason{{ $id }}">
                        </div>

                    </div>
                    <div class="row">
                        <input type="button" onclick="blockseller({{ $id }})"
                            class="btn btn-sm btn-primary mr-4" value="حفظ">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<!--@if ($close == 1)
-->
<!--<span class="btn btn-success btn-sm" onclick="openseller({{ $id }})">-->
<!--    فتح-->
<!--</span>-->
<!--@else-->
<!-- <span class="btn btn-danger btn-sm" onclick="openseller({{ $id }})">-->
<!--    اغلاق-->
<!--</span>-->
<!--
@endif-->
<span class="switch btn btns-m switch-outline switch-icon switch-primary">
    <label>
        <input type="checkbox" name="active" onchange="openseller({{ $id }})"
            @if ($availability == 1) checked @endif value="1" />
        <span @if ($availability == 1) title="un available" @else title="available" @endif></span>
    </label>
</span>
<!--<a href="{{ route('itemseller', $id) }}" class="btn btn-success btn-sm">المنتجات</a>-->
<a href="{{ route('seller_items', $id) }}" class="span"
    style="background-color: #e6f1fb;
    border-radius: 9px;
    padding: 7px;" title="المنتجات"> <i
        class="fas fa-pizza-slice" style="color:red;"></i></a>
<span class="btn btn-success btn-sm span" style="font-size:11px;color:white;" data-toggle="modal"
    data-target="#myModale{{ $id }}">
    تحصيل </span>
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->


<div id="myModale{{ $id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">


        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">تحصيل </h4>
            </div>
            <div class="modal-body">
                <div>
                    @if (isset($collect))
                        اخر تحصيل منذ
                        {{ \Carbon\Carbon::parse($collect->created_at)->format('Y-m-d') }}
                    @else
                        لم يحصل بعد
                    @endif
                </div>
                <div class="row">
                    <div class="col-6">
                        <label>عدد الطلبات</label>
                        <input type="number" required value="{{ $countorders }}" min="1" name="orders"
                            id="orders{{ $id }}" class="form-control">
                    </div>
                    <div class="col-6">
                        <label> المبلغ + المتبقى</label>
                        <input type="hidden" id="total{{ $id }}" value="{{ $value }}"
                            class="form-control">
                        <input type="text" id="money_taken{{ $id }}" value="{{ $value }}"
                            class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-3">
                        <input type="button" onclick="addcollection({{ $id }})" value="حفظ"
                            class="form-control btn btn-success btn-sm m-4">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
</div>
<span class="switch btn btns-m switch-outline switch-icon switch-primary">
    <label>
        <input type="checkbox" name="active" onchange="choose_seller_website({{ $id }})"
            @if (in_array($id, $sellers->pluck('seller_id')->toArray())) checked @endif value="1" />
        <span title="ظهور المطعم فى الموقع"></span>
    </label>
</span>

<script>
    function toggle_btns(id) {
        $(`.btns${id}`).toggle();

    }

    function addcollection(id) {
        var table = $('.dataTable').DataTable();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: `addcollection`,
            //    contentType: "application/json; charset=utf-8",
            dataType: "Json",
            data: {
                'total': $(`#total${id}`).val(),
                'money_taken': $(`#money_taken${id}`).val(),
                //'money_left':$(`#discount_to${id}`).val(),
                'id': id
            },
            success: function(result) {
                if (result.status == true) {


                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: result.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $(`#myModale${id}`).modal('hide');
                    table.ajax.reload();
                }
            }
        })
    }

    function deleteseller(sel) {
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
                    url: `seller/${id}`,
                    //    contentType: "application/json; charset=utf-8",
                    dataType: "Json",
                    success: function(result) {
                        if (result.status == true) {
                            Swal.fire(
                                'Deleted!',
                                'تم المسح بنجاح',
                                'success'
                            )
                        }
                        table.ajax.reload();
                    }
                });
            }
        })
    }

    function blockseller(sel) {
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
            url: `blockseller`,
            //    contentType: "application/json; charset=utf-8",
            dataType: "Json",
            data: {
                'id': id,
                'block_reason': $(`#block_reason${id}`).val(),
            },
            success: function(result) {
                if (result.status == true) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'تمت بنجاح ',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $(`#myModal${id}`).modal('hide');
                    table.ajax.reload();
                }

            }
        })
    }
    //
    function openseller(sel) {
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
            url: `openseller/${id}`,
            //    contentType: "application/json; charset=utf-8",
            dataType: "Json",
            success: function(result) {
                if (result.status == true) {

                    table.ajax.reload();
                }

            }
        })
    }

    function choose_seller_website(sel) {
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
            url: `choose_seller_website/${id}`,
            //    contentType: "application/json; charset=utf-8",
            dataType: "Json",
            success: function(result) {
                if (result.status == true) {

                    table.ajax.reload();
                }

            }
        })
    }
</script>
