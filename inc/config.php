<?php

// Define some contants

define('SERVER_NAME', 'localhost');
define('DB_NAME', 'mydb');
define('USER_NAME', 'root');
define('USER_PWD', '');

// Try connecting to MSQL

try {
	
	$pdo = new PDO("mysql:host=".SERVER_NAME.";dbname=".DB_NAME, USER_NAME, USER_PWD);

	// Set ERRMODE attribue
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch (Exception $e) {
	die("Une erreur s'est produite :". $e->getMessage() );
}
