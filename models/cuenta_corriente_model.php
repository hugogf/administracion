<?php 
	require_once ($_SERVER['DOCUMENT_ROOT']."/administracion/models/db_model.php");

	
	class cuentaCorriente extends db_model {

		function cuotas($id){
			$query = "SELECT * FROM cuenta_corriente WHERE datos_usuario_id = '".$id."'";
			$this->connect();
			$this->result = $this->conn->query($query);
			$this->close();
			return $this->result;
		}

		function crear($array, $id){

			$cuotas = $array['cuotas'];
			$costo =$array['valor_plan'];			
			$descuento = $array['descuento'];			
			$fecha = $array['dia_pago'];
			$resto = $costo%$cuotas;			
			$valor = ($costo - $resto)/$cuotas;			
			$resto = ($valor%10)*$cuotas + $resto;			
			$valor = ($costo - $resto)/$cuotas;			

			$this->connect();

			if(isset($array['valor_matricula']))
			{
				$matricula = $array['valor_matricula'];
				$query = "INSERT INTO cuenta_corriente (datos_usuario_id, monto_total, descuento, monto_descuento, matricula, fecha_pago, numero_cuota)
						  VALUES ('".$id."','".$matricula."','0','".$matricula."',1,'".$array['fecha']."',0)";				
				$this->conn->query($query);	
			}
			
			$q=0;

			for ($i=1; $i < $cuotas ; $i++) 
			{  
				$q = $i - 1;

				$query = "INSERT INTO cuenta_corriente (datos_usuario_id, monto_total, descuento, monto_descuento, matricula, fecha_pago, numero_cuota)
						  VALUES ('".$id."','".$valor."','".$descuento."','".($valor - $descuento)."',0,'".date("Y-m-d",strtotime("$fecha + $q month"))."',".$i.")";
				$this->conn->query($query);
			}
			
			$q = $i - 1;

			$query = "INSERT INTO cuenta_corriente (datos_usuario_id, monto_total, descuento, monto_descuento, matricula, fecha_pago, numero_cuota)
						  VALUES ('".$id."','".($valor + $resto)."','".$descuento."','".($valor + $resto - $descuento)."',0,'".date("Y-m-d",strtotime("$fecha + $q month"))."',".$i.")";
			$this->conn->query($query);
			

			$this->close();

		}
	}

 ?>