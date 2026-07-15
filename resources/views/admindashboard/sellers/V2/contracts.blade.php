@extends('layouts.adminindex')

@section('content')
    <style>
        .contracts-page {
            direction: rtl;
        }

        .contracts-page .card.card-custom {
            border: 0;
            border-radius: 16px;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            background: #ffffff;
        }

        .contracts-page .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 22px 26px;
            border-bottom: 1px solid #edf0f5;
            background: #fff;
            flex-wrap: wrap;
            gap: 15px;
        }

        .contracts-page .page-title {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .contracts-page .page-icon {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .contracts-page .page-icon svg {
            width: 26px;
            height: 26px;
        }

        .contracts-page .page-title h3 {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            color: #181c32;
        }

        .contracts-page .add-btn {
            background: #3699ff;
            color: #fff !important;
            border-radius: 10px;
            min-width: 130px;
            height: 42px;
            padding: 0 22px;
            font-size: 14px;
            font-weight: 800;
            border: 0;
            transition: all 0.15s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 18px rgba(54, 153, 255, 0.22);
        }

        .contracts-page .add-btn:hover {
            background: #187de4;
            color: #fff !important;
            text-decoration: none;
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(54, 153, 255, 0.28);
        }

        .contracts-page .table-wrapper {
            padding: 28px;
            background: #ffffff;
        }

        .contracts-page .table-shell {
            border: 1px solid #edf0f5;
            border-radius: 14px;
            overflow: hidden;
            background: #ffffff;
            padding: 18px;
        }

        .contracts-page .dataTables_wrapper {
            padding: 0;
        }

        .contracts-page table.dataTable {
            width: 100% !important;
            border-collapse: separate !important;
            border-spacing: 0 8px !important;
            margin-top: 0 !important;
        }

        .contracts-page table.dataTable thead th {
            background: #f3f6f9;
            color: #3f4254;
            font-weight: 800;
            border: 0 !important;
            padding: 14px 12px !important;
            white-space: nowrap;
            text-align: center;
        }

        .contracts-page table.dataTable thead th:first-child {
            border-radius: 0 10px 10px 0;
        }

        .contracts-page table.dataTable thead th:last-child {
            border-radius: 10px 0 0 10px;
        }

        .contracts-page table.dataTable tbody tr {
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        }

        .contracts-page table.dataTable tbody td {
            border-top: 1px solid #edf0f5 !important;
            border-bottom: 1px solid #edf0f5 !important;
            padding: 13px 12px !important;
            vertical-align: middle !important;
            text-align: center;
            color: #3f4254;
        }

        .contracts-page table.dataTable tbody td:first-child {
            border-right: 1px solid #edf0f5 !important;
            border-radius: 0 10px 10px 0;
        }

        .contracts-page table.dataTable tbody td:last-child {
            border-left: 1px solid #edf0f5 !important;
            border-radius: 10px 0 0 10px;
        }

        .contracts-page .dataTables_wrapper .dataTables_filter input {
            border-radius: 10px;
            border: 1px solid #e4e6ef;
            min-height: 38px;
            padding: 6px 12px;
            margin-right: 8px;
            box-shadow: none !important;
        }

        .contracts-page .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #3699ff;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
            outline: none;
        }

        .contracts-page .dataTables_wrapper .dataTables_length select {
            border-radius: 8px;
            border: 1px solid #e4e6ef;
            min-height: 36px;
            padding: 4px 8px;
        }

        .contracts-page .dataTables_wrapper .dataTables_info {
            color: #7e8299;
            font-weight: 600;
            padding-top: 16px;
        }

        .contracts-page .dataTables_wrapper .dataTables_paginate {
            padding-top: 14px;
            display: flex;
            justify-content: center;
            gap: 4px;
        }

        .contracts-page .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 8px !important;
            border: 0 !important;
            margin: 0 2px;
            min-width: 34px;
            height: 34px;
            padding: 0 12px !important;
            color: #3f4254 !important;
            background: transparent !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
        }

        .contracts-page .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #3699ff !important;
            color: #ffffff !important;
            box-shadow: 0 8px 18px rgba(54, 153, 255, 0.18);
        }

        .contracts-page .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #eaf4ff !important;
            color: #3699ff !important;
        }

        .contracts-page .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            opacity: 0.5;
            pointer-events: none;
        }

        @media (max-width:768px) {
            .contracts-page .page-header {
                flex-direction: column;
                align-items: stretch;
            }

            .contracts-page .add-btn {
                width: 100%;
                text-align: center;
            }

            .contracts-page .table-wrapper {
                padding: 18px;
            }

            .contracts-page .table-shell {
                padding: 14px;
            }
        }
    </style>

    <div class="contracts-page">

        <div class="card card-custom">

            <div class="page-header">

                <div class="page-title">

                    <div class="page-icon">
                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none">
                            <rect x="4" y="5" width="16" height="3" rx="1.5" fill="#3699FF"/>
                            <path
                                d="M5.5 10H18.5C19.33 10 20 10.67 20 11.5C20 12.33 19.33 13 18.5 13H5.5C4.67 13 4 12.33 4 11.5C4 10.67 4.67 10 5.5 10ZM5.5 15H18.5C19.33 15 20 15.67 20 16.5C20 17.33 19.33 18 18.5 18H5.5C4.67 18 4 17.33 4 16.5C4 15.67 4.67 15 5.5 15Z"
                                fill="#3699FF"
                                opacity=".35"/>
                        </svg>
                    </span>
                    </div>

                    <h3>عقد البائع</h3>

                </div>

                <a href="{{ route('addsellercontract',$id) }}" class="add-btn">
                    <i class="fas fa-plus ml-1"></i>
                    إضافة
                </a>

            </div>

                <div class="table-wrapper">
                    <div class="table-shell">
                        {!! $dataTable->table([], true) !!}
                    </div>

            </div>

        </div>

    </div>

@endsection

@section('scripts')

    {{ $dataTable->scripts() }}

    <script>

    </script>

@endsection
