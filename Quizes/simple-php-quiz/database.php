<?php

/**
 * @file
 * Connect to mysql
 */

//Create connection credentials
$db_host = 'localhost';
$db_name = 'testes';
$db_user = 'root';
$db_pass = 'root';

//Create mysqli object
$con = new mysqli($db_host,$db_user,$db_pass,$db_name);

//Error handler
if($con->connect_error){
	printf("Connect failed: %s\n",$mysqli->connect_error);
	exit;
}


?>
