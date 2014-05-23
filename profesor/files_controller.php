<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/profesor/files.php");

if(isset($_POST['boton'])){
	if($_POST['boton']=="Subir Archivo")
	{
		$dir = '../materiales_estudiantes/';
	
		$upload = $dir.basename($_FILES['userfile']['name']);
	
		if(move_uploaded_file($_FILES['userfile']['tmp_name'], $upload)){
			
			$db = new File();
			$db->upload($upload, basename($_FILES['userfile']['name']), $_POST['curso']);
			
	
			
			echo "Archivo Subido exitosamente";
		}
		else
			echo "Error, problemas al subir el archivo";
	}
}

function listar_materiales($curso){
	$materiales = new File();
	return $materiales->listar($curso);
 	}
 ?>
