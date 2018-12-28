<?php

require_once(DIRNAME(__FILE__)."/db.standard.php");

class db_common_class{
	private $db;
	private $table;
	function __construct(){
		$this->db = new DBManager();
		if($_SERVER["HTTP_HOST"] === "localhost"){
			$this->table = "kairo";
		} else {
			$this->table = "KAIRO";
		}
	}
	function set($username,$type,$ip){
		
		$sql = "INSERT INTO {$this->table}(`USERNAME`, `TYPE`, `IPADDRESS`) ";
		$sql .= " VALUES ('{$username}','{$type}','{$ip}')";
		$ret = $this->db->query($sql);
		return $ret;
	}
}



?>
