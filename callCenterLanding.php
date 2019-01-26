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
                <h1 class="text-center" id="callCenterTitle"> CALL CENTER </h1>

                <div id="callCenter" class="well">


                    <div class="text-center " id="appLauncher">
                        <a  href="queue-stats/index.php" class="btn btn-info linkToModule"> DEMARRER</a>
                    </div>


                </div>

                <div id="loggedInAs">
                    <span class="pull-">Utilisateur -> <?php echo strtoupper($_SESSION['fullname']); ?></span>
                </div>
            </div>
        </div>


    </div>


<?php	require "inc/footer.php"; ?>
<script type="text/javascript">
    (function() {

        var quotes = $("#callCenterTitle");
        var quoteIndex = -1;

        function showNextQuote() {
            ++quoteIndex;
            quotes.eq(quoteIndex % quotes.length)
                .fadeIn(2000)
                .delay(2000)
                .fadeOut(2000, showNextQuote);
        }

        showNextQuote();

    })();
</script>
