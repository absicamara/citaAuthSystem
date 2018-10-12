
<?php
    require "login.php";
?>

<?php	require "inc/header.php"; ?>

	<div class="container-fluid">
		
		<?php	require "inc/navbar.php"; ?>

        <?php if (!empty($_SESSION['flash']['danger'])){ ?>

        <div class="alert alert-danger">
            <ul>
                <li><?php echo $_SESSION['flash']['danger']; ?> </li>
            </ul>
        </div>

            <?php unset($_SESSION{'flash'}); }?>


        <?php if (!empty($_SESSION['flash']['success'])){ ?>

            <div class="alert alert-success">
                <ul>
                    <li><?php echo $_SESSION['flash']['success']; ?> </li>
                </ul>
            </div>

            <?php unset($_SESSION{'flash'}); }?>

		<div id="mainWrapper" class="well">
			<div class="row">
				<div id="formContainer" class="col-md-4 col-md-offset-4">
					<form action="#" method="post" autocomplete="off">
						<div id="logo" style="text-align: center;" class="text-center">
							<img  width="125px" src="public/img/logo_officiel.png">
						</div>
						<h2 class="text-center"> Connexion</h2>
						<div class="form-group">
							<label>Login</label>
							<input type="text" name="username" class="form-control">
                            <span class="help-block text-danger"> <?php echo $username_err ?> </span>

                        </div>

                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                            <span class="help-block text-danger"> <?php echo $password_err ?> </span>
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

		<?php	require "inc/footer.php"; ?>
