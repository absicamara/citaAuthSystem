<?php
/**
 * Created by PhpStorm.
 * User: aBSicamara
 * Date: 10/2/2018
 * Time: 4:17 PM
 */

require "inc/config.php";

function loggedCheck($allowedRole = "admin"){
    if (session_status() == PHP_SESSION_NONE){
        session_start();
    }

    if(!isset($_SESSION['loggedin']) && $_SESSION["loggedin"] !== true) {
        header("location: loginPage.php");
        exit;
    }

    if ($allowedRole === "admin" AND $_SESSION['userRole'] !== "admin"){

        $_SESSION['flash']['danger'] = "Vous n'êtes pas autorisé à accéder à cette page";
        header("Location: /accounts");

        exit();
    }
}
