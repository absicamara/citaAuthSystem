<?php

require "config.php";

if (($_POST['username'] !== null AND ($_POST[pwd]) !==null)) {
	
	$usr = $_POST['username'];
	$pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);


	try {
		
	$rep = $pdo->prepare("INSERT INTO users(username, password) VALUES(:usr, :pwd)");
	$rep->execute(array(
		'usr' =>  $usr,
		'pwd' => $pwd ));
	header("Location: /php auth/public/adminCenter.php?opt=2");
	} catch (Exception $e) {
		echo $usr;
		die("Erreur pendant l'ajout de l'utilisateur". $e->getMessage());
	}


}