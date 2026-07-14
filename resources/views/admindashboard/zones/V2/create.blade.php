@extends('layouts.adminindex')

@section('content')
    <style>
        .zone-create-page {
            direction: rtl;
        }

        .zone-create-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
        }

        .zone-create-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 22px 26px;
        }

        .zone-create-card .card-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .zone-create-card .card-label {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            color: #181c32;
        }

        .zone-create-card .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /*.zone-create-card .card-icon svg path,*/
        /*.zone-create-card .card-icon svg polygon {*/
        /*    fill: #3699ff !important;*/
        /*}*/

        .zone-create-body {
            padding: 28px;
            background: #ffffff;
        }

        .zone-section {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 22px;
        }

        .zone-section-title {
            font-size: 16px;
            font-weight: 800;
            color: #181c32;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .zone-section-title::before {
            content: "";
            width: 5px;
            height: 18px;
            border-radius: 10px;
            background: #3699ff;
            display: inline-block;
        }

        .zone-create-page .form-group label {
            font-weight: 700;
            color: #3f4254;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .zone-create-page .form-control,
        .zone-create-page .bootstrap-select > .dropdown-toggle {
            min-height: 44px;
            border-radius: 10px !important;
            border: 1px solid #e4e6ef !important;
            color: #3f4254 !important;
            background-color: #ffffff !important;
            box-shadow: none !important;
            transition: all 0.15s ease;
        }

        .zone-create-page .form-control:focus,
        .zone-create-page .bootstrap-select.show > .dropdown-toggle {
            border-color: #3699ff !important;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
        }

        .zone-create-page .bootstrap-select .filter-option {
            text-align: right !important;
        }

        .zone-create-page .dropdown-menu {
            border-radius: 12px;
            border: 1px solid #edf0f5;
            box-shadow: 0 10px 26px rgba(0, 0, 0, 0.12);
        }

        .zone-create-page .text-danger,
        .zone-create-page p[style*="color:red"] {
            color: #f64e60 !important;
            font-size: 13px;
            font-weight: 700;
            margin-top: 6px;
        }

        .zone-automatic-box {
            min-height: 44px;
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 10px;
            padding: 10px 14px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-top: 28px;
        }

        .zone-automatic-box span:first-child {
            font-weight: 800;
            color: #3f4254;
        }

        .zone-add-price-wrapper {
            display: flex;
            justify-content: center;
            margin: 8px 0 18px;
        }

        .zone-add-price-btn {
            min-width: 170px;
            height: 42px;
            border-radius: 10px !important;
            background: #eaf4ff !important;
            color: #3699ff !important;
            border: 1px solid #b5d9ff !important;
            font-size: 14px;
            font-weight: 900 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
        }

        .zone-add-price-btn:hover {
            background: #3699ff !important;
            color: #ffffff !important;
        }

        .zone-price-row {
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 12px;
            padding: 16px 12px 6px;
            margin-bottom: 12px;
            align-items: flex-end;
        }

        .zone-remove-price-btn {
            min-width: 72px;
            height: 38px;
            border-radius: 9px !important;
            background: #fff5f6 !important;
            color: #f64e60 !important;
            border: 1px solid #ffd0d6 !important;
            font-weight: 800 !important;
        }

        .zone-map {
            width: 100%;
            height: 440px;
            border-radius: 14px;
            border: 1px solid #edf0f5;
            overflow: hidden;
            background: #f3f6f9;
        }

        .zone-map-note {
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 10px;
            padding: 12px 14px;
            margin-bottom: 14px;
            color: #7e8299;
            font-size: 13px;
            font-weight: 700;
        }

        .zone-submit-wrapper {
            display: flex;
            justify-content: center;
            padding: 0 28px 28px;
        }

        .zone-submit-btn {
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

        .zone-submit-btn:hover {
            color: #ffffff !important;
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(54, 153, 255, 0.32);
        }

        .zone-submit-btn svg path {
            fill: #ffffff !important;
        }

        @media (max-width: 768px) {
            .zone-create-body {
                padding: 18px;
            }

            .zone-section {
                padding: 16px;
            }

            .zone-submit-wrapper {
                padding: 0 18px 18px;
            }

            .zone-submit-btn,
            .zone-add-price-btn {
                width: 100%;
            }

            .zone-map {
                height: 330px;
            }
        }
    </style>

    <div class="zone-create-page">
        <div class="card card-custom zone-create-card">
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

                    <h3 class="card-label">إضافة منطقة</h3>
                </div>
            </div>

            <form method="post" action="{{ route('zone.store') }}">
                @csrf

                <div class="card-body zone-create-body">
                    <div class="zone-section">
                        <div class="zone-section-title">بيانات المنطقة</div>

                        <div class="row">
                            <div class="form-group col-lg-6 col-md-6">
                                <label>الدوله <span class="text-danger">*</span></label>
                                <select name="country_id"
                                        class="form-control selectpicker"
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
                                <label>المحافظه <span class="text-danger">*</span></label>
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
                                <label>المدينه <span class="text-danger">*</span></label>
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
                                <label>الاسم <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control"
                                       required="required"
                                       value="{{ old('name') }}"
                                       name="name"/>
                                @error('name')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="zone-automatic-box">
                                    <span>Automatic</span>

                                    <span class="switch btn btns-m switch-outline switch-icon switch-primary">
                                    <label>
                                        <input type="checkbox"
                                               name="automatic"
                                               value="1"/>
                                        <span></span>
                                    </label>
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="zone-section">
                        <div class="zone-section-title">أسعار المسافات</div>

                        <div class="zone-add-price-wrapper">
                            <button type="button" id="addf" class="btn zone-add-price-btn">
                                <i class="fas fa-plus"></i>
                                اضافه سعر
                            </button>
                        </div>

                        <section id="section1"></section>
                    </div>

                    <div class="zone-section">
                        <div class="zone-section-title">تحديد المنطقة على الخريطة</div>

                        <div class="zone-map-note">
                            ارسم حدود المنطقة باستخدام أداة Polygon، ويمكنك تحديد الشكل وحذفه ثم رسمه مرة أخرى.
                        </div>

                        @error('points')
                        <p style="color:red;">{{ $message }}</p>
                        @enderror

                        <div id="map" class="zone-map"></div>
                        <input type="hidden" id="points" name="points">
                    </div>
                </div>

                <div class="zone-submit-wrapper">
                    <button type="submit" class="btn btn-shadow btn-primary font-weight-bold zone-submit-btn">
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
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true&libraries=drawing,geometry"></script>

    <script>
        let id1 = $("#section1 .row").length;

        $('#addf').click(function() {
            $('#section1').append(`
            <div class="row zone-price-row" id="remov${id1}">
                <div class="form-group col-lg-3 col-md-6">
                    <label>من <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" required="required" name="from_distance[]" value="">
                </div>

                <div class="form-group col-lg-3 col-md-6">
                    <label>السعر <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" value="" name="price[]" required="required">
                </div>

                <div class="form-group col-lg-3 col-md-6">
                    <label>إلى <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" value="" name="to_distance[]" required="required">
                </div>

                <div class="form-group col-lg-3 col-md-6">
                    <button class="btn btn-sm zone-remove-price-btn" type="button" onclick="removef(${id1})">حذف</button>
                </div>
            </div>
        `);

            id1++;
        });

        function removef(id) {
            $(`#remov${id}`).remove();
        }

        function getstates(selected) {
            let id = selected.value;

            $('#city').empty();
            $('select#city').selectpicker("refresh");

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

                        if ($('#state').val()) {
                            getcities(document.getElementById('state'));
                        }
                    }
                }
            });
        }

        function getcities(selected) {
            let id = selected.value;

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
                    }
                }
            });
        }

        var coordinates = [];
        var selectedShape;
        var map;
        var newShape;

        function syncShapePoints(shape) {
            coordinates = [];

            var polygonBounds = shape.getPath();

            for (var i = 0; i < polygonBounds.length; i++) {
                var point = polygonBounds.getAt(i);

                coordinates.push({
                    lat: point.lat(),
                    lng: point.lng()
                });
            }

            if (polygonBounds.length > 0) {
                var firstPoint = polygonBounds.getAt(0);

                coordinates.push({
                    lat: firstPoint.lat(),
                    lng: firstPoint.lng()
                });
            }

            $("#points").val(JSON.stringify(coordinates));
        }

        function clearSelection() {
            if (selectedShape) {
                selectedShape.setEditable(false);
                selectedShape = null;
            }
        }

        function setSelection(shape) {
            clearSelection();
            selectedShape = shape;
            shape.setEditable(true);
            syncShapePoints(shape);
        }

        function deleteSelectedShape() {
            if (selectedShape) {
                selectedShape.setMap(null);
                $("#points").val('');
            }

            clearSelection();
        }

        function initialize() {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 10,
                center: new google.maps.LatLng(30.033333, 31.233334)
            });

            var deleteControlDiv = document.createElement('div');
            var deleteControl = new DeleteControl(deleteControlDiv, map);
            deleteControlDiv.index = 1;
            map.controls[google.maps.ControlPosition.BOTTOM_LEFT].push(deleteControlDiv);

            var drawingManager = new google.maps.drawing.DrawingManager();

            drawingManager.setOptions({
                drawingControlOptions: {
                    position: google.maps.ControlPosition.BOTTOM_LEFT,
                    drawingModes: ['polygon']
                },
                polygonOptions: {
                    fillColor: "#ffffff",
                    strokeColor: "#FFA500",
                    fillOpacity: .3,
                    strokeWeight: 3,
                    editable: true
                }
            });

            drawingManager.setMap(map);

            google.maps.event.addListener(drawingManager, 'overlaycomplete', function(e) {
                if (selectedShape) {
                    selectedShape.setMap(null);
                }

                newShape = e.overlay;
                newShape.type = e.type;

                google.maps.event.addListener(newShape, 'click', function() {
                    setSelection(this);
                });

                google.maps.event.addListener(newShape.getPath(), 'set_at', function() {
                    syncShapePoints(newShape);
                });

                google.maps.event.addListener(newShape.getPath(), 'insert_at', function() {
                    syncShapePoints(newShape);
                });

                setSelection(newShape);
            });

            google.maps.event.addListener(map, 'click', function() {
                clearSelection();
            });
        }

        function DeleteControl(controlDiv, map) {
            var controlUI = document.createElement('div');

            controlUI.style.backgroundColor = '#ffffff';
            controlUI.style.border = '1px solid #e4e6ef';
            controlUI.style.borderRadius = '8px';
            controlUI.style.height = '34px';
            controlUI.style.width = '38px';
            controlUI.style.marginBottom = '8px';
            controlUI.style.cursor = 'pointer';
            controlUI.style.display = 'flex';
            controlUI.style.alignItems = 'center';
            controlUI.style.justifyContent = 'center';
            controlUI.title = 'Delete area';

            controlDiv.appendChild(controlUI);

            var controlText = document.createElement('div');
            controlText.innerHTML = '<i class="fas fa-trash" style="color:#f64e60;font-size:14px;"></i>';

            controlUI.appendChild(controlText);

            google.maps.event.addDomListener(controlUI, 'click', function() {
                if (selectedShape) {
                    deleteSelectedShape();
                } else {
                    alert("Select area first");
                }
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@endsection
