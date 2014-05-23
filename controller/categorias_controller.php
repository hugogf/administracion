<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/categoria_model.php");

function listar_categorias(){
	$categorias = new Categoria();
	return $categorias->listar();
	
	}

if(isset($_POST['boton']))
	if($_POST['boton']=='Crear')
	{
		$categoria = new Categoria();
		$categoria->crear($_POST);
	}else if($_POST['boton'] == 'Grabar'){
		$categoria = new Categoria();
		$categoria->edit($_POST);
	}

?>
