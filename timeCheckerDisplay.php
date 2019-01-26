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

                <div id="tableContainer">

                    <h2 class="text-center text-primary"> POINTAGE </h2>

                    <?php require "signUp.php";
                        $rep = $pdo->query("SELECT calldate, dst, lastapp, duration, uniqueid FROM cdr");

                    ?>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th class="text-center hidden-xs hidden-sm"> Calldate </th>
                        <th class="text-center"> Dst </th>
                        <th class="text-center hidden-xs hidden-sm"> Lastapp </th>
                        <th class="text-center"> duration </th>
                        <th class="text-center"> Uniqueid </th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($data = $rep->fetch()) { ?>
                        <tr class="text-center">
                            <td class="hidden-xs hidden-sm"> <?php echo $data['calldate']; ?> </td>
                            <td> <?php echo $data['dst']; ?> </td>
                            <td class="hidden-xs hidden-sm"> <?php echo $data['lastapp']; ?> </td>
                            <td class="hidden-xs hidden-sm"> <?php echo $data['duration']; ?> </td>
                            <td class="hidden-xs hidden-sm"> <?php echo $data['uniqueid']; ?> </td>


                        </tr>
                    <?php } ?>
                    </tbody>
                    <tfoot>
                        <th class="text-center hidden-xs hidden-sm"> Calldate </th>
                        <th class="text-center"> Dst </th>
                        <th class="text-center hidden-xs hidden-sm"> Lastapp </th>
                        <th class="text-center"> duration </th>
                        <th class="text-center"> Uniqueid </th>

                    </tfoot>
                    </table>

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