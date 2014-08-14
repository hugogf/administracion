<?php require_once($_SERVER['DOCUMENT_ROOT'].'/administracion/models/db_model.php');
	  require_once($_SERVER['DOCUMENT_ROOT'].'/administracion/controller/cuenta_corriente_controller.php');
	  require_once($_SERVER['DOCUMENT_ROOT'].'/administracion/controller/datos_usuarios_controller.php');
	 
	class Usuario extends db_model{
		
		//Funcion que ingresa un nuevo usuario
		function ingresar($array){

			$query = "INSERT INTO usuarios (rut, password, rol_id, nombre, apellidos, direccion, telefono, celular, mail, fecha, created_at, habilitado) 
					  VALUES ('".$array['rut']."',
					  		  '".md5($array['rut'])."',
					  		  '".$array['rol_id']."',
					  		  '".$array['nombre']."',
					  		  '".$array['apellidos']."',
					  		  '".$array['direccion']."',
					  		  '".$array['telefono']."',
					  		  '".$array['celular']."',
					  		  '".$array['mail']."',
					  		  '".$array['fecha']."',
					  		  '".date("Y-m-d")."',1)";
			$this->connect();
			$this->conn->query($query);
	   		// var_dump($this->conn->error);
			
			/* En caso de que el usuario sea un alumno con un apoderado, 
		    se agregaran los datos del apoderado en la tabla usuario */
			if(isset($array['rut_ap']))
			{
				$query = "INSERT INTO usuarios (rut, password, rol_id, nombre, apellidos, direccion, telefono, celular, mail, fecha, created_at, habilitado) 
						  VALUES ('".$array['rut_ap']."',
						  		  '".md5($array['rut_ap'])."',
						  		  '".$array['rol_id_ap']."',
						  		  '".$array['nombre_ap']."',
						  		  '".$array['apellidos_ap']."',
						  		  '".$array['direccion_ap']."',
						  		  '".$array['telefono_ap']."',
						  		  '".$array['celular_ap']."',
						  		  '".$array['mail_ap']."',
						  		  '".$array['fecha']."',
						  		  '".date("Y-m-d")."',1)";
				$this->conn->query($query);
		   		// var_dump($this->conn->error);

			}	

			$this->close(); 	

			/* Ahora se agregaran los datos academicos del usuario en caso 
		    de que el rol del usuario sea alumno y además se crea los datos
		    de su cuenta corrinete */
	   		if($array['rol_id']=='3')
	   		{
				$id = agregar_datos_usuarios($array);
				crear_cuenta_corriente($array, $id);
	   		}
			// header('location: ../administrador/usuarios.php');
		}
		
		function delete($rut, $array){
			$query = "UPDATE  `usuarios` SET  `habilitado` = '0', motivo_baja = '".$array['motivo_eliminar']."', fecha_baja='".$array['fecha']."' WHERE `rut` ='".$rut."'"; 
			$this->connect();
			$this->conn->query($query);
			if($this->conn->error == ''){
				$query = "SELECT id from datos_usuarios where usuario_id = '".$rut."'";
				$id = $this->conn->query($query);
				$id = $id->fetch_assoc();

				eliminar_cuotas($id['id'], $array['fecha']);
			}
			$this->close();
			header('location: ../administrador/usuarios.php?q='.$query);
		}
		
		function editar($array){
			
			if(!isset($array['rol']))
			{
				$array['rol']=3;
				$header = 'location: ../secretaria/editar_alumno.php?rut='.$array['rut'];
			}else{
				$header = 'location: ../administrador/usuarios.php';
			}

			$query="UPDATE `usuarios` SET 
					`nombre` = '".$array['nombre']."',
					`apellidos` = '".$array['apellidos']."',
					`mail` = '".$array['mail']."',
					`telefono` = '".$array['telefono']."',
					`rol_id` = '".$array['rol']."',
					`celular` = '".$array['celular']."' 
					WHERE `rut` = '".$array['rut']."'";
			
			$this->connect();
			$this->conn->query($query);
			
			$this->close();

			header($header);
		}
		
		function listar($rol, $array, $order){

		/* Lista los usuarios definidos segun un rol, al enviar la sentencia 'All'
		a la variable $rol, listara todos los usuarios que no sean ni alumnos ni
		apoderados */
			if($rol == 'All')
				$query = "SELECT *
						  FROM usuarios 
						  WHERE rol_id != 4 
						  AND rol_id != 3
						  AND habilitado = 1 ";
			else
				$query = "SELECT a1.*, a2.* FROM usuarios a1, datos_usuarios a2 
						  WHERE rol_id = ".$rol." 
						  AND habilitado = 1 
						  AND a1.rut = a2.usuario_id ";

			if(isset($_GET['busqueda']))
				{if($array['nombre']!='')
					$query .= " AND a1.nombre LIKE '%".$array['nombre']."%'";
				if($array['apellidos']!='')
					$query .= " AND a1.apellidos LIKE '%".$array['apellidos']."%'";
				if($array['rut']!='')
					$query .= " AND a1.rut LIKE '%".$array['rut']."%'";
				if($array['plan']!='')
					$query .= " AND a2.plan_id =".$array['plan']."";}
			

			if($order == 'apellidos')
				{$query .= 'ORDER BY apellidos';}
			else if($order == 'rut')
				{$query .= 'ORDER BY rut';}
			else
				{$query .= 'ORDER BY nombre';}

			
			$this->connect();
			$this->result = $this->conn->query($query);
			$this->close();

			$result = array();
			while($usuario = $this->result->fetch_assoc()){
				array_push($result, $usuario);
			}
			//var_dump($query);

			$result = json_encode($result);

			return $result;

		}
		function renuncias($rol, $array, $order){

		/* Lista los usuarios definidos segun un rol, al enviar la sentencia 'All'
		a la variable $rol, listara todos los usuarios que no sean ni alumnos ni
		apoderados */
			if($rol == 'All')
				$query = "SELECT *
						  FROM usuarios 
						  WHERE rol_id != 4 
						  AND rol_id != 3
						  AND habilitado = 0 ";
			else
				$query = "SELECT a1.*, a2.* FROM usuarios a1, datos_usuarios a2 
						  WHERE rol_id = ".$rol." 
						  AND habilitado = 0 
						  AND a1.rut = a2.usuario_id ";

			if(isset($_GET['busqueda']))
				{if($array['nombre']!='')
					$query .= " AND a1.nombre LIKE '%".$array['nombre']."%'";
				if($array['apellidos']!='')
					$query .= " AND a1.apellidos LIKE '%".$array['apellidos']."%'";
				if($array['rut']!='')
					$query .= " AND a1.rut LIKE '%".$array['rut']."%'";
				if($array['plan']!='')
					$query .= " AND a2.plan_id =".$array['plan']."";}
			

			if($order == 'apellidos')
				{$query .= 'ORDER BY apellidos';}
			else if($order == 'rut')
				{$query .= 'ORDER BY rut';}
			else
				{$query .= 'ORDER BY nombre';}

			//var_dump($order);
			
			$this->connect();
			$this->result = $this->conn->query($query);
			$this->close();

			$result = array();
			while($usuario = $this->result->fetch_assoc()){
				array_push($result, $usuario);
			}

			$result = json_encode($result);

			return $result;

		}
		function buscar($id){
			$query = "SELECT * FROM usuarios WHERE rut = '".$id."'";
			$this->connect();
			$this->result = $this->conn->query($query);
			$this->close();
			return $this->result;
		}

		function buscar_lista($array){
			
			$query = "SELECT a1.*, a2.* from usuarios a1, datos_usuarios a2
					  where a1.rut = a2.usuario_id and rol_id = 3 and habilitado = 1";
			$this->connect();
			$this->result = $this->conn->query($query);
			$this->close();
			$result = json_encode($this->result);
			return $result;


		}


		function listar_profesores(){
			
			$query = "SELECT * from usuarios
					  where rol_id = 5 and habilitado = 1";
			$this->connect();
			$this->result = $this->conn->query($query);
			$this->close();
			return $this->result;


		}


		function morosos($fecha){

			$query = "SELECT a3.nombre, a3.apellidos, a3.telefono, a3.celular, a3.rut, a3.direccion, a3.mail, a1.fecha_pago, (monto_descuento - MONTO_CANCELADO) monto  FROM cuenta_corriente a1, datos_usuarios a2, usuarios a3 WHERE (monto_descuento - MONTO_CANCELADO) > 0 AND a1.datos_usuario_id = a2.id AND a2.usuario_id = a3.rut AND a1.fecha_pago <= '".$fecha."' ORDER BY a3.apellidos";
			$this->connect();
			$this->result = $this->conn->query($query);
			$this->close();
			
			$JSON = array();
			
			while($alumno = $this->result->fetch_assoc())
				array_push($JSON, $alumno);
			return json_encode($JSON);
		}
	}
 ?>