<?php 
	require_once('core/TpaController.php');

	class planes extends TpaController {

		function __construct(){
		
			if(!isset($_SESSION['user']))
				header('location: ../index.php');

		  	if	($_SESSION['rol'] == '2')
		 		header('location: ../secretaria');
		 	else if	($_SESSION['rol'] == '3')
				header('location: ../alumno');
			else if	($_SESSION['rol'] == '4')
				header('location: ../apoderado');
			else if	($_SESSION['rol'] == '5')
				header('location: ../profesor');
			else
				require_once('views/administrador/header.php');

		}

		function indexAction(){
			
			$where['habilitado'] = 1;
			$planes = $this->select('planes', $where);

			require_once('views/planes/index.php');

		}

		function updateAction(){

			$in_where['id'] = $_POST['id'];
			$this->update('planes', $in_where, $_POST);

			$this->indexAction();
		}

		function saveAction(){

			$where                 = $_POST;
			$where['habilitado']   = "1";
			$where['fecha_inicio'] = $where['inicio_clases'];

			$this->save('planes', $where);

			echo "El curso se guardo con exito";

			$this->indexAction();
		}

		function deleteAction(){
		
			$in_where['id'] = $_GET['i'];
			$in_set['habilitado'] = 0;
			$this->update('planes', $in_where, $in_set);
			
			//Emitiendo mensaje de Eliminación Exitosa por $_SESSION
			echo "El plan se deshabilito correctamente";
			
			$this->indexAction();	

		}
	}
?>