<?php
require_once "inc/config.php";


function getUser($id){
    global $pdo;

    $stmt = $pdo->prepare("SELECT id, username, fullname, email, tel, userRole FROM users WHERE id = :id");
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $userId, PDO::PARAM_STR);
        $userId = (int) $id;

        $stmt->execute();
        $req = $stmt->fetch();

        return $req;

}