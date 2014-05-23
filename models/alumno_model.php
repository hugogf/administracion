<?php 
	
	require_once ($_SERVER['DOCUMENT_ROOT']."/administracion/models/db_model.php");

	
	class alumno extends db_model {

		private $table= "datos_usuarios";

		public function listar($array, $valor){
			
			if($valor){
				$query = "SELECT DISTINCT a2.nombre ";
			}else{
			$query = "SELECT a2.nombre";
			}
			$query=$query." , a2.rut,a2.apellidos, a3.nombre plan 
					  FROM usuarios a1, datos_usuarios a2, planes a3, cuenta_corriente a4
					  WHERE a1.id = a2.usuarios_id 
					  AND a1.id = a4.usuarios_id
					  AND a3.id = a2.planes_id
					  AND a1.rol_id = 3
					  AND a4.renuncia = 0";
			
			if(isset($array['buscar'])){
				if($array['rut']!="")
					$query = $query." AND a2.usuarios_id='".$array['rut']."'";
				if($array['nombre']!="")
					$query = $query." AND a2.nombre LIKE '%".$array['nombre']."%'";
				if($array['apellidos']!="")
					$query = $query." AND a2.apellidos LIKE '%".$array['apellidos']."%'";
				if($array['plan']!="")
					$query = $query." AND a2.planes_id='".$array['plan']."'";
			}
			$this->connect();
			$this->result = $this->conn->query($query);
			$this->close();
			return $this->result;
		}

		// function create_user($rut, $nombre, $rol){
			
		// 	$user = $rut;
		// 	$pass = md5($nombre.$rut[0].$rut[1]);
		// 	$query = "INSERT INTO usuarios (id, rol_id, password) VALUES ('".$user."',".$rol.",'".$pass."')";
		// 	$this->connect();
		// 	$this->conn->query($query);
		// 	$this->close();
		// 	var_dump($query);

		// 	return $user;
		// }

		// function create_cta($array) {
		// 	$anio = Date("Y");
		// 	$dia = $array['dia_pago'];
		// 	$mes = Date("m");
		// 	$cuotas = $array['cuotas'];
		// 	$resto = 365000%$cuotas;
		// 	$valor = (365000-$resto)/$cuotas;
		// 	$query = "INSERT INTO cuenta_corriente (usuarios_id, monto_total, pct_desc, dia_pago, num_cuotas) VALUES ";

		// 	for ($i=1; $i <= $cuotas; $i++) 
		// 		if($i!=$cuotas){
		// 			if($mes != 12)
		// 				$mes = $mes +1;
		// 			else {
		// 				$mes = 1;
		// 				$anio = $anio+1;
		// 			}
		// 			$query = $query."('".$array['rut']."', '".$valor."','".$array['descuento']."','".$anio."-".$mes."-".$dia."','".$i."'),";
		// 		}
		// 		else
		// 			$query = $query."('".$array['rut']."','".($valor+$resto)."','".$array['descuento']."','".$anio."-".$mes."-".$dia."','".$i."')";
		
			
		// 	if(isset($array['valor_matricula']))
		// 		$query =  $query.",('".$array['rut']."','".$array['valor_matricula']."','".$array['descuento']."','".$array['dia_pago']."', 0)";

		// 	$this->connect();
		// 	$this->conn->query($query);
		// 	$this->close();
		// 	header('../secretaria/alumnos.php');
		// }

		// function insert($rut, $id, $plan, $apoderado, $nombre, $apellidos, $mail, $telefono, $celular, $direccion, $rol){

		// 	if($apoderado!=NULL)
		// 		$apoderado = "'".$apoderado."'";
		// 	else
		// 		$apoderado = "NULL";

		// 	$query = "INSERT INTO ". $this->table .
		// 						" (rut,
		// 						   usuarios_id,
		// 						   planes_id,
		// 						   apoderado_id, 
		// 						   nombre, 
		// 						   apellidos,
		// 						   mail,
		// 						   fecha_inicio, 
		// 						   telefono,
		// 						   celular,
		// 						   direccion
		// 						   )";

		// 	if($rol==4)
		// 		$query = $query." VALUES ('".$rut."',
		// 			  		  '".$id."',
		// 			  		  NULL,
		// 			  		  NULL,
		// 			  	      '".$nombre."',
		// 			  	      '".$apellidos."',
		// 			  	      '".$mail."',
		// 			  	      '".date("Y-m-d")."',
		// 			  	      '".$telefono."',
		// 			  	      '".$celular."',
		// 			  	      '".$direccion."')" ;
		// 	else
		// 		$query = $query." VALUES ('".$rut."',
		// 			  		  '".$id."',
		// 			  		  ".$plan.",
		// 			  		  ".$apoderado.",
		// 			  	      '".$nombre."',
		// 			  	      '".$apellidos."',
		// 			  	      '".$mail."',
		// 			  	      '".date("Y-m-d")."',
		// 			  	      '".$telefono."',
		// 			  	      '".$celular."',
		// 			  	      '".$direccion."')" ;

		// 	$this->connect();
		// 	$this->conn->query($query);
		// 	$this->close();
		// }

		// function save ($array){
		// 	if(!isset($array['ap'])){
		// 		$id_apoderado = $this->create_user($array['rut_ap'], $array['nombre_ap'], 4);
				
		// 		$this->insert($array['rut_ap'], 
		// 				  $id_apoderado, 
		// 				  NULL, 
		// 				  NULL, 
		// 				  $array['nombre_ap'], 
		// 				  $array['apellidos_ap'], 
		// 				  $array['mail_ap'], 
		// 				  $array['telefono_ap'], 
		// 				  $array['celular_ap'], 
		// 				  $array['direccion_ap'], 4);

		// 	}else{
		// 		$id_apoderado=NULL;
		// 	}
				

		// 	$id = $this->create_user($array['rut'], $array['nombre'], 3);
			
		// 	$this->insert($array['rut'], 
		// 				  $id, 
		// 				  $array['programa'], 
		// 				  $id_apoderado, 
		// 				  $array['nombre'], 
		// 				  $array['apellidos'], 
		// 				  $array['mail'], 
		// 				  $array['telefono'], 
		// 				  $array['celular'], 
		// 				  $array['direccion'], 3);
			
		// 	$this->connect();
		// 	if(isset($array['ciencias'])){
		// 		$query = "UPDATE datos_usuarios SET ciencias = 0, electivo = '".$array['electivo']."' WHERE rut='".$id."'";
		// 		$this->conn->query($query);
		// 	}
		// 	if(isset($array['historia'])){
		// 		$query = "UPDATE datos_usuarios SET CS = 0 WHERE rut='".$id."'";
		// 		$this->conn->query($query);
		// 	}
		// 	$query = "UPDATE datos_usuarios SET jornada = '".$array['jornada']."' WHERE rut='".$id."'";
		// 	$this->conn->query($query);
		// 	$this->close();
		// 	$this->create_cta($array);
		// 	header('location: ../secretaria/index.php');
		// }

		function buscar($rut){

			$query =  "SELECT * FROM usuarios WHERE rut='".$rut."' AND habilitado != 0";	

			$this->connect();

			$this->result = $this->conn->query($query);

			$this->close();
            
			return $this->result;
		}

		function baja($rut){
			$query = "UPDATE cuenta_corriente SET renuncia = 1 WHERE usuarios_id = '".$rut."'";
			$this->connect();
			$this->conn->query($query);
			$this->close();
			header('location: ../secretaria/pago_alumno.php?rut='.$rut);

		}

		function cursa($rut, $curso){
			
			$query = "SELECT categoria_id FROM cursos WHERE id = ".$curso;
			$this->connect();
			
			$categoria = $this->conn->query($query)->fetch_assoc();;
			$categoria = (int)$categoria['categoria_id'];
			
			$query = "SELECT count(*) cont FROM cursa a1, cursos a2 WHERE a1.cursos_id = a2.id AND a1.usuarios_id='".$rut."' AND a2.categoria_id=".$categoria." AND a1.activo = 1 AND a2.habilitado = 1";
			$this->result = $this->conn->query($query);

			$this->close();

			return $this->result;
		}

		function editar($array){
			
			$query = "UPDATE cursa SET activo = 0 WHERE usuarios_id ='".$array['rut']."'";
			
			$this->connect();
			$this->conn->query($query);
			
			$query = "UPDATE datos_usuarios SET nombre = '".$array['nombre']."',
					  apellidos = '".$array['apellidos']."',
					  mail = '".$array['mail']."',
					  telefono = '".$array['telefono']."',
					  celular = '".$array['celular']."',
					  direccion = '".$array['direccion']."',
					  jornada = '".$array['jornada']."'
					  WHERE rut = '".$array['rut']."'";
			
			$this->conn->query($query);

			if(isset($array['1']))
			{
				$query="SELECT * FROM cursa  WHERE usuarios_id ='".$array['rut']."' AND cursos_id=".$array['1'];
				$this->result = $this->conn->query($query);
				if($this->result->fetch_assoc()){
					$query = "UPDATE cursa SET activo = 1  WHERE usuarios_id ='".$array['rut']."' AND cursos_id=".$array['1'];
					$this->conn->query($query);}
					else{
						$query="INSERT INTO cursa (cursos_id, usuarios_id, activo) VALUES (".$array['1'].",'".$array['rut']."', 1) ";
						$this->result = $this->conn->query($query);
					} var_dump($query);
			}
			if(isset($array['2']))
			{
				$query="SELECT * FROM cursa  WHERE usuarios_id ='".$array['rut']."' AND cursos_id=".$array['2'];
				$this->result = $this->conn->query($query);
				if($this->result->fetch_assoc()){
					$query = "UPDATE cursa SET activo = 1  WHERE usuarios_id ='".$array['rut']."' AND cursos_id=".$array['2'];
					$this->conn->query($query);}
					else{
						$query="INSERT INTO cursa (cursos_id, usuarios_id, activo) VALUES (".$array['2'].",'".$array['rut']."', 1) ";
						$this->result = $this->conn->query($query);
					} var_dump($query);
			}
			if(isset($array['3']))
			{
				$query="SELECT * FROM cursa  WHERE usuarios_id ='".$array['rut']."' AND cursos_id=".$array['3'];
				$this->result = $this->conn->query($query);
				if($this->result->fetch_assoc()){
					$query = "UPDATE cursa SET activo = 1  WHERE usuarios_id ='".$array['rut']."' AND cursos_id=".$array['3'];
					$this->conn->query($query);}
					else{
						$query="INSERT INTO cursa (cursos_id, usuarios_id, activo) VALUES (".$array['3'].",'".$array['rut']."', 1) ";
						$this->result = $this->conn->query($query);
					} var_dump($query);
			}
			if(isset($array['4']))
			{
				$query="SELECT * FROM cursa  WHERE usuarios_id ='".$array['rut']."' AND cursos_id=".$array['4'];
				$this->result = $this->conn->query($query);
				if($this->result->fetch_assoc()){
					$query = "UPDATE cursa SET activo = 1  WHERE usuarios_id ='".$array['rut']."' AND cursos_id=".$array['4'];
					$this->conn->query($query);}
					else{
						$query="INSERT INTO cursa (cursos_id, usuarios_id, activo) VALUES (".$array['4'].",'".$array['rut']."', 1) ";
						$this->result = $this->conn->query($query);
					} var_dump($query);
			}
			if(isset($array['5']))
			{
				$query="SELECT * FROM cursa  WHERE usuarios_id ='".$array['rut']."' AND cursos_id=".$array['5'];
				$this->result = $this->conn->query($query);
				if($this->result->fetch_assoc()){
					$query = "UPDATE cursa SET activo = 1  WHERE usuarios_id ='".$array['rut']."' AND cursos_id=".$array['5'];
					$this->conn->query($query);}
					else{
						$query="INSERT INTO cursa (cursos_id, usuarios_id, activo) VALUES (".$array['5'].",'".$array['rut']."', 1) ";
						$this->result = $this->conn->query($query);
					} var_dump($query);
			}
			
			$this->close();

			header("location: ../secretaria/editar_alumno.php?rut=".$array['rut']);
		}
	}
 ?>
