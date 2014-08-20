<?php 
	require_once('core/TpaController.php');

	class index extends TpaController {

		function indexAction(){
			if(isset($_SESSION['user']))
				echo "si";
			else
				require_once('views/welcome/index.php');
		}

		function loginAction(){

			echo "Lo estamos redirigiendo";

			$where['rut']   = $_POST['usuario'];
			$where['clave'] = MD5($_POST['password']);

			$user = $this->select('usuarios',$where);			
			
			if( count($user) == 1 ){
				
				$_SESSION['rol']      = $user[0]['rol_id'];
				$_SESSION['user']     = $user[0]['nombre'];
				$_SESSION['id']       = $user[0]['rut'];
				$_SESSION['PASSWORD'] = $user[0]['password'];
				
				if($_SESSION['rol'] == '1')
			 		header('location: index.php?c=administrador&a=index');
			 	else if	($_SESSION['rol'] == '2')
			 		header('location: index.php?c=secretaria&a=index');
			 	else if	($_SESSION['rol'] == '3')
			 		header('location: index.php?c=alumno&a=index');
				else if	($_SESSION['rol'] == '4')
			 		header('location: index.php?c=apoderado&a=index');
				else if	($_SESSION['rol'] == '5')
			 		header('location: index.php?c=profesor&a=index');
			
			} else {
				
				$_SESSION['msg']="Error de usuario o contraseña";
		 		header('location: index.php');
			}
		}
	}

 ?>