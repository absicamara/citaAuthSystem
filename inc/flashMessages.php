<?php
/**
 * Created by PhpStorm.
 * User: aBSicamara
 * Date: 10/12/2018
 * Time: 12:57 AM
 */


     if (!empty($_SESSION['flash']['danger'])){ ?>

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


