<?php 
	require_once("core/db_controller.php");

	abstract class TpaController extends db_controller {

		private	$resultado = array();

		function save($modelo, $valores)
		{
			$campos_json = file_get_contents("models/".$modelo.".json");
			$campos = json_decode($campos_json,true);
			$pop = $campos;
			$parametro = false;
			
			$cant = count($campos);
			$value = " VALUES (";
			$insert = " ".$modelo." (";
			$cont_parametro = 0;
			$this->connect();
			for ($i=0; $i < $cant ; $i++) 
			{ 
				$prueba = array_pop($campos);

				if(isset($valores[$prueba]))
				{
					$parametro = array_search($prueba, $pop);

					if($cont_parametro != 0)
						{
							$value .= ",";
							$insert .= ",";
						}
				
					$insert .= $parametro;
					$value .= "'".$this->conn->real_escape_string($valores[$prueba])."'";
					$cont_parametro = $cont_parametro + 1;	
				}
				
			}
			$this->close();
			$value .=  ")";
			$insert .=  ")";

			$query = "INSERT INTO ".$insert." ".$value;

			$this->query_return($query);

			
		}

		
		function all($modelo)
		{
		
			$query = "SELECT * FROM ".$modelo;

			return $this->query_return($query);

			while($date = $this->result->fetch_assoc()){
				array_push($this->resultado, $date); 
			}

			return $this->resultado;
		}
		
		function delete()
		{

		}
		
		function select($modelo, $valores)
		{
			$campos_json = file_get_contents("models/".$modelo.".json");
			$campos = json_decode($campos_json,true);
			$pop = $campos;
			$parametro = false;
			$query = "SELECT * FROM ".$modelo." ";
			$where = "WHERE ";
			$this->connect();
			
			$cant = count($campos);
			$cont_parametro = 0;

			for ($i=0; $i < $cant ; $i++) 
			{ 
				$prueba = array_pop($campos);

				if(isset($valores[$prueba]))
				{
					$parametro = array_search($prueba, $pop);

					if($cont_parametro != 0)
						{
							$where .= " AND ";
						}

					$where .= $parametro." = '".$this->conn->real_escape_string($valores[$prueba])."' ";
					$cont_parametro = $cont_parametro + 1;	
				}
				
			}
			$this->close();
			
			$query .= $where;

			if(isset($valores['SQL_AND']))
				$query .= $valores['SQL_AND'];

			if(isset($valores['SQL_ORDERBY']))
				$query .= $valores['SQL_ORDERBY'];

			var_dump($query);
			$this->query_return($query);

			$this->resultado = array();
			
			if($this->result)
			{	
				while($date = $this->result->fetch_assoc())
				{
				
					array_push($this->resultado, $date); 
				
				}

				return $this->resultado;

			} else {
				
				return false;
			}

		}

		function update($modelo, $in_where, $in_set)
		{
			$campos_json = file_get_contents("models/".$modelo.".json");
			$campos = json_decode($campos_json,true);
			$pop = $campos;
			$parametro = false;
			$query = "UPDATE ".$modelo." ";
			$where = "WHERE ";
			$set = "SET ";
			$this->connect();

			$cant = count($campos);

			$cont_parametro = 0;

			for ($i=0; $i < $cant ; $i++) 
			{ 
				$prueba = array_pop($campos);

				if(isset($in_where[$prueba]))
				{
					$parametro = array_search($prueba, $pop);

					if($cont_parametro != 0)
						{
							$where .= " AND ";
						}

					$where .= $parametro." = '".$this->conn->real_escape_string($in_where[$prueba])."' ";
					$cont_parametro = $cont_parametro + 1;	
				}
				
			}

			$campos = $pop;
			$parametro = false;
			$cont_parametro = 0; 
			$prueba = false;

			for ($i=0; $i < $cant ; $i++) 
			{ 
				$prueba = array_pop($campos);

				if(isset($in_set[$prueba]))
				{
					$parametro = array_search($prueba, $pop);

					if($cont_parametro != 0)
						{
							$set .= ", ";
						}

					$set .= $parametro." = '".$this->conn->real_escape_string($in_set[$prueba])."' ";
					$cont_parametro = $cont_parametro + 1;	
				}
				
			}
			
			$this->close();
			
			$query .= $set." ".$where; 
			
			$this->query_return($query);

		}
	}
 ?>