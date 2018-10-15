<?php

// Define some contants

define('SERVER_NAME', 'ec2-54-221-225-11.compute-1.amazonaws.com');
define('DB_NAME', 'd7jladfk880rdv');
define('USER_NAME', 'jimalhukeepbox');
define('USER_PWD', '7851584f4b3a78dedf3bc47069c036763c6b9d4c9628ace7c81446810679309f');

// Try connecting to MSQL

try {
	
	$pdo = new PDO("mysql:host=".SERVER_NAME."port=5432;dbname=".DB_NAME, USER_NAME, USER_PWD);

	// Set ERRMODE attribue
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch (Exception $e) {
	die("Une erreur s'est produite :". $e->getMessage() );
}
