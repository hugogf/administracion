<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/noticias_model.php");
	
	function listar_noticias(){
		$noticias = new Noticia();
		return $noticias->listar();
	}
	if(isset($_POST['boton']))
		if($_POST['boton']=="Crear noticia"){
			$noticia = new Noticia();
			$noticia->guardar($_POST);
	}else if($_POST['boton']=="Editar noticia"){
			$noticia = new Noticia();
			$noticia->editar($_POST);
	}


 ?>