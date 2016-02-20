<?php

namespace App\Lib;

use PDO;

class Connection
{

	public $conn = '';

	function __construct()
	{
		try 
		{
		    $this->conn = new PDO('mysql:host=127.0.0.1;dbname=wallethubtest', 'root', '');

		    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e) 
		{
		    echo 'ERROR: ' . $e->getMessage();
		}
	}

}