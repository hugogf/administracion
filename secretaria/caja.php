<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/secretaria/header.php"); 
      require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/pagos_controller.php"); 

      
      $total = 0;
      $cont = 0;
      $fecha = false;

      if(isset($_POST['fecha']))
  		$fecha = $_POST['fecha'];
      else
  	  $fecha = date('Y-m-d');
          $pagos = listar_pagos($fecha);
          $pagos = json_decode($pagos);
          $cant_pagos = count($pagos);
	  
?>
	<div class="row">
		<div class="col-xs-12 col-md-10 col-md-offset-1">
	  <h2>
	  	Rendir Caja <small><?= $_SESSION['user']; ?></small>
		<input type="button" name="imprimir" value="Imprimir" class="btn btn-success" onclick="window.print();"> 
	  </h2>
	  <form action="caja.php" method="POST">
	  		<div class="campo-form pull-right">
	  			<label>
			  		Fecha de Rendicion: 
	  			</label>
		  		<input type="date" class="fecha" name="fecha" value="<?php echo $fecha; ?>">
		  		<input type="submit" value="Consultar" class="btn btn-default" style="margin: 20px;">
	  		</div>
	  </form>


<?php	  if($pagos){ 
	  ?>
		<table class="table table-hover">
			<tr>
				<th>Fecha</th>
				<th>Nro. Boleta</th>
				<th>Monto</th>
			</tr>
		  	<?php for ($i=0; $i < $cant_pagos ; $i++){ $total += $pagos[$i]->monto ;?>
					  		<tr>
					  			<td>
						  			<?php echo $pagos[$i]->fecha; ?>
					  			</td>
					  			<td>
						  			<?php echo $pagos[$i]->boleta; ?>
					  			</td>
					  			<td>
						  			<?php echo number_format($pagos[$i]->monto); ?>
					  			</td>
					  		</tr>
					  	<?php }}?> 
		
		
                </table>
		<table class="table table-hover">
			<tr>
				<td><b>Total Caja de fecha <?= $fecha ?></b></td>
				<td><?php echo number_format($total); ?></td>
			</tr>
		</table>
</div></div>

		