<?php
$res = \App\Models\Driver::where('id', $id)->first();

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
        .company-collection-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            flex-wrap: wrap;
            direction: rtl;
        }

        .company-collection-badge {
            min-width: 74px;
            height: 30px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 900;
            cursor: pointer;
            padding: 0 10px;
            border: 1px solid transparent;
            transition: all 0.15s ease;
        }

        .company-collection-badge-new {
            background: #e8fff3;
            color: #1bc5bd;
            border-color: #bdf4dd;
        }

        .company-collection-badge-new:hover {
            background: #1bc5bd;
            color: #ffffff;
        }

        .company-collection-badge-old {
            background: #eaf4ff;
            color: #3699ff;
            border-color: #b5d9ff;
        }

        .company-collection-badge-old:hover {
            background: #3699ff;
            color: #ffffff;
        }

        .company-collection-modal .modal-content {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 14px 40px rgba(0, 0, 0, 0.18);
            direction: rtl;
        }

        .company-collection-modal .modal-header {
            background: #fbfcfe;
            border-bottom: 1px solid #edf0f5;
            padding: 18px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .company-collection-modal .modal-title {
            margin: 0;
            font-size: 17px;
            font-weight: 900;
            color: #181c32;
        }

        .company-collection-modal .close {
            margin: 0;
            padding: 0;
            color: #7e8299;
            opacity: 1;
            font-size: 26px;
            font-weight: 700;
        }

        .company-collection-modal .modal-body {
            padding: 22px;
            background: #ffffff;
        }

        .company-collection-modal .modal-footer {
            border-top: 1px solid #edf0f5;
            padding: 14px 22px;
            display: flex;
            justify-content: flex-start;
            gap: 10px;
        }

        .company-collection-modal .form-group label,
        .company-collection-modal label {
            font-weight: 800;
            color: #3f4254;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .company-collection-modal .form-control {
            min-height: 42px;
            border-radius: 10px !important;
            border: 1px solid #e4e6ef !important;
            color: #3f4254 !important;
            box-shadow: none !important;
            text-align: center;
            font-weight: 700;
        }

        .company-collection-modal .form-control:focus {
            border-color: #3699ff !important;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
        }

        .company-collection-save-btn {
            min-width: 120px;
            height: 42px;
            border-radius: 10px !important;
            background: #1bc5bd !important;
            border: 0 !important;
            color: #ffffff !important;
            font-weight: 900 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 8px 18px rgba(27, 197, 189, 0.22);
        }

        .company-collection-save-btn:hover {
            color: #ffffff !important;
            background: #159b96 !important;
        }

        .company-collection-close-btn {
            min-width: 100px;
            height: 40px;
            border-radius: 10px !important;
            background: #f3f6f9 !important;
            color: #3f4254 !important;
            border: 1px solid #e4e6ef !important;
            font-weight: 800 !important;
        }
    </style>
@endonce

<div class="company-collection-wrapper">
    @foreach($aa as $a)
            <?php
            $modalKey = str_replace('-', '', $a);

            $collect = \App\Models\AllCollection::where('driver_id', $id)
                ->where('month_date', $a)
                ->first();
            ?>

        @if($collect)
            @if($collect->money_left != 0)
                <span class="company-collection-badge company-collection-badge-old"
                      data-toggle="modal"
                      data-target="#companyCollectionOld{{ $modalKey }}">
                    {{ $a }}
                </span>

                <div id="companyCollectionOld{{ $modalKey }}" class="modal fade company-collection-modal" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">تحصيل شهر {{ $a }}</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label>عدد الطلبات</label>
                                        <input type="number"
                                               disabled
                                               required
                                               value="{{ $collect->ordersnumber }}"
                                               min="1"
                                               class="form-control">
                                    </div>

                                    <div class="form-group col-4">
                                        <label>المبلغ الكلى</label>
                                        <input type="number"
                                               disabled
                                               required
                                               value="{{ $collect->total }}"
                                               min="1"
                                               class="form-control">
                                    </div>

                                    <div class="form-group col-4">
                                        <label>المحصل</label>
                                        <input type="number"
                                               disabled
                                               required
                                               value="{{ $collect->money_taken }}"
                                               min="1"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>المتبقى</label>
                                        <input type="number"
                                               required
                                               value="{{ $collect->money_left }}"
                                               max="{{ $collect->money_left }}"
                                               min="1"
                                               id="value{{ $modalKey }}"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="text-center mt-3">
                                    <input type="button"
                                           onclick="add_company_collection({{ $id }}, '{{ $a }}', '{{ $modalKey }}')"
                                           value="حفظ"
                                           class="btn company-collection-save-btn">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button"
                                        class="btn company-collection-close-btn"
                                        data-dismiss="modal">
                                    إغلاق
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @else
                <?php
                $orders = $res->company_done_orders()
                    ->whereYear('orders.created_at', \Carbon\Carbon::parse($a))
                    ->whereMonth('orders.created_at', \Carbon\Carbon::parse($a))
                    ->get();

                $countorders = count($orders);

                $money = array_sum(
                    $res->company_done_orders()
                        ->whereYear('orders.created_at', \Carbon\Carbon::parse($a))
                        ->whereMonth('orders.created_at', \Carbon\Carbon::parse($a))
                        ->get()
                        ->pluck('delivery_fee')
                        ->toArray()
                );

                $value = 0;

                if ($res->commission) {
                    $value = $money * ($res->commission / 100);
                }
                ?>

            @if($res->commission && $countorders != 0)
                <span class="company-collection-badge company-collection-badge-new"
                      data-toggle="modal"
                      data-target="#companyCollectionNew{{ $modalKey }}">
                    {{ $a }}
                </span>

                <div id="companyCollectionNew{{ $modalKey }}" class="modal fade company-collection-modal" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">تحصيل شهر {{ $a }}</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label>عدد الطلبات</label>
                                        <input type="number"
                                               disabled
                                               required
                                               value="{{ $countorders }}"
                                               min="1"
                                               id="orders{{ $modalKey }}"
                                               class="form-control">
                                    </div>

                                    <div class="form-group col-4">
                                        <label>المبلغ الكلى</label>
                                        <input type="number"
                                               disabled
                                               required
                                               value="{{ $value }}"
                                               min="1"
                                               id="total{{ $modalKey }}"
                                               class="form-control">
                                    </div>

                                    <div class="form-group col-4">
                                        <label>المحصل</label>
                                        <input type="number"
                                               disabled
                                               required
                                               value="0"
                                               min="1"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>المبلغ</label>
                                        <input type="number"
                                               required
                                               value="{{ $value }}"
                                               max="{{ $value }}"
                                               min="1"
                                               id="value{{ $modalKey }}"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="text-center mt-3">
                                    <input type="button"
                                           onclick="add_company_collection({{ $id }}, '{{ $a }}', '{{ $modalKey }}')"
                                           value="حفظ"
                                           class="btn company-collection-save-btn">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button"
                                        class="btn company-collection-close-btn"
                                        data-dismiss="modal">
                                    إغلاق
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    @endforeach
</div>

@once
    <script>
        function add_company_collection(id, date, modalKey) {
            var table = $('.dataTable').DataTable();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: `add_company_collection`,
                dataType: "Json",
                data: {
                    'value': $(`#value${modalKey}`).val(),
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

                        $(`#companyCollectionOld${modalKey}`).modal('hide');
                        $(`#companyCollectionNew${modalKey}`).modal('hide');

                        table.ajax.reload();
                    }
                }
            });
        }
    </script>
@endonce
