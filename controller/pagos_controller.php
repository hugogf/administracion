<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/pagos_model.php");
	  require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/cuenta_corriente_controller.php");

if(isset($_POST['boton'])){
	
	if($_POST['boton'] == "Ingresar"){
		$pago = new Pago();
		$pago->ingresarPago($_POST);
	}
	
	if($_POST['boton'] == "Anular"){
		$pago = new Pago();
		$pago->anularPago($_POST);
	}
}

function pagosAlumno($id){
	// pide todas las cuotas relacionadas al id enviado como parametro
	$cuotas = mostrar_cuotas($id);
	// Si no existen cuotas se sale y retorna "Error, alumno sin cuotas"
	if($cuotas)
	// Contador nos dira la cantida de pagos que se realizaron
	// Pago es el objeto pago quien pedira los pagos de cada cuota de la 
	// cuenta corriente y array almacenara cada pago para luego ser retornada
	{
		$contador = 0;
		$array = array();
		// sacamos una cuota de la variable cuota, la cual contiene todas las cuotas
		// que el alumno debe pagar
		while($cuota = $cuotas->fetch_assoc())
		// preguntamos ahora si esa cuota tiene un pago relacionado, asi con cada
		// cuota del alumno
		{
			$pagos = new Pago();
			$pagos = $pagos->pagos($cuota['id']);

			// si ese pago es nul no ara nada, pero si no lo es
			// almacenara pago, sumara uno al contador y le dira
			// al array asociativo a 'num_pagos' cuantos pagos se van almacenando
			if($pagos)
				while($pago = $pagos->fetch_assoc())
				{
					$array['num_pagos'] = $contador + 1;
					$array[$contador] = $pago;
					$contador = $contador + 1;
				}
		}
		// retorna array
		return $array;
	}else{return "Error, alumno sin cuotas";}
}


?>