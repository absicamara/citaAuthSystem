<?php
// Include config file
require_once "inc/config.php";

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
                    $username_err = "This username is already taken.";
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
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = strip_tags(trim($_POST["password"]));
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = htmlspecialchars(trim($_POST["confirm_password"]));
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

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
            $email = (string) htmlspecialchars(trim($_POST['email']));
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
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($tel_err) && empty($fullName_err) && empty($email_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, fullname, email, tel) VALUES (:username, :password, :fullname, :email, :tel)";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":fullname", $param_fullname, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":tel", $param_tel, PDO::PARAM_STR);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_fullname = $fullName;
            $param_email = $email;
            $param_tel = $tel;


            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: adminCenter.php?opt=2");
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