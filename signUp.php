<?php
// Include config file
require_once "inc/config.php";
require_once "inc/function.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = $fullName = $email = $tel = "";
$username_err = $password_err = $confirm_password_err = $fullName_err = $email_err = $tel_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
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
                if($stmt->rowCount() == 1){
                    $username_err = "Ce nom d'utilisateur est déjà prise.";
                } else{
                    $username = htmlspecialchars(trim($_POST["username"]));
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Validate password
//    if(empty(trim($_POST["password"]))){
//        $password_err = "Entrez un mot de passe SVP.";
//    } elseif(strlen(trim($_POST["password"])) < 8){
//        $password_err = "Le mot de passe doit avoir au moins 8 characters.";
//    } else{
//        $password = strip_tags(trim($_POST["password"]));
//    }

    // Validate confirm password
//    if(empty(trim($_POST["confirm_password"]))){
//        $confirm_password_err = "confirmez le mot de passe SVP.";
//    } else{
//        $confirm_password = htmlspecialchars(trim($_POST["confirm_password"]));
//        if(empty($password_err) && ($password != $confirm_password)){
//            $confirm_password_err = "La confirmation ne correspond pas";
//        }
//    }

    //validate fullName

    if (empty(trim($_POST['fullName']))){
        $fullName_err = "Veuillez renseigner ce champ";
    }else{
        if (preg_match("#^[a-zA-Z]+([ ]{1}[a-zA-Z]+)+#", $_POST['fullName'])) {
            $fullName = (string)htmlspecialchars(trim($_POST['fullName']));
        }else{
            $fullName_err = "Format non valide";

        }
    }

    // Validate email format
    if (empty(trim($_POST['email']))){
        $email_err = "Veuillez renseigner ce champ";
    }else{
        if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])){

            // Prepare a select statement
            $sql = "SELECT id FROM users WHERE email = :email";

            if($stmt = $pdo->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);

                // Set parameters
                $param_email = trim($_POST["email"]);

                // Attempt to execute the prepared statement
                if($stmt->execute()) {
                    if ($stmt->rowCount() == 1) {
                        $email_err = "Cette adresse mail est déjà utilisée.";
                    } else {
                        $email = (string) trim($_POST['email']);
                    }
                }
            }
        }else{
            $email_err = "Format d'addresse mail non valide";
        }
    }

    // Validate tel format
    if (empty(trim($_POST['tel']))){
        $tel_err= "Veuillez renseigner ce champ";
    }else{
        if (preg_match("#^[0-9+][0-9]+$#", $_POST['tel'])){

            $tel = htmlspecialchars(trim($_POST['tel']));
            $tel = preg_replace("#\+#", "00", $tel);
        }else{
            $tel_err = "Format incorrecte. ex: 775717682/ +221775717682";
        }
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($tel_err) && empty($fullName_err) && empty($email_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, fullname, email, tel, userRole, password_reset) VALUES (:username, :password, :fullname, :email, :tel, :userRole, :password_reset)";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":fullname", $param_fullname, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":tel", $param_tel, PDO::PARAM_STR);
            $stmt->bindParam(":userRole", $param_userRole, PDO::PARAM_STR);
            $stmt->bindParam(":password_reset", $param_password_reset, PDO::PARAM_STR);

            // Set parameters
            $param_username = $username;
            $gen_password = generatePass();
            $param_password = password_hash($gen_password, PASSWORD_DEFAULT); // Creates a password hash
            $param_fullname = $fullName;
            $param_email = $email;
            $param_tel = $tel;
            $param_userRole = "user";
            $param_password_reset = 1;


            // Attempt to execute the prepared statement
            if($stmt->execute()){

                // sending generated password to user mail
                sendMail($param_email, " Mot de passe - ".$param_username, "Votre login est: ".$param_username."<br> Votre mot de passe est: ".$gen_password);
                $_SESSION['flash']['success'] = "Utilisateur enregistré. Mot de passe envoyé par mail à l'utilisateur. !!";
                // Redirect to login page
                header("location: adminCenter.php?opt=listUsers");
                exit();
            } else{
                echo "Une erreur s'est produite.";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Close connection
    unset($pdo);
}
?>