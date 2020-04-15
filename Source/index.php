<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/connection.php';

$title = "Install more software at once on Linux";

?>

<!DOCTYPE html>
<html lang="en">

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/resources/php-requires/meta.php'; ?>

    <body class="container">

        <nav class="navbar navbar-expand-sm mt-5 mb-3 p-0">

            <ul class="nav list-unstyled w-100">

                <li class="d-inline-block">
                    <h1><a href="index.php">LINSETUP</a></h1>
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

                <?php if (isset($_SESSION['errors_login'])) : ?>
                    <li class="alert alert-danger alert-dismissible d-inline-block mx-auto">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?=$_SESSION['errors_login']?>
                    </li>
                <?php endif;?>

                <li class="ml-auto d-inline-block mt-1 text-white">

                    <?php if (isset($_SESSION['user_identify'])): ?>
                        <a href="pages/my_user.php" class="btn btn-primary"><?=$_SESSION['user_identify']['user'];?></a>
                        <a data-toggle="modal" data-target="#settings" class="btn btn-primary"><i class="fas fa-sliders-h"></i></a>
                        <a href="configs/logout.php" class="btn btn-primary"><i class="fas fa-sign-out-alt"></i></a>
                    <?php endif; ?>

                    <?php if (!isset($_SESSION['user_identify'])): ?>
                        <a data-toggle="modal" data-target="#signin" class="btn btn-primary">Sign in</a>
                        <a data-toggle="modal" data-target="#login" class="btn btn-primary">Login</a>
                    <?php endif; ?>

                </li>

            </ul>
        </nav>

        <form method="POST" action="../validate_data/createautoinstaller.php" class="p-0">

            <div class="row pl-4">

            <?php 
            for($i = 0; $i <= 2; $i++):
                $searcherCategories = "searcherCategories" . $i;
                $categories[$i] = $searcherCategories($db);
            ?>

                <div class="col-md-4">

                    <?php while($category = mysqli_fetch_assoc($categories[$i])): ?>

                        <ul class="p-0">
                            
                            <h2 class="categories"><?=$category['name']?></h2>

                            <?php
                            $softwares = getSoftware($db, $category['id']);
                            while($software = mysqli_fetch_assoc($softwares)):
                            ?>

                            <li class="list-unstyled">
                                <input type="checkbox" name="<?=$software['id']?>">
                                <img width="18px" alt="<?=$software['name'] . " Logo"?>" src="/resources/img/logos/<?=$software['logo']?>">
                                <label class="list-unstyled"><?=$software['name']?></label>
                            </li>

                            <?php endwhile; ?>
                        
                        </ul>

                    <?php endwhile; ?>

                </div>

            <?php endfor; ?>

            </div>

            <div class="form-group">
                <label>Custom commands:</label>
                <textarea class="form-control" name="commands" placeholder="sudo apt install htop"></textarea>
            </div>

            <?php if (isset($_SESSION['user_identify'])): ?>

                <div class="form-group">
                    <label for="save_autoinstaller">If you put a name the autoinstaller will be saved:</label>
                    <input type="text" name="save_autoinstaller" class="form-control"/><br/>
                </div>

            <?php endif; ?>

            <input type="submit" value="Download Autoinstaller" class="btn btn-primary btn-block">

        </form>

        <div class="alert alert-warning alert-dismissible mt-3">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <label>This site use cookies more in <a href="/about/cookies_policy.php">Cookies Policy</a></label>
        </div>

        <ul class="footer list-unstyled">

            <li>
                <a href="/pages/terms_and_conditions.php" target="_blank">Terms and Conditions</a>
            </li>

            <li>
                <a href="/pages/cookies_policy.php" target="_blank">Cookies Policy</a>
            </li>

            <li>
                <a href="https://github.com/danielmac03/Linsetup" target="_blank">Github</a>
            </li>

        </ul>
        
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/resources/php-requires/modals.php'; ?>

        <?php deleteErrors(); ?>

    </body>

</html>
