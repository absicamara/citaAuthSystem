i<?php
/**
 * Created by PhpStorm.
 * User: aBSicamara
 * Date: 9/30/2018
 * Time: 5:46 PM
 */
session_start();

//Checking the userRole;
require"inc/function.php";
loggedCheck("admin");

require_once "inc/config.php";

if (!empty($_GET['userId'])){
    $id = strip_tags(trim($_GET['userId']));
    $pdo->query("DELETE FROM users WHERE id =".$id);

    $_SESSION['flash']['success'] = "Utilisateur supprimé !!";

    header("Location: adminCenter.php?opt=listUsers");

}else{

    header("Location: adminCenter.php?opt=failure");
}