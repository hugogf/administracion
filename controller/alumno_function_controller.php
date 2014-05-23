<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/alumno_model.php");

	function buscar($rut) {
		$alumno = new alumno();
		$result = $alumno->buscar($rut)->fetch_assoc();
		return $result;
	}

	function listar_alumnos($array, $valor) {
		$alumno = new alumno();
		return $alumno->listar($array, $valor);
	}

	function pagos($id_cuenta){
		$alumno = new alumno();
		return $alumno->pagos($id_cuenta);
	}


	 ?>	