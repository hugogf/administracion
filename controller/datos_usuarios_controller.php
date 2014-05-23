<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/datos_usuario_model.php");

function agregar_datos_usuarios($array){
	$datos = new Datos_usuario();
	return $datos->insertar($array);
}

function listar_datos_usuarios($rol){
	$usuarios = new Datos_usuarios();
	$usuarios->listar($rol);
}
function buscar_datos_usuario($id){
	$datos = new Datos_usuario();
	return $datos->buscar($id)->fetch_assoc();
}
?>