<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/secretaria/header.php"); 
	  require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/usuarios_controller.php"); 

	  $total = 0;
	  $cont = 0;
	  $fecha = false;

  	if(isset($_POST['fecha']))
  		$fecha = $_POST['fecha'];
  	else
  		$fecha = date('Y-m-d');

	  
	  $alumnos = listar_morosos($fecha);
	  $alumnos = json_decode($alumnos);
	  $cant_alumnos = count($alumnos);
?>

	<div class="row">
		<div class="col-xs-12 col-md-10 col-md-offset-1">
	  <h2>
	  	Lista de deudores a la fecha 
		<input type="button" name="imprimir" value="Imprimir" class="btn btn-success" onclick="window.print();"> 
	  </h2>
	  <form action="morosos.php" method="POST">
	  		<div class="campo-form pull-right">
	  			<label>
			  		Fecha de corte: 
	  			</label>
		  		<input type="date" class="fecha" name="fecha" value="<?php echo $fecha; ?>">
		  		<input type="submit" value="Consultar" class="btn btn-default" style="margin: 20px;">
	  		</div>
	  </form>
<?php	  if($alumnos){ 
	  ?>
		<table class="table table-hover">
			<tr>
				<th class="ver"></th>
				<th>Nombre</th>
				<th>Apellidos</th>
				<th>Rut</th>
				<th>Telefono</th>
				<th>Celular</th>
				<th>Dirección</th>
				<th>Mail</th>
				<th>Fecha vencimiento</th>
				<th>Monto</th>
			</tr>
		  	<?php for ($i=0; $i < $cant_alumnos ; $i++){ $cont += 1;?>
					  		<tr>
					  			<td class="ver">
						  			<a href="pago_alumno.php?rut=<?php echo $alumnos[$i]->rut; ?>">Ver</a>
					  			</td>
					  			<td>
						  			<?php echo $alumnos[$i]->nombre; ?>
					  			</td>
					  			<td>
						  			<?php echo $alumnos[$i]->apellidos; ?>
					  			</td>
					  			<td>
						  			<?php echo $alumnos[$i]->rut; ?>
					  			</td>
					  			<td>
						  			<?php echo $alumnos[$i]->telefono; ?>
					  			</td>
					  			<td>
						  			<?php echo $alumnos[$i]->celular; ?>
					  			</td>
					  			<td>
						  			<?php echo $alumnos[$i]->direccion; ?>
					  			</td>
					  			<td>
						  			<?php echo $alumnos[$i]->mail; ?>
					  			</td>
					  			<td>
						  			<?php 
						  				if(!($i+1 == $cant_alumnos))
						  				{	
						  					for ($j=$i; $alumnos[$j]->rut == $alumnos[$j+1]->rut ; $j++) { 
						  						
									  			echo $alumnos[$j]->fecha_pago."<br>";
									  		}
									  			echo $alumnos[$j]->fecha_pago."<br>";
									  	}else{
									  			echo $alumnos[$j]->fecha_pago."<br>";
									  	}
						  			?>
						  		</td>
						  		<td>
						  			<?php 
						  				if(!($i+1 == $cant_alumnos))
						  				{	
						  					for ($i; $alumnos[$i]->rut == $alumnos[$i+1]->rut ; $i++) { 
						  						
									  			echo "$".$alumnos[$i]->monto."<br>";
									  			$total += $alumnos[$i]->monto;
									  		}
									  			echo "$".$alumnos[$i]->monto."<br>";
									  			$total += $alumnos[$i]->monto;
									  	}else{
									  			echo "$".$alumnos[$i]->monto."<br>";
									  			$total += $alumnos[$i]->monto;
									  	}
						  			?>
						  		</td>
					  		</tr>
					  	<?php }}?> 
		</table>
		<h2>Datos financieros del instituto a la fecha <small><?php echo $fecha; ?></small></h2>
		<table class="table table-hover">
			<th>Cantidad de deudores</th>
			<th>Monto total de la dueda</th>
			<th></th>
			<tr>
				<td><?php echo $cont; ?></td>
				<td><?php echo "$".$total; ?></td>
				<td></td>
			</tr>
		</table>
		
		</div>
	</div>