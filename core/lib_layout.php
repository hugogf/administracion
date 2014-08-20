<?php 
	
	
	/* CONTROLA LAS RUTAS A LAS QUE SON INGRESADAS, VEE EL CONTROLADOR Y LA ACCION QUE SE DESEA EJECUTAR
	*  LUEGO ES EL CONTROLADOR QUIEN GATILLA LA ACCION Y GENERA LAS VISTAS SOLICITADAS POR EL USUARIO */

	function layout($controller = "index", $action="indexAction")
	{	
			
		// require("params.php");

		$controller_route = false;

		if(isset($_GET['c']))
		{
			$controller = $_GET['c'];

			if(isset($_GET['a']))
				$action = $_GET['a']."Action";
		}
		
		$controller_route = "controller/";
		$controller_route .= $controller;
		$controller_route .= "Controller.php";
		

		require_once($controller_route);
		$controller = new $controller();
		
		if(count($_POST)==0)
			{
				$controller->$action();
			}
		else
			{
				$action = $_POST['accion']."Action";
				$controller->$action($_POST);
			}
	}

	// ADMINISTRA LAS RUTAS, CREA LINKS PARA LOS DIFERENTES CONTROLADORES Y ACCIONES QUE EL USUARIO
	// DESEA EJECUTAR

	function link_to($controller = false, $action = 'index', $name = "Link", $attr1='', $attr2='')
	{
		
		if($controller)
			echo "<a href='index.php?c=$controller&a=$action&i=".$attr1."&j=".$attr2."'>$name</a>";
	}
			
?>