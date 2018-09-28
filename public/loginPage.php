<?php
	require "partials/header.php";
?>

	<div class="container">
		
		<?php	require "partials/navbar.php"; ?>

		<div class="well">
			<div class="row">
				<div id="formContainer" class="col-md-4 col-md-offset-4">
					<form action="../private/login.php" method="post" autocomplete="off">
						<div id="logo" style="text-align: center;" class="text-center">
							<img  width="125px" src="img/logoPlaceholder.png">
						</div>
						<h2 class="text-center"> Connexion</h2>
						<div class="form-group">
							<label>Login</label>
							<input type="text" name="username" class="form-control">
						</div>
							
						<div class="form-group">
							<label>Password</label>
							<input type="Password" name="pwd" class="form-control">
						</div>

						<button class="btn btn-primary btn-lg"> Valider </button>
						<br>
						<br>
						<a href="#"> mot de passe oublié ?</a>
					</form>
				</div>
			</div>
			
		</div>

	</div>

		<?php	require "partials/footer.php"; ?>
