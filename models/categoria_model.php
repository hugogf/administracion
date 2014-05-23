<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/db_model.php");

class Categoria extends db_model{

	function listar(){
		$query = "SELECT * FROM categoria";
		$this->connect();
		$this->result = $this->conn->query($query);
		$this->close();
		return $this->result;
	}
	function crear($array){
		$query = "INSERT INTO categoria (nombre) VALUES ('".$array['nombre']."')";
		$this->connect();
		$this->conn->query($query);
		$this->close();
		echo "<meta http-equiv='Refresh' content='0;url=../administrador/configuracion.php'>";
	}
	function edit($array){
		$query = "UPDATE categoria SET nombre ='".$array['nombre']."' WHERE id=".$array['id'];
		$this->connect();
		$this->conn->query($query);
		$this->close();
		echo "<meta http-equiv='Refresh' content='0;url=../administrador/configuracion.php'>";
	}

}
?>