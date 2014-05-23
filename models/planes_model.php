<?php 
	require_once ($_SERVER['DOCUMENT_ROOT']."/administracion/models/db_model.php");


class plan extends db_model {

	function save($array){

		$query = " INSERT INTO planes (nombre, descripcion, fecha_inicio, jornada,valor, habilitado) VALUES ( ".

				  "'".$array['nombre']."',".
				  "'".$array['descripcion']."',".
				  "'".$array['inicio_clases']."',".
				  "'".$array['jornada']."',".
				  "'".$array['valor']."', 
				  '1')";
		$this->connect();
		$this->conn->query($query);
		$this->close();
		header("location: ../administrador/planes.php");

	}

	function listar(){
		$query = "SELECT * FROM planes WHERE habilitado = '1'";
		$this->connect();
		$this->result = $this->conn->query($query);
		$this->close();
		return $this->	result;
	}

	function buscar($id){
		$query = "SELECT * FROM planes WHERE id = ".$id;
		$this->connect();
		$result = $this->conn->query($query);
		$this->close();
		return $result;	
	}

	function delete($array){
		$query = "UPDATE  `planes` SET  `habilitado` = '0' WHERE `planes`.`id` =".$array['id']; 
		$this->connect();
		$this->conn->query($query);
		$this->close();
		header('location: ../administrador/planes.php');
	}
	function editar($array){
		$query = "UPDATE planes SET 
				  nombre = '".$array['nombre']."',
				  descripcion = '".$array['descripcion']."',
				  valor = '".$array['valor']."',
				  fecha_inicio = '".$array['fecha_inicio']."',
				  jornada = '".$array['jornada']."'
				  WHERE id='".$array['id']."'"; 
		$this->connect();
		$this->conn->query($query);
		$this->close();
		header('location: ../administrador/planes.php');
	}
}

 ?>