@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
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
                
                $("#salidastock").modal(); 
                var id_plaza = event.feature.getProperty('id');  //CON ESTO OBTENEMOS CUALQUIER VALOR(Obtendria el ID aca)
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
            
            var infowindow =  new google.maps.InfoWindow({
                content: 'Hello World!',
                map: map
            });

            map.data.addListener('mouseover', function() {
                infowindow.open(map, this);
            });

            // assuming you also want to hide the infowindow when user mouses-out
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
        });

       /* $('#click').click(function() {
            
            $("#focus").focus();
        });*/
        
        /*$('.edit').click(function(){
            $('#editar').modal();

            //tomo las variables y las paso al modal edit
            var unidad = $(this).data('selectunidad');
            var rubro = $(this).data('selectrubro');
            var subrubro = $(this).data('selectsubrubro');
            var desc = $(this).data('desc');
            var id = $(this).attr('value');
            var estado = $(this).data('estado');

             $("#selectsubrubroedit").prop("readonly", true); //desabilitar subrubro hasta que se elija rubro **CORREJIR** Si lo desabilito que seria lo corecto, el usuario vera toda la lista de subrubros.

            $('#selectrubroedit').on("select2:select", function(e) { //si elijo un rubro...
                
                idrubro = $("#selectrubroedit").val(); //tomar id

                $("#selectsubrubroedit").select2().empty(); // vaciar select subrubros

                $.getJSON("/ajax/subrubros/" + idrubro, function (json) { //completar select subrubros con la query que responda al id del rubro
                  $("#selectsubrubroedit").select2({
                        data: json,
                        language: "es",

                    });
                });

                $("#selectsubrubroedit").prop("readonly", false); // habilitar subrubro una vez que se eligio rubro
            });
        
            //Modificar atributos con el item seleccionado

            $("#descedit").val( desc ).trigger("change");
            $("#selectunidadedit").val( unidad ).trigger("change");
            $("#selectrubroedit").val( rubro ).trigger("change");
            $("#selectsubrubroedit").val( subrubro ).trigger("change");
            $("input[name='id_articulo']").val(id);
            if (estado == 0)
            {
               $("#estado").val(false); 
               $('#estado').prop('checked', false);
            }
            else
            {
                $("#estado").val(true);
                $('#estado').prop('checked', true);
            }
        });   */
        });
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXlWuFRd_KKz9jNwJeXZC7uxoNnF-sS2E&callback=initMap"> </script>
@endsection
