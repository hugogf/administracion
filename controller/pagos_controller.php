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
	$pagos = new Pago();
	return $pagos->pagos($id);
}

function listar_pagos($fecha){
	$pagos = new Pago();
	return $pagos->pagosFecha($fecha);
}
?>