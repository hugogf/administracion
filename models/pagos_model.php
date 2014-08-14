<?php 
	require_once ($_SERVER['DOCUMENT_ROOT']."/administracion/models/db_model.php");

	
	class Pago extends db_model {

		function ingresarPago($array){
			session_start();

			$query = "UPDATE cuenta_corriente SET MONTO_CANCELADO = ".$array['monto']." WHERE id=".$array['cuota'];

			$this->connect();

			$this->conn->query($query);

			$query = "INSERT INTO pagos (corriente_id, monto, fecha, glosa, tipo, boleta, usuarios_id)
					  VALUES ('".$array['cuota']."', 
					  		  '".$array['monto']."', 
					  		  '".$array['fecha']."',
					  		  '".$array['glosa']."',
					  		  '".$array['tipo']."',
					  		  '".$array['boleta']."',
					  		  '".$_SESSION['id']."')";


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

		function pagos($id){
			$query = "SELECT a1.* FROM pagos a1, cuenta_corriente a2 WHERE a2.datos_usuario_id = '".$id."' AND a1.corriente_id = a2.id AND a1.nulo = 0 ";
			$this->connect();
			$this->result = $this->conn->query($query);
			$this->close();
			
			return $this->result;
		}

               function pagosFecha($fecha){

			$query = "SELECT fecha, boleta, monto  FROM pagos WHERE fecha = '".$fecha."' AND usuarios_id = '".$_SESSION['id']."' ORDER BY boleta";
			$this->connect();
			$this->result = $this->conn->query($query);
			$this->close();
			
			$JSON = array();
			
			while($pagos = $this->result->fetch_assoc())
				array_push($JSON, $pagos);
			return json_encode($JSON);
		}
		
		function anularPago($array)
		{
			$query = "UPDATE pagos SET nulo = 1, motivo = '".$array['motivo']."' WHERE id = ".$array['pago_anular'];
			$this->connect();
			$this->result = $this->conn->query($query);
			$query = "SELECT * FROM pagos WHERE id=".$array['pago_anular'];
			$this->result = $this->conn->query($query)->fetch_assoc();
			$query = "UPDATE cuenta_corriente SET MONTO_CANCELADO = (MONTO_CANCELADO - ".$this->result['monto'].") WHERE id =".$this->result['corriente_id'];
			$this->result = $this->conn->query($query);
			$this->close();
			header('location: ../secretaria/pago_alumno.php?rut='.$array['rut_usuario']);

		}
}