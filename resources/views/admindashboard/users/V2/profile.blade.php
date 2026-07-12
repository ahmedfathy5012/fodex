@extends('layouts.adminindex')

@section('content')
    <style>
        .user-profile-page {
            direction: rtl;
        }

        .user-profile-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
        }

        .user-profile-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 22px 26px;
        }

        .user-profile-card .card-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-profile-card .card-label {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            color: #181c32;
        }

        .user-profile-card .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-profile-card .card-icon svg path,
        .user-profile-card .card-icon svg rect {
            fill: #3699ff !important;
        }

        .user-profile-body {
            padding: 28px;
            background: #ffffff;
        }

        .user-profile-summary {
            background: linear-gradient(135deg, #f3f9ff 0%, #ffffff 100%);
            border: 1px solid #edf0f5;
            border-radius: 16px;
            padding: 26px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .user-profile-info {
            display: flex;
            align-items: center;
            gap: 18px;
            flex-wrap: wrap;
        }

        .user-profile-avatar {
            width: 112px;
            height: 112px;
            border-radius: 50%;
            overflow: hidden;
            background: #ffffff;
            border: 4px solid #ffffff;
            box-shadow: 0 8px 24px rgba(54, 153, 255, 0.18);
            flex-shrink: 0;
        }

        .user-profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-profile-details h4 {
            margin: 0;
            font-size: 22px;
            font-weight: 900;
            color: #181c32;
        }

        .user-profile-phone {
            margin-top: 10px;
            min-height: 34px;
            border-radius: 9px;
            background: #ffffff;
            color: #3f4254;
            font-size: 14px;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 12px;
            border: 1px solid #edf0f5;
        }

        .user-profile-status {
            margin-top: 12px;
        }

        .user-status-badge {
            min-width: 95px;
            height: 32px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 900;
            padding: 0 14px;
        }

        .user-status-active {
            background: #e8fff3;
            color: #1bc5bd;
            border: 1px solid #bdf4dd;
        }

        .user-status-blocked {
            background: #fff5f6;
            color: #f64e60;
            border: 1px solid #ffd0d6;
        }

        .user-profile-stat {
            min-width: 170px;
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 18px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        }

        .user-profile-stat-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: #eaf4ff;
            color: #3699ff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .user-profile-stat-content span {
            display: block;
            color: #7e8299;
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .user-profile-stat-content strong {
            display: block;
            color: #181c32;
            font-size: 20px;
            font-weight: 900;
        }

        .user-orders-section {
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 18px;
            overflow-x: auto;
        }

        .user-orders-section-title {
            font-size: 16px;
            font-weight: 900;
            color: #181c32;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .user-orders-section-title::before {
            content: "";
            width: 5px;
            height: 18px;
            border-radius: 10px;
            background: #3699ff;
            display: inline-block;
        }

        .user-profile-page table.dataTable {
            width: 100% !important;
            border-collapse: separate !important;
            border-spacing: 0 8px !important;
            margin-top: 0 !important;
        }

        .user-profile-page table.dataTable thead th {
            background: #f3f6f9;
            color: #3f4254;
            font-weight: 800;
            border: 0 !important;
            padding: 14px 12px !important;
            white-space: nowrap;
            text-align: center;
        }

        .user-profile-page table.dataTable thead th:first-child {
            border-radius: 0 10px 10px 0;
        }

        .user-profile-page table.dataTable thead th:last-child {
            border-radius: 10px 0 0 10px;
        }

        .user-profile-page table.dataTable tbody tr {
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        }

        .user-profile-page table.dataTable tbody td {
            border-top: 1px solid #edf0f5 !important;
            border-bottom: 1px solid #edf0f5 !important;
            padding: 13px 12px !important;
            vertical-align: middle !important;
            text-align: center;
            color: #3f4254;
        }

        .user-profile-page table.dataTable tbody td:first-child {
            border-right: 1px solid #edf0f5 !important;
            border-radius: 0 10px 10px 0;
        }

        .user-profile-page table.dataTable tbody td:last-child {
            border-left: 1px solid #edf0f5 !important;
            border-radius: 10px 0 0 10px;
        }

        .user-profile-page .dataTables_wrapper .dataTables_filter input {
            border-radius: 10px;
            border: 1px solid #e4e6ef;
            min-height: 38px;
            padding: 6px 12px;
            margin-right: 8px;
            box-shadow: none !important;
        }

        .user-profile-page .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #3699ff;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
            outline: none;
        }

        .user-profile-page .dataTables_wrapper .dataTables_length select {
            border-radius: 8px;
            border: 1px solid #e4e6ef;
            min-height: 36px;
            padding: 4px 8px;
        }

        .user-profile-page .dataTables_wrapper .dataTables_info {
            color: #7e8299;
            font-weight: 600;
            padding-top: 16px;
        }

        .user-profile-page .dataTables_wrapper .dataTables_paginate {
            padding-top: 14px;
        }

        .user-profile-page .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 8px !important;
            border: 0 !important;
            margin: 0 2px;
            padding: 6px 12px !important;
            color: #3f4254 !important;
            background: transparent !important;
        }

        .user-profile-page .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #3699ff !important;
            color: #ffffff !important;
        }

        .user-profile-page .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #eaf4ff !important;
            color: #3699ff !important;
        }

        @media (max-width: 768px) {
            .user-profile-body {
                padding: 18px;
            }

            .user-profile-summary {
                padding: 18px;
            }

            .user-profile-info {
                justify-content: center;
                text-align: center;
                width: 100%;
            }

            .user-profile-stat {
                width: 100%;
            }

            .user-orders-section {
                padding: 14px;
            }
        }
    </style>

    <div class="user-profile-page">
        <!--begin::Card-->
        <div class="card card-custom gutter-b user-profile-card">
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

                    <h3 class="card-label">{{ $user->name }}</h3>
                </div>
            </div>

            <div class="card-body user-profile-body">
                <div class="user-profile-summary">
                    <div class="user-profile-info">
                        <div class="user-profile-avatar">
                            @if($user->image)
                                <img src="{{ asset($user->image) }}" alt="profile image">
                            @else
                                <img src="{{ asset('user.png') }}" alt="profile image">
                            @endif
                        </div>

                        <div class="user-profile-details">
                            <h4>{{ $user->name }}</h4>

                            <div class="user-profile-phone">
                                <i class="fas fa-phone"></i>
                                {{ $user->phone }}
                            </div>

                            <div class="user-profile-status">
                                @if($user->block == 0)
                                    <span class="user-status-badge user-status-active">مفعل</span>
                                @elseif($user->block == 1)
                                    <span class="user-status-badge user-status-blocked">غير مفعل</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="user-profile-stat">
                        <div class="user-profile-stat-icon">
                            <i class="fas fa-shopping-bag"></i>
                        </div>

                        <div class="user-profile-stat-content">
                            <span>عدد الطلبات</span>
                            <strong>{{ count($user->done_orders) }}</strong>
                        </div>
                    </div>
                </div>

                <div class="user-orders-section">
                    <div class="user-orders-section-title">طلبات المستخدم</div>

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
