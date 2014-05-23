<?php
require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/db_model.php");

// session_start();

class File extends db_model{
	function upload($url, $name, $curso){
		$query = "INSERT INTO materiales (url, nombre, created_at, cursos_id) 
		    	  VALUES ('".$url."', '".$name."', '".date("Y-m-d")."', ".$curso.")";
		$this->connect();
		$this->conn->query($query);
		$this->close();

		header('location: ../profesor');

	}
	function listar($curso){
		$query = "SELECT * FROM materiales WHERE cursos_id = ".$curso;
		$this->connect();
		$this->result = $this->conn->query($query);
		$this->close();
		return $this->result;
		var_dump($query);
	}
}


?>