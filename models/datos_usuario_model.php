<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/db_model.php");

	class Datos_usuario extends db_model{

		function insertar($array){
		
			/* Ingresa los datos del usuario en caso de que sea alumno, 
			verifica si el usuario tiene apoderado, si lo tiene, lo inserta
			si no lo deja en blanco, verifica además cual es área seleccionada
			por el alumno */

			if(!isset($array['ap']))
				$array['rut_id'] = "NULL";
			if(!isset($array['cs']))
				$array['cs'] = "NULL";
			if(!isset($array['ciencias']))
				$array['ciencias']= "NULL";
			if(!isset($array['electivo']))
				$array['electivo']="NULL";

			$query="INSERT INTO datos_usuarios (usuario_id, apoderado_id, cs, electivo, ciencias, jornada, plan_id)
					VALUES ('".$array['rut']."',";
			if(isset($array['rut_ap']))
				$query = $query."'".$array['rut_ap']."',";
			else
				$query = $query."NULL,";

			$query =$query."'".$array['cs']."',
							'".$array['electivo']."',
							'".$array['ciencias']."',
							'".$array['jornada']."',
							'".$array['programa']."')";
			$this->connect();
			$this->conn->query($query);
			$id = $this->conn->insert_id;
			$this->close();
			return $id;


		}
		function listar($rol){
			// Lista los datos de usuarios segun el rol ingresado
			$query = "SELECT * FROM datos_usuarios WHERE rol_id = ".$rol;
			$this->connect();
			$this->result = $this->conn->query($query);
			$this->close();
			return $this->result;
		}

		function buscar($id){
			// Busca los datos de un usuario en particular 
			$query = "SELECT * FROM datos_usuarios WHERE usuario_id = '".$id."'";
			$this->connect();
			$this->result = $this->conn->query($query);
			$this->close();
			// var_dump($query);
			return $this->result;
		}
	}
?>