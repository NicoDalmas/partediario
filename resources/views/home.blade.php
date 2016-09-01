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

    <div class="panel panel-primary">
        <div class="panel-heading">ESPACIOS PUBLICOS DE LA CIUDAD</div>
        <div class="panel-body">
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
        </div>
    </div>

					
	<div class="panel panel-success">
		<div class="panel-heading">MAPA INTERACTIVO</div>
		<div class="panel-body" id="contenedormap">
			
		    <div id="map" style="width: auto; height: 500px; margin: 0 auto;"></div>

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
            map.data.addListener('click', function(event) {
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

        function initTable(id_plaza)
        {
            $("#tabla-detalles-"+id_plaza).DataTable({
                "processing": true,
                "serverSide": true,
                "destroy": true,
                "ajax": "/datatables/detallestrabajos/"+id_plaza,
                "error": function () {
                    alert("Custom error");
                },
                "columns":[
                    {
                        className:"details-control",
                        orderable: false,
                        searchable: false,
                        data: null,
                        defaultContent: ""
                    },
                    {data: 'fecha', name: 'trabajos_master.fecha'},
                    {data: 'descripcion', name: 'trabajos_master.descripcion'},
                    {data: 'name', name: 'users.name'},
                    {data: 'imagenes', name: 'trabajos_master.imagenes'},
                    {data: 'id_master', name: 'trabajos_master.id_master', visible: false}
                ],
                "order": [ 0, "desc" ],
                "language":{
                    url: "{!! asset('/plugins/datatables/lenguajes/spanish.json') !!}"
                }
            });
        }

        function format(callback, $id_master) {
            $.ajax({
                url: "/ajax/detallestrabajos/" + $id_master,
                dataType: "json",
                beforeSend: function(){
                    callback($('<div align="center">Cargando...</div>')).show();
                },
                complete: function (response) {
                    var data = JSON.parse(response.responseText);   
                    var thead = '',  tbody = '';
                    thead += '<th>#</th>';
                    thead += '<th>Mobiliario</th>'; 
                    thead += '<th>Trabajos realizados</th>'; 
                    thead += '<th>Cuadrilla</th>'; 

                    count = 1;
                    $.each(data, function (i, d) {
                        tbody += '<tr><td>'+ count +'</td><td>' + d.mobiliario + '</td><td>' + d.tipo_trabajos + '</td><td>'+ d.cuadrilla + '</td></tr>';
                        count++;
                    });
                    callback($('<table class="table table-hover">' + thead + tbody + '</table>')).show();
                },
                error: function () {
                    callback($('<div align="center">Ha ocurrido un error. Intente nuevamente y si persigue el error, contactese con informática.</div>')).show();
                }
            });
        }
       
        //Cerrar modal salidas de stock
        $(".close").click(function() {
            $('#informacionplazas').modal('hide');
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

                $("#informacionplazas").modal(); 
                var id_plaza = $(this).data("id");
                $(".cambiartablaid").attr('id', "tabla-detalles-"+id_plaza);
                initTable(id_plaza);

                $("#tabla-detalles-"+id_plaza).on("click", "td.details-control", function () {
                    var tr = $(this).closest('tr');
                    var row = $("#tabla-detalles-"+id_plaza).DataTable().row(tr);
                    var id_master = row.data().id_master;
                    if (row.child.isShown()) {
                        row.child.hide();
                        tr.removeClass('shown');
                    } else {
                        format(row.child, id_master);
                        tr.addClass('shown');
                    }
                });

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
