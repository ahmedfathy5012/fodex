@extends('layouts.adminindex')

@section('content')
    <style>
        .seller-order-items-page {
            direction: rtl;
        }

        .seller-order-items-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
        }

        .seller-order-items-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 22px 26px;
        }

        .seller-order-items-card .card-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .seller-order-items-card .card-label {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            color: #181c32;
        }

        .seller-order-items-card .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .seller-order-items-card .card-icon svg path,
        .seller-order-items-card .card-icon svg rect {
            fill: #3699ff !important;
        }

        .seller-order-items-body {
            padding: 28px;
            background: #ffffff;
        }

        .seller-order-items-table-section {
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 18px;
            overflow-x: auto;
        }

        .seller-order-items-page table.dataTable {
            width: 100% !important;
            border-collapse: separate !important;
            border-spacing: 0 8px !important;
            margin-top: 0 !important;
        }

        .seller-order-items-page table.dataTable thead th {
            background: #f3f6f9;
            color: #3f4254;
            font-weight: 800;
            border: 0 !important;
            padding: 14px 12px !important;
            white-space: nowrap;
            text-align: center;
        }

        .seller-order-items-page table.dataTable thead th:first-child {
            border-radius: 0 10px 10px 0;
        }

        .seller-order-items-page table.dataTable thead th:last-child {
            border-radius: 10px 0 0 10px;
        }

        .seller-order-items-page table.dataTable tbody tr {
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        }

        .seller-order-items-page table.dataTable tbody td {
            border-top: 1px solid #edf0f5 !important;
            border-bottom: 1px solid #edf0f5 !important;
            padding: 13px 12px !important;
            vertical-align: middle !important;
            text-align: center;
            color: #3f4254;
        }

        .seller-order-items-page table.dataTable tbody td:first-child {
            border-right: 1px solid #edf0f5 !important;
            border-radius: 0 10px 10px 0;
        }

        .seller-order-items-page table.dataTable tbody td:last-child {
            border-left: 1px solid #edf0f5 !important;
            border-radius: 10px 0 0 10px;
        }

        .seller-order-items-page .dataTables_wrapper .dataTables_filter input {
            border-radius: 10px;
            border: 1px solid #e4e6ef;
            min-height: 38px;
            padding: 6px 12px;
            margin-right: 8px;
            box-shadow: none !important;
        }

        .seller-order-items-page .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #3699ff;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
            outline: none;
        }

        .seller-order-items-page .dataTables_wrapper .dataTables_length select {
            border-radius: 8px;
            border: 1px solid #e4e6ef;
            min-height: 36px;
            padding: 4px 8px;
        }

        .seller-order-items-page .dataTables_wrapper .dataTables_info {
            color: #7e8299;
            font-weight: 600;
            padding-top: 16px;
        }

        .seller-order-items-page .dataTables_wrapper .dataTables_paginate {
            padding-top: 14px;
        }

        .seller-order-items-page .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 8px !important;
            border: 0 !important;
            margin: 0 2px;
            padding: 6px 12px !important;
            color: #3f4254 !important;
            background: transparent !important;
        }

        .seller-order-items-page .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #3699ff !important;
            color: #ffffff !important;
        }

        .seller-order-items-page .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #eaf4ff !important;
            color: #3699ff !important;
        }

        @media (max-width: 768px) {
            .seller-order-items-body {
                padding: 18px;
            }

            .seller-order-items-table-section {
                padding: 14px;
            }
        }
    </style>

    <div class="seller-order-items-page">
        <!--begin::Card-->
        <div class="card card-custom gutter-b seller-order-items-card">
            <div class="card-header">
                <div class="card-title">
                <span class="card-icon">
                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink"
                             width="24px"
                             height="24px"
                             viewBox="0 0 24 24"
                             version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5"/>
                                <path d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L18.5,10 C19.3284271,10 20,10.6715729 20,11.5 C20,12.3284271 19.3284271,13 18.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z"
                                      fill="#000000"
                                      opacity="0.3"/>
                            </g>
                        </svg>
                    </span>
                </span>

                    <h3 class="card-label">تفاصيل طلبات البائع</h3>
                </div>
            </div>

            <div class="card-body seller-order-items-body">
                <div class="seller-order-items-table-section">
                    {!! $dataTable->table([

                    ], true) !!}
                </div>
            </div>
        </div>
        <!--end::Card-->
    </div>
@endsection

@section('scripts')
    {{ $dataTable->scripts() }}

    <script>
        function getstates(selected) {
            let id = selected.value;
            console.log(id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "get",
                url: `getstatesemployee/${id}`,
                dataType: "Json",
                success: function(result) {
                    if (result.status == true) {
                        $('#state').empty();
                        $('#state').append(result.data);
                        $('select#state').selectpicker("refresh");
                        console.log(result);
                    }
                }
            });
        }

        function getcities(selected) {
            let id = selected.value;
            console.log(id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "get",
                url: `getcitiesemployee/${id}`,
                dataType: "Json",
                success: function(result) {
                    if (result.status == true) {
                        $('#city').empty();
                        $('#city').append(result.data);
                        $('select#city').selectpicker("refresh");
                        console.log(result);
                    }
                }
            });
        }

        function getzones(selected) {
            let id = selected.value;
            console.log(id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "get",
                url: `getzonesemployee/${id}`,
                dataType: "Json",
                success: function(result) {
                    if (result.status == true) {
                        $('#zone').empty();
                        $('#zone').append(result.data);
                        $('select#zone').selectpicker("refresh");
                        console.log(result);
                    }
                }
            });
        }

        $("#btn").on("click", function() {
            $('#dataTableBuilder').off('preXhr.dt').on('preXhr.dt', function(e, settings, data) {
                console.log($('#city').val());

                data.country_id = $('#country').val();
                data.state_id = $('#state').val();
                data.city_id = $('#city').val();
                data.zone_id = $('#zone').val();
            });

            $('#dataTableBuilder').DataTable().ajax.reload();

            return false;
        });
    </script>
@endsection
