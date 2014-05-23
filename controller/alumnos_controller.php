<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/cursa_model.php");
require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/cursa_controller.php");
require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/datos_usuarios_controller.php");
require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/alumno_model.php");

if(isset($_POST["boton"])){

	$accion = $_POST["boton"];

	if ($accion == 'Agregar'){
		
		$alumno = new alumno();
		$alumno = $alumno->buscar($_POST['rut'])->fetch_assoc();
		
		if($alumno){
			$datos_alumno = buscar_datos_usuario($alumno['rut']);
			if($_POST['plan'] != $datos_alumno['plan_id']){

				echo "<div id='alert' style='display: none' title='Alumno equivocado'> Error, el alumno no pertenece al plan academico. </div>";  
			
			} else if(alumno_curso($_POST['rut'],(int)$_POST['curso']) != 0){ 
					$x = alumno_curso($_POST['rut'],(int)$_POST['curso']);
					echo "<div id='alert' style='display: none' title='Alumno cursando'> Error ( $x ), el alumno ya se encuentra cursando una asignatura de este tipo.</div>";  
			
			} else { 
			
				$nombre = $alumno['nombre'];
				$apellidos = $alumno['apellidos'];
				$rut = $alumno['rut'];
				$rut = $alumno['rut'];
				$rut = $alumno['rut'];
				
				$cursa = new Cursa();
				$cursa->agregar($_POST['rut'],$_POST['curso']);

				echo "<tr class='success'>
						<td> $nombre </td>
						<td> $apellidos</td>
						<td> $rut </td>
						<td> $rut </td>
						<td> $rut </td>
					</tr>";

			}

		} else {
			echo "<div id='alert' style='display: none' title='Alumno no encontrado'> Error, el alumno no se encuentra. </div>";  
		}

	 
	}
}

	function darDeBaja($rut){
		$alumno = new alumno();
		$alumno->baja($rut);
	}

	function alumno_curso($rut, $curso){
		$alumno = new alumno();
		$result = $alumno->cursa($rut, $curso)->fetch_assoc();	
		return (int)$result['cont'];
	}