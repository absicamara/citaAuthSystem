<?php
/**
 * Created by PhpStorm.
 * User: aBSicamara
 * Date: 10/7/2018
 * Time: 2:54 PM
 */

require "inc/function.php";

loggedCheck("admin");

if (!empty($_GET['userId'])){

    $userId = (int) $_GET['userId'];
    $username = $_GET['usr'];

    $user = getOneUser($userId);

    $stm = $pdo->prepare("UPDATE users SET password = :password, password_reset = :reset WHERE  id =".$user['id']);

    $stm->bindParam(":password", $param_password, PDO::PARAM_STR);
    $stm->bindParam(":reset", $param_password_reset, PDO::PARAM_INT);

    $gen_password = generatePass();
    $param_password = password_hash($gen_password, PASSWORD_DEFAULT);
    $param_password_reset = 1;

    if ($stm->execute()){

        sendMail($user['email'], "Nouveau votre mot de passe - ".$username, "Réinitialisez votre mot de passe avec ce mot de passe par défaut : <strong>". $gen_password ."</strong><br> Vous devez saisir votre nouveau mot de passe à la première connexion");
        header("location: adminCenter.php?opt=listUsers");

    }else{
        header("location: adminCenter.php?opt=listUsers");
    }


}

