<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/login_model.php");
	session_start();
	echo "Lo estamos redirigiendo";
	$user = $_POST['usuario'];
	$pass = md5($_POST['password']);
	

	$login = new login();

	$result = $login->in($user, $pass);

	$user = $result->fetch_assoc();
	
	if($user){
		
		$_SESSION['rol'] = $user['rol_id'];
		$_SESSION['user'] = $user['nombre'];
		$_SESSION['id'] = $user['rut'];
		$_SESSION['PASSWORD'] = $pass;
		
		if($_SESSION['rol'] == '1')
	 		echo "  <meta http-equiv='Refresh' content='0;url=../administrador'>";
	 	else if	($_SESSION['rol'] == '2')
	 		echo "  <meta http-equiv='Refresh' content='0;url=../secretaria'>";
	 	else if	($_SESSION['rol'] == '3')
	 		echo "  <meta http-equiv='Refresh' content='0;url=../alumno'>";
		else if	($_SESSION['rol'] == '4')
			header('location: ../apoderado');
		else if	($_SESSION['rol'] == '5')
	 		echo "  <meta http-equiv='Refresh' content='0;url=../profesor'>";

	} else {
		$_SESSION['msg']="Error de usuario o contraseña";
	 	echo "  <meta http-equiv='Refresh' content='0;url=../'>";
	}
	

 ?>