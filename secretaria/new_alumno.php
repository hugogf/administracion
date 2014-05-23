<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/secretaria/header.php"); ?>
		
<div class="row form">
	<form action="../controller/usuarios_controller.php" class="formulario_ingreso"  method="POST">

	<div class="col-xs-12 col-md-8 col-md-offset-2 formulario">
	    <div class="row">	
		<h3>MATRICULANDO ALUMNO</h3>
		<input type="submit" value="Matricular" class="btn btn-warning pull-right" name="boton">
		
		<!-- Datos del alumno -->
		<h3>Alumno</h3>
		
			<div class="col-xs-12 col-md-6">
				<label>Nombre:</label>
				<input type="text"  required="required"  name="nombre">
			</div>
			<div class="col-xs-12 col-md-6">
				<label>Apellidos:</label>
				<input type="text"  required="required"  name="apellidos">
			</div>
			<div class="col-xs-12 col-md-4">
				<label>Rut:</label>
				<input type="text" class="rut"  required="required" name="rut">
			</div>
			<div class="col-xs-12 col-md-4">
				<label>Telefono:</label>
				<input type="text"  name="telefono">
			</div>
			<div class="col-xs-12 col-md-4">
				<label>Celular:</label>
				<input type="text"  name="celular">
			</div>
			
			<div class="col-xs-12">
				<label>Dirección:</label>
				<input type="text"  required="required"  name="direccion">
			</div>
			<div class="col-xs-12">
				<label>Mail:</label>
				<input type="text"  required="required" name="mail">
			</div>
			<input type="hidden" name="rol_id" value="3">
			<!-- Datos del apoderado -->
			<h3>Apoderado <small><input type="checkBox" id="desabilitar" name="ap"> Desabilitar Apoderado</small></h3>

			<div class="col-xs-12 col-md-6" id="ap">
				<label class="ap_apoderado">Nombre:</label>
				<input type="text" class="ap_apoderado text_form" name="nombre_ap" required="required" >
			</div>
			<div class="col-xs-12 col-md-6" id="ap">
				<label class="ap_apoderado">Apellidos:</label>
				<input type="text" class="ap_apoderado text_form" name="apellidos_ap" required="required" >
			</div>
			<div class="col-xs-12 col-md-4" id="ap">
				<label class="ap_apoderado">Rut:</label>
				<input type="text" class="ap_apoderado rut text_form" name="rut_ap" required="required">
			</div>
			<div class="col-xs-12 col-md-4" id="ap">
				<label class="ap_apoderado">Telefono:</label>
				<input type="text" class="ap_apoderado text_form" name="telefono_ap">
			</div>
			<div class="col-xs-12 col-md-4" id="ap">
				<label class="ap_apoderado">Celular:</label>
				<input type="text" class="ap_apoderado text_form" name="celular_ap">
			</div>
			<div class="col-xs-12" id="ap">
				<label class="ap_apoderado">Dirección:</label>
				<input type="text" class="ap_apoderado text_form" name="direccion_ap" required="required" >
			</div>
			<div class="col-xs-12" id="ap">
				<label class="ap_apoderado">Mail:</label>
				<input type="text" class="ap_apoderado text_form" name="mail_ap">
			</div>
			<input type="hidden" name="rol_id_ap" value="4">
			
			<!-- Datos academicos -->
			<div class="col-xs-12 col-md-9">
				
			<h3>Antecedentes Académicos</h3>

			<div class="col-xs-12 col-md-9">
				<label>Programa:</label>
				<select name="programa" required="required" >
				<option value="0"></option>
				<?php 
					require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/planes_controller.php");
					$lista = listar_planes(); 
					while($plan = $lista -> fetch_assoc()){	
						?>								
						<option value="<?php echo $plan['id']; ?>" data-valor="<?php echo $plan['valor']; ?>" id="plan_<?php echo $plan['id']; ?>"><?php echo $plan['nombre']; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="col-xs-12 col-md-3">
				<label>Fecha</label>
				<input type="text" name="fecha" required="required" class="fecha" />
			</div>
			<div class="col-xs-12 col-md-3">
				<label>Jornada: </label>
				<select name="jornada">
					<option value="Mañana">Mañana</option>
					<option value="Tarde">Tarde</option>
					<option value="Noche">Noche</option>
				</select>
			</div>
			<div class="col-xs-12 col-md-3">
				<label> Valor del Plan:</label><div class="valor-plan"></div>
				<input type="hidden"  name="valor_plan">
			</div>
			<div class="col-xs-12 col-md-6">
				<label id="historia">Historia & Ciencias Soc.</label>
				<input type="checkbox" name="historia">
			</div>
			<div class="col-xs-12 col-md-6">
				<label>Ciencias</label>
				
				<input type="checkbox" name="ciencias">
				
				<ul id="electivo">
					<li><p>Biologia</p><input type="radio" value="b" name="electivo"> </li>
					<li><p>Física</p><input type="radio" value="f" name="electivo"></li>
					<li><p>Química</p><input type="radio" value="q" name="electivo"></li> 	
				</ul>
			</div>

			</div>
			<!-- Informacion financiera -->
			<div class="col-xs-12 col-md-3">	
				<h3>Datos financieros</h3>
				<div class="col-xs-12">
					<label>Fecha de pago:</label>
					<input type="date" class="fecha" required="required"  name="dia_pago">
				</div>
				<div class="col-xs-12">
					<label>N° Cuotas: </label>
					<input type="number" required="required" name="cuotas">
				</div>
				<div class="col-xs-12">
					<label>Descuento:</label>
					<input type="number" name="descuento" value='0'>
				</div>
				<div class="col-xs-12">
					<label>Excento de Matricula:</label>
					<input type="checkbox" name="matricula">
				</div>
				<div class="col-xs-12">
					<label>Valor Matricula:</label>
					<input type="number" name="valor_matricula">
				</div>
			</div>

			<a href="#" id="generar" class="btn btn-success">Generar Detalle</a>
			
			<div class="table">
				<table class='table table-hover' id='cuotas_total'>
					<tr class='active'>
						<th>N° Cuota</th>
						<th>Valor Neto</th>
						<th>Descuento</th>
						<th>Valor con Descuento</th>
						<th>Fecha de Pago</th>
					</tr>
					<tr id="cuotas_total"></tr>
				</table>
			</div>
	    </div>
		</div>
	</form>
</div>

	<script src="../js/new_alumno.js"></script>
</body>
</html>
