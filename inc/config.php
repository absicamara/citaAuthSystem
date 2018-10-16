<?php

// Define some contants

define('SERVER_NAME', 'jlg7sfncbhyvga14.cbetxkdyhwsb.us-east-1.rds.amazonaws.com	');
define('DB_NAME', 'y2v9pi0rf0z2u56o');
define('USER_NAME', 't2e00zbnzvu26qt5');
define('USER_PWD', 'oserwjl8z8fqn7c6');

// Try connecting to MSQL

try {
	
	$pdo = new PDO("mysql:host=".SERVER_NAME."port=3306;dbname=".DB_NAME, USER_NAME, USER_PWD);

	// Set ERRMODE attribue
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch (Exception $e) {
	die("Une erreur s'est produite :". $e->getMessage() );
}
