@extends('layouts.adminindex')

@section('content')
    <style>
        .employee-discounts-page {
            direction: rtl;
        }

        .employee-discounts-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
        }

        .employee-discounts-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 22px 26px;
        }

        .employee-discounts-card .card-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .employee-discounts-card .card-label {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            color: #181c32;
        }

        .employee-discounts-card .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #fff5f6;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .employee-discounts-card .card-icon svg path,
        .employee-discounts-card .card-icon svg rect {
            fill: #f64e60 !important;
        }

        .employee-discounts-body {
            padding: 28px;
            background: #ffffff;
        }

        .employee-discounts-table-section {
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 18px;
            overflow-x: auto;
        }

        .employee-discounts-page table.dataTable {
            width: 100% !important;
            border-collapse: separate !important;
            border-spacing: 0 8px !important;
            margin-top: 0 !important;
        }

        .employee-discounts-page table.dataTable thead th {
            background: #f3f6f9;
            color: #3f4254;
            font-weight: 800;
            border: 0 !important;
            padding: 14px 12px !important;
            white-space: nowrap;
            text-align: center;
        }

        .employee-discounts-page table.dataTable thead th:first-child {
            border-radius: 0 10px 10px 0;
        }

        .employee-discounts-page table.dataTable thead th:last-child {
            border-radius: 10px 0 0 10px;
        }

        .employee-discounts-page table.dataTable tbody tr {
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        }

        .employee-discounts-page table.dataTable tbody td {
            border-top: 1px solid #edf0f5 !important;
            border-bottom: 1px solid #edf0f5 !important;
            padding: 13px 12px !important;
            vertical-align: middle !important;
            text-align: center;
            color: #3f4254;
        }

        .employee-discounts-page table.dataTable tbody td:first-child {
            border-right: 1px solid #edf0f5 !important;
            border-radius: 0 10px 10px 0;
        }

        .employee-discounts-page table.dataTable tbody td:last-child {
            border-left: 1px solid #edf0f5 !important;
            border-radius: 10px 0 0 10px;
        }

        .employee-discounts-page .dataTables_wrapper .dataTables_filter input {
            border-radius: 10px;
            border: 1px solid #e4e6ef;
            min-height: 38px;
            padding: 6px 12px;
            margin-right: 8px;
            box-shadow: none !important;
        }

        .employee-discounts-page .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #f64e60;
            box-shadow: 0 0 0 3px rgba(246, 78, 96, 0.12) !important;
            outline: none;
        }

        .employee-discounts-page .dataTables_wrapper .dataTables_length select {
            border-radius: 8px;
            border: 1px solid #e4e6ef;
            min-height: 36px;
            padding: 4px 8px;
        }

        .employee-discounts-page .dataTables_wrapper .dataTables_info {
            color: #7e8299;
            font-weight: 600;
            padding-top: 16px;
        }

        .employee-discounts-page .dataTables_wrapper .dataTables_paginate {
            padding-top: 14px;
        }

        .employee-discounts-page .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 8px !important;
            border: 0 !important;
            margin: 0 2px;
            padding: 6px 12px !important;
            color: #3f4254 !important;
            background: transparent !important;
        }

        .employee-discounts-page .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #f64e60 !important;
            color: #ffffff !important;
        }

        .employee-discounts-page .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #fff5f6 !important;
            color: #f64e60 !important;
        }

        @media (max-width: 768px) {
            .employee-discounts-body {
                padding: 18px;
            }

            .employee-discounts-table-section {
                padding: 14px;
            }
        }
    </style>

    <div class="employee-discounts-page">
        <!--begin::Card-->
        <div class="card card-custom gutter-b employee-discounts-card">
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

                    <h3 class="card-label">الخصومات</h3>
                </div>
            </div>

            <div class="card-body employee-discounts-body">
                <div class="employee-discounts-table-section">
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
@endsection
