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
	<div class="container spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
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

	       			 <div class="form-group">
							{!! Form::label(null, 'Tipo de trabajo:', array('class' => 'control-label col-sm-2')) !!}
							<div class="col-sm-4">
								{!! Form::select('tipo_trabajo', array('Autorizacion de recursos' => 'Autorizar recursos', 'Autorizacion de elementos de seguridad' => 'Autorizar elementos de seguridad'), null ,array('class'=>'tipo_retiro form-control', 'style' => 'width: 100%', 'required' => 'required')) 
	                            !!}
							</div>
							{!! Form::label(null, 'Cuadrilla afectada:', array('class' => 'control-label col-sm-2')) !!}
							<div class="col-sm-4">
								{!! Form::select('cuadrilla_afectada', array('' => ''), null ,array('id' => 'destinos', 'class'=>' form-control', 'style' => 'width: 100%')) 
	                            !!}
							</div>

					</div>
					<div class="form-group">
							{!! Form::label(null, 'Descripcion:', array('class' => 'control-label col-sm-2')) !!}
							<div class="col-sm-4">
								{!! Form::select('descripcion', array('' => ''), null ,array('id' => 'destinos', 'class'=>' form-control', 'style' => 'width: 100%')) 
	                            !!}
							</div>
							{!! Form::label(null, 'Asignar a:', array('class' => 'control-label col-sm-2')) !!}
							<div class="col-sm-4">
								{!! Form::select('asignacion', array('' => ''), null ,array('id' => 'asignacion', 'class'=>' form-control', 'style' => 'width: 100%')) 
	                            !!}
							</div>
						
					</div>



					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
