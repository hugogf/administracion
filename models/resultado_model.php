<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/db_model.php");


class Resultado extends db_model{

	function lista_alumnos($curso){
		$query = "SELECT a2.nombre, a2.rut,a2.apellidos, a3.nombre plan 
					  FROM usuarios a1, datos_usuarios a2, planes a3
					  WHERE a1.id = a2.usuarios_id 
					  AND a3.id = a2.planes_id
					  AND a1.rol_id = 3";

		$this->connect();
		$this->result = $this->conn->query($query);
		$this->close();
		return $this->result;
	}

	function lista_alumnos_x_examen($examen){
		$query = "SELECT a1.*, a2.* FROM usuarios a1, datos_usuarios a2, resultados a3 
				  WHERE a1.rut = a2.usuario_id 
				  AND a2.id = a3.datos_usuarios_id
				  AND examen_id =".$examen;
				  
		// var_dump($query);
		$this->connect();
		$this->result = $this->conn->query($query);
		$this->close();
		return $this->result;

	}

	function actualizar($array){
		$query = "UPDATE resultados SET promedio =".$array['resultado']." 
				  WHERE usuarios_id = '".$array['alumno']."' AND examen_id = ".$array['examen'];
		var_dump($query);
		$this->connect();
		$this->conn->query($query);
		$this->close();
	}

}


?>
