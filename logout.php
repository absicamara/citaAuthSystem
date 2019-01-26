<?php
/**
 * Created by PhpStorm.
 * User: aBSicamara
 * Date: 9/29/2018
 * Time: 8:47 PM
 */

// Initialize the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page
header("location: loginPage.php");
exit;
