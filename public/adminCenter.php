<?php
	require "partials/header.php";
?>

	<div class="container">
		
		<?php	require "partials/navbar.php"; ?>

		<div class="well" style="padding-right: 30px;">
			

					<h1 style="padding-top: 0"> ADMIN CENTER</h1>
			<div class="row">
				<div class="col-md-4">
					<div class="list-group">
						<a class="list-group-item list-group-item-action active">  OPTIONS </a>
						<a href="/php auth/public/adminCenter.php?opt=1" class="list-group-item list-group-item-action">  Créer Utilisateurs </a>
						<a class="list-group-item list-group-item-action disabled">  List Utilisateurs </a>
						
						<a class="list-group-item list-group-item-action disabled"> Permissions </a>
						<a class="list-group-item list-group-item-action disabled"> Paramètres </a>
					</div>	
				</div>
				<div class="col-md-8" style="background: white;">
					<div id="displayContainer">

						<?php if (!empty($_GET['opt']) AND $_GET['opt'] == 1) { ?>
							<form action="../private/signUp.php" method="post" autocomplete="off">

								<h2 class="text-center"> Nouvel utilisateur</h2>
								<div class="form-group">
									<!-- <label>Login</label> -->
									<input type="text" name="username" class="form-control" placeholder="Nom d'utilisateur">
								</div>
									
								<div class="form-group">
									<!-- <label>Mot de passe</label> -->
									<input type="Password" name="pwd" class="form-control" placeholder="Mot de passe">
								</div>

								<div class="form-group">
									<!-- <label>Confirmer Mot de passe</label> -->
									<input type="Password" name="pwd2" class="form-control" placeholder="Confirmer le mot de passe">
								</div>

								<button class="btn btn-primary btn-lg"> Valider </button>
								<br>
								<br>
							</form>
						<?php } else if (!empty($_GET['opt']) AND $_GET['opt'] == 2) { ?>

							<h1 class="text-center text-danger"> Utilisateurs Crée avec succès </h1>
					
						<?php } else{ ?>
							<h1 class="text-center text-danger"> 404 </h1>
							<p class="text-center">Option indisponible</p>
						<?php } ?>
						
					</div>
				</div>
			</div>

		</div>

	</div>

		<?php	require "partials/footer.php"; ?>
