<?php
include_once './configs/functions.php';
include_once './configs/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once './configs/meta.php'; ?>
        <title>LINSETUP</title>
    </head>
    <body class="container">

        <nav class="navbar navbar-expand-sm bg-dark navbar-light">

            <ul class="list-unstyled">

                <li class="nav-item">
                    <h1><a href="./index.php" class="nav-link">LINSETUP</a></h1>
                </li>


               <?php if (isset($_SESSION['user_identify'])): ?>
                 <li class="nav-item text-right">
                    <a href="user/my_user.php" class="nav-link"><?=$_SESSION['user_identify']['user'];?></a>
                    <a href="user/my_data.php" class="nav-link">Settings</a>
                    <a href="./configs/logout.php" class="nav-link">Sign Off</a>
                </li>
                <?php endif; ?>

                <?php if (!isset($_SESSION['user_identify'])): ?>
                <li class="nav-item text-right">
                    <a href="pages/signin.php" class="btn btn-primary">Sign in</a>
                    <a href="pages/login.php" class="btn btn-primary">Login</a>
                </li>
                <?php endif; ?>
            </ul>
        </nav>

        <?php if (isset($_SESSION['completed'])) : ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?=$_SESSION['completed']?>
            </div>
        <?php endif;?>


        <?php if (isset($_SESSION['errors'])) : ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?=$_SESSION['errors']?>
            </div>
        <?php endif;?>

        <form method="POST" action="./validate_data/autoinstaller/createautoinstaller.php">
            <div class="row">
                <div class="col-md-6">
                    <?php
                    $categorieshead = searcherCategorieshead($db);
                    if (!empty($categorieshead)):
                                while($categoryhead = mysqli_fetch_assoc($categorieshead)):
                                    $altlogo = explode(".", $software['name']);
                                    $altlogo = $altlogo[0];
                                    $altlogo = $altlogo . " Logo";
                                    ?>
                                    <ul class="homepage-app-section">
                                    <h4><?=$categoryhead['name']?></h4>
                                    <?php
                                    $softwares = getSoftware($db, $categoryhead['id']);
                                    if (!empty($softwares)):
                                    while($software = mysqli_fetch_assoc($softwares)):
                                    ?>

                                    <li class="list-unstyled">
                                        <input type="checkbox" name="<?=$software['id']?>">
                                        <img width="18px" alt="<?=$altlogo?>" src="./resources/img/logos/<?=$software['logo']?>">
                                        <label class="list-unstyled"><?=$software['name']?></label>
                                    </li>

                                    <?php
                                        endwhile;
                                    endif;
                                    ?>
                                    </ul>

                        <?php
                        endwhile;
                        endif;
                        ?>
                </div>

                <div class="col-md-6">
                <?php
                $categoriesfooter = searcherCategoriesfooter($db);
                if (!empty($categoriesfooter)):
                        while($categoryfooter = mysqli_fetch_assoc($categoriesfooter)):
                ?>
                        <ul class="homepage-app-section">
                            <h4><?=$categoryfooter['name']?></h4>
                            <?php
                            $softwares = getSoftware($db, $categoryfooter['id']);
                            if (!empty($softwares)):
                                while($software = mysqli_fetch_assoc($softwares)):
                                    $altlogo = explode(".", $software['name']);
                                    $altlogo = $altlogo[0];
                                    $altlogo = $altlogo . " Logo";
                            ?>

                            <li class="list-unstyled">
                                <input type="checkbox"  name="<?=$software['id']?>">
                                 <img width="18px" alt="<?=$altlogo?>" src="./resources/img/logos/<?=$software['logo']?>">
                                <label class="list-unstyled"><?=$software['name']?></label>
                            </li>
                            <?php
                                endwhile;
                            endif;
                            ?>

                            <?php if($categoryfooter['id'] == 6):;?>
                                <br/>
                                <div class="form-group">
                                    <label for="commands">Custom commands:</label><br/>
                                    <textarea class="form-control" name="commands" placeholder="$"></textarea>
                                </div>
                            <?php endif; ?>
                        </ul>

                <?php
                endwhile;
                endif;
                ?>
                </div>
            </div><br/>

            <?php if (isset($_SESSION['user_identify'])): ?>
            <div class="form-group">
                <label for="save_autoinstaller">Name of Autoinstaller:</label>
                <input type="text" name="save_autoinstaller" class="form-control" autofocus/><br/>
            </div>

            <?php endif; ?>

            <input type="submit" value="Download Autoinstaller" class="btn btn-primary btn-block">

        </form>
        <br/>

        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p>This site use cookies more in <a href="./about/cookies_policy.php">Cookies Policy</a></p>
        </div>

       <footer class="text-right"> Developed by Daniel Macias </footer>

        <?php deleteErrors(); ?>
  </body>
</html>
