<?php 
	require_once('core/TpaController.php');

	class cursos extends TpaController {

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

			// Capturando las categorias de los cursos
			$categorias   = $this->all('categoria');

			// Capturando los usuarios cuyo $where['rol'] = 5 
			//(5 es el id que identifica que el usuario es profesor)
			$where['rol'] = 5;
			$profesores   = $this->select('usuarios', $where);

			//Capturando todos los planes
			$planes       = $this->all('planes');

			//Capturando los cursos creados
			$cursos       = $this->query_return('SELECT a1.id curso_id, a2.id categoria_id, a1.*, a2.* 
							      			     FROM cursos a1, categoria a2 
										         WHERE a2.id = a1.categoria_id
										         AND habilitado = 1');

			require_once('views/cursos/index.php');
		}

		function saveAction(){

			$where               = $_POST;
			$where['created_at'] = date('Y-m-d');
			$where['habilitado'] = "1";

			$this->save('cursos', $where);

			$this->indexAction();
		}

		function editAction(){

			// Capturando el curso
			$whereCurso['id'] = $_GET['i'];
			$curso            = $this->select('cursos', $whereCurso)[0];

			// Capturando las categorias de los cursos
			$categorias       = $this->all('categoria');

			// Capturando los usuarios cuyo $where['rol'] = 5 
			//(5 es el id que identifica que el usuario es profesor)
			$where['rol']     = 5;
			$profesores       = $this->select('usuarios', $where);

			//Capturando todos los planes
			$planes = $this->all('planes');

			require_once('views/cursos/edit.php');

		}

		function updateAction(){

			$in_where['id'] = $_POST['id'];
			$this->update('cursos', $in_where, $_POST);

			$this->indexAction();
		}

		function deleteAction(){
		
			$in_where['id'] = $_GET['i'];
			$in_set['habilitado'] = 0;
			$this->update('cursos', $in_where, $in_set);
			//Emitiendo mensaje de Eliminación Exitosa por $_SESSION
			echo "El curso se deshabilito correctamente";
			
			$this->indexAction();	

		}
	}