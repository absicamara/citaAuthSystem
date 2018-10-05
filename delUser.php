<?php
/**
 * Created by PhpStorm.
 * User: aBSicamara
 * Date: 9/30/2018
 * Time: 5:46 PM
 */

require_once "inc/config.php";

if (!empty($_GET['userId'])){
    $id = strip_tags(trim($_GET['userId']));
    $pdo->query("DELETE FROM users WHERE id =".$id);

    header("Location: adminCenter.php?opt=listUsers");

}else{

    header("Location: adminCenter.php?opt=failure");
}