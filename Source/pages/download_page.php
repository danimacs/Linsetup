<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/functions.php';

if (empty($_SESSION['clickeds'])){
    header('Location: ../index.php');
    die();
}

$title = "Download Page";

?>
<!DOCTYPE html>
<html lang="en">

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/resources/php-requires/meta.php'; ?>

    <body class="container">

        <nav class="navbar navbar-expand-sm mt-5 mb-3 p-0">

            <ul class="nav list-unstyled w-100">

                <li class="d-inline-block">
                    <h1><a href="../index.php">LINSETUP</a></h1>
                </li>

                <li class="ml-auto d-inline-block mt-1 text-white">

                    <?php if (isset($_SESSION['user_identify'])): ?>
                        <a href="../pages/my_user.php" class="btn btn-primary"><?=$_SESSION['user_identify']['user'];?></a>
                        <a data-toggle="modal" data-target="#settings" class="btn btn-primary"><i class="fas fa-sliders-h"></i></a>
                        <a href="../configs/logout.php" class="btn btn-primary"><i class="fas fa-sign-out-alt"></i></a>
                    <?php endif; ?>

                    <?php if (!isset($_SESSION['user_identify'])): ?>
                        <a data-toggle="modal" data-target="#signin" class="btn btn-primary">Sign in</a>
                        <a data-toggle="modal" data-target="#login" class="btn btn-primary">Login</a>
                    <?php endif; ?>

                </li>

            </ul>
        </nav>


        <div class="jumbotron mt-5 py-5">
            <h2>How to install</h2>
            <p>
                Open a terminal in download folder<br>
                chmod +x linsetup_autoinstaller.sh && yes | ./linsetup_autoinstaller.sh
            </p>
        </div>

        <div class="list-unstyled">
            <?php
            if (isset($_SESSION['clickeds']['commands'])):
                $commands = $_SESSION['clickeds']['commands'];
                $long_commands = count($commands) -1;
                $txt = null;
                for ($i = 0; $i <= $long_commands; $i++):
                    $txt .= $commands[$i] . "\n";
            ?>
                <img width="18px" alt="Default Logo" src="../resources/img/logos/default-logo.png?>">
                <label class="list-unstyled"><?=$commands[$i]?></label><br/>
            <?php
                endfor;
            endif;
            ?>
            
            <?php
            $long = count($_SESSION['clickeds']['software']) -1;
            $names = null;
            for ($i = 0; $i <= $long; $i++):
                $namesclickeds = searcherPacketsFromID($db, $_SESSION['clickeds']['software'][$i]);
                $nameclickeds = mysqli_fetch_assoc($namesclickeds);
            ?>
                <div class="list-unstyled">
                    <img width="18px" alt="<?=$software['name'] . " Logo"?>" src="../resources/img/logos/<?=$nameclickeds['logo']?>">
                    <label class="list-unstyled"><?=$nameclickeds['name']?></label>
                </div>
            <?php
            endfor;
            unset($_SESSION['clickeds']);
            ?>
    </div>

    <a href="../validate_data/linsetup_autoinstaller.sh" class="btn btn-primary mt-3" download>Download Autoinstaller</a>
    
    <ul class="footer list-unstyled mt-5">

        <li>
            <a href="../pages/terms_and_conditions.php">Terms and Conditions</a>
        </li>

        <li>
            <a href="../pages/cookies_policy.php" target="_blank">Cookies Policy</a>
        </li>

        <li>
            <a href="https://github.com/danielmac03/Linsetup" target="_blank">Github</a>
        </li>

    </ul>
        
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/resources/php-requires/modals.php'; ?>

    <?php deleteErrors(); ?>

    </body>
</html>
