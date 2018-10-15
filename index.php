<?php

    // server should keep session data for AT LEAST 1 hour
    ini_set('session.gc_maxlifetime', 1);

    // each client should remember their session id for EXACTLY 1 hour
    session_set_cookie_params(3600);

    session_start(); // ready to go!

    require"func/loggedInCheck.php";

    loggedCheck("user");


?>

<?php require "inc/header.php"; ?>

	<div class="container">
		


        <div class="row">

		    <div class="col-md-12">
                <?php	require "inc/navbar.php"; ?>

                <?php require "inc/flashMessages.php"; ?>

                <div id="mainWrapper" class="well">

                    <h1 class="text-center"> BIENVENUE SUR LA PLATEFORME CALL-CENTER </h1>

                    <p class="text-center">
                        <img class="imgage-responsive" src="public/img/logo_officiel.png">
                    </p>

                    <div class="text-center">
                        <a  href="callCenterLanding.php" class="btn btn-default linkToModule"> CALL-CENTER</a>
                        <a  href="#" class="btn btn-default linkToModule"> POINTAGE</a>
                    </div>
                    <br>

                    <marquee> <span id="citaAc"> CENTRE INTERNATIONAL DE TELECOMMUNICATIONS APPLIQUEES</span></marquee>
                </div>

                <div id="loggedInAs">
                    <span class="pull-">Utilisateur -> <?php echo strtoupper($_SESSION['fullname']); ?></span>
                </div>
            </div>

        </div>


	</div>

		<?php	require "inc/footer.php"; ?>
