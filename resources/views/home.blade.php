@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Mapa</div>

					<div class="panel-body">
						
					 <div id="map" style="width: auto; height: 500px; margin: 0 auto;"></div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="infowindows"></div>

	 <script>
		function initMap() {
		  var map = new google.maps.Map(document.getElementById('map'), {
		    center: {lat: -32.9497106, lng: -60.6473459},
		    zoom: 12
		  });

		    map.data.loadGeoJson('/js/mapa.json');



		  var drawingManager = new google.maps.drawing.DrawingManager({
		    drawingMode: google.maps.drawing.OverlayType.MARKER,
		    drawingControl: true,
		    drawingControlOptions: {
		      position: google.maps.ControlPosition.TOP_CENTER,
		      drawingModes: [
		        google.maps.drawing.OverlayType.MARKER,
		        google.maps.drawing.OverlayType.CIRCLE,
		        google.maps.drawing.OverlayType.POLYGON,
		        google.maps.drawing.OverlayType.POLYLINE,
		        google.maps.drawing.OverlayType.RECTANGLE
		      ]
		    },
		    markerOptions: {icon: 'images/beachflag.png'},
		    circleOptions: {
		      fillColor: '#ffff00',
		      fillOpacity: 1,
		      strokeWeight: 5,
		      clickable: false,
		      editable: true,
		      zIndex: 1
		    }
		  });
		  drawingManager.setMap(map);
		}
    </script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXlWuFRd_KKz9jNwJeXZC7uxoNnF-sS2E&signed_in=true&libraries=drawing&callback=initMap" async defer></script>
@endsection
