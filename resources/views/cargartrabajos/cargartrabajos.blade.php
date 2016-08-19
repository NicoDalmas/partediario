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
				
				{!! Form::open(['route' => 'addtrabajo', 'method' => 'POST', 'class' => 'form-horizontal' ]) !!}

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
					@include('dropzoner::dropzone')
				</div>
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
    });
	</script>
@endsection
