<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/secretaria/header.php"); 
	  require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/usuarios_controller.php"); 
	  require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/datos_usuarios_controller.php"); 
	  require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/cuenta_corriente_controller.php");
	  require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/planes_controller.php");
	  require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/pagos_controller.php"); ?>
	
	<!-- Busqueda de alumno -->	
	
	<div class="row">
		<div class="row" >
				<div class="col-xs-8">
					<h3>Ficha del Alumno</h3>
				</div>
				<div class="col-xs-4">
					<form action="pago_alumno.php" method="POST">
						<div class="input-group">
							<span class="input-group-btn" style="color: black !important;" >
								<input type="submit" class="btn btn-default" value="Buscar">
							</span>								
							<input type="text" class="form-control" name="rut" placeholder="Ingrese rut">
						</div>
					</form>
				</div>
		</div>

		<?php if(isset($_GET['rut']) or isset($_POST['rut'])){
			  	if (isset($_GET['rut']))
			  	{
				  	$alumno = buscar_usuario($_GET['rut']);
				  	$datos_alumno = buscar_datos_usuario($_GET['rut']);
			  	} 
				else
				{
			  		$alumno = buscar_usuario($_POST['rut']); 
				  	$datos_alumno = buscar_datos_usuario($_GET['rut']);

				} ?>
	
	 	<!-- fin busqueda de alumno-->	
 	

 	</div>
		
	<div class="row" id="cuerpo">
		<?php if (isset($alumno)) { ?>
		<div class="col-xs-6 col-xs-offset-7">
 			<?php if ($alumno['habilitado'] == '0') {?>
				<a href="#" class="btn btn-danger">Alumno dado de baja</a>
 			<?php } else { ?>
				<a href="#" id="btn-pago" class="btn btn-warning">Generar Pago</a>
				<a href="#" id="btn-baja" class="btn btn-warning">Dar de baja a alumno</a>
				<a href="#" id="btn-anular-pago" class="btn btn-warning">Anular pago</a>
			<?php } ?>
		</div>

 		<!-- Formulario de Pagos (Controlando su visibilidad con jQuery en js/pagos_alumnos.js -->
		
		<div class="col-xs-7 col-xs-offset-2" id="form-pago">
 				
 				<form class="formulario-pago" method="POST" action="../controller/pagos_controller.php">

					<h3>Información Basica</h3>
					
					<div class="pack-form">
						<label>Seleccione tipo Pago:</label>	
	 					<select name="tipo" value="">
	 						<option>...Seleccione</option>
	 						<option value="cheque">Cheque</option>
	 						<option value="Efectivo">Efectivo</option>
	 						<option value="T. Credito">T. Credito</option>
	 					</select>
					</div>

					<div class="pack-form">				
 					<label> N° de boleta </label>
 					<input type="text" name="boleta">
					</div>
					
					<div class="pack-form">				
 						<label>Fecha:</label>
 						<input type="text" name="fecha" class="fecha">
 					</div>
					<div class="pack-form">				
					<label>Seleccione Cuota</label>	
					<select name="cuota" id="cuota">
					<?php $cuotas = mostrar_cuotas($datos_alumno['id']); 	
					while ($cuota = $cuotas->fetch_assoc()) {  ?>
						
						<option value="<?php echo $cuota['id'];?>">
						
						<?php if ($cuota['numero_cuota']!=0) {
						    
							echo "cuota".$cuota['numero_cuota'].": $".$cuota['monto_descuento'];
							
						}else{
							echo "Matricula : $".$cuota['monto_descuento'];
						}
						?>
						</option>
					<?php } ?>
					</select>
				</div>
					<div class="pack-form">				
						<label>Monto a Cancelar:</label>
 					<input type="text" name="monto">
 				</div>
					<div class="pack-form">				
 					<label>Glosa: </label>
 					<input type="text" name="glosa">
 				</div>
 				<input type="hidden" name="rut" value="<?php echo $_GET['rut']; ?>">
				<div class="blocke-pago-3 cheque">
					<h3>Información Adicional <small>Información de Cheque</small></h3>
					<label>Nombre:</label>
					<input type="text" name="nombre_cheque">
				</div>
				<div class="blocke-pago-3 cheque">
					<label>Dirección:</label>
					<input type="text" name="direccion_cheque">
				</div>
				<div class="blocke-pago-4 cheque">
					<label>Telefono:</label>
					<input type="text" name="telefono_cheque">
				</div>
				<div class="blocke-pago-4 cheque">
					<label>Fecha de Cobro:</label>
					<input type="text" name="cobro_cheque" class="fecha">
				</div>
				<input type="hidden" name="rut" value="<?php echo $alumno['rut'] ?>">
				<input type="submit" class="btn btn-warning" name="boton" value="Ingresar">
				<a href="#" id="cerrar-pago" class="btn btn-default">Cerrar</a>
			</form>
 		</div>
 		<!-- Fin -->

 		<!-- Formulario baja a un alumno -->
 		<div class="col-xs-12" id="form-anular">
 			<h1>¿Esta seguro que desea anular al alumno?</h1>
 			<a href="../controller/usuarios_controller.php?eliminar=on&rut=<?php echo $alumno['rut'] ?>" class="btn btn-default">Sí</a>
 			<a href="#" class="btn btn-default" id="no-baja">Cancelar</a>
 		</div>
 		<!-- Fin -->
 		
 
 		<!-- Formulario Anular pago -->
 		<div class="col-md-6 col-md-offset-3" id="form-anular-pago">
 			<h4>Anular pago del alumno</h4>
 			<form action="#" method="POST"id="baja-pago">
 				<label>Seleccione el pago a anular:</label>
 				<select name="pago_anular">
 			
 				<?php $pagos = pagosAlumno($datos_alumno['id']); 
				
				if($pagos['num_pagos']!=0)
				for ($i=0; $i < $pagos['num_pagos'] ; $i++){ 
					$pago = $pagos[$i];?>
				
					<option value="<?php echo $pago['id']; ?>"><?php echo $pago['monto']." | ".$pago['fecha']." | ".$pago['glosa']." | ".$pago['tipo']; ?></option>
 				
 				<?php } ?>
 				</select>
				<label>Ingrese motivo de la anulación:</label>
 				<input type="text" placehover="Ingrese motivo" name="motivo">
 				<input type="submit" value="Anular" name="boton" class="btn btn-warning">
	 			<a href="#" id="cerrar-form-anular-pago" class="btn btn-default">Cerrar</a>
 			</form> 			
 		</div>
 		<!-- Fin -->

		<div class="col-md-10 col-md-offset-1">
		
			<table class="table pagoTable">
				<tr class="active">
					<td></td>
					<td></td>
					<th>DATOS PERSONALES</th>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr CLASS="success">
					<th>Nombre: </th>
					<td><?php echo $alumno['nombre']." ".$alumno['apellidos'] ?></td>
					<th>Rut: </th>
					<td><?php echo $alumno['rut'] ?></td>
					<th>E-mail: </th>
					<td><?php echo $alumno['mail'] ?></td>
				</tr>
				<tr CLASS="success">
					<th>Plan Academico:</th>
					<?php $nombre_plan = buscar_plan($datos_alumno['plan_id']); ?>
					<td><?php echo $nombre_plan['nombre']; ?></td>
					<th>Telefono:</th>
					<td><?php echo $alumno['telefono'] ?></td>
					<th>Dirección:</th>
					<td><?php echo $alumno['direccion'] ?></td>
				</tr>
				<tr class="active">
					<td></td>
					<td></td>
					<th>DETALLE DE CUOTAS</th>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<?php $cuotas = mostrar_cuotas($datos_alumno['id']); ?>
				<?php while ($cuota = $cuotas->fetch_assoc()) { ?>
					<tr CLASS="warning">
						<th>Cuota <?php 
						if ($cuota['numero_cuota']!=0) {
							echo $cuota['numero_cuota']; 
							
						}else{
							echo "Matricula";
						}

						?>:</th>
						<td>$<?php echo $cuota['monto_descuento']; ?></td>
						<th>Vence:</th>
						<td><?php echo $cuota['fecha_pago']; ?></td>
						<th></th>
						<td></td>
					</tr>
				<?php } ?>
				<tr class="active">
					<td></td>
					<td></td>
					<th>PAGOS REALIZADOS</th>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<?php $pagos = pagosAlumno($datos_alumno['id']); 
				if($pagos)
				if($pagos['num_pagos']!=0)
				for ($i=0; $i < $pagos['num_pagos'] ; $i++){ 
					$pago = $pagos[$i];?>
					<tr CLASS="danger">
						<th><?php echo $i+1; ?></th>
						<td>$<?php echo $pago['monto']; ?></td>
						<th>Glosa:</th>
						<td><?php echo $pago['glosa']; ?></td>
						<td><?php echo $pago['fecha']; ?></td>
						<td><?php echo $pago['tipo'] ?></td>
					</tr>
				<?php } ?>

			</table>
			<?php } else { ?>
			<h1>Ingrese un rut para realizar la busqueda
			<?php } ?>
		</div>
	</div>
<?php }else{ ?>
	<h1>Ingrese un rut para visualizar ficha</h1>
	<?php } ?>
	<script src="../js/pagos_alumnos.js"></script>
</body>
</html>