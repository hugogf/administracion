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
		
		function delete($rut){
			$query = "UPDATE  `usuarios` SET  `habilitado` = '0' WHERE `rut` ='".$rut."'"; 
			$this->connect();
			$this->conn->query($query);
			$this->close();
			header('location: ../administrador/usuarios.php?q='.$query);
		}
		
		function editar($array){
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
			var_dump($this->conn->error);
			$this->close();
			// header('location: ../administrador/usuarios.php');
		}
		
		function listar($rol){

		/* Lista los usuarios definidos segun un rol, al enviar la sentencia 'All'
		a la variable $rol, listara todos los usuarios que no sean ni alumnos ni
		apoderados */
			if($rol == 'All')
				$query = "SELECT *
						  FROM usuarios 
						  WHERE rol_id != 4 
						  AND rol_id != 3
						  AND habilitado = 1";
			else
				$query = "SELECT * FROM usuarios WHERE rol_id = ".$rol." AND habilitado = 1 ORDER BY nombre ";
			
			$this->connect();
			$this->result = $this->conn->query($query);
			$this->close();
			return $this->result;

		}
		function buscar($id){
			$query = "SELECT * FROM usuarios WHERE rut = '".$id."'";
			$this->connect();
			$this->result = $this->conn->query($query);
			$this->close();
			return $this->result;
		}
		function morosos(){
			$query = 'select a1.id, a1.fecha_pago, a3.* from cuenta_corriente a1, datos_usuarios a2, usuarios a3 where fecha_pago <= now() and a1.id not in (select corriente_id from pagos where fecha < now()) and a1.datos_usuario_id = a2.id and a2.usuario_id = a3.rut ';
			$this->connect();
			$this->result = $this->conn->query($query);
			$this->close();
			return $this->result;
		}
	}
 ?>