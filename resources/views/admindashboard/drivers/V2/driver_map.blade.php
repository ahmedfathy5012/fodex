@extends('layouts.adminindex')

@section('content')
    <style>
        .driver-map-page {
            direction: rtl;
        }

        .driver-map-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
        }

        .driver-map-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 22px 26px;
        }

        .driver-map-card .card-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .driver-map-card .card-label {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            color: #181c32;
        }

        .driver-map-card .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .driver-map-card .card-icon svg path,
        .driver-map-card .card-icon svg polygon {
            fill: #3699ff !important;
        }

        .driver-map-body {
            padding: 28px;
            background: #ffffff;
        }

        .driver-map-info {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 18px 22px;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
        }

        .driver-map-title-box {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .driver-map-avatar {
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

        .driver-map-title-content span {
            display: block;
            font-size: 12px;
            font-weight: 800;
            color: #7e8299;
            margin-bottom: 4px;
        }

        .driver-map-title-content strong {
            display: block;
            font-size: 17px;
            font-weight: 900;
            color: #181c32;
        }

        .driver-map-location-badges {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .driver-map-badge {
            min-height: 34px;
            border-radius: 9px;
            background: #ffffff;
            color: #3f4254;
            font-size: 13px;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 12px;
            border: 1px solid #edf0f5;
        }

        .driver-map-wrapper {
            width: 100%;
            height: 560px;
            border-radius: 16px;
            border: 1px solid #edf0f5;
            overflow: hidden;
            background: #f3f6f9;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
        }

        #map {
            width: 100%;
            height: 100%;
        }

        @media (max-width: 768px) {
            .driver-map-body {
                padding: 18px;
            }

            .driver-map-info {
                padding: 16px;
            }

            .driver-map-wrapper {
                height: 420px;
            }
        }
    </style>

    <div class="driver-map-page">
        <div class="card card-custom driver-map-card">
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

                    <h3 class="card-label">موقع {{ $driver->name }}</h3>
                </div>
            </div>

            <div class="card-body driver-map-body">
                <div class="driver-map-info">
                    <div class="driver-map-title-box">
                        <div class="driver-map-avatar">
                            <i class="fas fa-motorcycle"></i>
                        </div>

                        <div class="driver-map-title-content">
                            <span>السائق</span>
                            <strong>{{ $driver->name }}</strong>
                        </div>
                    </div>

                    <div class="driver-map-location-badges">
                    <span class="driver-map-badge">
                        <i class="fas fa-map-marker-alt"></i>
                        Lat:
                        <strong>{{ $driver->address->lat ?? '---' }}</strong>
                    </span>

                        <span class="driver-map-badge">
                        <i class="fas fa-location-arrow"></i>
                        Lng:
                        <strong>{{ $driver->address->lon ?? '---' }}</strong>
                    </span>
                    </div>
                </div>

                <div class="driver-map-wrapper">
                    <div id="map"></div>
                </div>

                <div class="d-none">
                    <input type="hidden"
                           class="form-control"
                           @if($driver->address) value="{{ $driver->address->lat }}" @endif
                           id="Lat"
                           name="lat"/>

                    <input type="hidden"
                           class="form-control"
                           @if($driver->address) value="{{ $driver->address->lon }}" @endif
                           id="Lng"
                           name="lon"/>

                    <input type="hidden"
                           class="form-control"
                           value="{{ $driver->id }}"
                           id="id"/>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js"></script>

    <script>
        var markers = [];
        var marks = [];
        var map;

        function initialize() {
            let lat1 = $('#Lat').val();
            let lng1 = $('#Lng').val();

            if (!lat1 || !lng1) {
                lat1 = 25.381427;
                lng1 = 49.582997;
            }

            var myLatlng = new google.maps.LatLng(lat1, lng1);

            var mapOptions = {
                center: myLatlng,
                zoom: 14
            };

            map = new google.maps.Map(document.getElementById("map"), mapOptions);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var id = $("#id").val();

            $.ajax({
                type: "get",
                url: `../get_driver/${id}`,
                dataType: "Json",
                success: function(result) {
                    if (result.status == true) {
                        markers = result.data;

                        $.each(result.data, function(index, value) {
                            marks[value.name] = addMarker(markers[index]);
                        });
                    }
                }
            });
        }

        function addMarker(marker) {
            var icon = {
                url: "../driver.png",
                scaledSize: new google.maps.Size(50, 50)
            };

            var marker1 = new google.maps.Marker({
                position: new google.maps.LatLng(marker.lat, marker.lon),
                map: map,
                icon: icon,
                label: {
                    fontSize: "14px",
                    text: marker.name,
                    color: "#ffffff",
                    fontWeight: "bold"
                }
            });

            var infoWindow = new google.maps.InfoWindow({
                content: `<strong>${marker.name}</strong>`
            });

            marker1.addListener('click', function() {
                infoWindow.open(map, marker1);
            });

            return marker1;
        }

        google.maps.event.addDomListener(window, 'load', initialize);

        Echo.channel('FodexApp')
            .listen('DriverMoved', (e) => {
                updatePosition(e.lat, e.lon, e.name);
            });

        function updatePosition(newLat, newLng, name) {
            const latLng = {
                lat: parseFloat(newLat),
                lng: parseFloat(newLng)
            };

            if (marks[name]) {
                marks[name].setPosition(latLng);
            } else {
                marks[name] = addMarker({
                    name: name,
                    lat: newLat,
                    lon: newLng
                });
            }
        }
    </script>
@endsection
