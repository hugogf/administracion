<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/cuenta_corriente_model.php");


function crear_cuenta_corriente($array, $id){
	$cuenta_corriente = new cuentaCorriente();
	$cuenta_corriente->crear($array, $id);
}

function mostrar_cuotas($id){
	$cuenta_corriente = new cuentaCorriente();
	return $cuenta_corriente->cuotas($id);
}

function eliminar_cuotas($id, $fecha){
	$cuenta_corriente = new cuentaCorriente();
	return $cuenta_corriente->eliminar($id, $fecha);
}

?>