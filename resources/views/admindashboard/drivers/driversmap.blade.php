@extends('layouts.adminindex')
@section('content')

<div class="card card-custom">
 
 
    <div class="card-header">
		<div class="card-title">
			<span class="card-icon">
			
			
    			<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-12-28-020759/theme/html/demo8/dist/../src/media/svg/icons/Files/File-plus.svg-->
                   <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"/>
                            <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000"/>
                        </g>
                    </svg><!--end::Svg Icon-->
                </span>
			
			
			</span>
			
			<h3 class="card-label">    خريطه السائقين </h3>
		</div>
	</div>
 
 
 <!--begin::Form-->

  
  <div class="card-body">
   <div class ="row">

             <div id="map" style="width:100%;height:400px; ">
     </div>
      <input type="hidden" id="points" name="points">
       </div>
    
       
   </div>
  
   
  
 </form>
 <!--end::Form-->
</div>
@endsection
@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js"></script>

<script>




   </script>
<script>
   var markers = [];
   console.log(markers);
    var marks = []; 
    var map;
    function initialize() {
        var myLatlng = new google.maps.LatLng(25.381427, 49.582997);

        var mapOptions = {
            center: myLatlng,
            zoom: 14
        };

         map = new google.maps.Map(document.getElementById("map"), mapOptions);
        var geocoder = new google.maps.Geocoder;
        var infowindow = new google.maps.InfoWindow;
$.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `alldrivers`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        if(result.status == true){
            markers = result.data;
            $.each(result.data, function( index, value ) {
                 marks[value.name] = addMarker(markers[index]);
             
});
//  for(var i = 0; i < markers.length; i++){
//             marks[i] = addMarker(markers[i]);
//         }
        }
       }

      });
        // google.maps.event.addListener(map, 'click', function(e) {
        //     //marker.setPosition(e.latLng);
        //     map.panTo(e.latLng)
        //     var Lat = e.latLng.lat();
        //             var Lng = e.latLng.lng();
        //             $('#Lat').val(Lat);
        //             $('#Lng').val(Lng);
        //     //map.setCenter(e.latLng);
        // });
        
        // google.maps.event.addListener(map, 'center_changed', function() {
        //     var center = map.getCenter();
        //     marker.setPosition(center);

        //     window.setTimeout(function() {
        //         geocodeLatLng(geocoder, map, infowindow, marker);
        //     }, 2000);
        // });
    }function addMarker(marker){
        var icon = {
        url: "driver.png", // url
        scaledSize: new google.maps.Size(50, 50), // size
    };
        var marker1 = new google.maps.Marker({
            position: new google.maps.LatLng(marker.lat,marker.lon),
            map: map,
             icon: icon,
              label: {
             fontSize: "20px",
            text: marker.name,
              color: "#fff",
           fontWeight: "bold"
    }
        });
        return marker1;
    }

    // function geocodeLatLng(geocoder, map, infowindow, marker) {
    //     geocoder.geocode({
    //         'location': marker.position
    //     }, function(results, status) {
    //         if (status === google.maps.GeocoderStatus.OK) {
    //             console.log(results);
    //             if (results[1]) {
    //                 //map.setZoom(11);
    //                 infowindow.setContent(results[1].formatted_address);
    //                 infowindow.open(map, marker);
    //             } else {
    //                 console.warn('GeoCoder: No results found');
    //             }
    //         } else {
    //             console.warn('Geocoder failed due to: ' + status);
    //         }
    //     });
    // }

    google.maps.event.addDomListener(window, 'load', initialize);
//     setInterval(function() {
//   initialize()
// }, 10000);
                Echo.channel('FodexApp')
                .listen('DriverMoved', (e) => {
                 
//                     $.ajaxSetup({
//        headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
//     });
  
//     $.ajax({
//        type:"get",
//        url: `alldrivers`,
//    //    contentType: "application/json; charset=utf-8",
//        dataType: "Json",
//        success: function(result){
//         if(result.status == true){
//             markers = result.data;
//  for(var i = 0; i < markers.length; i++){
//             marks[i] = addMarker(markers[i]);
//         }
//         }
//        }

//       });
     updatePosition(e.lat, e.lon,e.name);
                   
                });
 function updatePosition(newLat, newLng,name)
            {
                const latLng = { lat: parseFloat(newLat), lng: parseFloat(newLng) };
                marks[name].setPosition(latLng);
               // map.setCenter(latLng);
            }
           console.log(marks);
    </script>
@endsection