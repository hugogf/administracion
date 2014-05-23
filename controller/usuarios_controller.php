<?php require_once($_SERVER['DOCUMENT_ROOT'].'/administracion/models/usuario_model.php'); 

	function buscar_usuario($id){
		$usuario = new Usuario();
		return $usuario->buscar($id)->fetch_assoc();
	}
	
	function buscar_lista_usuarios($array){
		$usuarios = new Usuario();
		return $usuarios->buscar_lista($array);
	}

	function listar_usuarios($rol){
		$usuarios = new Usuario();
		$result = $usuarios->listar($rol);
		return $result;
	}
	function listar_morosos(){
		$usuarios = new Usuario();
		$result = $usuarios->morosos();
		return $result;
	}

	function listar_profesores(){
		$profesores = new Usuario();
		$result = $profesores->listar_profesores();
		return $result;
	}

	if(isset($_POST['boton'])){
		if($_POST['boton']=="Registrar" || $_POST['boton']=="Matricular"){
			$usuarios = new Usuario();
			$usuarios->ingresar($_POST);
			if($_POST['boton']=="Registrar")
				header('location: ../administrador/usuarios.php');
			else
				header('location: ../secretaria/alumno.php');

		} else if($_POST['boton']=="Ingresar"){
			$usuarios = new Usuario();
			$result = $usuarios->ingresar();
			var_dump($result);
		} else if($_POST['boton']=="Grabar"){
			$usuarios = new Usuario();
			$result = $usuarios->editar($_POST);
		}
	}

	if(isset($_GET['eliminar']))
	{
		$usuario = new Usuario();
		$usuario->delete($_GET['rut']);
	}
?>