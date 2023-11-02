<?php
@session_start();
@ob_start();
error_reporting(0); 
class db_config
{

	private $server = "localhost";
	private $username = "root";
	private $password = "";
	private $db = "taps9";
	public $con;
	public $baseurl = "http://localhost/amit/taps9";

	// private $server = "localhost";
	// private $username = "laxmip89_chonas";
	// private $password = "Asdf@123!@#";
	// private $db = "laxmip89_chonas";
	// public $con;
	// public $baseurl = "https://laxmiplastics.com/chonas";
	
	
	

	public function __construct()
	{
		return $this->db_connect();
	}


	public function db_connect()
	{
		$this->con = new mysqli($this->server,$this->username,$this->password,$this->db) or die('db connection failed');
		
		return $this->con;
	}
	}

?>