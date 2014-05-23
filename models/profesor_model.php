<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/db_model.php");

	class Profesor extends db_model{
		function listar_cursos($rut){
			$query="SELECT a1.id curso_id, a1.*, a2.* FROM cursos a1, categoria a2 
					WHERE a1.categoria_id = a2.id 
					AND profesor_id='".$rut."'
					And a1.habilitado = 1";

			$this->connect();
			$this->result = $this->conn->query($query);
			$this->close();
			return $this->result;
		}

		function alumnos_curso($curso){
			$query="SELECT * FROM cursa a1, datos_usuarios a2
					WHERE a1.usuarios_id = a2.usuario_id
					AND a1.cursos_id = ".$curso;
			$this->connect();
			$this->result = $this->conn->query($query);
			$this->close();
			return $this->result;	
		}
	}
 ?>