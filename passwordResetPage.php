<?php
/**
 * Created by PhpStorm.
 * User: aBSicamara
 * Date: 10/11/2018
 * Time: 12:22 AM
 */
session_start();
require_once "inc/function.php";
require_once "inc/config.php";

$password = "";
$password_err = $confirm_password_err = "";

if (!empty($_SESSION['id']) AND $_SERVER['REQUEST_METHOD'] == 'POST'){


    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Entrez un mot de passe SVP.";
    } elseif(strlen(trim($_POST["password"])) < 8){
        $password_err = "Le mot de passe doit avoir au moins 8 characters.";
    } else{
        $password = strip_tags(trim($_POST["password"]));
    }


    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "confirmez le mot de passe SVP.";
    } else{
        $confirm_password = htmlspecialchars(trim($_POST["confirm_password"]));
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "La confirmation ne correspond pas";
        }
    }
    var_dump($password);

    if (empty($password_err) && empty($confirm_password_err)){


        $stmt = $pdo->prepare("UPDATE users SET password = :password, password_reset = :rstValue WHERE id = :userId ");

        $stmt->bindParam(":password", $param_passwordHash, PDO::PARAM_STR);
        $stmt->bindParam(":userId", $param_userId, PDO::PARAM_INT);
        $stmt->bindParam(":rstValue", $param_rstValue, PDO::PARAM_INT);

        $param_passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $param_userId = $_SESSION['id'];
        $param_rstValue = 0;

        if ($stmt->execute()){

            $_SESSION['flash']['success'] = "Votre mot de passe a été réinitialisé. Veuillez vous connecter avec votre nouveau mot de passe.";
            header("location: loginPage.php");
        }

        exit();
    }


}
?>

<?php 	require "inc/header.php"; ?>

    <div class="container-fluid">

    <?php	require "inc/navbar.php"; ?>




        <div id="mainWrapper" class="well">
            <div class="row">
                <div id="formContainer" class="col-md-4 col-md-offset-4">
                    <form action="#" method="post" autocomplete="off">
                        <div id="logo" style="text-align: center;" class="text-center">
                            <img  width="125px" src="public/img/logo_officiel.png">
                        </div>
                        <h2 class="text-center"> Réinitialisation</h2>
                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <input type="password" name="password" class="form-control" placeholder="Nouveau mot de passe">
                            <span class="text-default"> <?php echo $password_err ?> </span>

                        </div>

                        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                            <input type="password" name="confirm_password" class="form-control" placeholder="Confirmer le mot de passe">
                            <span class=" text-default"> <?php echo $confirm_password_err ?> </span>
                        </div>

                        <button class="btn btn-default btn-md"> Valider </button>
                        <br>
                        <br>
                        <!--						<a href="#"> mot de passe oublié ?</a>-->
                    </form>
                </div>
            </div>

        </div>





    </div>
