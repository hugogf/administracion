<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/db_model.php");

	class login extends db_model{
		function in($usuarios, $password){
			$query = "SELECT * FROM usuarios WHERE rut='".$usuarios."' AND password='".$password."'";
			$this->connect();
			$this->result = $this->conn->query($query);
			$this->close();
			return $this->result;
		}
		function cambio_clave($rut, $clave){
			$pass = md5($clave);
			
			$query = "UPDATE usuarios SET password = '".$pass."'
					  WHERE rut='".$rut."'";
			$this->connect();
			$this->conn->query($query);
			$this->close();
		}
	}
 ?>