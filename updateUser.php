<?php
/**
 * Created by PhpStorm.
 * User: aBSicamara
 * Date: 10/5/2018
 * Time: 9:36 PM
 */

session_start();
// Include config file
require_once "inc/config.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = $fullName = $email = $tel = "";
if(!empty($_POST['userId'])){

    $userId = (int) $_POST['userId'];
}else{
    $_SESSION['flash']['danger'] = "Erreur";
}

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
        $_SESSION['flash']['danger'] = "Veuillez remplir tous les champs";
        header("location: /accounts/adminCenter.php?opt=editUser&userId=".$_POST['userId']);
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = :username";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                $dd = $stmt->fetch();
                if($stmt->rowCount() == 1  && ($dd['id'] != $userId)){
                    $_SESSION['flash']['danger'] = "Ce nom d'utilisateur est déjà utilisé";
                    header("location: /accounts/adminCenter.php?opt=editUser&userId=".$_POST['userId']);
                }else{
                    $username = $_POST['username'];
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);
    }


    //validate fullName

    if (empty(trim($_POST['fullName']))){
        $_SESSION['flash']['danger'] = "Veuillez remplir tous les champs";
        header("location: /accounts/adminCenter.php?opt=editUser&userId=".$_POST['userId']);
    }else{
        if (preg_match("#^[a-zA-Z]+([ ]{1}[a-zA-Z]+)+#", $_POST['fullName'])) {
            $fullName = (string)htmlspecialchars(trim($_POST['fullName']));
        }else{
            $_SESSION['flash']['danger'] = "Entrez nom et prénom.";
            header("location: /accounts/adminCenter.php?opt=editUser&userId=".$_POST['userId']);
        }
    }

    // Validate email format
    if (empty(trim($_POST['email']))){
        $_SESSION['flash']['danger'] = "Veuillez remplir tous les champs";
        header("location: /accounts/adminCenter.php?opt=editUser&userId=".$_POST['userId']);
    }else{
        if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])){
            $email = (string) htmlspecialchars(trim($_POST['email']));
        }else{
            $_SESSION['flash']['danger'] = "Format Email incorrecte";
            header("location: /accounts/adminCenter.php?opt=editUser&userId=".$_POST['userId']);
        }
    }

    // Validate tel format
    if (empty(trim($_POST['tel']))){
        $_SESSION['flash']['danger'] = "Veuillez remplir tous les champs";
        header("location: /accounts/adminCenter.php?opt=editUser&userId=".$_POST['userId']);
    }else{
        if (preg_match("#^[0-9+][0-9]+$#", $_POST['tel'])){
            $tel = htmlspecialchars(trim($_POST['tel']));
            $tel = preg_replace("#\+#", "00", $tel);
        }else{
            $_SESSION['flash']['danger'] = "Format incorrecte. ex: 775717682/ +221775717682";
            header("location: /accounts/adminCenter.php?opt=editUser&userId=".$_POST['userId']);
        }
    }

    // Validate userRole format
    if (empty(trim($_POST['userRole']))){
        $_SESSION['flash']['danger'] = "Veuillez remplir tous les champs";
        header("location: /accounts/adminCenter.php?opt=editUser&userId=".$_POST['userId']);
    }else{
        if ($_POST['userRole'] === "user" || $_POST['userRole'] === "admin"){
            $userRole = $_POST['userRole'];
        }else{
            $_SESSION['flash']['danger'] = "Erreur sur le champ Niveau";
            header("location: /accounts/adminCenter.php?opt=editUser&userId=".$_POST['userId']);
        }
    }


        // Prepare an insert statement
        $sql = "UPDATE users SET username = :username, fullname = :fullName, email = :email, tel = :tel, userRole = :userRole WHERE id =".$userId;

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":fullName", $param_fullname, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":tel", $param_tel, PDO::PARAM_STR);
            $stmt->bindParam(":userRole", $param_userRole, PDO::PARAM_STR);

            // Set parameters
            $param_username = $username;
            $param_fullname = $fullName;
            $param_email = $email;
            $param_tel = $tel;
            $param_userRole = $userRole;


            // Attempt to execute the prepared statement
            if($stmt->execute()){

                $_SESSION['flash']['success'] = "Utilisateur enregistré !!";
                // Redirect to login page
                $_SESSION['flash']['success'] = "Modification effectuée";
                header("location: adminCenter.php?opt=editUser&userId=".$_POST['userId']);
                exit();
            } else{
                echo "Une erreur s'est produite.";
            }
        }

        // Close statement
        unset($stmt);


    // Close connection
    unset($pdo);
}
?>