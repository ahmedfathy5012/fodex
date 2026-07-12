@extends('layouts.adminindex')

@section('content')
    <style>
        .employee-show-page {
            direction: rtl;
        }

        .employee-show-header {
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 16px;
            padding: 22px 26px;
            margin-bottom: 22px;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }

        .employee-show-title {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .employee-show-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #3699ff;
            font-size: 16px;
        }

        .employee-show-title h3 {
            margin: 0;
            font-size: 20px;
            font-weight: 900;
            color: #181c32;
        }

        .employee-show-title span {
            display: block;
            margin-top: 4px;
            color: #7e8299;
            font-size: 13px;
            font-weight: 700;
        }

        .employee-show-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .employee-show-action-btn {
            min-width: 120px;
            height: 40px;
            border-radius: 10px !important;
            background: #eaf4ff !important;
            color: #3699ff !important;
            border: 1px solid #b5d9ff !important;
            font-size: 13px;
            font-weight: 900 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            gap: 7px;
            text-decoration: none !important;
        }

        .employee-show-action-btn:hover {
            background: #3699ff !important;
            color: #ffffff !important;
        }

        .employee-show-edit-btn {
            min-width: 105px;
            height: 40px;
            border-radius: 10px !important;
            background: #e8fff3 !important;
            color: #1bc5bd !important;
            border: 1px solid #bdf4dd !important;
            font-size: 13px;
            font-weight: 900 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            gap: 7px;
            text-decoration: none !important;
        }

        .employee-show-edit-btn:hover {
            background: #1bc5bd !important;
            color: #ffffff !important;
        }

        .employee-profile-card {
            border: 0;
            border-radius: 16px;
            background: #ffffff;
            overflow: hidden;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
            margin-bottom: 22px;
        }

        .employee-profile-body {
            padding: 28px;
        }

        .employee-profile-main {
            display: flex;
            gap: 22px;
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .employee-avatar {
            width: 118px;
            height: 118px;
            border-radius: 18px;
            background: #f3f6f9;
            border: 4px solid #ffffff;
            box-shadow: 0 8px 24px rgba(54, 153, 255, 0.16);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #7e8299;
            font-weight: 800;
            text-align: center;
            flex-shrink: 0;
        }

        .employee-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .employee-info {
            flex: 1;
            min-width: 260px;
        }

        .employee-info-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 14px;
            flex-wrap: wrap;
        }

        .employee-name {
            margin: 0;
            color: #181c32;
            font-size: 22px;
            font-weight: 900;
        }

        .employee-sub-info {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 12px;
        }

        .employee-sub-item {
            min-height: 34px;
            border-radius: 9px;
            background: #f3f6f9;
            color: #3f4254;
            font-size: 13px;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 12px;
        }

        .employee-description {
            margin-top: 14px;
            color: #7e8299;
            font-size: 14px;
            font-weight: 600;
            line-height: 1.8;
        }

        .employee-profile-separator {
            height: 1px;
            background: #edf0f5;
            margin: 24px 0;
        }

        .employee-stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
        }

        .employee-stat-card {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 18px;
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .employee-stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 17px;
        }

        .employee-stat-icon.paid {
            background: #eaf4ff;
            color: #3699ff;
        }

        .employee-stat-icon.discount {
            background: #fff5f6;
            color: #f64e60;
        }

        .employee-stat-icon.award {
            background: #e8fff3;
            color: #1bc5bd;
        }

        .employee-stat-icon.salary {
            background: #fff8dd;
            color: #ffa800;
        }

        .employee-stat-content span {
            display: block;
            color: #7e8299;
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .employee-stat-content strong {
            display: block;
            color: #181c32;
            font-size: 18px;
            font-weight: 900;
        }

        .employee-table-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
        }

        .employee-table-header {
            padding: 22px 26px;
            border-bottom: 1px solid #edf0f5;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .employee-table-header h4 {
            margin: 0;
            font-size: 18px;
            font-weight: 900;
            color: #181c32;
        }

        .employee-table-body {
            padding: 28px;
        }

        .employee-table-section {
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 18px;
            overflow-x: auto;
        }

        .employee-show-page table.dataTable {
            width: 100% !important;
            border-collapse: separate !important;
            border-spacing: 0 8px !important;
            margin-top: 0 !important;
        }

        .employee-show-page table.dataTable thead th {
            background: #f3f6f9;
            color: #3f4254;
            font-weight: 800;
            border: 0 !important;
            padding: 14px 12px !important;
            white-space: nowrap;
            text-align: center;
        }

        .employee-show-page table.dataTable thead th:first-child {
            border-radius: 0 10px 10px 0;
        }

        .employee-show-page table.dataTable thead th:last-child {
            border-radius: 10px 0 0 10px;
        }

        .employee-show-page table.dataTable tbody tr {
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        }

        .employee-show-page table.dataTable tbody td {
            border-top: 1px solid #edf0f5 !important;
            border-bottom: 1px solid #edf0f5 !important;
            padding: 13px 12px !important;
            vertical-align: middle !important;
            text-align: center;
            color: #3f4254;
        }

        .employee-show-page table.dataTable tbody td:first-child {
            border-right: 1px solid #edf0f5 !important;
            border-radius: 0 10px 10px 0;
        }

        .employee-show-page table.dataTable tbody td:last-child {
            border-left: 1px solid #edf0f5 !important;
            border-radius: 10px 0 0 10px;
        }

        .employee-show-page .dataTables_wrapper .dataTables_filter input {
            border-radius: 10px;
            border: 1px solid #e4e6ef;
            min-height: 38px;
            padding: 6px 12px;
            margin-right: 8px;
            box-shadow: none !important;
        }

        .employee-show-page .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #3699ff;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
            outline: none;
        }

        .employee-show-page .dataTables_wrapper .dataTables_length select {
            border-radius: 8px;
            border: 1px solid #e4e6ef;
            min-height: 36px;
            padding: 4px 8px;
        }

        .employee-show-page .dataTables_wrapper .dataTables_info {
            color: #7e8299;
            font-weight: 600;
            padding-top: 16px;
        }

        .employee-show-page .dataTables_wrapper .dataTables_paginate {
            padding-top: 14px;
        }

        .employee-show-page .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 8px !important;
            border: 0 !important;
            margin: 0 2px;
            padding: 6px 12px !important;
            color: #3f4254 !important;
            background: transparent !important;
        }

        .employee-show-page .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #3699ff !important;
            color: #ffffff !important;
        }

        .employee-show-page .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #eaf4ff !important;
            color: #3699ff !important;
        }

        @media (max-width: 992px) {
            .employee-stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 768px) {
            .employee-show-header,
            .employee-profile-body,
            .employee-table-body {
                padding: 18px;
            }

            .employee-show-actions,
            .employee-show-action-btn,
            .employee-show-edit-btn {
                width: 100%;
            }

            .employee-stats-grid {
                grid-template-columns: 1fr;
            }

            .employee-table-section {
                padding: 14px;
            }
        }
    </style>

    @php
        $paid = array_sum($employee->expenses->pluck('value')->toArray());
        $discounts = array_sum($employee->expenses->pluck('discounts')->toArray());
        $awards = array_sum($employee->expenses->pluck('awards')->toArray());
    @endphp

    <div class="employee-show-page">
        <div class="employee-show-header">
            <div class="employee-show-title">
                <div class="employee-show-icon">
                    <i class="fas fa-user"></i>
                </div>

                <div>
                    <h3>{{ $employee->name }}</h3>
                    <span>صفحة تفاصيل الموظف</span>
                </div>
            </div>

            <div class="employee-show-actions">
                <a href="{{ route('employeecontracts', $employee->id) }}" class="employee-show-action-btn">
                    <i class="fas fa-file-contract"></i>
                    العقود
                </a>

                <a href="{{ route('employeeawards', $employee->id) }}" class="employee-show-action-btn">
                    <i class="fas fa-gift"></i>
                    المكافأه
                </a>

                <a href="{{ route('employeediscounts', $employee->id) }}" class="employee-show-action-btn">
                    <i class="fas fa-minus-circle"></i>
                    الخصم
                </a>

                <a href="{{ route('employee.edit', $employee->id) }}" class="employee-show-edit-btn">
                    <i class="fas fa-pen"></i>
                    تعديل
                </a>
            </div>
        </div>

        <div class="employee-profile-card">
            <div class="employee-profile-body">
                <div class="employee-profile-main">
                    <div class="employee-avatar">
                        @if(isset($employee->image))
                            <img src="{{ asset('uploads/' . $employee->image) }}" alt="image">
                        @else
                            لا يوجد صوره
                        @endif
                    </div>

                    <div class="employee-info">
                        <div class="employee-info-top">
                            <div>
                                <h3 class="employee-name">{{ $employee->name }}</h3>

                                <div class="employee-sub-info">
                                <span class="employee-sub-item">
                                    <i class="fas fa-phone"></i>
                                    {{ $employee->phone }}
                                </span>

                                    @if($employee->mobile)
                                        <span class="employee-sub-item">
                                        <i class="fas fa-mobile-alt"></i>
                                        {{ $employee->mobile }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if($employee->description)
                            <div class="employee-description">
                                {{ $employee->description }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="employee-profile-separator"></div>

                <div class="employee-stats-grid">
                    <div class="employee-stat-card">
                        <div class="employee-stat-icon paid">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <div class="employee-stat-content">
                            <span>المدفوع</span>
                            <strong>{{ $paid }}</strong>
                        </div>
                    </div>

                    <div class="employee-stat-card">
                        <div class="employee-stat-icon discount">
                            <i class="fas fa-minus-circle"></i>
                        </div>
                        <div class="employee-stat-content">
                            <span>الخصومات</span>
                            <strong>{{ $discounts }}</strong>
                        </div>
                    </div>

                    <div class="employee-stat-card">
                        <div class="employee-stat-icon award">
                            <i class="fas fa-gift"></i>
                        </div>
                        <div class="employee-stat-content">
                            <span>المكافاه</span>
                            <strong>{{ $awards }}</strong>
                        </div>
                    </div>

                    <div class="employee-stat-card">
                        <div class="employee-stat-icon salary">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="employee-stat-content">
                            <span>المرتب</span>
                            <strong>{{ $contract->sallary ?? '' }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="employee-table-card">
            <div class="employee-table-header">
                <h4>سجل المدفوعات</h4>
            </div>

            <div class="employee-table-body">
                <div class="employee-table-section">
                    {!! $dataTable->table([

                    ], true) !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{ $dataTable->scripts() }}
@endsection
