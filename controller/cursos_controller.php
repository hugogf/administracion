<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/curso_model.php");

	function listar_cursos(){
		$cursos = new Curso();
		return $cursos->listar();
	}

	if(isset($_POST['boton'])){
		if($_POST['boton']=="Crear"){
			$cursos = new Curso();
			$cursos->ingresar($_POST);		
		}
		else if($_POST['boton']=='Editar'){
			$cursos = new Curso();
			$cursos->editar($_POST);
		}
	}

	if(isset($_GET['delet'])){
		if($_GET['delet']=="on"){
			$curso = new Curso();
			$curso->delete($_GET['id']);
		}
	}

 ?>
