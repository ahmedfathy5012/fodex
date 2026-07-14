@extends('layouts.adminindex')

@section('content')
    <style>
        .employee-permissions-page {
            direction: rtl;
        }

        .employee-permissions-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
        }

        .employee-permissions-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 22px 26px;
        }

        .employee-permissions-card .card-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .employee-permissions-card .card-label {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            color: #181c32;
        }

        .employee-permissions-card .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .employee-permissions-card .card-icon svg path,
        .employee-permissions-card .card-icon svg polygon {
            fill: #3699ff !important;
        }

        .employee-permissions-body {
            padding: 28px;
            background: #ffffff;
        }

        .employee-permissions-section {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 22px;
        }

        .employee-permissions-section-title {
            font-size: 16px;
            font-weight: 800;
            color: #181c32;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .employee-permissions-section-title::before {
            content: "";
            width: 5px;
            height: 18px;
            border-radius: 10px;
            background: #3699ff;
            display: inline-block;
        }

        .employee-permission-row {
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 18px;
            margin-bottom: 14px;
            align-items: flex-end;
        }

        .employee-permissions-page .form-group {
            margin-bottom: 0;
        }

        .employee-permissions-page .form-group label {
            font-weight: 800;
            color: #3f4254;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .employee-permissions-page .form-control,
        .employee-permissions-page .bootstrap-select > .dropdown-toggle {
            min-height: 44px;
            border-radius: 10px !important;
            border: 1px solid #e4e6ef !important;
            color: #3f4254 !important;
            background-color: #ffffff !important;
            box-shadow: none !important;
            transition: all 0.15s ease;
        }

        .employee-permissions-page .form-control:focus,
        .employee-permissions-page .bootstrap-select.show > .dropdown-toggle {
            border-color: #3699ff !important;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
        }

        .employee-permissions-page .bootstrap-select .filter-option {
            text-align: right !important;
        }

        .employee-permissions-page .dropdown-menu {
            border-radius: 12px;
            border: 1px solid #edf0f5;
            box-shadow: 0 10px 26px rgba(0, 0, 0, 0.12);
        }

        .employee-permissions-page .text-danger,
        .employee-permissions-page p[style*="color:red"] {
            color: #f64e60 !important;
            font-size: 13px;
            font-weight: 700;
            margin-top: 6px;
        }

        .employee-permission-select-all {
            min-height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #eaf4ff;
            border: 1px solid #b5d9ff;
            color: #3699ff;
            border-radius: 10px;
            font-weight: 800;
            cursor: pointer;
            margin: 0;
            padding: 8px 12px;
        }

        .employee-permission-select-all input {
            width: 16px;
            height: 16px;
            margin: 0;
            cursor: pointer;
        }

        .employee-permission-count {
            min-height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .employee-permission-count .badge {
            min-width: 44px;
            height: 30px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 13px;
            background: #e8fff3 !important;
            color: #1bc5bd !important;
            border: 1px solid #bdf4dd;
        }

        .employee-permissions-submit-wrapper {
            display: flex;
            justify-content: center;
            padding: 0 28px 28px;
        }

        .employee-permissions-submit-btn {
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
        }

        .employee-permissions-submit-btn:hover {
            color: #ffffff !important;
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(54, 153, 255, 0.32);
        }

        .employee-permissions-submit-btn svg path {
            fill: #ffffff !important;
        }

        @media (max-width: 768px) {
            .employee-permissions-body {
                padding: 18px;
            }

            .employee-permissions-section {
                padding: 16px;
            }

            .employee-permission-row {
                padding: 16px;
            }

            .employee-permission-row > div {
                margin-bottom: 12px;
            }

            .employee-permissions-submit-wrapper {
                padding: 0 18px 18px;
            }

            .employee-permissions-submit-btn {
                width: 100%;
            }
        }
    </style>

    <div class="employee-permissions-page">
        <div class="card card-custom employee-permissions-card">

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

                    <h3 class="card-label">صلاحيات مناطق الموظف</h3>
                </div>
            </div>

            <form method="post" action="{{ route('savecountriespermissions', $employee->id) }}" enctype="multipart/form-data">
                @csrf

                <div class="card-body employee-permissions-body">
                    <div class="employee-permissions-section">
                        <div class="employee-permissions-section-title">تحديد صلاحيات المناطق</div>

                        <div class="row employee-permission-row">
                            <div class="form-group col-lg-6 col-md-12">
                                <label>الدوله<span class="text-danger">*</span></label>
                                <select name="country_id[]"
                                        class="form-control selectpicker"
                                        multiple
                                        id="country_id"
                                        data-live-search="true">
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}"
                                                style="padding-left:30px;"
                                                @if(in_array($country->id, $employee->countries->pluck('id')->toArray())) selected @endif>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('country_id')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <label class="employee-permission-select-all">
                                    <input type="checkbox" onchange="selectall('country_id', this)">
                                    الكل
                                </label>
                            </div>

                            <div class="col-lg-3 col-md-6 employee-permission-count">
                                <span class="badge badge-success">{{ count($employee->countries) }}</span>
                            </div>
                        </div>

                        <div class="row employee-permission-row">
                            <div class="form-group col-lg-6 col-md-12">
                                <label>المحافظه<span class="text-danger">*</span></label>
                                <select name="state_id[]"
                                        class="form-control selectpicker"
                                        id="state"
                                        multiple
                                        data-live-search="true">
                                    @foreach($states as $state)
                                        <option value="{{ $state->id }}"
                                                style="padding-left:30px;"
                                                @if(in_array($state->id, $employee->states->pluck('id')->toArray())) selected @endif>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('state_id')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <label class="employee-permission-select-all">
                                    <input type="checkbox" onchange="selectall('state', this)">
                                    الكل
                                </label>
                            </div>

                            <div class="col-lg-3 col-md-6 employee-permission-count">
                                <span class="badge badge-success">{{ count($employee->states) }}</span>
                            </div>
                        </div>

                        <div class="row employee-permission-row">
                            <div class="form-group col-lg-6 col-md-12">
                                <label>المدينه<span class="text-danger">*</span></label>
                                <select name="city_id[]"
                                        class="form-control selectpicker"
                                        multiple
                                        id="city"
                                        data-live-search="true">
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}"
                                                style="padding-left:30px;"
                                                @if(in_array($city->id, $employee->cities->pluck('id')->toArray())) selected @endif>
                                            {{ $city->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('city_id')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <label class="employee-permission-select-all">
                                    <input type="checkbox" onchange="selectall('city', this)">
                                    الكل
                                </label>
                            </div>

                            <div class="col-lg-3 col-md-6 employee-permission-count">
                                <span class="badge badge-success">{{ count($employee->cities) }}</span>
                            </div>
                        </div>

                        <div class="row employee-permission-row">
                            <div class="form-group col-lg-6 col-md-12">
                                <label>المنطقه<span class="text-danger">*</span></label>
                                <select name="zone_id[]"
                                        class="form-control selectpicker"
                                        id="zone"
                                        multiple
                                        data-live-search="true">
                                    @foreach($zones as $zone)
                                        <option value="{{ $zone->id }}"
                                                style="padding-left:30px;"
                                                @if(in_array($zone->id, $employee->zones->pluck('id')->toArray())) selected @endif>
                                            {{ $zone->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('zone_id')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <label class="employee-permission-select-all">
                                    <input type="checkbox" onchange="selectall('zone', this)">
                                    الكل
                                </label>
                            </div>

                            <div class="col-lg-3 col-md-6 employee-permission-count">
                                <span class="badge badge-success">{{ count($employee->zones) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="employee-permissions-submit-wrapper">
                    <button type="submit" class="btn btn-shadow btn-primary font-weight-bold employee-permissions-submit-btn">
                        حفظ الصلاحيات

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
        function getstates(selected) {
            let id = selected.value;
            console.log(id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: `../getstatesmultiple`,
                dataType: "Json",
                data: {
                    "country_id": $("#country_id").val()
                },
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
                type: "post",
                url: `../getcitiesmultiple`,
                dataType: "Json",
                data: {
                    "state_id": $("#state").val()
                },
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
                type: "post",
                url: `../getzonesmultiple`,
                dataType: "Json",
                data: {
                    "city_id": $("#city").val()
                },
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

        function selectall(id, select) {
            $(`#${id}`).find("option").prop("selected", $(select).is(':checked'));
            $(`#${id}`).selectpicker("refresh");

            if (id == "country_id") {
                getstates(select);
            } else if (id == "state") {
                getcities(select);
            } else if (id == "city") {
                getzones(select);
            }
        }
    </script>
@endsection
