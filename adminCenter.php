<?php
session_start();

require"func/loggedInCheck.php";
require "func/getUser.php";

loggedCheck("admin");

    require "signUp.php";

?>
<?php
	require "inc/header.php";

?>

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


		<div class="well" style="padding-right: 30px;">
			

					<h1 style="padding-top: 0"> ADMIN CENTER</h1>
			<div class="row">
				<div class="col-md-4">
					<div class="list-group">
						<a class="list-group-item list-group-item-action active">  OPTIONS </a>
						<a href="adminCenter.php?opt=addUser" class="list-group-item list-group-item-action">  Ajouter Utilisateurs </a>
						<a href="adminCenter.php?opt=listUsers" class="list-group-item list-group-item-action">  List Utilisateurs </a>
						
						<a class="list-group-item list-group-item-action disabled"> Permissions </a>
						<a class="list-group-item list-group-item-action disabled"> Paramètres </a>
					</div>	
				</div>
				<div id="whitePane" class="col-md-8">
					<div id="displayContainer">

						<?php if (!empty($_GET['opt']) AND $_GET['opt'] == "addUser") { ?>


                            <div id="formSizer">
                                <form action="#" method="post" autocomplete="off">

								<h2 class="text-center"> Nouvel utilisateur</h2>
								<div class="form-group">
									<!-- <label>Login</label> -->
									<input type="text" name="username" class="form-control" placeholder="Login" required>
                                    <span class="help-block text-danger"> <?php echo $username_err ?> </span>
								</div>

                                <div class="form-group">
                                    <!-- <label>Mot de passe</label> -->
                                    <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
                                    <span class="help-block text-danger"> <?php echo $password_err ?> </span>
                                </div>

                                <div class="form-group">
                                    <!-- <label>Confirmer Mot de passe</label> -->
                                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirmer le mot de passe" required>
                                    <span class="help-block text-danger"> <?php echo $confirm_password_err ?> </span>
                                </div>

                                <div class="form-group">
                                    <!-- <label>Login</label> -->
                                    <input type="text" name="fullName" class="form-control" placeholder="Nom & Prénom" required>
                                    <span class="help-block text-danger"> <?php echo $fullName_err ?> </span>
                                </div>


                                <div class="form-group">
                                    <!-- <label>Login</label> -->
                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                    <span class="help-block text-danger"> <?php echo $email_err ?> </span>
                                </div>

                                <div class="form-group">
                                    <!-- <label>Login</label> -->
                                    <input type="tel" name="tel" class="form-control" placeholder="Tel">
                                    <span class="help-block text-danger"> <?php echo $tel_err ?> </span>
                                </div>



								<button class="btn btn-primary btn-md"> Valider </button>
								<button type="reset" class="btn btn-default btn-md"> Effacer </button>
								<br>
								<br>
							</form>
                            </div>

                        <?php } else if (!empty($_GET['opt']) AND $_GET['opt'] == "editUser") { ?>
                            <div id="formSizer">

                                <?php $data = getUser($_GET['userId']); ?>

                                <form class="" action="updateUser.php" method="post" autocomplete="off">

                                    <h2 class="text-center"> Modifier utilisateur</h2>
                                    <input type="hidden" name="userId" value="<?php echo $_GET['userId']; ?>">
                                    <div class="form-group">
                                        <!-- <label>Login</label> -->
                                        <label for="username"> Login</label>
                                        <input type="text" name="username" class="form-control"  value="<?php echo $data['username']; ;?>" required>
                                        <span class="help-block text-danger"> <?php echo $username_err ?> </span>
                                    </div>

                                    <div class="form-group">
                                        <label for="fullname"> Nom & Prénom</label>
                                        <input type="text" name="fullName" class="form-control" value="<?php echo $data['fullname']; ;?>" required>
                                        <span class="help-block text-danger"> <?php echo $fullName_err ?> </span>
                                    </div>


                                    <div class="form-group">
                                        <label for="email"> Email </label>
                                        <input type="email" name="email" class="form-control" value="<?php echo $data['email']; ;?>" required>
                                        <span class="help-block text-danger"> <?php echo $email_err ?> </span>
                                    </div>

                                    <div class="form-group">
                                        <label for="tel"> Tel </label>
                                        <input type="tel" name="tel" class="form-control" value="<?php echo $data['tel']; ;?>">
                                        <span class="help-block text-danger"> <?php echo $tel_err ?> </span>
                                    </div>
                                    <fieldset>
                                        <legend> Autorisation </legend>

                                        <div class="form-group">
                                            <label for="tel"> Niveau </label>
                                            <select name="userRole" class="form-control" style="width: 50%">
                                                <option value="user"> User </option>
                                                <option value="admin"> admin </option>
                                            </select>
                                            <span> Niveau Actuel : <?php echo $data['userRole']; ?></span>
                                        </div>
                                    </fieldset>


                                    <input type="submit" class="btn btn-success btn-md" value="Valider">
                                    <a  class="btn btn-primary btn-md "> Réinitialiser mot de passe </a>
                                        <a href="delUser.php?userId=<?php echo $data['id']; ?>" class="pull-right btn btn-danger btn-md"> Supprimer le compte </a>


                                        <br>
                                        <br>
                                </form>
                            </div>

						<?php } else if (!empty($_GET['opt']) AND $_GET['opt'] == 2) { ?>

							<h1 class="text-center text-success"> Succès !! </h1>

                        <?php } else if (!empty($_GET['opt']) AND $_GET['opt'] == 'listUsers') { ?>

                            <h2 class="text-center text-primary"> Utilisateurs </h2>

                            <?php require "signUp.php";
                                $rep = $pdo->query("SELECT id, username, fullname, email, tel FROM users");

                            ?>
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th class="text-center"> Login </th>
                                <th class="text-center"> Nom & Prénom </th>
                                <th class="text-center"> Email </th>
                                <th class="text-center"> Tel </th>
                                <th class="text-center"> Actions </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php while ($data = $rep->fetch()) { ?>
                                <tr>
                                    <td> <?php echo $data['username']; ?> </td>
                                    <td> <?php echo $data['fullname']; ?> </td>
                                    <td> <?php echo $data['email']; ?> </td>
                                    <td> <?php echo $data['tel']; ?> </td>
                                    <td>
                                        <a href="delUser.php?userId=<?php echo $data['id']; ?>" class="btn btn-danger"> Supprimer </a>
                                        <a href="adminCenter.php?opt=editUser&userId=<?php echo $data['id']; ?>" class="btn btn-success"> Modifier </a>

                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                            <tfoot>
                                <th class="text-center"> Login </th>
                                <th class="text-center"> Nom & Prénom </th>
                                <th class="text-center"> Email </th>
                                <th class="text-center"> Tel </th>
                                <th class="text-center"> Actions </th>
                            </tfoot>
                        </table>


                        <?php } else if (!empty($_GET['opt']) AND $_GET['opt'] == 'failure') { ?>
                            <h1 class="text-center text-danger"> Une Erreur s'est produite !! </h1>
						<?php } else{ ?>
                            <h1 class="text-success text-center"> Bienvenue Admin !! </h1>
						<?php } ?>
						
					</div>
				</div>
			</div>

		</div>

	</div>

		<?php	require "inc/footer.php"; ?>
