<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/db_model.php");
	class Contenido extends db_model{
		
		function listar($curso){
			$query = "SELECT * FROM contenidos WHERE cursos_id = ".$curso;
			$this->connect();
			$this->result = $this->conn->query($query);
			$this->close();
			return $this->result;
		}

		function registrar($array){
			
			$query = "INSERT INTO contenidos (descripcion, titulo, fecha, cursos_id) 
					  VALUES ('".$array['descripcion']."','".$array['titulo']."', '".$array['fecha']."',".$_POST['curso'].")";
			
			$this->connect();
			$this->conn->query($query);
			$this->close();		  
		}

		function eliminar($contenido){
			$query = "DELETE FROM contenidos WHERE id=".$contenido;
			$this->connect();
			$this->conn->query($query);
			$this->close();
		}
	}
 ?>