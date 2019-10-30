<?php include_once '.././configs/connection.php';?>
<?php include_once '.././configs/functions.php';?>
<!DOCTYPE html>
<html lang="en">
<html>
        <head>
            <?php include_once '.././configs/meta.php'; ?>
            <title>WPM</title>
            <link rel="stylesheet" type="text/css" href=".././resources/css/download_page.css">
        </head>

        <body>
            <?php if (isset($_SESSION['errors'])) : ?>
                <div class="errors">
                    <?=$_SESSION['errors'];?><br/><br/>
                </div>
            <?php endif;?>
            <?php if(isset($_SESSION['completed'])): ?>
                <div class="completed">
                    <?=$_SESSION['completed']?><br/><br/>
                </div>
            <?php endif; ?>

            <h1><a href=".././index.php">WPM</a></h1>

            <?php if (isset($_SESSION['user_identify'])): ?>
                <header class="data">
                    <a href=".././user/my_user.php"><?=$_SESSION['user_identify']['user'];?></a>
                    <a href=".././user/my_data.php">Settings</a>
                    <a href=".././configs/logout.php">Sign Off</a>
                </header>
            <?php endif; ?>

            <?php if (!isset($_SESSION['user_identify'])): ?>
                <a href="login_signin.php" class="signin_login">Login | Signin</a>
            <?php endif; ?>

            <header>
                <form method="POST">
                    <input type="text" name="searcher" placeholder="Searcher:">
                    <input type="checkbox" value="1" name="complement">
                    <input type="submit" value="Searcher:">
                </form>
            </header>
            <hr/>

            <div class="list_software">
                <?php
                $long = count($_SESSION['clickeds']);
                $long--;
                for ($i = 0; $i <= $long; $i++) {
                    $namesclickeds = searcherNamePacketsFromID($db, $_SESSION['clickeds'][$i]);
                    $nameclickeds = mysqli_fetch_assoc($namesclickeds);
                    $list = implode(" ", $nameclickeds);
                    echo $list."<br/>"."<br/>";
                } ?>
            </div>

            <div class="instrucctions">
                <h2>How to install</h2>
                <p>Open a terminal</p>
                <p>cd Download/</p>
                <p>chmod +x autoinstaller.sh</p>
                <p>yes | ./autoinstaller.sh</p>
            </div><br/>

            <a href=".././functions/autoinstaller.sh" class="buttons" download>Download Autoinstaller</a>

        </body>
        <?php deleteErrors(); ?>
        <footer> Developed by Daniel Macias </footer>
    </body>
</html>
