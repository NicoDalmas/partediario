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
			<div class="panel-heading">Cargar trabajo en plaza</div>

			<div class="panel-body">

				{!! Form::open(['url' => route('upload-post'), 'class' => 'form-horizontal', 'id'=>'real-dropzone', 'enctype' => 'multipart/form-data', 'file' => 'true']) !!}

				<!--@if($errors->has())
		            <div class="alert alert-warning" role="alert">
		               @foreach ($errors->all() as $error)
		                  <div>{{ $error }}</div>
		              @endforeach
		            </div>
       			 @endif -->

   			<div class="col-md-6">
       			<div class="form-group">
					{!! Form::label(null, 'Mobiliario:', array('class' => 'control-label col-sm-4')) !!}
					<div class="col-sm-8">
						{!! Form::select('mobiliario', array('Bebederos' => 'Bebederos', 'Juegos' => 'Juegos', 'Bancos' => 'Bancos', 'Cesto' => 'Cestos', 'Estaciones Aerobicas' => 'Estaciones Aerobicas'), null ,array('class'=>'form-control', 'style' => 'width: 100%', 'required' => 'required', 'id' => 'mobiliario', 'placeholder' => 'Seleccione el mobiliario...')) 
                        !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label(null, 'Tipo de trabajo:', array('class' => 'control-label col-sm-4')) !!}
					<div class="col-sm-8">
						{!! Form::checkbox('tipos[]', 'Pintura') !!}
                        <label>Pintura</label><br>

                        {!! Form::checkbox('tipos[]', 'Reparación') !!}
                        <label>Reparación</label><br>

                        {!! Form::checkbox('tipos[]', 'Herreria') !!}
                        <label>Herreria</label><br>

                        {!! Form::checkbox('tipos[]', 'Instalación') !!}
                        <label>Instalación</label><br>

                        {!! Form::checkbox('tipos[]', 'Traslado') !!}
                        <label>Traslado</label><br>

                        {!! Form::checkbox('tipos[]', 'Extracción') !!}
                        <label>Extracción</label>

					</div>
				</div>
				<div class="form-group">
					{!! Form::label(null, 'Cuadrilla asignada:', array('class' => 'control-label col-sm-4')) !!}
					<div class="col-sm-8">
						{!! Form::select('cuadrilla', array('Cuadrilla de Portillo' => 'Cuadrilla de Portillo', 'Cuadrilla de Chichin' => 'Cuadrilla de Chichin'), null ,array('class'=>' form-control', 'style' => 'width: 100%', 'id' => 'cuadrilla', 'placeholder' => 'Seleccione la cuadrilla interviniente...')) 
				        !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label(null, 'Descripcion:', array('class' => 'control-label col-sm-4')) !!}
					<div class="col-sm-8">
						<textarea name="descripcion" class="form-control" rows="4" cols="50" maxlength="200" id="descripcion" placeholder="Describa el trabajo realizado."></textarea>
					</div>	
				</div>
				<div class="form-group">
					<div class="col-sm-8">
					{!! Form::button('Agregar Trabajo', array('class' => 'btn btn-primary', 'id' => 'agregar')) !!}
					</div>
				</div>

			</div>
			<div class="col-md-6">
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
			                            <th>a</th>
			                        </tr>
			                    </thead>
			                </table>
			   			</div>
					</div>
				</div>

				<div class="form-group">
		            <div>
		               <div id="myDropZone" class="dropzone"></div>
		            </div>
				</div>
				{{ Form::hidden('csrf-token', csrf_token(), ['id' => 'csrf-token']) }}
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
		                        $("#photoCounter").text( "(" + photo_counter + ")");
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
		        $("#photoCounter").text( "(" + photo_counter + ")");
		    }
		});

		var contador = 1;
        $("#agregar").on( 'click', function () {
            

			var tipos = $("input[name='tipos[]']:checked").map(function() {return this.value;}).get().join(', ')
            var mobiliario = $("#mobiliario").val();
            var cuadrilla = $("#cuadrilla").val();
            var descripcion = $("#descripcion").val();

            $("#tabla-cargartrabajo").DataTable().row.add( [
                mobiliario+"<input type='hidden' name='mobiliario[]' value='"+mobiliario+"'>",
                tipos+"<input type='hidden' name='tipos[]' value='"+tipos+"'>",
                cuadrilla+"<input type='hidden' name='cuadrilla[]' value='"+cuadrilla+"'>",
                descripcion+"<input type='hidden' name='descripcion[]' value='"+descripcion+"'>",
                "<a class='btn botrojo btn-xs' href='#'><i class='glyphicon glyphicon-trash delete'></i></a>"
            ] ).draw( false );

             //Eliminar articulos ingresados en la datatable
		    $("#tabla-cargartrabajo tbody").on( "click", ".delete", function () {
		        $("#tabla-cargartrabajo").DataTable()
		            .row( $(this).parents("tr") )
		            .remove()
		            .draw();
		    });

            $("#mobiliario").val("");
            /*$("#mobiliario").val("");*/
            $("#cuadrilla").val("");
            $("#descripcion").val("");
       
        });

    });
	</script>
@endsection
