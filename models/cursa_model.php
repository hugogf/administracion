<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/db_model.php");

	class Cursa extends db_model{

		function agregar($rut, $curso){
			$query = "INSERT INTO cursa (usuarios_id, cursos_id, fecha_asignacion, activo)
					  VALUES ('".$rut."', '".$curso."', '".date("Y-m-d")."', '1');";
			$this->connect();
			$this->conn->query($query);
			$this->close();
		}

		function buscar($rut){
			$query = "select * from cursa a1, cursos a2, categoria a3 where a1.cursos_id = a2.id and a2.categoria_id = a3.id and a1.usuarios_id = '".$rut."' AND activo = 1";
			$this->connect();
			$this->result = $this->conn->query($query);
			$this->close();
			return $this->result;
		}

		function listar_especifico($categoria, $plan){
			$query = "SELECT grupo, id FROM cursos WHERE categoria_id = '".$categoria."' AND planes_id = '".$plan."' AND habilitado = 1";
			$this->connect();
			$this->result = $this->conn->query($query);
			$this->close();
			return $this->result;
		}
	}
 ?>