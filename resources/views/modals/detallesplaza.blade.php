<div class="modal fade" id="informacionplazas" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

<div class="modal-dialog modal-lg">

<div class="modal-content">

	{!! Form::open(['route' => 'addsalida', 'method' => 'POST', 'class' => 'form-horizontal' ]) !!}

		<!--HEADER MODAL -->
		<div class="modal-header" style="background: #4682B4; color: #FFFFFF;">
			<button type="button" class="close" date-dismiss='modal' aria-hidden='true'>&times;</button>
			<h4 class="modal-title">Información de la plaza</h4> 
		</div>

		<!--BODY MODAL -->
		<div class="modal-body">
			
			<div class="form-group">
					{!! Form::label(null, 'Limpieza:', array('class' => 'control-label col-sm-2')) !!}
					<div class="col-sm-4">
						{!! Form::label(null, '', array('id' => 'limpieza', 'class'=>' form-control', 'style' => 'width: 70%')) 
                        !!}
					</div>
					{!! Form::label(null, 'Jardinería:', array('class' => 'control-label col-sm-2')) !!}
					<div class="col-sm-4">
						{!! Form::label(null, '', array('id' => 'jardineria', 'class'=>' form-control', 'style' => 'width: 70%')) 
                        !!}
					</div>
				
			</div>

			<div class="form-group">
					{!! Form::label(null, 'Arbolado:', array('class' => 'control-label col-sm-2')) !!}
					<div class="col-sm-4">
						{!! Form::label(null, '' ,array('id' => 'arbolado', 'class'=>' form-control', 'style' => 'width: 70%')) 
                        !!}
					</div>
					{!! Form::label(null, 'Juegos:', array('class' => 'control-label col-sm-2')) !!}
					<div class="col-sm-4">
						{!! Form::label(null, '', array('id' => 'juegos', 'class'=>' form-control', 'style' => 'width: 70%')) 
                        !!}
					</div>
				
			</div>

			<div class="form-group">
					{!! Form::label(null, 'Bebederos:', array('class' => 'control-label col-sm-2')) !!}
					<div class="col-sm-4">
						{!! Form::label(null, '' ,array('id' => 'bebederos', 'class'=>' form-control', 'style' => 'width: 70%')) 
                        !!}
					</div>
					{!! Form::label(null, 'Estaciones Aerobbicas:', array('class' => 'control-label col-sm-2')) !!}
					<div class="col-sm-4">
						{!! Form::label(null, '', array('id' => 'estaciones_aerobicas', 'class'=>' form-control', 'style' => 'width: 70%')) 
                        !!}
					</div>
				
			</div>
			<div class="form-group">
					{!! Form::label(null, 'Bicicleteros:', array('class' => 'control-label col-sm-2')) !!}
					<div class="col-sm-4">
						{!! Form::label(null, '', array('id' => 'bicicleteros', 'class'=>' form-control', 'style' => 'width: 70%')) 
                        !!}
					</div>
					{!! Form::label(null, 'Cercos:', array('class' => 'control-label col-sm-2')) !!}
					<div class="col-sm-4">
						{!! Form::label(null, '', array('id' => 'cercos', 'class'=>' form-control', 'style' => 'width: 70%')) 
                        !!}
					</div>
				
			</div>
			<div class="form-group">
					{!! Form::label(null, 'Riego:', array('class' => 'control-label col-sm-2')) !!}
					<div class="col-sm-4">
						{!! Form::label(null, '', array('id' => 'riego', 'class'=>' form-control', 'style' => 'width: 70%')) 
                        !!}
					</div>
					{!! Form::label(null, 'Cartelería:', array('class' => 'control-label col-sm-2')) !!}
					<div class="col-sm-4">
						{!! Form::label(null, '', array('id' => 'carteleria', 'class'=>' form-control', 'style' => 'width: 70%')) 
                        !!}
					</div>
				
			</div>
			<div class="form-group">
					{!! Form::label(null, 'Mobiliario:', array('class' => 'control-label col-sm-2')) !!}
					<div class="col-sm-4">
						{!! Form::label(null, '', array('id' => 'mobiliario', 'class'=>' form-control', 'style' => 'width: 70%')) 
                        !!}
					</div>
					{!! Form::label(null, 'Mastil:', array('class' => 'control-label col-sm-2')) !!}
					<div class="col-sm-4">
						{!! Form::label(null, '', array('id' => 'mastil', 'class'=>'form-control', 'style' => 'width: 70%')) 
                        !!}
					</div>
				
			</div>
			<div class="form-group">
					{!! Form::label(null, 'Arenero:', array('class' => 'control-label col-sm-2')) !!}
					<div class="col-sm-4">
						{!! Form::label(null, '', array('id' => 'arenero', 'class'=>' form-control', 'style' => 'width: 70%')) 
                        !!}
					</div>
					{!! Form::label(null, 'Caminos:', array('class' => 'control-label col-sm-2')) !!}
					<div class="col-sm-4">
						{!! Form::label(null, '', array('id' => 'caminos', 'class'=>'form-control', 'style' => 'width: 70%')) 
                        !!}
					</div>
				
			</div>
			<div class="form-group">
					{!! Form::label(null, 'Veredas:', array('class' => 'control-label col-sm-2')) !!}
					<div class="col-sm-4">
						{!! Form::label(null, '', array('id' => 'veredas', 'class'=>' form-control', 'style' => 'width: 70%')) 
                        !!}
					</div>
					{!! Form::label(null, 'Luminarias:', array('class' => 'control-label col-sm-2')) !!}
					<div class="col-sm-4">
						{!! Form::label(null, '', array('id' => 'luminarias', 'class'=>'form-control', 'style' => 'width: 70%')) 
                        !!}
					</div>
				
			</div>
			<div class="form-group">
					{!! Form::label(null, 'Esculturas:', array('class' => 'control-label col-sm-2')) !!}
					<div class="col-sm-4">
						{!! Form::label(null, '', array('id' => 'esculturas', 'class'=>' form-control', 'style' => 'width: 70%')) 
                        !!}
					</div>
					{!! Form::label(null, 'Playón:', array('class' => 'control-label col-sm-2')) !!}
					<div class="col-sm-4">
						{!! Form::label(null, '', array('id' => 'playon', 'class'=>'form-control', 'style' => 'width: 70%')) 
                        !!}
					</div>
				
			</div>
			<div class="form-group">
					{!! Form::label(null, 'Cestos:', array('class' => 'control-label col-sm-2')) !!}
					<div class="col-sm-4">
						{!! Form::label(null, '', array('id' => 'cestos', 'class'=>' form-control', 'style' => 'width: 70%')) 
                        !!}
					</div>
					{!! Form::label(null, 'Observaciones:', array('class' => 'control-label col-sm-2')) !!}
					<div class="col-sm-4">
						{!! Form::label(null, '', array('id' => 'observaciones', 'class'=>'form-control', 'style' => 'width: 100%')) 
                        !!}
					</div>
				
			</div>

			<div class="box tabla-articulos">
			<table class="table table-bordered">
				<tr>
					<th>Hamacas</th>
					<th>Sube y bajas</th>
					<th>Tobogan</th>
					<th>Trepador</th>
					<th>Circuitos aerobicos</th>
					<th>Pasamanos</th>
					<th>Multijuegos</th>
					<th>Hamacas inclusivas</th>
					<th>Playon</th>
					<th>Bebederos</th>
				</tr>
				<tr style="text-align: center;">
					<td> {!! Form::label(null, '', array('id' => 'hamaca')) !!}</td>
                    <td> {!! Form::label(null, '', array('id' => 'subeybaja')) !!}</td>
                    <td> {!! Form::label(null, '', array('id' => 'tobogan')) !!}</td>
                    <td> {!! Form::label(null, '', array('id' => 'trepador')) !!}</td>
                    <td> {!! Form::label(null, '', array('id' => 'circuitos_aerobicos')) !!}</td>
                    <td> {!! Form::label(null, '', array('id' => 'pasamanos')) !!}</td>
                    <td> {!! Form::label(null, '', array('id' => 'multijuego')) !!}</td>
                    <td> {!! Form::label(null, '', array('id' => 'hamaca_inclusiva')) !!}</td>
                    <td> {!! Form::label(null, '', array('id' => 'playon2')) !!}</td>
                    <td> {!! Form::label(null, '', array('id' => 'bebedero')) !!}</td>
				</tr>
			</table>
			</div>
       	 	<!-- DATATABLE ARTICULOS-->
	       	<div class="box tabla-articulos">
	            <div class="box-body no-padding">
	                <table id="tabla-detalles" class="table table-striped table-bordered cambiartablaid"  cellspacing="0" width="100%">
	                    <thead>
	                        <tr>
	                        	<th></th>
	                        	<th>Fecha</th>
	                        	<th>Descripcion de los trabajos</th>
	                            <th>Usuario</th>
	                            <th>Nro imagenes</th>
	                            <th></th>
	                        </tr>
	                    </thead>
	                </table>
	   			</div>
			</div>
		</div><!-- fin modal body -->
		
		<!-- MODAL FOOTER-->
		<div class="modal-footer">
		</div>

</div>

</div>

</div>