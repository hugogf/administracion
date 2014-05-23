<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/db_model.php");

	class Noticia extends db_model {

		function guardar($array){
			$query = "INSERT INTO noticias (Titulo, Contenido, Fecha_creacion, usuarios_id) VALUES 
					  ('".$array['titulo']."','".$array['contenido']."','".date("Y-m-d")."','".$array['usuario_id']."')";
			$this->connect();
			$this->conn->query($query);
			$this->close();
			header("location: ../secretaria/noticias.php");
			// var_dump($query);
		}

		function listar(){
			$query = "SELECT * FROM noticias ORDER BY Fecha_creacion";
			$this->connect();
			$this->result = $this->conn->query($query);
			$this->close();
			return $this->result;
		}

		function editar($array){
			$query = "UPDATE noticias SET Titulo = '".$array['titulo']."', Contenido = '".$array['contenido']."' WHERE id=".$array['id_noticia'];
			$this->connect();
			$this->conn->query($query);
			$this->close();
			header("location: ../secretaria/noticias.php");
		}
	
	}

 ?>