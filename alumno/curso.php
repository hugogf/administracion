<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/alumno/header.php"); 
	  require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/cursa_controller.php"); 
	  if(isset($_GET['curso']))
	  	$curso = buscar_curso($_SESSION['id'], $_GET['curso']);
	  var_dump($curso);
	  ?>