<?php

abstract class db_model {
	private static $host = "localhost";
	private static $user ="root";
	private static $pass ="";
	protected $db = "preutcl_preut";
	protected $conn;
	protected $result;

	function connect (){
		$this->conn = new mysqli(self::$host, self::$user, self::$pass, $this->db);
	}

	function close (){
		$this->conn->close();
	}

}
