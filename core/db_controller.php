<?php

abstract class db_controller {
	private static $host = "192.185.100.42:3306";
	private static $user ="targetpl_cliente";
	private static $pass ="123target";
	protected $db = "targetpl_tg";
	protected $conn;
	public $result;
	public	$last_id = false;


	function connect (){
		$this->conn = new mysqli(self::$host, self::$user, self::$pass, $this->db);
	}

	function close (){
		$this->conn->close();
	}

	function query_return($query){

		$this->connect();
		$this->result = $this->conn->query($query);

		if($this->conn->error!='')
			{
				echo $this->conn->error;
				echo "<br>".$query;
			}
		
		$this->last_id = $this->conn->insert_id;

		$this->conn->close();

		return $this->result;

	}

}
