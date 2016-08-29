@extends('layouts.app')

@section('htmlheader_title')
	Cargar Trabajos
@endsection

@section ('contentheader_title') 
    <div class="titulo_header">
        CARGAR TRABAJOS EN PLAZA
    </div>
@stop

@section('main-content')
	<div class="container-fluid">
		<div class="panel panel-default">
			<div class="panel-heading">Cargar trabajo en {!! $plaza->nombre !!} - Codigo de plaza {!! $plaza->codigo !!}</div>

			<div class="panel-body">

				{!! Form::open(['url' => route('store-trabajo'), 'class' => 'form-horizontal']) !!}

   				<div class="panel panel-primary">
   				<div class="panel-heading">CARGAR TRABAJOS REALIZADOS EN LA PLAZA</div>
   				<div class="panel-body">
	       			<div class="form-group">
						{!! Form::label(null, 'Mobiliario:', array('class' => 'control-label col-sm-2')) !!}
						<div class="col-sm-8">
							{!! Form::select('mobiliario', array('Bebederos' => 'Bebederos', 'Juegos' => 'Juegos', 'Bancos' => 'Bancos', 'Cesto' => 'Cestos', 'Estaciones Aerobicas' => 'Estaciones Aerobicas'), null ,array('class'=>'form-control', 'style' => 'width: 100%', 'id' => 'mobiliario', 'placeholder' => 'Seleccione el mobiliario...')) 
	                        !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label(null, 'Tipo de trabajo:', array('class' => 'control-label col-sm-2')) !!}
						<div class="col-sm-8">

							<div class="col-md-6">
								{!! Form::checkbox('tipos', 'Pintura') !!}
		                        <label>Pintura</label><br>

		                        {!! Form::checkbox('tipos', 'Reparación') !!}
		                        <label>Reparación</label><br>

		                        {!! Form::checkbox('tipos', 'Herreria') !!}
		                        <label>Herreria</label><br>
	                        </div>

	                        <div class="col-md-6">
		                        {!! Form::checkbox('tipos', 'Instalación') !!}
		                        <label>Instalación</label><br>

		                        {!! Form::checkbox('tipos', 'Traslado') !!}
		                        <label>Traslado</label><br>

		                        {!! Form::checkbox('tipos', 'Extracción') !!}
		                        <label>Extracción</label>
	                        </div>


						</div>
					</div>
					<div class="form-group">
						{!! Form::label(null, 'Cuadrilla asignada:', array('class' => 'control-label col-sm-2')) !!}
						<div class="col-sm-8">
							{!! Form::select('cuadrilla', array('Cuadrilla de Portillo' => 'Cuadrilla de Portillo', 'Cuadrilla de Chichin' => 'Cuadrilla de Chichin'), null ,array('class'=>' form-control', 'style' => 'width: 100%', 'id' => 'cuadrilla', 'placeholder' => 'Seleccione la cuadrilla interviniente...')) 
					        !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label(null, 'Descripcion:', array('class' => 'control-label col-sm-2')) !!}
						<div class="col-sm-8">
							<textarea name="descripcion" class="form-control" rows="4" cols="50" maxlength="200" id="descripcion" placeholder="Describa el trabajo realizado."></textarea>
						</div>	
					</div>
					

					
				</div>
				<div class="panel-footer">
					<div class="form-group">
						{!! Form::button('+ Cargar trabajo', array('class' => 'btn btn-primary', 'id' => 'agregar', 'style' => ' margin-left: 15px;')) !!}
					</div>
				</div>
				</div>

				<div class="panel panel-success">
	   				<div class="panel-heading">REGISTRAR TRABAJOS Y ADJUNTAR IMAGENES.</div>
	   				<div class="panel-body">
						<div class="form-group">
							<!-- DATATABLE ARTICULOS-->
							<div class="box tabla-articulos">
					            <div class="box-body no-padding">
					                <table id="tabla-cargartrabajo" class="table table-striped table-bordered"  cellspacing="0" width="100%">
					                    <thead>
					                        <tr>
					                            <th>Mobiliario</th>
					                            <th>Tipos de trabajo</th>
					                            <th>Cuadrilla</th>
					                            <th>Descripción</th>
					                            <th></th>
					                        </tr>
					                    </thead>
					                </table>
					   			</div>
							</div>
						</div>

						<div class="form-group">
								<span class="label label-success" id="photocounter" style="font-size: 15px;"></span>
					            <div class="bordedropzone">
					               <div id="myDropZone" class="dropzone"></div>
					            </div>
						</div>

						<div id="fotosinput"></div>

					</div>
					<div class="panel-footer">
						{{ Form::hidden('usuario', Auth::user()->id) }}
						{{ Form::hidden('csrf-token', csrf_token(), ['id' => 'csrf-token']) }}
						{{ Form::hidden('contadorhidden', null, ['id' => 'contadorhidden']) }}

						{{ Form::submit('Finalizar', ['class'=>'btn btn-success'])}}
						
					</div>

				{{ Form:: close() }}
				

			</div>
		</div>
	</div>
	<script>
	$(document).ready( function () {
		//Datatable para cargar los diferentes trabajos
        $("#tabla-cargartrabajo").DataTable({
            language: {
                url: "{!! asset('/plugins/datatables/lenguajes/spanish.json') !!}"
            },
            "paging":   false,
            "bFilter": false,
            "ordering": false
        });

        //CONFIGURACION DROPZONE
        Dropzone.autoDiscover = false;
        var photo_counter = 0;
        $("div#myDropZone").dropzone({
		    url : "/cargartrabajo/imagenes/upload",
		    autoProcessQueue: true,
  			maxFiles: 10,
		    maxFilesize: 8,
		    addRemoveLinks: true,
		    dictDefaultMessage: 'Arrastre y suelte las fotos aquí.',
		    dictRemoveFile: 'Eliminar',
			dictFileTooBig: 'Image is bigger than 8MB',
			headers: {
			    'X-CSRF-Token': $('#csrf-token').val()
			},

			// The setting up of the dropzone
		    init:function() {

			    // First change the button to actually tell Dropzone to process the queue.
			    var myDropzone = this;

		        this.on("removedfile", function(file) {

		            $.ajax({
		                type: 'POST',
		                url: '/cargartrabajo/imagenes/delete',
		                data: {id: file.name, _token: $('#csrf-token').val()},
		                dataType: 'html',
		                success: function(data){
		                    var rep = JSON.parse(data);
		                    if(rep.code == 200)
		                    {
		                        photo_counter--;
		                        $("#photocounter").text( "Imagenes cargadas: (" + photo_counter + ")");
		                        $("#contadorhidden").val(photo_counter);
		                        $("input[value='"+rep.id+"']").remove();
		                    }

		                }

		            });
		        } );
		    },
		    error: function(file, response) {
		        if($.type(response) === "string")
		            var message = response; //dropzone sends it's own error messages in string
		        else
		            var message = response.message;
		        file.previewElement.classList.add("dz-error");
		        _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
		        _results = [];
		        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
		            node = _ref[_i];
		            _results.push(node.textContent = message);
		        }
		        return _results;
		    },
		    success: function(file,done) {
		        photo_counter++;
		        $("#photocounter").text( "Imagenes cargadas: (" + photo_counter + ")");
		        $("#contadorhidden").val(photo_counter);
		        console.log(done.id);
		        $("#fotosinput").append($("<input type='hidden' name='fotos[]' value='" + done.id + "'>"));
		    }
		});

		//Eliminar articulos ingresados en la datatable
	    $("#tabla-cargartrabajo tbody").on( "click", ".delete", function () {
	        $("#tabla-cargartrabajo").DataTable()
	            .row( $(this).parents("tr") )
	            .remove()
	            .draw();
	    });

        $("#agregar").on( 'click', function () {
          
       		var tipos = $("input[name='tipos']:checked").map(function() {return this.value;}).get().join(', ')
            var mobiliario = $("#mobiliario").val();
            var cuadrilla = $("#cuadrilla").val();
            var descripcion = $("#descripcion").val();

       		//Validaciones antes de agregar articulos a la tabla
            if(tipos.length != 0 && mobiliario.length != 0 && cuadrilla.length != 0 && descripcion.length != 0)
            {
	            $("#tabla-cargartrabajo").DataTable().row.add( [
	                mobiliario+"<input type='hidden' name='mobiliario[]' value='"+mobiliario+"'>",
	                tipos+"<input type='hidden' name='tipos[]' value='"+tipos+"'>",
	                cuadrilla+"<input type='hidden' name='cuadrilla[]' value='"+cuadrilla+"'>",
	                descripcion+"<input type='hidden' name='descripcion[]' value='"+descripcion+"'>",
	                "<a class='btn botrojo btn-xs' href='#'><i class='glyphicon glyphicon-trash delete'></i></a>"
	            ] ).draw( false );
	            $("#mobiliario").val("");
	            $("input:checkbox").prop('checked', false);
	            $("#cuadrilla").val("");
	            $("#descripcion").val("");
	            $("#mobiliario").focus();
            }
            else{
                alert("Todos los campos son requeridos.")
            }   
        });

    });
	</script>
@endsection
