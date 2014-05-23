<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/cursa_model.php");

	function listar_cursos($rut){
		$cursos = new Cursa();
		return $cursos->buscar($rut);
	}

	// if(isset($_POST['boton']))
	// 	if($_POST['boton']=='Agregar'){
	// 		$cursa = new Cursa();
	// 		$cursa->agregar($_POST['rut'],$_POST['curso']);
	// 	}
 ?>