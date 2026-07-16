@extends('layouts.adminindex')

@section('content')
    <style>
        .role-create-page {
            direction: rtl;
        }

        .role-create-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
        }

        .role-create-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 22px 26px;
        }

        .role-create-card .card-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .role-create-card .card-label {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            color: #181c32;
        }

        .role-create-card .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /*.role-create-card .card-icon svg path,*/
        /*.role-create-card .card-icon svg polygon {*/
        /*    fill: #3699ff !important;*/
        /*}*/

        .role-create-body {
            padding: 28px;
            background: #ffffff;
        }

        .role-section {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 22px;
        }

        .role-section-title {
            font-size: 16px;
            font-weight: 800;
            color: #181c32;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .role-section-title::before {
            content: "";
            width: 5px;
            height: 18px;
            border-radius: 10px;
            background: #3699ff;
            display: inline-block;
        }

        .role-create-page .form-group label {
            font-weight: 700;
            color: #3f4254;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .role-create-page .form-control {
            min-height: 44px;
            border-radius: 10px !important;
            border: 1px solid #e4e6ef !important;
            color: #3f4254 !important;
            background-color: #ffffff !important;
            box-shadow: none !important;
            transition: all 0.15s ease;
        }

        .role-create-page .form-control:focus {
            border-color: #3699ff !important;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
        }

        .role-create-page .text-danger,
        .role-create-page p[style*="color:red"] {
            color: #f64e60 !important;
            font-size: 13px;
            font-weight: 700;
            margin-top: 6px;
        }

        .role-select-all-box {
            min-height: 44px;
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 12px;
            padding: 10px 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-top: 26px;
        }

        .role-select-all-box label {
            margin: 0 !important;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 900;
            color: #3f4254;
            cursor: pointer;
        }

        .role-select-all-box input {
            width: 18px;
            height: 18px;
            margin: 0;
            cursor: pointer;
            accent-color: #3699ff;
        }

        .role-permissions-wrapper {
            margin-top: 6px;
        }

        .role-tabs {
            border-bottom: 0 !important;
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 10px;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .role-tabs .nav-item {
            margin: 0 !important;
        }

        .role-tabs .nav-link {
            border: 1px solid #e4e6ef !important;
            border-radius: 10px !important;
            background: #f8fafc;
            color: #3f4254 !important;
            font-size: 13px;
            font-weight: 800;
            padding: 10px 14px;
            min-width: 95px;
            text-align: center;
            transition: all 0.15s ease;
        }

        .role-tabs .nav-link:hover {
            background: #eaf4ff;
            color: #3699ff !important;
            border-color: #b5d9ff !important;
        }

        .role-tabs .nav-link.active {
            background: #3699ff !important;
            color: #ffffff !important;
            border-color: #3699ff !important;
            box-shadow: 0 8px 16px rgba(54, 153, 255, 0.22);
        }

        .role-tab-content {
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 22px;
            margin-top: 16px;
            min-height: 96px;
        }

        .role-permission-list {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .role-permission-item {
            min-width: 135px;
            min-height: 44px;
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 12px;
            padding: 10px 14px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .role-permission-item:hover {
            background: #eaf4ff;
            border-color: #b5d9ff;
        }

        .role-permission-item input {
            width: 18px;
            height: 18px;
            margin: 0;
            cursor: pointer;
            opacity: 1 !important;
            z-index: 2 !important;
            accent-color: #3699ff;
        }

        .role-permission-item label {
            margin: 0 !important;
            font-size: 14px;
            font-weight: 800;
            color: #3f4254;
            cursor: pointer;
        }

        .role-submit-wrapper {
            display: flex;
            justify-content: center;
            padding: 0 28px 28px;
        }

        .role-submit-btn {
            min-width: 220px;
            height: 48px;
            border-radius: 12px !important;
            background: #3699ff !important;
            border: 0 !important;
            color: #ffffff !important;
            font-size: 16px;
            font-weight: 900 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 8px 18px rgba(54, 153, 255, 0.25);
            transition: all 0.15s ease;
        }

        .role-submit-btn:hover {
            color: #ffffff !important;
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(54, 153, 255, 0.32);
        }

        .role-submit-btn svg path {
            fill: #ffffff !important;
        }

        @media (max-width: 768px) {
            .role-create-body {
                padding: 18px;
            }

            .role-section {
                padding: 16px;
            }

            .role-tabs .nav-link {
                min-width: auto;
                width: 100%;
            }

            .role-tabs .nav-item {
                width: calc(50% - 4px);
            }

            .role-permission-item {
                width: 100%;
            }

            .role-submit-wrapper {
                padding: 0 18px 18px;
            }

            .role-submit-btn {
                width: 100%;
            }
        }
    </style>

    <div class="role-create-page">
        <div class="card card-custom role-create-card">
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
                                <polygon points="0 0 24 0 24 24 0 24"/>
                                <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z"
                                      fill="#000000"
                                      fill-rule="nonzero"
                                      opacity="0.3"/>
                                <path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z"
                                      fill="#000000"/>
                            </g>
                        </svg>
                    </span>
                </span>

                    <h3 class="card-label">إضافة دور</h3>
                </div>
            </div>

            <form method="post" action="{{ route('roles.store') }}">
                @csrf

                <div class="card-body role-create-body">
                    <div class="role-section">
                        <div class="role-section-title">بيانات الدور</div>

                        <div class="row">
                            <div class="form-group col-lg-6 col-md-6">
                                <label>الاسم <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control"
                                       value="{{ old('name') }}"
                                       name="name"/>

                                @error('name')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-3 col-md-6">
                                <div class="role-select-all-box">
                                    <label>
                                        <input type="checkbox" onchange="selectall(this)">
                                        الكل
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    @php
                        $models = [
                            'country',
                            'state',
                            'city',
                            'major',
                            'category',
                            'subcategory',
                            'item',
                            'incomes',
                            'seller',
                            'offers',
                            'expensetype',
                            'collectionstypes',
                            'expenses',
                            'workschedule',
                            'expenseemployee',
                            'employee',
                            'zone',
                            'driver'
                        ];

                        $maps = ['create', 'read', 'update', 'delete'];
                    @endphp

                    <div class="role-section">
                        <div class="role-section-title">الصلاحيات</div>

                        <div class="role-permissions-wrapper">
                            <ul class="nav nav-tabs role-tabs">
                                @foreach($models as $index => $model)
                                    <li class="nav-item">
                                        <a href="#{{ $model }}"
                                           data-toggle="tab"
                                           aria-expanded="false"
                                           class="nav-link {{ $index == 0 ? 'active' : '' }}">
                                            <span>{{ __('messages.' . $model) }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="tab-content role-tab-content">
                                @foreach($models as $index => $model)
                                    <div role="tabpanel"
                                         class="tab-pane fade show {{ $index == 0 ? 'active' : '' }}"
                                         id="{{ $model }}">

                                        <div class="role-permission-list">
                                            @foreach($maps as $key => $map)
                                                <div class="role-permission-item">
                                                    <input type="checkbox"
                                                           name="permissions[]"
                                                           id="inlineCheckbox{{ $model }}{{ $key }}"
                                                           value="{{ $model }}-{{ $map }}">

                                                    <label for="inlineCheckbox{{ $model }}{{ $key }}">
                                                        {{ __('messages.' . $map) }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="role-submit-wrapper">
                    <button type="submit" class="btn btn-shadow btn-primary font-weight-bold role-submit-btn">
                        إضافة

                        <span class="svg-icon svg-icon m-0 svg-icon-md">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink"
                             width="24px"
                             height="24px"
                             viewBox="0 0 24 24"
                             version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                      fill="#000000"
                                      fill-rule="nonzero"
                                      transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)"></path>
                                <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                                      fill="#000000"
                                      fill-rule="nonzero"
                                      opacity="0.3"
                                      transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)"></path>
                            </g>
                        </svg>
                    </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function selectall(select) {
            $(`input[type='checkbox']`).prop("checked", $(select).is(':checked'));
        }
    </script>
@endsection
