<?php
    require"func/loggedInCheck.php";

    loggedCheck("user");


?>

<?php require "inc/header.php"; ?>

	<div class="container-fluid">
		
		<?php	require "inc/navbar.php"; ?>

        <?php if (!empty($_SESSION['flash']['danger'])){ ?>
        <div class="alert alert-danger">
            <ul>
                <li><?php echo $_SESSION['flash']['danger']; ?> </li>
            </ul>
        </div>
            <?php unset($_SESSION{'flash'}); ?>
        <?php } ?>

		<div id="mainWrapper" class="well">
			<h1 class="text-center"> BIENVENUE SUR LA PLATEFORME CALL-CENTER </h1>

			<p class="text-center">
				<img class="imgage-responsive" src="public/img/logo_officiel.png">
			</p>

			<div class="text-center">
			<a  href="#" class="btn btn-default linkToModule"> CRM</a>
			<a  href="#" class="btn btn-default linkToModule"> CALL-CENTER</a>
			</div>
            <br>

            <marquee> <span id="citaAc"> CENTRE INTERNATIONAL DE TELECOMMUNICATIONS APPLIQUEES</span></marquee>
		</div>

	</div>

		<?php	require "inc/footer.php"; ?>
