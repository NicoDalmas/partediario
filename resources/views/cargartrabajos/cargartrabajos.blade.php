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

				{!! Form::open(['url' => route('upload-post'), 'class' => 'form-horizontal', 'id'=>'real-dropzone', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}

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
							{!! Form::select('mobiliario', array('Bebederos' => 'Bebederos', 'Juegos' => 'Juegos', 'Bancos' => 'Bancos', 'Cesto' => 'Cestos', 'Estaciones Aerobicas' => 'Estaciones Aerobicas'), null ,array('class'=>'form-control', 'style' => 'width: 100%', 'required' => 'required')) 
                            !!}
						</div>
						
						<!--<div class="col-sm-6">

							
						</div>-->

				</div>
				<div class="form-group">
					{!! Form::label(null, 'Tipo de trabajo:', array('class' => 'control-label col-sm-4')) !!}
					<div class="col-sm-8">
						{!! Form::checkbox('name', 'value') !!}
                        <label>Pintura</label><br>

                        {!! Form::checkbox('name', 'value') !!}
                        <label>Reparación</label><br>

                        {!! Form::checkbox('name', 'value') !!}
                        <label>Herreria</label><br>

                        {!! Form::checkbox('name', 'value') !!}
                        <label>Instalación</label><br>

                        {!! Form::checkbox('name', 'value') !!}
                        <label>Traslado</label><br>

                        {!! Form::checkbox('name', 'value') !!}
                        <label>Extracción</label>

					</div>
				</div>
				<div class="form-group">
					{!! Form::label(null, 'Cuadrilla asignada:', array('class' => 'control-label col-sm-4')) !!}
					<div class="col-sm-8">
						{!! Form::select('cuadrilla', array('Cuadrilla de Portillo' => 'Cuadrilla de Portillo', 'Cuadrilla de Chichin' => 'Cuadrilla de Chichin'), null ,array('class'=>' form-control', 'style' => 'width: 100%')) 
				        !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label(null, 'Descripcion:', array('class' => 'control-label col-sm-4')) !!}
					<div class="col-sm-8">
						<textarea class="form-control" rows="4" cols="50" maxlength="200"></textarea>
					</div>	
				</div>
				<div class="form-group">
					<div class="col-sm-8">
					{!! Form::button('Agregar Trabajo', array('class' => 'btn btn-primary')) !!}
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
			                            <th>Cantidad</th>
			                            <th>Retirado por</th>
			                            <th>Acciones</th>
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
				{!! Form::hidden('csrf-token', csrf_token(), ['id' => 'csrf-token']) !!}
				{{ Form::submit('Upload', array('name' => 'upload-file', 'class'=>"btn btn-info")) }}
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
        $("div#myDropZone").dropzone({
		    url : "/cargartrabajo/imagenes",
		    autoProcessQueue: false,
			uploadMultiple: true,
			parallelUploads: 100,
			maxFiles: 100,

			init:function() {

			var myDropzone = this;
			var photo_counter = 0;

		        /*myDropzone.on("removedfile", function(file) {
		            $.ajax({
		                type: 'POST',
		                url: 'cargartrabajo/imagenes/delete',
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

		        });*/

		        // First change the button to actually tell Dropzone to process the queue.
            	document.querySelector("input[name=upload-file]").addEventListener("click", function(e) {
		                // Make sure that the form isn't actually being sent.
		                e.preventDefault();
		                e.stopPropagation();
		                myDropzone.processQueue();
	            });
			},
			success: function(file,done) {
		        photo_counter++;
		        $("#photoCounter").text( "(" + photo_counter + ")");
		    }
		});
    });
	</script>
@endsection
