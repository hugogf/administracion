<?php 
	require_once ($_SERVER['DOCUMENT_ROOT']."/administracion/models/db_model.php");

	
	class Pago extends db_model {

		function ingresarPago($array){
			session_start();

			$query = "INSERT INTO pagos (corriente_id, monto, fecha, glosa, tipo, boleta, usuarios_id)
					  VALUES ('".$array['cuota']."', 
					  		  '".$array['monto']."', 
					  		  '".$array['fecha']."',
					  		  '".$array['glosa']."',
					  		  '".$array['tipo']."',
					  		  '".$array['boleta']."',
					  		  '".$_SESSION['id']."')";
			$this->connect();
			$this->conn->query($query);
			$id = $this->conn->insert_id;
			$this->close();

			if($array['tipo'] == "cheque")
				$this->cheque($array, $id);
			header("location: ../secretaria/pago_alumno.php?rut=".$array['rut']);
		}

		function cheque($array, $id){
			$query = "INSERT INTO cheques (pagos_id, nombre, direccion, fecha_cobro, telefono)
					  VALUES ( ".$id.", 
					  		   '".$array['nombre_cheque']."',
					   		   '".$array['direccion_cheque']."',
					   		   '".$array['cobro_cheque']."',
					   		   '".$array['telefono_cheque']."')";
			$this->connect();
			$this->conn->query($query);
			$this->close();
			echo $id;
		}

		function pagos($id_cuota){
			$query = "SELECT * FROM pagos WHERE corriente_id = ".$id_cuota." AND nulo != 1";
			$this->connect();
			$this->result = $this->conn->query($query);
			$this->close();
			return $this->result;
		}

		function anularPago($array)
		{
			$query = "UPDATE pagos SET nulo = 1, motivo = '".$array['motivo']."' WHERE id = ".$array['pago_anular'];
			$this->connect();
			$this->result = $this->conn->query($query);
			$this->close();
			header('location: ../secretaria/pago_alumno.php');

		}
}