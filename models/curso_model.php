<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/db_model.php");

class Curso extends db_model {

	function listar(){
		$query = "SELECT a1.nombre nombre_profesor, a1.rut id_profesor, a1.apellidos apellidos_profesor, a2.*, a3.nombre nombre,a3.id id_categoria, a4.nombre plan, a4.id id_plan
		          FROM usuarios a1, cursos a2, categoria a3, planes a4 
		          WHERE rut = profesor_id
		          AND a2.planes_id = a4.id
		          AND a3.id = a2.categoria_id
		          AND a2.habilitado = 1";
		$this->connect();
		$this->result = $this->conn->query($query);
		$this->close();
		return $this->result;
	}

	function ingresar($array){
		$query = "INSERT INTO  `cursos` (`id` ,`categoria_id` ,`grupo` ,`created_at` ,`inicio_clases` ,`profesor_id`,`planes_id`,`habilitado` )
				  VALUES ( NULL ,
				   		   '".$array['categoria']."',
				   		   '".$array['grupo']."',
				   		   '".Date("Y-m-d")."',
				   		   '".$array['inicio_clases']."',
				   		   '".$array['profesor']."',
				   		   '".$array['plan']."', '1')";
		$this->connect();
		$this->conn->query($query);
		$this->close();
		header('location: ../administrador/cursos.php');
	}

	function editar($array){
		$query = "UPDATE `cursos` SET `profesor_id`='".$array['profesor_editar']."',
				  `inicio_clases` = '".$array['inicio_clases']."', `grupo`='".$array['grupo']."'
				  WHERE `id`='".$array['id']."'";
		$this->connect();
		$this->conn->query($query);
		$this->close();
		echo "<meta http-equiv='Refresh' content='0;url=../administrador/cursos.php'>";
	}

	function delete($id){
		$query = "UPDATE  `cursos` SET  `habilitado` = '0' WHERE `id` =".$id; 
		$this->connect();
		$this->conn->query($query);
		$this->close();
		header('location: ../administrador/cursos.php');
	}

} 
 ?>