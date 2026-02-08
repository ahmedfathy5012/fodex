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
			
			<h3 class="card-label">   اضافه مدينه </h3>
		</div>
	</div>
 
 
 <!--begin::Form-->
<form method="post" action="{{route('city.update',$city->id)}}">

    @csrf
     @method('put')
  <div class="card-body">
   <div class ="row">
   <div class="form-group col-6">
        <label>الدوله <span class="text-danger">*</span></label>
        <select name="country_id" class="form-control selectpicker" onchange="getstates(this)" required="required" data-live-search="true">
          @foreach($countries as $country)
          <option value="{{$country->id}}" @if($city->country_id == $country->id) selected @endif>{{$country->name}}</option>
          @endforeach
        </select>
       @error('name')
       <p style="color:red;">{{$message}}</p>
       @enderror
       </div>
       <div class="form-group col-6">
        <label>المحافظه <span class="text-danger">*</span></label>
        <select name="state_id" class="form-control selectpicker" id="state" required="required" data-live-search="true">
          @foreach($states as $state)
          <option value="{{$state->id}}" @if($city->state_id == $state->id) selected @endif>{{$state->name}}</option>
          @endforeach
        </select>
       @error('state_id')
       <p style="color:red;">{{$message}}</p>
       @enderror
       </div>
   <div class="form-group col-6">
        <label>الاسم <span class="text-danger">*</span></label>
        <input type="text" class="form-control " required="required" value="{{$city->name}}" name="name" />
       @error('name')
       <p style="color:red;">{{$message}}</p>
       @enderror
       </div>
      <div id="map" style="width:100%;height:400px; ">
     </div>
     <input type="hidden" id="points" name="points">
       </div>
    <button type="submit" class="btn btn-shadow btn-primary font-weight-bold mt-5">
       
       إضافة
       
       
       <span class="svg-icon svg-icon m-0 svg-icon-md">
			<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<polygon points="0 0 24 0 24 24 0 24"></polygon>
					<path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)"></path>
					<path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)"></path>
				</g>
			</svg>
			<!--end::Svg Icon-->
		</span>
       
       
       
    </button>
       
   </div>
  
   
  
 </form>
 <!--end::Form-->
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true&libraries=drawing,geometry">
</script>

<script>
    var coordinates = [];
    var all_shapes = [];

    var selectedShape;
    var selectedArea;
    var ehaab;
</script>


<script>
    var coordinates = [];
    var all_shapes = [];

    var selectedShape;
    var selectedArea;
    var ehaab;
</script>

<script>
    function draw_shape() {
        var areas = <?php
                              echo $country;
                                        
                            ?>
        // for (var j = 0; j < areas.length; j++) {
             var latlngs = areas.text;
           const latlngsObj = JSON.parse(latlngs);
            const bermudaTriangle = new google.maps.Polygon({
                paths: latlngsObj,
                strokeColor: "#FF0000",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#FF0000",
                fillOpacity: 0.35,
                area: areas
            });
            google.maps.event.addListener(bermudaTriangle, 'click', function() {
                var area = this.area;
                setSavedAreaSelectionSelection(area, this);
            });
            bermudaTriangle.setMap(map);
        // }
    }
</script>

<script>
    function clearSelection() {
        if (selectedShape) {
            selectedShape.setEditable(false);
            selectedShape = null;
        }
        if (selectedArea) {
            selectedArea = null;
        }
    }

    function setSelection(shape) {

        clearSelection();
        selectedShape = shape;
        shape.setEditable(true);
    }

    function setSavedAreaSelectionSelection(area, shape) {
        clearSelection();
        selectedShape = shape;
        selectedArea = area;
        shape.setEditable(true);
    }

    function deleteSelectedShape() {
        if (selectedShape) {
            selectedShape.setMap(null);
        }
        if (selectedArea) {

            $.ajax({
                type: "GET",
                url: "{{url('ciadmin/Area/delete')}}" + "/" + selectedArea.id,
                contentType: "application/json; charset=utf-8",
                dataType: "Json",
                success: function(result) {
                    if (result == "true") {
                        // $('#exampleModalDele' + id).modal('hide');
                        $('#delete' + id).remove();
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'تم الحذف ',
                            showConfirmButton: false,
                            timer: 2000
                        })

                    }
                }
            });
        }
        clearSelection();
    }
</script>

<script>
    function save_coordinates_to_array(newShapeArg) {
        var polygonBounds = newShapeArg.getPath();

        for (var i = 0; i < polygonBounds.length; i++) {
            var point = polygonBounds.getAt(i);
            var item = {
                "lat": point.lat(),
                "lng": point.lng()
            };
            coordinates.push(item);
        }
        var fPoint = polygonBounds.getAt(0);
        var item = {
            "lat": fPoint.lat(),
            "lng": fPoint.lng()
        };
        console.log("SAsa");
        coordinates.push(fPoint);
        //alert('points '+JSON.stringify(coordinates));
        var points = JSON.stringify(coordinates);
        $("#points").val(points);
        var waiting = document.getElementById("waiting").value;
        var Kilometercost = document.getElementById("Kilometercost").value;
        var countcounter = document.getElementById("countcounter").value;
        var placename = document.getElementById("placename").value;
        var percentdelivery = document.getElementById("percentdelivery").value;

        // $.ajax({
        //     type: "GET",
        //     url: "{{url('ciadmin/maps/store')}}",
        //     contentType: "application/json; charset=utf-8",
        //     dataType: "Json",
        //     data: {
        //         points: points,
        //         waiting: waiting,
        //         Kilometercost: Kilometercost,
        //         countcounter: countcounter,
        //         placename: placename,
        //         percentdelivery: percentdelivery,
        //     },
        //     success: function(result) {

        //         if (result == 1) {
        //             Swal.fire({
        //                 position: 'top-start',
        //                 icon: 'success',
        //                 title: 'تم الاضافه ',
        //                 showConfirmButton: false,
        //                 timer: 2000
        //             })

        //         } else {
        //             Swal.fire({
        //                 position: 'top-start',
        //                 icon: 'success',
        //                 title: '  تمت الاضافه من قبل ',
        //                 showConfirmButton: false,
        //                 timer: 2000
        //             })
        //         }
        //         setTimeout(function() { // wait for 5 secs(2)
        //             location.reload(); // then reload the page.(3)
        //         });
        //     }
        // });

    }
</script>

<script>
    var map;
    var id = 0;
    var newShape;

    function initialize() {

        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: new google.maps.LatLng(30.033333, 31.233334)
        });

        draw_shape();

        // Create the DIV to hold the control and call the CustomControl() constructor passing in this DIV.
        var saveControlDiv = document.createElement('div');
        var saveControl = new SaveControl(saveControlDiv, map);
        saveControlDiv.index = 1;
        map.controls[google.maps.ControlPosition.BOTTOM_LEFT].push(saveControlDiv);
        // Create the DIV to hold the control and call the CustomControl() constructor passing in this DIV.
        var deleteControlDiv = document.createElement('div');
        var deleteControl = new DeleteControl(deleteControlDiv, map);
        deleteControlDiv.index = 1;
        map.controls[google.maps.ControlPosition.BOTTOM_LEFT].push(deleteControlDiv);

        var drawingManager = new google.maps.drawing.DrawingManager();
        drawingManager.setOptions({
            drawingControlOptions: {
                position: google.maps.ControlPosition.BOTTOM_LEFT,
                drawingModes: ['polygon', 'marker']
            },
            polygonOptions: {
                fillColor: "#ffffff",
                strokeColor: "#FFA500",
                fillOpacity: .3,
                strokeWeight: 3
            }
        });

        drawingManager.setMap(map);

        google.maps.event.addListener(drawingManager, 'overlaycomplete', function(e) {
            
            if (e.type == "marker") {
                alert(e.overlay.getPosition());
            } else {
             

                newShape = e.overlay;
                newShape.type = e.type;

                google.maps.event.addListener(newShape, 'click', function() {
                    setSelection(this);
                });
                setSelection(newShape);
           
                var polygonBounds = newShape.getPath();

for (var i = 0; i < polygonBounds.length; i++) {
    var point = polygonBounds.getAt(i);
    var item = {
        "lat": point.lat(),
        "lng": point.lng()
    };
    coordinates.push(item);
}
var fPoint = polygonBounds.getAt(0);
var item = {
    "lat": fPoint.lat(),
    "lng": fPoint.lng()
};
console.log("SAsa");
coordinates.push(fPoint);
//alert('points '+JSON.stringify(coordinates));
var points = JSON.stringify(coordinates);
$("#points").val(points);
            }
        });

        google.maps.event.addListener(map, 'click', function(e) {
            clearSelection();
        });



    }

    function DeleteControl(controlDiv, map) {

        // Set CSS for the control border
        var controlUI = document.createElement('div');
        controlUI.style.backgroundColor = '#ffffff';
        controlUI.style.borderStyle = 'solid';
        controlUI.style.borderWidth = '1px';
        controlUI.style.borderColor = '#ccc';
        controlUI.style.height = '24px';
        controlUI.style.marginBottom = '5px';
        controlUI.style.cursor = 'pointer';
        controlUI.style.paddingTop = '3px';
        controlUI.style.textAlign = 'center';
        controlUI.title = 'Delete area';
        controlDiv.appendChild(controlUI);

        // Set CSS for the control interior
        var controlText = document.createElement('div');
        controlText.style.fontFamily = 'Arial,sans-serif';
        controlText.style.fontSize = '10px';
        controlText.style.paddingLeft = '4px';
        controlText.style.paddingRight = '4px';
        controlText.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg>';
        controlUI.appendChild(controlText);

        // Setup the click event listeners
        google.maps.event.addDomListener(controlUI, 'click', function() {

            if (selectedShape) {
                deleteSelectedShape();
            } else {
                alert("Select area first")
            }
        });
    }

    function SaveControl(controlDiv, map) {

        // Set CSS for the control border
        var controlUI = document.createElement('div');
        controlUI.style.backgroundColor = '#ffffff';
        controlUI.style.borderStyle = 'solid';
        controlUI.style.borderWidth = '1px';
        controlUI.style.borderColor = '#ccc';
        controlUI.style.height = '24px';
        controlUI.style.marginBottom = '5px';
        controlUI.style.marginLeft = '-5px';
        controlUI.style.paddingTop = '3px';
        controlUI.style.cursor = 'pointer';
        controlUI.style.textAlign = 'center';
        controlUI.title = 'Save area';
        controlDiv.appendChild(controlUI);

        // Set CSS for the control interior
        var controlText = document.createElement('div');
        controlText.style.fontFamily = 'Arial,sans-serif';
        controlText.style.fontSize = '10px';
        controlText.style.paddingLeft = '4px';
        controlText.style.paddingRight = '4px';
        controlText.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16"><path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/></svg>';
        controlUI.appendChild(controlText);

        // Setup the click event listeners
        google.maps.event.addDomListener(controlUI, 'click', function() {

            if (selectedShape) {
            
            } else {
                alert("Select area first")
            }
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);

    function submitFunction() {

        save_coordinates_to_array(newShape);

    }
    </script>
<script>
function getstates(selected){
let id = selected.value;
console.log(id);
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `../getstates/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        if(result.status == true){
       $('#state').empty();
       $('#state').append(result.data);
       $('select#state').selectpicker("refresh");
       console.log(result);
     }
       }

      });
    }

</script>
@endsection