@extends('layouts.adminindex')

@section('content')
    <style>
        .order-show-page {
            direction: rtl;
        }

        .order-show-card {
            border: 0;
            border-radius: 18px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
        }

        .order-show-header {
            /*background: ;*/
            padding: 34px 28px;
            color: #ffffff;
        }

        .order-show-title {
            color: #ffffff;
            font-size: 28px;
            font-weight: 900;
            margin-bottom: 26px;
        }

        .order-info-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
            margin-top: 18px;
        }

        .order-info-box {
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 14px;
            padding: 14px 16px;
            min-height: 76px;
        }

        .order-info-label {
            display: block;
            color: #ffffff;
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .order-info-value {
            display: block;
            color: rgba(255, 255, 255, 0.86);
            font-size: 14px;
            font-weight: 600;
            line-height: 1.6;
        }

        .order-show-toolbar {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 18px 28px;
        }

        .order-toolbar-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .order-toolbar-btn {
            min-width: 190px;
            height: 42px;
            border-radius: 10px !important;
            border: 0 !important;
            background: #3699ff !important;
            color: #ffffff !important;
            font-size: 13px;
            font-weight: 800 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 18px rgba(54, 153, 255, 0.22);
        }

        .order-actions-panel {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 18px;
            margin: 22px 28px;
        }

        .order-actions-title {
            font-size: 16px;
            font-weight: 800;
            color: #181c32;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .order-actions-title::before {
            content: "";
            width: 5px;
            height: 18px;
            border-radius: 10px;
            background: #3699ff;
            display: inline-block;
        }

        .order-actions-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .order-action-btn,
        .order-action-label {
            min-width: 125px;
            min-height: 38px;
            margin: 0 !important;
            padding: 8px 12px !important;
            border-radius: 10px !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            font-size: 13px !important;
            font-weight: 800 !important;
            white-space: nowrap;
            cursor: pointer;
            border: 1px solid transparent !important;
        }

        .order-action-icon {
            width: 38px;
            min-width: 38px;
            height: 38px;
            padding: 0 !important;
            background: #f3f6f9 !important;
            border-color: #e4e6ef !important;
        }

        .order-action-icon img {
            width: 18px !important;
            height: 18px !important;
            object-fit: contain;
        }

        .order-action-primary {
            background: #eaf4ff !important;
            color: #3699ff !important;
            border-color: #b5d9ff !important;
        }

        .order-action-success {
            background: #e8fff3 !important;
            color: #1bc5bd !important;
            border-color: #bdf4dd !important;
        }

        .order-action-danger {
            background: #fff5f6 !important;
            color: #f64e60 !important;
            border-color: #ffd0d6 !important;
        }

        .order-action-warning {
            background: #fff8dd !important;
            color: #ffa800 !important;
            border-color: #ffe7a0 !important;
        }

        .order-items-section {
            padding: 8px 28px 28px;
        }

        .order-items-card {
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 18px;
            overflow-x: auto;
        }

        .order-show-page table.dataTable {
            width: 100% !important;
            border-collapse: separate !important;
            border-spacing: 0 8px !important;
            margin-top: 0 !important;
        }

        .order-show-page table.dataTable thead th {
            background: #f3f6f9;
            color: #3f4254;
            font-weight: 800;
            border: 0 !important;
            padding: 14px 12px !important;
            white-space: nowrap;
            text-align: center;
        }

        .order-show-page table.dataTable tbody td {
            border-top: 1px solid #edf0f5 !important;
            border-bottom: 1px solid #edf0f5 !important;
            padding: 13px 12px !important;
            vertical-align: middle !important;
            text-align: center;
            color: #3f4254;
        }

        .order-show-page .modal-content {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.18);
        }

        .order-show-page .modal-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 18px 22px;
        }

        .order-show-page .modal-title {
            font-size: 18px;
            font-weight: 900;
            color: #181c32;
            margin: 0;
        }

        .order-show-page .modal-body {
            padding: 22px;
            direction: rtl;
        }

        .order-show-page .modal-footer {
            border-top: 1px solid #edf0f5;
            padding: 14px 22px;
        }

        .order-show-page .modal-body label,
        .order-show-page .modal-body .text {
            font-size: 14px;
            font-weight: 800;
            color: #3f4254;
            margin-bottom: 8px;
        }

        .order-show-page .modal-body .text2 {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 10px;
            padding: 10px 12px;
            color: #3f4254;
            font-weight: 700;
            min-height: 42px;
        }

        .order-show-page .form-control {
            min-height: 44px;
            border-radius: 10px;
            border: 1px solid #e4e6ef;
            color: #3f4254;
            box-shadow: none !important;
        }

        .order-show-page .form-control:focus {
            border-color: #3699ff;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
        }

        @media (max-width: 768px) {
            .order-info-grid {
                grid-template-columns: 1fr;
            }

            .order-show-header,
            .order-show-toolbar,
            .order-items-section {
                padding-left: 18px;
                padding-right: 18px;
            }

            .order-actions-panel {
                margin-left: 18px;
                margin-right: 18px;
            }

            .order-toolbar-btn,
            .order-action-btn,
            .order-action-label {
                width: 100%;
            }
        }
    </style>

    <div class="order-show-page">
        <div class="card card-custom overflow-hidden invoice_table order-show-card" id="invoice">
            <div class="card-body p-0">

                <div class="order-show-header invoice_back">
                    <div class="container-fluid">
                        <h1 class="order-show-title title_wizard">تفاصيل الطلب</h1>

                        <div class="order-info-grid">
                            <div class="order-info-box">
                                <span class="order-info-label title_wizard">الاسم</span>
                                <span class="order-info-value text-wizard">{{ $order->user->name ?? "" }}</span>
                            </div>

                            <div class="order-info-box">
                                <span class="order-info-label title_wizard">رقم الهاتف</span>
                                <span class="order-info-value text-wizard">{{ $order->user->phone ?? "" }}</span>
                            </div>

                            <div class="order-info-box">
                                <span class="order-info-label title_wizard">العنوان</span>
                                <span class="order-info-value text-wizard">{{ $order->address }}</span>
                            </div>

                            <div class="order-info-box">
                                <span class="order-info-label title_wizard">اسم البائع</span>
                                <span class="order-info-value text-wizard">{{ $order->seller->name ?? "" }}</span>
                            </div>

                            <div class="order-info-box">
                                <span class="order-info-label title_wizard">رقم هاتف البائع</span>
                                <span class="order-info-value text-wizard">{{ $order->seller->phone ?? "" }}</span>
                            </div>

                            <div class="order-info-box">
                                <span class="order-info-label title_wizard">عنوان البائع</span>
                                <span class="order-info-value text-wizard">{{ $order->seller->address->address ?? "" }}</span>
                            </div>

                            <div class="order-info-box">
                                <span class="order-info-label title_wizard">اسم الموظف</span>
                                <span class="order-info-value text-wizard">{{ $order->seller->name ?? "" }}</span>
                            </div>

                            <div class="order-info-box">
                                <span class="order-info-label title_wizard">شركه التوصيل</span>
                                <span class="order-info-value text-wizard">{{ $order->company->name ?? "" }}</span>
                            </div>

                            <div class="order-info-box">
                                <span class="order-info-label title_wizard">اسم السائق</span>
                                <span class="order-info-value text-wizard">{{ $order->driver->name ?? "" }}</span>
                            </div>

                            <div class="order-info-box">
                                <span class="order-info-label title_wizard">السعر</span>
                                <span class="order-info-value text-wizard">{{ $order->price }}</span>
                            </div>

                            <div class="order-info-box">
                                <span class="order-info-label title_wizard">السعر بعد الخصم</span>
                                <span class="order-info-value text-wizard">{{ $order->priceafterdiscount }}</span>
                            </div>

                            <div class="order-info-box">
                                <span class="order-info-label title_wizard">سعر التوصيل</span>
                                <span class="order-info-value text-wizard">{{ $order->delivery_fee }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="order-show-toolbar">
                    <div class="order-toolbar-row">
                        <button type="button" class="btn order-toolbar-btn" data-toggle="modal" data-target="#myModal444">
                            اوقات الطلب
                        </button>

                        <button type="button" class="btn order-toolbar-btn" data-toggle="modal" data-target="#myModal445">
                            احصائيه اوقات الطلب
                        </button>

                        <button type="button" class="btn order-toolbar-btn" data-toggle="modal" data-target="#myModal447">
                            احصائيه اوقات الطلب بالترتيب
                        </button>
                    </div>
                </div>

                <div class="modal fade" role="dialog" id="myModal444">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">اوقات الطلب</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="text font-weight-bolder mb-2">وقت قبول الطلب</p>
                                        <p class="text2 opacity-70">{{ $order->accepted_at ? \Carbon\Carbon::parse($order->accepted_at)->format('g:i A') : null }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <p class="text font-weight-bolder mb-2">وقت قبول المطعم</p>
                                        <p class="text2 opacity-70">{{ $order->seller_accept ? \Carbon\Carbon::parse($order->seller_accept)->format('g:i A') : null }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <p class="text font-weight-bolder mb-2">وقت ادراج الطلب للشركه</p>
                                        <p class="text2 opacity-70">{{ $order->insert_order_driver ? \Carbon\Carbon::parse($order->insert_order_company)->format('g:i A') : null }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <p class="text font-weight-bolder mb-2">وقت ادراج الطلب للسائق</p>
                                        <p class="text2 opacity-70">{{ $order->insert_order_driver ? \Carbon\Carbon::parse($order->insert_order_driver)->format('g:i A') : null }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <p class="text font-weight-bolder mb-2">وقت قبول السائق</p>
                                        <p class="text2 opacity-70">{{ $order->driver_accept ? \Carbon\Carbon::parse($order->driver_accept)->format('g:i A') : null }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <p class="text font-weight-bolder mb-2">وقت تحضير الطلب</p>
                                        <p class="text2 opacity-70">{{ $order->preparation_time ? \Carbon\Carbon::parse($order->preparation_time)->format('g:i A') : null }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <p class="text font-weight-bolder mb-2">وقت وصول السائق للمطعم</p>
                                        <p class="text2 opacity-70">{{ $order->driver_waiting_order ? \Carbon\Carbon::parse($order->driver_waiting_order)->format('g:i A') : null }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <p class="text font-weight-bolder mb-2">وقت استلام السائق للطلب من المطعم</p>
                                        <p class="text2 opacity-70">{{ $order->driver_pickup ? \Carbon\Carbon::parse($order->driver_pickup)->format('g:i A') : null }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <p class="text font-weight-bolder mb-2">وقت وصول الطلب للعميل</p>
                                        <p class="text2 opacity-70">{{ $order->delivery_time ? \Carbon\Carbon::parse($order->delivery_time)->format('g:i A') : null }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" role="dialog" id="myModal445">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">اوقات الطلب</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="text font-weight-bolder mb-2">وقت قبول الطلب</p>
                                        <p class="text2 opacity-70">{{ $order->time_accept }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <p class="text font-weight-bolder mb-2">وقت قبول المطعم</p>
                                        <p class="text2 opacity-70">{{ $order->seller_accept_time }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <p class="text font-weight-bolder mb-2">وقت ادراج الطلب للسائق</p>
                                        <p class="text2 opacity-70">{{ $order->insert_order_driver }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <p class="text font-weight-bolder mb-2">وقت قبول السائق</p>
                                        <p class="text2 opacity-70">{{ $order->driver_accept_time }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <p class="text font-weight-bolder mb-2">وقت تحضير الطلب</p>
                                        <p class="text2 opacity-70">{{ $order->time_preparation }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <p class="text font-weight-bolder mb-2">وقت وصول السائق للمطعم</p>
                                        <p class="text2 opacity-70">{{ $order->driver_waiting_order_time }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <p class="text font-weight-bolder mb-2">وقت استلام السائق للطلب من المطعم</p>
                                        <p class="text2 opacity-70">{{ $order->driver_pickup_time }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <p class="text font-weight-bolder mb-2">وقت وصول الطلب للعميل</p>
                                        <p class="text2 opacity-70">{{ $order->driver_waiting_client_time }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <p class="text font-weight-bolder mb-2">وقت تسليم الطلب</p>
                                        <p class="text2 opacity-70">{{ $order->accepted_at ? \Carbon\Carbon::parse($order->accepted_at)->format('g:i A') : null }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" role="dialog" id="myModal447">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">اوقات الطلب</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="text font-weight-bolder mb-2">وقت قبول الطلب</p>
                                        <p class="text2 opacity-70">{{ $order->time_accept }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <p class="text font-weight-bolder mb-2">وقت قبول المطعم</p>
                                        <p class="text2 opacity-70">{{ $order->seller_accept_after }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <p class="text font-weight-bolder mb-2">وقت قبول السائق بعد الادراج</p>
                                        <p class="text2 opacity-70">{{ $order->driver_accept_after }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <p class="text font-weight-bolder mb-2">وقت تحضير المطعم للطلب</p>
                                        <p class="text2 opacity-70">{{ $order->preparation_after }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <p class="text font-weight-bolder mb-2">وقت وصول السائق للمطعم بعد قبوله الطلب</p>
                                        <p class="text2 opacity-70">{{ $order->driver_reach_seller }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <p class="text font-weight-bolder mb-2">وقت استلام السائق للطلب بعد وصوله للمطعم</p>
                                        <p class="text2 opacity-70">{{ $order->driver_pick_seller }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <p class="text font-weight-bolder mb-2">وقت وصول السائق للعميل بعد استلامه الطلب</p>
                                        <p class="text2 opacity-70">{{ $order->driver_reach_client }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <p class="text font-weight-bolder mb-2">وقت تسليم السائق للعميل بعد وصوله</p>
                                        <p class="text2 opacity-70">{{ $order->driver_pick_client }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="order-actions-panel" id="new">
                    <div class="order-actions-title">إجراءات الطلب</div>

                    <div class="order-actions-row" id="rowing">
                        <?php
                        $drivers = \App\Models\Driver::where("available", 1)->whereHas("company", function($q) use ($order) {
                            $q->where("master", 1)->whereHas("zones", function($q1) use ($order) {
                                return $q1->whereIn("zones.id", [$order->zone_id]);
                            });
                        })->get();

                        $reasons = \App\Models\RefusedReason::all();
                        $orderstatus = \App\Models\OrderStatus::all();
                        ?>

                        <span class="order-action-btn order-action-icon" style="cursor:pointer;" data-toggle="modal" data-target="#myModalp{{ $order->id }}">
                        <img src="{{ asset('dollar.png') }}">
                    </span>

                        <div id="myModalp{{ $order->id }}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">السعر</h4>
                                    </div>

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <label>السعر</label>
                                                <input type="number" min="0" class="form-control" id="price{{ $order->id }}" value="{{ $order->price }}">
                                            </div>

                                            <div class="col-6">
                                                <label>الخصم</label>
                                                <input type="number" min="0" class="form-control" id="discount{{ $order->id }}" value="{{ $order->price - $order->priceafterdiscount }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <button class="btn btn-primary mx-auto mt-4" onclick="editprice({{ $order->id }})">حفظ</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        $companies = \App\Models\Driver::where("is_company", 1)->whereHas("zones", function($q) use ($order) {
                            return $q->whereIn("zones.id", [$order->zone_id]);
                        })->get();
                        ?>

                        @if($order->status == 1)
                            <span class="order-action-label order-action-success" data-toggle="modal" data-target="#myModaleee{{ $order->id }}">
                            {{ $order->company ? $order->company->name : 'شركات التوصيل' }}
                        </span>

                            <div id="myModaleee{{ $order->id }}" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">شركات التوصيل</h4>
                                        </div>

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label>شركات التوصيل</label>
                                                    <select class="form-control" style="display:block;" id="companyw{{ $order->id }}" data-live-search="true">
                                                        @foreach($companies as $company)
                                                                <?php
                                                                $company_drivers = \App\Models\Driver::where("driver_id", $company->id)->where("available", 1)->get();
                                                                ?>
                                                            <option value="{{ $company->id }}" @if($order->company_id == $company->id) selected @endif>
                                                                {{ $company->name }} <span class="badge badge-secondary">{{ count($company_drivers) }}</span>
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <button class="btn btn-primary mx-auto mt-4" onclick="choosecompany({{ $order->id }})">حفظ</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <span class="order-action-label order-action-success" data-toggle="modal" data-target="#myModalw{{ $order->id }}">
                            {{ $order->driver ? $order->driver->name : 'الدليفري' }}
                        </span>

                            <div id="myModalw{{ $order->id }}" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">الدليفري</h4>
                                        </div>

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label>الدليفري</label>
                                                    <select class="form-control" style="display:block;" id="driver_idw{{ $order->id }}" data-live-search="true">
                                                        @foreach($drivers as $driver)
                                                            <option value="{{ $driver->id }}" @if($order->driver_id == $driver->id) selected @endif>{{ $driver->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <button class="btn btn-primary mx-auto mt-4" onclick="choosedriver({{ $order->id }})">حفظ</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($order->cancel == 1)
                            <span class="order-action-label order-action-danger">ملغى</span>
                        @endif

                        <span class="order-action-label order-action-success">{{ $order->seller_status_name }}</span>

                        @if($order->status == 0)
                            <span onclick="orderstatus({{ $order->id }}, 1)" class="order-action-label order-action-success">قبول</span>

                            <span class="order-action-label order-action-danger" data-toggle="modal" data-target="#myModale{{ $order->id }}">رفض</span>

                            <div id="myModale{{ $order->id }}" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">اسباب الرفض</h4>
                                        </div>

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label>السبب</label>
                                                    <select class="form-control" style="display:block;" id="refusedreason_id{{ $order->id }}" data-live-search="true">
                                                        @foreach($reasons as $reason)
                                                            <option value="{{ $reason->id }}">{{ $reason->text }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <button class="btn btn-danger mx-auto mt-4" onclick="orderstatus({{ $order->id }}, 2)">رفض</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @elseif($order->status == 1)
                            <span class="order-action-label order-action-primary" data-toggle="modal" data-target="#myModalos{{ $order->id }}">حاله الطلب</span>

                            <div id="myModalos{{ $order->id }}" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">حاله الطلب</h4>
                                        </div>

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label>حاله الطلب</label>
                                                    <select class="form-control" style="display:block;" id="orderstatus_id{{ $order->id }}" data-live-search="true">
                                                        <option value="1" @if($order->status == 1) selected @endif>المطعم استلم الطلب</option>
                                                        <option value="2" @if($order->status == 2) selected @endif>تم التحضير</option>
                                                        <option value="3" @if($order->status == 3) selected @endif>تم تسليم الطلب</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <button class="btn btn-primary mx-auto mt-4" onclick="changeorderstatus_id({{ $order->id }})">حفظ</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <span class="order-action-label order-action-success" data-toggle="modal" data-target="#myModalstatus{{ $order->id }}">حاله الدليفري</span>

                            <div id="myModalstatus{{ $order->id }}" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">حاله الدليفري</h4>
                                        </div>

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label>حاله الدليفري</label>
                                                    <select class="form-control" style="display:block;" id="delivery_status{{ $order->id }}" data-live-search="true">
                                                        <option value="1" @if($order->delivery_status == 1) selected @endif>قبول السائق</option>
                                                        <option value="2" @if($order->delivery_status == 2) selected @endif>السائق وصل للمنقد</option>
                                                        <option value="3" @if($order->delivery_status == 3) selected @endif>السائق استلم الطلب</option>
                                                        <option value="4" @if($order->delivery_status == 4) selected @endif>السائق وصل للعميل</option>
                                                        <option value="5" @if($order->delivery_status == 5) selected @endif>تم توصيل الطلب</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <button class="btn btn-primary mx-auto mt-4" onclick="change_delivery_status({{ $order->id }})">حفظ</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <span class="order-action-label order-action-primary">قيد التحضير</span>

                        @elseif($order->status == 2)
                            <span class="order-action-label order-action-success" data-toggle="modal" data-target="#myModalstatus{{ $order->id }}">حاله الدليفري</span>

                            <div id="myModalstatus{{ $order->id }}" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">حاله الدليفري</h4>
                                        </div>

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label>حاله الدليفري</label>
                                                    <select class="form-control" style="display:block;" id="delivery_status{{ $order->id }}" data-live-search="true">
                                                        <option value="1" @if($order->delivery_status == 1) selected @endif>قبول السائق</option>
                                                        <option value="2" @if($order->delivery_status == 2) selected @endif>السائق وصل للمنقد</option>
                                                        <option value="3" @if($order->delivery_status == 3) selected @endif>السائق استلم الطلب</option>
                                                        <option value="4" @if($order->delivery_status == 4) selected @endif>السائق وصل للعميل</option>
                                                        <option value="5" @if($order->delivery_status == 5) selected @endif>تم توصيل الطلب</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <button class="btn btn-primary mx-auto mt-4" onclick="change_delivery_status({{ $order->id }})">حفظ</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <span class="order-action-label order-action-primary">تم التحضير</span>

                        @elseif($order->status == 3)
                            <span class="order-action-label order-action-success">تم تسليم الطلب</span>
                        @endif

                        <div id="myModalde{{ $order->id }}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">السعر</h4>
                                    </div>

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <label>سعر الدليفري</label>
                                                <input type="number" min="0" class="form-control" id="delivery_fee{{ $order->id }}" value="{{ $order->delivery_fee }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <button class="btn btn-primary mx-auto mt-4" onclick="delivery_fee({{ $order->id }})">حفظ</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="order-items-section">
                    <div class="order-items-card">
                        {!! $dataTable->table([

                        ],true) !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{ $dataTable->scripts() }}

    <script>
        function orderstatus(sel,status){
            let id = sel;
            console.log(sel);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:"post",
                url: `../orderstatus`,
                dataType: "Json",
                data:{
                    "id":sel,
                    "status":status,
                    'driver_id':$(`#driver_id${id}`).val(),
                    'refusedreason_id':$(`#refusedreason_id${id}`).val(),
                },
                success: function(result){
                    if(result.type == "accept"){
                        $(`#myModal${id}`).modal('hide');

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'تم قبول الطلب بنجاح',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        location.reload();

                    }else if(result.type == "refused"){
                        $(`#myModale${id}`).modal('hide');

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'تم رفض الطلب بنجاح',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        location.reload();
                    }
                }
            });
        }

        function editprice(sel){
            let id = sel;
            console.log(sel);

            var table = $('.dataTable').DataTable();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:"post",
                url: `../editprice`,
                dataType: "Json",
                data:{
                    "id":sel,
                    "price":$(`#price${id}`).val(),
                    'discount':$(`#discount${id}`).val()
                },
                success: function(result){
                    if(result.status == true){
                        $(`#myModalp${id}`).modal('hide');

                        Swal.fire(
                            'done!',
                            'تم تغيير السعر بنحاح',
                            'success'
                        );

                        location.reload();
                    }
                }
            });
        }

        function choosedriver(sel){
            let id = sel;
            console.log(sel);

            var table = $('.dataTable').DataTable();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:"post",
                url: `../choosedriver`,
                dataType: "Json",
                data:{
                    "id":sel,
                    'driver_id':$(`#driver_id${id}`).val()
                },
                success: function(result){
                    $(`#myModalaa${id}`).modal('hide');

                    Swal.fire(
                        'done!',
                        result.message,
                        'success'
                    );

                    location.reload();
                }
            });
        }

        function choosecompany(sel){
            let id = sel;
            console.log(sel);

            var table = $('.dataTable').DataTable();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:"post",
                url: `../choosecompany`,
                dataType: "Json",
                data:{
                    "id":sel,
                    'company_id':$(`#companyw${id}`).val()
                },
                success: function(result){
                    $(`#myModaleee${id}`).modal('hide');

                    Swal.fire(
                        'done!',
                        result.message,
                        'success'
                    );

                    location.reload();
                }
            });
        }

        function changeorderstatus_id(sel){
            let id = sel;
            console.log(sel);

            var table = $('.dataTable').DataTable();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:"post",
                url: `../changeorderstatus_id`,
                dataType: "Json",
                data:{
                    "id":sel,
                    'orderstatus_id':$(`#orderstatus_id${id}`).val()
                },
                success: function(result){
                    $(`#myModalos${id}`).modal('hide');

                    Swal.fire(
                        'done!',
                        'تم تغييرالحاله بنجاح',
                        'success'
                    );

                    location.reload();
                }
            });
        }

        function change_delivery_status(sel){
            let id = sel;
            console.log(sel);

            var table = $('.dataTable').DataTable();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:"post",
                url: `../change_delivery_status`,
                dataType: "Json",
                data:{
                    "id":sel,
                    'orderstatus_id':$(`#delivery_status${id}`).val()
                },
                success: function(result){
                    $(`#myModalstatus${id}`).modal('hide');

                    Swal.fire(
                        'done!',
                        'تم تغييرالحاله بنجاح',
                        'success'
                    );

                    location.reload();
                }
            });
        }

        function delivery_fee(sel){
            let id = sel;
            console.log(sel);

            var table = $('.dataTable').DataTable();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:"post",
                url: `../delivery_fee`,
                dataType: "Json",
                data:{
                    "order_id":sel,
                    'delivery_fee':$(`#delivery_fee${id}`).val()
                },
                success: function(result){
                    $(`#myModalde${id}`).modal('hide');

                    Swal.fire(
                        'done!',
                        'تم تغيير سعر الدليفري بنجاح',
                        'success'
                    );

                    location.reload();
                }
            });
        }
    </script>
@endsection
