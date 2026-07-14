@extends('layouts.adminindex')

@section('content')
    <style>
        .employee-create-page {
            direction: rtl;
        }

        .employee-create-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
        }

        .employee-create-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 22px 26px;
        }

        .employee-create-card .card-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .employee-create-card .card-label {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            color: #181c32;
        }

        .employee-create-card .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /*.employee-create-card .card-icon svg path,*/
        /*.employee-create-card .card-icon svg polygon {*/
        /*    fill: #3699ff !important;*/
        /*}*/

        .employee-create-body {
            padding: 28px;
            background: #ffffff;
        }

        .employee-section {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 22px;
        }

        .employee-section-title {
            font-size: 16px;
            font-weight: 800;
            color: #181c32;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .employee-section-title::before {
            content: "";
            width: 5px;
            height: 18px;
            border-radius: 10px;
            background: #3699ff;
            display: inline-block;
        }

        .employee-create-page .form-group label {
            font-weight: 700;
            color: #3f4254;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .employee-create-page .form-control,
        .employee-create-page .bootstrap-select > .dropdown-toggle {
            min-height: 44px;
            border-radius: 10px !important;
            border: 1px solid #e4e6ef !important;
            color: #3f4254 !important;
            background-color: #ffffff !important;
            box-shadow: none !important;
            transition: all 0.15s ease;
        }

        .employee-create-page .form-control:focus,
        .employee-create-page .bootstrap-select.show > .dropdown-toggle {
            border-color: #3699ff !important;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
        }

        .employee-create-page .bootstrap-select .filter-option {
            text-align: right !important;
        }

        .employee-create-page .dropdown-menu {
            border-radius: 12px;
            border: 1px solid #edf0f5;
            box-shadow: 0 10px 26px rgba(0, 0, 0, 0.12);
        }

        .employee-create-page .text-danger,
        .employee-create-page p[style*="color:red"] {
            color: #f64e60 !important;
            font-size: 13px;
            font-weight: 700;
            margin-top: 6px;
        }

        .employee-upload-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .employee-upload-card {
            width: 220px;
            min-height: 245px;
            border: 1px dashed #b5d9ff;
            border-radius: 16px;
            background: #f3f9ff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 18px;
            text-align: center;
        }

        .employee-upload-card .image-input {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .employee-upload-card .image-input-wrapper {
            width: 112px !important;
            height: 112px !important;
            border-radius: 50% !important;
            background-color: #ffffff;
            background-size: cover;
            background-position: center;
            border: 4px solid #ffffff;
            box-shadow: 0 8px 20px rgba(54, 153, 255, 0.16);
        }

        .employee-upload-btn {
            width: 42px !important;
            height: 42px !important;
            min-width: 42px !important;
            min-height: 42px !important;
            border-radius: 50% !important;
            background: #3699ff !important;
            color: #ffffff !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            margin-top: -20px;
            cursor: pointer;
        }

        .employee-upload-btn svg path,
        .employee-upload-btn svg rect,
        .employee-upload-btn svg circle {
            fill: #ffffff !important;
        }

        .employee-upload-label {
            margin-top: 12px;
            font-size: 14px;
            font-weight: 800;
            color: #181c32;
        }

        .employee-submit-wrapper {
            display: flex;
            justify-content: center;
            padding: 0 28px 28px;
        }

        .employee-submit-btn {
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

        .employee-submit-btn:hover {
            color: #ffffff !important;
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(54, 153, 255, 0.32);
        }

        .employee-submit-btn svg path {
            fill: #ffffff !important;
        }

        @media (max-width: 768px) {
            .employee-create-body {
                padding: 18px;
            }

            .employee-section {
                padding: 16px;
            }

            .employee-submit-wrapper {
                padding: 0 18px 18px;
            }

            .employee-submit-btn {
                width: 100%;
            }
        }
    </style>

    <div class="employee-create-page">
        <div class="card card-custom employee-create-card">

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

                    <h3 class="card-label">اضافه موظف</h3>
                </div>
            </div>

            <form method="post" action="{{ route('employee.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="card-body employee-create-body">

                    <div class="employee-section">
                        <div class="employee-section-title">صورة الموظف</div>

                        <div class="employee-upload-wrapper">
                            <div class="employee-upload-card">
                                <div class="image-input image-input-outline image-input-circle" id="kt_image_3">
                                    <div class="image-input-wrapper mb-5" id="im"></div>

                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow employee-upload-btn"
                                           data-action="change"
                                           data-toggle="tooltip"
                                           title=""
                                           data-original-title="Change avatar">
                                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink"
                                             width="24px"
                                             height="24px"
                                             viewBox="0 0 24 24"
                                             version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M5,7 L19,7 C20.1045695,7 21,7.8954305 21,9 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,9 C3,7.8954305 3.8954305,7 5,7 Z M12,17 C14.209139,17 16,15.209139 16,13 C16,10.790861 14.209139,9 12,9 C9.790861,9 8,10.790861 8,13 C8,15.209139 9.790861,17 12,17 Z"
                                                      fill="#000000"/>
                                                <rect fill="#000000" opacity="0.3" x="9" y="4" width="6" height="2" rx="1"/>
                                                <circle fill="#000000" opacity="0.3" cx="12" cy="13" r="2"/>
                                            </g>
                                        </svg>
                                    </span>

                                        <input type="file" name="image" id="do" />
                                        <input type="hidden" name="profile_avatar_remove"/>
                                    </label>

                                    <label class="employee-upload-label">صوره</label>

                                    @error('image')
                                    <p style="color:red;">{{ $message }}</p>
                                    @enderror

                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                          data-action="cancel"
                                          data-toggle="tooltip"
                                          title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="employee-section">
                        <div class="employee-section-title">المعلومات الرئيسية</div>

                        <div class="row">
                            <div class="form-group col-lg-6 col-md-6">
                                <label>الاسم <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control"
                                       value="{{ old('name') }}"
                                       name="name"
                                       required="required"/>
                                @error('name')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label>رقم الهاتف <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control"
                                       value="{{ old('phone') }}"
                                       name="phone"
                                       required="required"/>
                                @error('phone')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label>رقم الهاتف الثانى (اختياري)</label>
                                <input type="text"
                                       class="form-control"
                                       value="{{ old('mobile') }}"
                                       name="mobile"/>
                                @error('mobile')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label>كلمه السر <span class="text-danger">*</span></label>
                                <input type="password"
                                       class="form-control"
                                       value="{{ old('password') }}"
                                       name="password"
                                       required="required"/>
                                @error('password')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="employee-section">
                        <div class="employee-section-title">معلومات العنوان</div>

                        <div class="row">
                            <div class="form-group col-lg-6 col-md-6">
                                <label>الدوله<span class="text-danger">*</span></label>
                                <select name="country_id"
                                        class="form-control selectpicker"
                                        id="country_id"
                                        required="required"
                                        data-live-search="true">
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label>المحافظه<span class="text-danger">*</span></label>
                                <select name="state_id"
                                        class="form-control selectpicker"
                                        id="state"
                                        required="required"
                                        data-live-search="true">
                                    @foreach($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                                @error('state_id')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label>المدينه<span class="text-danger">*</span></label>
                                <select name="city_id"
                                        class="form-control selectpicker"
                                        id="city"
                                        required="required"
                                        data-live-search="true">
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                                @error('city_id')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label>المنطقه<span class="text-danger">*</span></label>
                                <select name="zone_id"
                                        class="form-control selectpicker"
                                        id="zone"
                                        required="required"
                                        data-live-search="true">
                                    @foreach($zones as $zone)
                                        <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                    @endforeach
                                </select>
                                @error('zone_id')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label>الشارع</label>
                                <input type="text"
                                       class="form-control"
                                       value="{{ old('street') }}"
                                       name="street"/>
                                @error('street')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label>رقم المبنى</label>
                                <input type="number"
                                       class="form-control"
                                       value="{{ old('building_number') }}"
                                       name="building_number"/>
                                @error('building_number')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label>رقم الطابق</label>
                                <input type="number"
                                       class="form-control"
                                       value="{{ old('floor_number') }}"
                                       name="floor_number"/>
                                @error('floor_number')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="employee-section">
                        <div class="employee-section-title">الدور والصلاحيات</div>

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

                        <div class="row">
                            <div class="form-group col-lg-6 col-md-6">
                                <label>دور الموظف<span class="text-danger">*</span></label>
                                <select name="role_id"
                                        class="form-control selectpicker"
                                        id="role"
                                        required="required"
                                        data-live-search="true">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>

                                @error('role_id')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="employee-submit-wrapper">
                    <button type="submit" class="btn btn-shadow btn-primary font-weight-bold employee-submit-btn">
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
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#im').css('background-image', 0);
                    $('#im').css('background-image', "url(" + e.target.result + ")");
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#do").change(function() {
            readURL(this);
            console.log($('#im').css('background-image'));
        });

        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#im1').css('background-image', 0);
                    $('#im1').css('background-image', "url(" + e.target.result + ")");
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#do1").change(function() {
            readURL1(this);
            console.log($('#im1').css('background-image'));
        });

        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#im2').css('background-image', 0);
                    $('#im2').css('background-image', "url(" + e.target.result + ")");
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#do2").change(function() {
            readURL2(this);
            console.log($('#im2').css('background-image'));
        });

        function readURL4(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#im4').css('background-image', 0);
                    $('#im4').css('background-image', "url(" + e.target.result + ")");
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#do4").change(function() {
            readURL4(this);
            console.log($('#im4').css('background-image'));
        });

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
                url: `../getstates/${id}`,
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
                url: `../getcities/${id}`,
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
                url: `../getzones/${id}`,
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

        function initMap(_Lat = '', _Lng = '') {
            if (_Lat) {
                var LatLng = new google.maps.LatLng(_Lat, _Lng);
            } else {
                var LatLng = new google.maps.LatLng(30.944654272165398, 31.179500891604654);
            }

            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 8,
                center: LatLng,
            });

            let marker = new google.maps.Marker({
                map,
                animation: google.maps.Animation.DROP,
                position: LatLng,
            });

            map.addListener("click", (mapsMouseEvent) => {
                marker.setMap(null);

                marker = new google.maps.Marker({
                    map,
                    position: mapsMouseEvent.latLng,
                });

                const cityCircle = new google.maps.Circle({
                    strokeColor: "#000",
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: "#fff",
                    fillOpacity: 0.35,
                    map,
                    center: mapsMouseEvent.latLng,
                    radius: 6000,
                });

                var Lat = mapsMouseEvent.latLng.lat();
                var Lng = mapsMouseEvent.latLng.lng();

                $('#Lat').val(Lat);
                $('#Lng').val(Lng);
            });
        }
    </script>
@endsection
