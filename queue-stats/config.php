<?php
require_once("dblib.php");
require_once("misc.php");

$dbhost = 'localhost';
$dbname = 'qstatslite';
$dbuser = 'root';
$dbpass = 'ousseynou';
$manager_host   = "127.0.0.1";
$manager_user   = "admin";
$manager_secret = "ousseynou";
$language = "fr";

require_once("lang/$language.php");

$midb = conecta_db($dbhost,$dbname,$dbuser,$dbpass);
$self = $_SERVER['PHP_SELF'];

$DB_DEBUG = false; 

session_start();
header('content-type: text/html; charset: utf-8'); 

?>


