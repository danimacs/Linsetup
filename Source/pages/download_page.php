<?php
include_once '.././configs/connection.php';
include_once '.././configs/functions.php';

if (empty($_SESSION['clickeds'])){
    header('Location: .././index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<html>
        <head>
            <?php include_once '.././configs/meta.php'; ?>
            <title>LINSETUP</title>
        </head>

        <body class="container">

     <nav class="navbar navbar-expand-sm bg-dark navbar-light">

         <ul class="list-unstyled">

             <li class="nav-item">
                 <h1><a href=".././index.php" class="nav-link">LINSETUP</a></h1>
             </li>

            <?php if (isset($_SESSION['user_identify'])): ?>
                 <li class="nav-item text-right">
                     <a href=".././user/my_user.php" class="nav-link"><?=$_SESSION['user_identify']['user'];?></a>
                     <a href=".././user/my_data.php" class="nav-link">Settings</a>
                     <a href=".././configs/logout.php" class="nav-link">Sign Off</a>
                 </li>
             <?php endif; ?>

             <?php if (!isset($_SESSION['user_identify'])): ?>
                 <li class="nav-item">
                     <a href=".././pages/login_signin.php" class="nav-link">Login | Signin</a>
                 </li>
             <?php endif; ?>

         </ul>

     </nav>

        <?php if (isset($_SESSION['errors'])) : ?>
            <div class="alert alert-danger alert-dismissible">
                <?=$_SESSION['errors'];?><br/><br/>
            </div>
        <?php endif;?>

        <?php if(isset($_SESSION['completed'])): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?=$_SESSION['completed']?><br/><br/>
            </div>
        <?php endif; ?>

            <div class="list-unstyled">
                <?php
                $long = count($_SESSION['clickeds']);
                $long--;
                for ($i = 0; $i <= $long; $i++):
                $namesclickeds = searcherPacketsFromID($db, $_SESSION['clickeds'][$i]);
                $nameclickeds = mysqli_fetch_assoc($namesclickeds);
                ?>
                    <div class="list-unstyled">
                       <!--<img src="./resources/img/logos/<?=$nameclickeds['logo']?>"> -->
                        <label class="list-unstyled"><?=$nameclickeds['name']?></label>
                    </div>
                <?php
                endfor;
                unset($_SESSION['clickeds']);
                ?>
            </div>

            <div class="instrucctions">
                <h2>How to install</h2>
                <p>Open a terminal</p>
                <p>cd Download/</p>
                <p>chmod +x autoinstaller.sh</p>
                <p>yes | ./autoinstaller.sh</p>
            </div><br/>

            <a href=".././functions/autoinstaller.sh" class="buttons" download>Download Autoinstaller</a>

        <?php deleteErrors(); ?>
        <footer class="text-right"> Developed by Daniel Macias </footer>
    </body>
</html>
