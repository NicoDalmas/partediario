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
                    	<th></th>
                        <th>ID Plaza</th>
                        <th>Nombre de la plaza</th>
                        <th>Distrito</th>
                        <th>Fecha de relevamiento</th>
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

					<div class="panel-body">
						
					 <div id="map" style="width: auto; height: 500px; margin: 0 auto;"></div>

					</div>
				</div>
			</div>
		</div>
	</div>

    <!-- Incluir Formulario -->
    @include('modals.detallesplaza')

	 <script>
		function initMap() {
		  var map = new google.maps.Map(document.getElementById('map'), {
		    center: {lat: -32.9497106, lng: -60.6473459},
		    zoom: 12
		  });

		    map.data.loadGeoJson('/js/mapa.json');

		    map.data.addListener('click', function(event) {
			    $("#salidastock").modal();  //CON ESTO OBTENEMOS CUALQUIER VALOR(Obtendria el ID aca)
                var id_geometria = event.feature.getProperty('id');

               $.getJSON("/ajax/viewplaza/" + id_geometria, function (json) { //para modal edit y add
    
                   $.each(json, function(index, element) {
                            
                            var array = ["limpieza", "jardineria", "arbolado", "juegos", "bebederos", "estaciones_aerobicas", "bicicleteros", "cercos", "riego", "carteleria", "mobiliario", "mastil", "arenero", "caminos", "veredas", "luminarias", "esculturas", "playon", "cestos", "observaciones"];

                            $('#limpieza').text(element.limpieza);
                            $('#jardineria').text(element.jardineria);
                            $('#arbolado').text(element.arbolado);
                            $('#juegos').text(element.juegos);
                            $('#bebederos').text(element.bebederos);
                            $('#aerobicas').text(element.estaciones_aerobicas);
                            $('#bicicleteros').text(element.bicicleteros);
                            $('#cercos').text(element.cercos);
                            $('#riego').text(element.riego);
                            $('#carteleria').text(element.carteleria);
                            $('#mobiliario').text(element.mobiliario);
                            $('#mastil').text(element.mastil);
                            $('#arenero').text(element.arenero);
                            $('#caminos').text(element.caminos);
                            $('#veredas').text(element.veredas);
                            $('#luminarias').text(element.luminarias);
                            $('#esculturas').text(element.esculturas);
                            $('#playon').text(element.playon);
                            $('#cestos').text(element.cestos);
                            $('#observaciones').text(element.observaciones);

                            jQuery.each( array, function( i, val ) {

                                text = element.+val;

                               if (text == "MUY BUENO")
                               {

                               }
                             
                            
                            });
                    });
                });

			});
		}

        $("#tabla-movimientos").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "/datatables/relevamiento",
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
                {data: 'id_plaza', name: 'id_plaza'},
                {data: 'plaza', name: 'plaza'},
                {data: 'distrito', name: 'distrito'},
                {data: 'relevado', name: 'relevado'},
                {data: 'action', name: 'action' , orderable: false, searchable: false},
            ],
            "order": [ 1, "desc" ],
            "language":{
                url: "{!! asset('/plugins/datatables/lenguajes/spanish.json') !!}"
            }
        });

        //Cerrar modal salidas de stock
        $(".close").click(function() {
            $('#salidastock').modal('hide');
        });

        $('#tabla-movimientos').on('draw.dt', function () {
            $('.geolocalizar').click(function() {
                console.log("hoola");
            });
        });

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

    </script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXlWuFRd_KKz9jNwJeXZC7uxoNnF-sS2E&signed_in=true&libraries=drawing&callback=initMap" async defer></script>
@endsection
