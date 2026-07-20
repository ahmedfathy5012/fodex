@extends('layouts.adminindex')

@section('content')
    <style>
        .collections-page {
            direction: rtl;
        }

        .collections-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
        }

        .collections-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 22px 26px;
        }

        .collections-card .card-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .collections-card .card-label {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            color: #181c32;
        }

        .collections-card .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /*.collections-card .card-icon svg rect,*/
        /*.collections-card .card-icon svg path {*/
        /*    fill: #3699ff !important;*/
        /*}*/

        .collections-body {
            padding: 28px;
            background: #ffffff;
        }

        .collections-filter-box {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 16px;
            padding: 22px;
            margin-bottom: 26px;
        }

        .collections-section-title {
            font-size: 16px;
            font-weight: 800;
            color: #181c32;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .collections-section-title::before {
            content: "";
            width: 5px;
            height: 18px;
            border-radius: 10px;
            background: #3699ff;
            display: inline-block;
        }

        .collections-page .form-group label {
            font-weight: 700;
            color: #3f4254;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .collections-page .form-control {
            min-height: 44px;
            border-radius: 10px !important;
            border: 1px solid #e4e6ef !important;
            color: #3f4254 !important;
            background: #ffffff !important;
            box-shadow: none !important;
            transition: all 0.15s ease;
        }

        .collections-page .form-control:focus {
            border-color: #3699ff !important;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
        }

        .collections-search-wrapper {
            display: flex;
            align-items: end;
            height: 100%;
        }

        .collections-search-btn {
            width: 100%;
            min-width: 140px;
            height: 44px;
            border-radius: 12px !important;
            background: #3699ff !important;
            border: 0 !important;
            color: #ffffff !important;
            font-size: 15px;
            font-weight: 900 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            box-shadow: 0 8px 18px rgba(54, 153, 255, 0.25);
            transition: all 0.15s ease;
        }

        .collections-search-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(54, 153, 255, 0.32);
            color: #ffffff !important;
        }

        .collections-table-section {
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 18px;
            overflow-x: auto;
        }

        .collections-page table.dataTable {
            width: 100% !important;
            border-collapse: separate !important;
            border-spacing: 0 8px !important;
            margin-top: 0 !important;
        }

        .collections-page table.dataTable thead th {
            background: #f3f6f9;
            color: #3f4254;
            font-weight: 800;
            border: 0 !important;
            padding: 14px 12px !important;
            white-space: nowrap;
            text-align: center;
        }

        .collections-page table.dataTable thead th:first-child {
            border-radius: 0 10px 10px 0;
        }

        .collections-page table.dataTable thead th:last-child {
            border-radius: 10px 0 0 10px;
        }

        .collections-page table.dataTable tbody tr {
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        }

        .collections-page table.dataTable tbody td {
            border-top: 1px solid #edf0f5 !important;
            border-bottom: 1px solid #edf0f5 !important;
            padding: 13px 12px !important;
            vertical-align: middle !important;
            text-align: center;
            color: #3f4254;
        }

        .collections-page table.dataTable tbody td:first-child {
            border-right: 1px solid #edf0f5 !important;
            border-radius: 0 10px 10px 0;
        }

        .collections-page table.dataTable tbody td:last-child {
            border-left: 1px solid #edf0f5 !important;
            border-radius: 10px 0 0 10px;
        }

        .collections-page .dataTables_wrapper .dataTables_filter input {
            border-radius: 10px;
            border: 1px solid #e4e6ef;
            min-height: 38px;
            padding: 6px 12px;
            margin-right: 8px;
            box-shadow: none !important;
        }

        .collections-page .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #3699ff;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
            outline: none;
        }

        .collections-page .dataTables_wrapper .dataTables_length select {
            border-radius: 8px;
            border: 1px solid #e4e6ef;
            min-height: 36px;
            padding: 12px 24px;
        }

        .collections-page .dataTables_wrapper .dataTables_info {
            color: #7e8299;
            font-weight: 600;
            padding-top: 16px;
        }

        .collections-page .dataTables_wrapper .dataTables_paginate {
            padding-top: 14px;
        }

        .collections-page .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 8px !important;
            border: 0 !important;
            margin: 0 2px;
            padding: 6px 12px !important;
            color: #3f4254 !important;
            background: transparent !important;
        }

        .collections-page .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #3699ff !important;
            color: #ffffff !important;
        }

        .collections-page .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #eaf4ff !important;
            color: #3699ff !important;
        }

        @media (max-width: 768px) {
            .collections-body {
                padding: 18px;
            }

            .collections-filter-box {
                padding: 16px;
            }

            .collections-table-section {
                padding: 14px;
            }
        }
    </style>

    <div class="collections-page">
        <div class="card card-custom gutter-b collections-card">
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

                    <h3 class="card-label">التحصيلات</h3>
                </div>
            </div>

            <div class="card-body collections-body">
                <div class="collections-filter-box">
                    <div class="collections-section-title">فلترة التحصيلات</div>

                    <div class="row">
                        <div class="form-group col-lg-4 col-md-6">
                            <label>من</label>
                            <input type="date"
                                   class="form-control"
                                   id="from">
                        </div>

                        <div class="form-group col-lg-4 col-md-6">
                            <label>إلى</label>
                            <input type="date"
                                   class="form-control"
                                   id="to">
                        </div>

                        <div class="form-group col-lg-4 col-md-12">
                            <label>&nbsp;</label>
                            <div class="collections-search-wrapper">
                            <span id="btn" class="btn btn-sm collections-search-btn">
                                <i class="fa fa-search"></i>
                                بحث
                            </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="collections-table-section">
                    {!! $dataTable->table([

                    ], true) !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{ $dataTable->scripts() }}

    <script>
        $(document).ready(function() {
            $('#dataTableBuilder').on('preXhr.dt', function(e, settings, data) {
                data.from = $('#from').val();
                data.to = $('#to').val();
            });

            $("#btn").on("click", function() {
                $('#dataTableBuilder').DataTable().ajax.reload();
                return false;
            });
        });
    </script>
@endsection
