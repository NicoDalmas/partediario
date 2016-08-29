@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

    <!-- Mensajes de error-->
    
    @if($errors->has())
        <div class="alert alert-warning" role="alert">
           @foreach ($errors->all() as $error)
              <div>{{ $error }}</div>
          @endforeach
        </div>
     @endif

    <!-- Mensajes de exito-->

    @if (session('status'))
        <div class="alert alert-success" id="ocultar">
            {{ session('status') }}
        </div>
    @endif

	<!-- Datatables Salidas Master -->
    <div class="box tabla-articulos">
        <div class="box-body no-padding">
            <table id="tabla-movimientos" class="table table-striped table-bordered"  cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre de la plaza</th>
                        <th>Distrito</th>
                        <th>Direccion</th>
                        <th>Observaciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
					
	<div class="container spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Mapa</div>

					<div class="panel-body" id="contenedormap">
						
					 <div id="map" style="width: auto; height: 500px; margin: 0 auto;"></div>

					</div>
				</div>
			</div>
		</div>
	</div>

    <!-- Incluir Formulario -->
    @include('modals.detallesplaza')
    
	<script>
        var map;
        

		function initMap() {
		    map = new google.maps.Map(document.getElementById('map'), {
		    center: {lat: -32.9497106, lng: -60.6473459},
		    zoom: 12
		  });
           
		    map.data.loadGeoJson('/ajax/geoplazas');

           /* map.data.setStyle({
               icon: 'img/icono-plaza.png',  //CAMBIAR ICONO
            });*/   

		    map.data.addListener('click', function(event) {
                
			});
            
            // global infowindow
            var infowindow = new google.maps.InfoWindow();

            // When the user clicks, open an infowindow
            map.data.addListener('mouseover', function(event) {
                var myHTML = event.feature.getProperty("name")+" ("+event.feature.getProperty("codigo")+")";
                infowindow.setContent("<div style='width:150px; text-align: center;'>"+myHTML+"</div>");
                infowindow.setPosition(event.feature.getGeometry().get());
                infowindow.setOptions({pixelOffset: new google.maps.Size(0,-30)});
                setTimeout(function() { infowindow.open(map) }, 400);
            });  

            map.data.addListener('mouseout', function() {
                infowindow.close();
            });

		}

        function newLocation(newLat,newLng)
        {
            map.setCenter({
                lat : newLat,
                lng : newLng
            });
            map.setZoom(18);
        }
     
        $( document ).ready(function() {

        //Errores y mensajes desaparecen.

        $("#ocultar").fadeTo(8000, 500).slideUp(500, function(){
            $("ocultar").alert('close');
        });

        //Datatables

        $("#tabla-movimientos").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "/datatables/relevamiento",
            "error": function () {
                alert("Custom error");
            },
            "columns":[
                {data: 'codigo', name: 'codigo'},
                {data: 'nombre', name: 'nombre'},
                {data: 'distrito', name: 'distrito'},
                {data: 'direccion', name: 'direccion'},
                {data: 'observaciones', name: 'observaciones'},
                {data: 'action', name: 'action' , orderable: false, searchable: false},
                {data: 'latitud', name: 'latitud', visible: false},
                {data: 'longitud', name: 'longitud', visible: false},
                {data: 'id_plaza', name: 'id_plaza', visible: false},
            ],
            "order": [ 1, "asc" ],
            "language":{
                url: "{!! asset('/plugins/datatables/lenguajes/spanish.json') !!}"
            }
        });

        var table = $("#tabla-movimientos").DataTable();

        //Cerrar modal salidas de stock
        $(".close").click(function() {
            $('#salidastock').modal('hide');
        });

        

        $('#tabla-movimientos').on('draw.dt', function () {
            $('.geolocalizar').click(function() {

                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var latitud = parseFloat(row.data().latitud);
                var longitud = parseFloat(row.data().longitud);



                if( isNaN(longitud) || isNaN(latitud) )
                {
                    alert("No esta georeferenciado")
                }
                else
                {   
                    newLocation(latitud,longitud);
                    $("html, body").animate({ scrollTop: $(document).height() }, "slow");
                    return false;
                }
            });
            $(".info").click(function(){
                $("#salidastock").modal(); 
                var id_plaza = $(this).data("id");
                console.log(id_plaza);
                $.getJSON("/ajax/viewplaza/" + id_plaza, function (json) { //para modal edit y add
                   
                   $.each(json, function(index, element) {

                           jQuery.each(element, function( index, element) {
                                $("#"+index).removeClass();
                                $("#"+index).text(element);
                                if(element == "MUY BUENO" || element == "MUY BUENA")
                                {
                                    $("#"+index).addClass("labelverdeosc");
                                }
                                else if(element == "NO PRESENTA")
                                {
                                    $("#"+index).addClass("labelgris");
                                }
                                else if(element == "BUENA" || element == "BUENO" || element == "BUEN ESTADO")
                                {
                                    $("#"+index).addClass("labelverde");

                                }
                                else if(element == "REGULAR")
                                {
                                    $("#"+index).addClass("labelnaranja");

                                }
                                else if(element == "MAL")
                                {
                                    $("#"+index).addClass("labelrojo");

                                }
                                else if(element == "MAL ESTADO")
                                {
                                    $("#"+index).addClass("labelrojo");

                                }
                                else if(element == "")
                                {
                                    $("#"+index).text("NO PRESENTA");
                                    $("#"+index).addClass("labelgris");
                                }
                                else
                                {
                                    $("#"+index).addClass("otros");
                                }                         
                            });
                    });
                });
                $.getJSON("/ajax/mobiliario/" + id_plaza, function (json) { //para modal edit y add
                   $.each(json, function(index, element) {
                           jQuery.each(element, function( index, element) {
                                $("#"+index).text(element);

                                if(element == "")
                                {
                                    return "0";
                                }
                            });
                    });
                });
            });
        });
    });
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXlWuFRd_KKz9jNwJeXZC7uxoNnF-sS2E&callback=initMap"> </script>
@endsection
