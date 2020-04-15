<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/isset_session.php';

$title = $_SESSION['user_identify']['user'];

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

                <?php if (isset($_SESSION['completed'])) : ?>
                <li class="alert alert-success alert-dismissible d-inline-block mx-auto">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?=$_SESSION['completed']?>
                </li>
                <?php endif;?>


                <?php if (isset($_SESSION['errors'])) : ?>
                    <li class="alert alert-danger alert-dismissible d-inline-block mx-auto">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?=$_SESSION['errors']?>
                    </li>
                <?php endif;?>

                <li class="ml-auto d-inline-block mt-1 text-white">
                    <a href="../pages/my_user.php" class="btn btn-primary"><?=$_SESSION['user_identify']['user'];?></a>
                    <a data-toggle="modal" data-target="#settings" class="btn btn-primary"><i class="fas fa-sliders-h"></i></a>
                    <a href="../configs/logout.php" class="btn btn-primary"><i class="fas fa-sign-out-alt"></i></a>
                </li>

            </ul>
        </nav>

        <main>

            <h2>Autoinstallers</h2>
            <?php
            $autoinstallers = getsaveautoinstallers($db, $_SESSION['user_identify']['id']);
            if(!empty($autoinstallers)):
                while($autoinstaller = mysqli_fetch_assoc($autoinstallers)):
                    ?>

                    <p><?=$autoinstaller['name']?></p>

                    <div class="buttons">

                        <a href="../validate_data/downloadautoinstaller.php?id=<?=$autoinstaller['id']?>" class="btn btn-primary">Download Autoinstaller</a>
                        <a href="../validate_data/deleteautoinstaller.php?id=<?=$autoinstaller['id']?>" class="btn btn-primary">Delete Autoinstaller</a>
                        <a href="../validate_data/update_share.php?id=<?=$autoinstaller['id']?>" onclick="fcopy(<?=$autoinstaller['id']?>)" class="btn btn-primary" >Generate Link</a>

                    </div>

                    <input type="text" style="opacity: 0" id="<?=$autoinstaller['id']?>" value="https://www.linsetup.com/validate_data/downloadautoinstaller.php?id=<?=$autoinstaller['id']?>">

            <?php
                    endwhile;
                endif;
                ?>


            <?php if (!mysqli_num_rows($autoinstallers)): ?>
                <p>You haven't saved any autoinstallers yet</p>
            <?php endif; ?>

        </main>

        <ul class="footer list-unstyled">

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
