<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="/accounts">CITA - CALLCENTER</a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		        <!-- <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li> -->

		        
		      </ul>
		      
		      <ul class="nav navbar-nav navbar-right">
                  <li><a href="index.php">Accueil</a></li>

                  <?php  if(!isset($_SESSION['loggedin'])) { ?>
    		        <li><a href="loginPage.php">Connexion</a></li>
                  <?php } ?>

                  <?php  if(isset($_SESSION['loggedin']) && $_SESSION["loggedin"] === true) { ?>
<!--                      <li><a href="#"><li>--><?php //echo $_SESSION['fullname']; ?><!--</li></a></li>-->


                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Applications <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                              <li><a href="callCenterLanding.php">Call center</a></li>
                              <li><a href="timeCheckerLanding.php">Pointage</a></li>

                          </ul>
                      </li>
                      <?php if( $_SESSION["userRole"] === "admin") { ?>
                          <li><a href="adminCenter.php">Admin</a></li>
                      <?php } ?>
                      <li><a href="logout.php">Se déconnecter</a></li>

                  <?php } ?>


		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
