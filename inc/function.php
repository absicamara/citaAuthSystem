<?php
/**
 * Created by PhpStorm.
 * User: aBSicamara
 * Date: 10/7/2018
 * Time: 2:41 PM
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

require_once "config.php";

function generatePass(){

    $token = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    $token =  str_shuffle(str_repeat($token, 2048));
    $token = substr($token, 0, 8);

    return $token;


}


function getOneUser($id){
    global $pdo;

    $stmt = $pdo->prepare("SELECT id, username, fullname, email, tel, userRole FROM users WHERE id = :id");
    // Bind variables to the prepared statement as parameters
    $stmt->bindParam(":id", $userId, PDO::PARAM_STR);
    $userId = (int) $id;

    $stmt->execute();
    $req = $stmt->fetch();

    return $req;

}


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


function sendMail($recipient, $subject, $body){

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'absidevtest@gmail.com';                 // SMTP username
        $mail->Password = 'absi0593';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('absicamara@gmail.com', 'Admin-Cita');
        $mail->addAddress($recipient);     // Add a recipient
//        $mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo('absicamara@gmail.com', 'Admin');
//        $mail->addCC('cc@example.com');
//        $mail->addBCC('bcc@example.com');

        //Attachments
//        $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body.'</b>';
//        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


        $mail->send();
            $_SESSION['flash']['success'] = "Un mail à été envoyé à l'utilisateur pour réinitialiser son mot de passe";

    } catch (Exception $e) {
        $_SESSION['flash']['danger'] = "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
        header("location: adminCenter.php?opt=listUsers");

    }

//    exit();

}
?>