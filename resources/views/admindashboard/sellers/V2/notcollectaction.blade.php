<?php
$res = \App\Models\Seller::where('id', $id)->first();
$collect = \App\Models\AllCollection::where('seller_id', $id)->latest()->first();
?>

<?php
$date2 = \Carbon\Carbon::now()->subMonth()->format('Y-m-d');
$date1 = \Carbon\Carbon::parse($res->created_at)->format('Y-m-d');

$period = \Carbon\CarbonPeriod::create($date1, '1 month', $date2);

$aa = [];

foreach ($period as $dt) {
    $aa[] = $dt->format("Y-m");
}
?>

@once
    <style>
        .seller-collection-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 7px;
            direction: rtl;
            max-width: 260px;
            margin: auto;
        }

        .seller-collection-badge {
            min-width: 76px;
            height: 32px;
            border-radius: 8px !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            font-size: 12px !important;
            font-weight: 800 !important;
            cursor: pointer;
            margin: 0 !important;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.08);
            transition: all 0.15s ease;
        }

        .seller-collection-badge:hover {
            transform: translateY(-1px);
        }

        .seller-collection-badge-primary {
            background: #eaf4ff !important;
            color: #3699ff !important;
            border: 1px solid #b5d9ff !important;
        }

        .seller-collection-badge-success {
            background: #e8fff3 !important;
            color: #1bc5bd !important;
            border: 1px solid #bdf4dd !important;
        }

        .seller-collection-modal .modal-content {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.18);
        }

        .seller-collection-modal .modal-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 18px 22px;
        }

        .seller-collection-modal .modal-title {
            margin: 0;
            font-size: 18px;
            font-weight: 900;
            color: #181c32;
        }

        .seller-collection-modal .modal-body {
            padding: 22px;
            direction: rtl;
        }

        .seller-collection-modal label {
            font-size: 14px;
            font-weight: 800;
            color: #3f4254;
            margin-bottom: 8px;
        }

        .seller-collection-modal .form-control {
            min-height: 44px;
            border-radius: 10px;
            border: 1px solid #e4e6ef;
            color: #3f4254;
            box-shadow: none !important;
        }

        .seller-collection-modal .form-control:focus {
            border-color: #3699ff;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
        }

        .seller-collection-save-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 18px;
        }

        .seller-collection-save-btn {
            min-width: 120px;
            height: 40px;
            border-radius: 10px !important;
            background: #1bc5bd !important;
            border: 0 !important;
            color: #ffffff !important;
            font-weight: 800 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
        }

        .seller-collection-modal .modal-footer {
            border-top: 1px solid #edf0f5;
            padding: 14px 22px;
        }

        .seller-collection-modal .btn-default {
            border-radius: 10px !important;
            font-weight: 800;
        }
    </style>
@endonce

<div class="seller-collection-wrapper">
    @foreach($aa as $a)
            <?php
            $date3 = \Carbon\Carbon::parse($a)->format('Y-m');

            $collect = \App\Models\AllCollection::where('seller_id', $id)
                ->where('month_date', $a)
                ->first();
            ?>

        @if($collect)
            @if($collect->money_left != 0)
                <span class="badge seller-collection-badge seller-collection-badge-primary"
                      data-toggle="modal"
                      data-target="#myModale{{ $a }}">
                    {{ $a }}
                </span>

                <div id="myModale{{ $a }}" class="modal fade seller-collection-modal" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">تحصيل</h4>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-4">
                                        <label>عدد الطلبات</label>
                                        <input type="number"
                                               disabled
                                               required
                                               value="{{ $collect->ordersnumber }}"
                                               min="1"
                                               name="orders"
                                               class="form-control">
                                    </div>

                                    <div class="col-4">
                                        <label>المبلغ الكلى</label>
                                        <input type="number"
                                               disabled
                                               required
                                               value="{{ $collect->total }}"
                                               min="1"
                                               name="orders"
                                               class="form-control">
                                    </div>

                                    <div class="col-4">
                                        <label>المحصل</label>
                                        <input type="number"
                                               disabled
                                               required
                                               value="{{ $collect->money_taken }}"
                                               min="1"
                                               name="orders"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <label>المتبقى</label>
                                        <input type="number"
                                               required
                                               value="{{ $collect->money_left }}"
                                               max="{{ $collect->money_left }}"
                                               min="1"
                                               name="orders"
                                               id="value{{ $a }}"
                                               class="form-control">
                                    </div>
                                </div>

                                <input type="hidden" id="{{ $collect->ordersnumber }}" value="{{ $a }}">

                                <div class="seller-collection-save-wrapper">
                                    <input type="button"
                                           onclick="addcollection({{ $id }}, {{ $collect->ordersnumber }})"
                                           value="حفظ"
                                           class="btn seller-collection-save-btn">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                    Close
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
        @else
                <?php
                $orders = $res->acceptorders()
                    ->whereYear('orders.created_at', \Carbon\Carbon::parse($a))
                    ->whereMonth('orders.created_at', \Carbon\Carbon::parse($a))
                    ->get();

                $countorders = count($orders);

                $money = array_sum(
                        $res->orders()
                            ->where('status', 1)
                            ->whereYear('orders.created_at', \Carbon\Carbon::parse($a))
                            ->whereMonth('orders.created_at', \Carbon\Carbon::parse($a))
                            ->get()
                            ->pluck('priceafterdiscount')
                            ->toArray()
                    ) - array_sum(
                        $res->orders()
                            ->where('status', 1)
                            ->whereYear('orders.created_at', \Carbon\Carbon::parse($a))
                            ->whereMonth('orders.created_at', \Carbon\Carbon::parse($a))
                            ->get()
                            ->pluck('delivery_fee')
                            ->toArray()
                    );

                $contract = \App\Models\Sellercontract::where('seller_id', $id)
                    ->where('active', 1)
                    ->latest()
                    ->first();
                ?>

            @if($contract)
                    <?php
                    $value = $money * ($contract->percentage / 100);
                    ?>

                @if($countorders != 0)
                    <span class="badge seller-collection-badge seller-collection-badge-success"
                          data-toggle="modal"
                          data-target="#myModal{{ $a }}">
                        {{ $a }}
                    </span>

                    <div id="myModal{{ $a }}" class="modal fade seller-collection-modal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">تحصيل</h4>
                                </div>

                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <label>عدد الطلبات</label>
                                            <input type="number"
                                                   disabled
                                                   required
                                                   value="{{ $countorders }}"
                                                   min="1"
                                                   name="orders"
                                                   id="orders{{ $a }}"
                                                   class="form-control">
                                        </div>

                                        <div class="col-4">
                                            <label>المبلغ الكلى</label>
                                            <input type="number"
                                                   disabled
                                                   required
                                                   value="{{ $value }}"
                                                   min="1"
                                                   name="orders"
                                                   id="total{{ $a }}"
                                                   class="form-control">
                                        </div>

                                        <div class="col-4">
                                            <label>المحصل</label>
                                            <input type="number"
                                                   disabled
                                                   required
                                                   value="0"
                                                   min="1"
                                                   name="orders"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <label>المبلغ</label>
                                            <input type="number"
                                                   required
                                                   value="{{ $value }}"
                                                   max="{{ $value }}"
                                                   min="1"
                                                   name="orders"
                                                   id="value{{ $a }}"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <input type="hidden" id="{{ $countorders }}" value="{{ $a }}">

                                    <div class="seller-collection-save-wrapper">
                                        <input type="button"
                                               onclick="addcollection({{ $id }}, {{ $countorders }})"
                                               value="حفظ"
                                               class="btn seller-collection-save-btn">
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                        Close
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif
            @endif
        @endif
    @endforeach
</div>

@once
    <script>
        function showres(sel) {
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
                url: `showres/${id}`,
                dataType: "Json",
                success: function(result) {
                    if (result.status == true) {
                        table.ajax.reload();
                    }
                }
            });
        }

        function opennow(sel) {
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
                url: `opennow/${id}`,
                dataType: "Json",
                success: function(result) {
                    if (result.status == true) {
                        table.ajax.reload();
                    }
                }
            });
        }

        function discountres(sel) {
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
                url: `discountres/${id}`,
                dataType: "Json",
                data: {
                    'discount': $(`#discount${id}`).val(),
                    'discount_from': $(`#discount_from${id}`).val(),
                    'discount_to': $(`#discount_to${id}`).val()
                },
                success: function(result) {
                    if (result.status == true) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'تم اضافه الخصم بنجاح',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        $(`#myModal${id}`).modal('hide');
                        table.ajax.reload();
                    }
                }
            });
        }

        function addcollection(id, a) {
            var table = $('.dataTable').DataTable();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let date = $(`#${a}`).val();

            console.log(date);

            $.ajax({
                type: "post",
                url: `addcollection`,
                dataType: "Json",
                data: {
                    'value': $(`#value${date}`).val(),
                    'date': date,
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
                        });

                        $(".modal-backdrop").remove();
                        $(`#myModale${date}`).modal('hide');
                        $(`#myModal${date}`).modal('hide');

                        table.ajax.reload();
                    }
                }
            });
        }
    </script>
@endonce
