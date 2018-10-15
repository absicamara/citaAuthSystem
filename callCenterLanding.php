<?php
/**
 * Created by PhpStorm.
 * User: aBSicamara
 * Date: 10/12/2018
 * Time: 12:53 AM
 */

require"inc/function.php";
loggedCheck("user");

require "inc/header.php";

?>

    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <?php	require "inc/navbar.php"; ?>
                <?php require "inc/flashMessages.php"; ?>
                <h1 class="text-center"> CALL CENTER </h1>

                <div id="mainWrapper2" class="well">


                    <div class="text-center " id="appLauncher">
                        <a  href="callCenterLanding.php" class="btn btn-info linkToModule"> DEMARRER</a>
                    </div>


                </div>

                <div id="loggedInAs">
                    <span class="pull-">Utilisateur -> <?php echo strtoupper($_SESSION['fullname']); ?></span>
                </div>
            </div>
        </div>


    </div>


<?php	require "inc/footer.php"; ?>
