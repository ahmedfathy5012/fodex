@extends('layouts.adminindex')

@section('content')
    <style>
        .company-driver-edit-page {
            direction: rtl;
        }

        .company-driver-edit-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
        }

        .company-driver-edit-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 22px 26px;
        }

        .company-driver-edit-card .card-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .company-driver-edit-card .card-label {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            color: #181c32;
        }

        .company-driver-edit-card .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /*.company-driver-edit-card .card-icon svg path,*/
        /*.company-driver-edit-card .card-icon svg polygon {*/
        /*    fill: #3699ff !important;*/
        /*}*/

        .company-driver-edit-body {
            padding: 28px;
            background: #ffffff;
        }

        .company-driver-section {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 22px;
        }

        .company-driver-section-title {
            font-size: 16px;
            font-weight: 800;
            color: #181c32;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .company-driver-section-title::before {
            content: "";
            width: 5px;
            height: 18px;
            border-radius: 10px;
            background: #3699ff;
            display: inline-block;
        }

        .company-driver-edit-page .form-group label {
            font-weight: 700;
            color: #3f4254;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .company-driver-edit-page .form-control,
        .company-driver-edit-page .bootstrap-select > .dropdown-toggle {
            min-height: 44px;
            border-radius: 10px !important;
            border: 1px solid #e4e6ef !important;
            color: #3f4254 !important;
            background-color: #ffffff !important;
            box-shadow: none !important;
            transition: all 0.15s ease;
        }

        .company-driver-edit-page .form-control:focus,
        .company-driver-edit-page .bootstrap-select.show > .dropdown-toggle {
            border-color: #3699ff !important;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
        }

        .company-driver-edit-page .bootstrap-select .filter-option {
            text-align: right !important;
        }

        .company-driver-edit-page .dropdown-menu {
            border-radius: 12px;
            border: 1px solid #edf0f5;
            box-shadow: 0 10px 26px rgba(0, 0, 0, 0.12);
        }

        .company-driver-edit-page .text-danger,
        .company-driver-edit-page p[style*="color:red"] {
            color: #f64e60 !important;
            font-size: 13px;
            font-weight: 700;
            margin-top: 6px;
        }

        .company-driver-map {
            width: 100%;
            height: 360px;
            border-radius: 14px;
            border: 1px solid #edf0f5;
            overflow: hidden;
            margin: 8px 0 22px;
            background: #f3f6f9;
        }

        .company-driver-submit-wrapper {
            display: flex;
            justify-content: center;
            padding: 0 28px 28px;
        }

        .company-driver-submit-btn {
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

        .company-driver-submit-btn:hover {
            color: #ffffff !important;
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(54, 153, 255, 0.32);
        }

        .company-driver-submit-btn svg path {
            fill: #ffffff !important;
        }

        @media (max-width: 768px) {
            .company-driver-edit-body {
                padding: 18px;
            }

            .company-driver-section {
                padding: 16px;
            }

            .company-driver-submit-wrapper {
                padding: 0 18px 18px;
            }

            .company-driver-submit-btn {
                width: 100%;
            }

            .company-driver-map {
                height: 280px;
            }
        }
    </style>

    <div class="company-driver-edit-page">
        <div class="card card-custom company-driver-edit-card">
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

                    <h3 class="card-label">تعديل سائق</h3>
                </div>
            </div>

            <form method="post" action="{{ route('company_drivers.update', $driver->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="card-body company-driver-edit-body">
                    <div class="company-driver-section">
                        <div class="company-driver-section-title">المعلومات الرئيسية</div>

                        <div class="row">
                            <div class="form-group col-lg-6 col-md-6">
                                <label>الاسم <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control"
                                       value="{{ $driver->name }}"
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
                                       value="{{ $driver->phone }}"
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
                                       value="{{ $driver->mobile }}"
                                       name="mobile"/>
                                @error('mobile')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="company-driver-section">
                        <div class="company-driver-section-title">معلومات العنوان</div>

                        <div class="row">
                            <div class="form-group col-lg-6 col-md-6">
                                <label>الدوله<span class="text-danger">*</span></label>
                                <select name="country_id"
                                        class="form-control selectpicker"
                                        onchange="getstates(this)"
                                        id="country_id"
                                        required="required"
                                        data-live-search="true">
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" @if($address->country_id == $country->id) selected @endif>
                                            {{ $country->name }}
                                        </option>
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
                                        onchange="getcities(this)"
                                        required="required"
                                        data-live-search="true">
                                    @foreach($states as $state)
                                        <option value="{{ $state->id }}" @if($address->state_id == $state->id) selected @endif>
                                            {{ $state->name }}
                                        </option>
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
                                        onchange="getzones(this)"
                                        id="city"
                                        required="required"
                                        data-live-search="true">
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}" @if($address->city_id == $city->id) selected @endif>
                                            {{ $city->name }}
                                        </option>
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
                                        <option value="{{ $zone->id }}" @if($address->zone_id == $zone->id) selected @endif>
                                            {{ $zone->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('zone_id')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label>الشارع <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control"
                                       value="{{ $address->street }}"
                                       name="street"
                                       required="required"/>
                                @error('street')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label>رقم المبنى <span class="text-danger">*</span></label>
                                <input type="number"
                                       class="form-control"
                                       value="{{ $address->building_number }}"
                                       name="building_number"
                                       required="required"/>
                                @error('building_number')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label>رقم الطابق <span class="text-danger">*</span></label>
                                <input type="number"
                                       class="form-control"
                                       value="{{ $address->floor_number }}"
                                       name="floor_number"
                                       required="required"/>
                                @error('floor_number')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-12">
                                <div id="map" class="company-driver-map"></div>
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label>lat</label>
                                <input type="text"
                                       class="form-control"
                                       value="{{ $address->lat }}"
                                       id="Lat"
                                       name="lat"/>
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label>lon</label>
                                <input type="text"
                                       class="form-control"
                                       value="{{ $address->lon }}"
                                       id="Lng"
                                       name="lon"/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="company-driver-submit-wrapper">
                    <button type="submit" class="btn btn-shadow btn-primary font-weight-bold company-driver-submit-btn">
                        حفظ التعديل

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
    <script src="https://maps.googleapis.com/maps/api/js"></script>
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
                url: `../../getstates/${id}`,
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
                url: `../../getcities/${id}`,
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
                url: `../../getzones/${id}`,
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

        function initialize() {
            var lat = $('#Lat').val();
            var lng = $('#Lng').val();

            var myLatlng = new google.maps.LatLng(
                lat ? lat : 25.381427,
                lng ? lng : 49.582997
            );

            var mapOptions = {
                center: myLatlng,
                zoom: 14
            };

            var map = new google.maps.Map(document.getElementById("map"), mapOptions);
            var geocoder = new google.maps.Geocoder;
            var infowindow = new google.maps.InfoWindow;

            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: 'I move with you man :)'
            });

            google.maps.event.addListener(map, 'click', function(e) {
                map.panTo(e.latLng);

                var Lat = e.latLng.lat();
                var Lng = e.latLng.lng();

                $('#Lat').val(Lat);
                $('#Lng').val(Lng);
            });

            google.maps.event.addListener(map, 'center_changed', function() {
                var center = map.getCenter();
                marker.setPosition(center);

                window.setTimeout(function() {
                    geocodeLatLng(geocoder, map, infowindow, marker);
                }, 2000);
            });
        }

        function geocodeLatLng(geocoder, map, infowindow, marker) {
            geocoder.geocode({
                'location': marker.position
            }, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    console.log(results);

                    if (results[1]) {
                        infowindow.setContent(results[1].formatted_address);
                        infowindow.open(map, marker);
                    } else {
                        console.warn('GeoCoder: No results found');
                    }
                } else {
                    console.warn('Geocoder failed due to: ' + status);
                }
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@endsection
