<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/cursa_model.php");

	function listar_cursos($rut){
		$cursos = new Cursa();
		return $cursos->buscar($rut);
	}

	function buscar_curso($rut, $curso){
		$curso_obj = new Cursa();
		return $curso_obj->curso($rut, $curso)->fetch_assoc();
	}

	// if(isset($_POST['boton']))
	// 	if($_POST['boton']=='Agregar'){
	// 		$cursa = new Cursa();
	// 		$cursa->agregar($_POST['rut'],$_POST['curso']);
	// 	}
 ?>