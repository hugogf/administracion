<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/db_model.php");
	  require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/datos_usuarios_controller.php");
	class Examen extends db_model {

		function listar($curso){

			$query = "SELECT * FROM examen WHERE cursos_id = ".$curso;
			$this->connect();
			$this->result = $this->conn->query($query);
			$this->close();

			return $this->result;
		}

		function ingresar($array){
			
			$query = "INSERT INTO examen (titulo, cursos_id, fecha) VALUES ('".$array['nombre']."',".$array['curso'].", '".$array['fecha']."')";

			$this->connect();
			if($this->conn->query($query)){

				$examen = $this->conn->insert_id;

				$query = "SELECT * FROM cursa WHERE cursos_id = ".$array['curso'];
				$this->result = $this->conn->query($query);
				
				while($alumno = $this->result->fetch_assoc()){
					$datos_alumno = buscar_datos_usuario($alumno['usuarios_id']);
					$query = "INSERT INTO resultados (examen_id, datos_usuarios_id, resultado) 
							  VALUES ('".$examen."','".$datos_alumno['id']."','0')";
					var_dump($query);
					$this->conn->query($query);
				}
			}else{echo "error al registrar examen"; }

			$this->close();
		}

		function eliminar($examen){
			
			$query = "DELETE FROM resultados WHERE examen_id = ".$examen;
			
			$this->connect();
			$this->conn->query($query);

			$query = "DELETE FROM examen WHERE id=".$examen;
	
			$this->conn->query($query);
			$this->close();
		}
	}

 ?>