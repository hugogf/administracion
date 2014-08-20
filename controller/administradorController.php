<?php 
	require_once('core/TpaController.php');

	class administrador extends TpaController {

		function __construct(){
		
			if(!isset($_SESSION['user']))
				header('location: ../index.php');

		  	if	($_SESSION['rol'] == '2')
		 		header('location: ../secretaria');
		 	else if	($_SESSION['rol'] == '3')
				header('location: ../alumno');
			else if	($_SESSION['rol'] == '4')
				header('location: ../apoderado');
			else if	($_SESSION['rol'] == '5')
				header('location: ../profesor');
			else
				require_once('views/administrador/header.php');

		}

		function indexAction(){
		
			// require_once('views/administrador/header.php');
			require_once('views/administrador/index.php');
		}

	}
 ?>