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
                 <li class="nav-item text-right">
                     <a href="signin.php" class="btn btn-primary">Sign in</a>
                     <a href="login.php" class="btn btn-primary">Login</a>
                 </li>
             <?php endif; ?>

         </ul>

     </nav>

        <?php if (isset($_SESSION['errors'])) : ?>
            <div class="alert alert-danger alert-dismissible">
                <?=$_SESSION['errors'];?>
            </div>
        <?php endif;?>

        <?php if(isset($_SESSION['completed'])): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?=$_SESSION['completed']?>
            </div>
        <?php endif; ?>

                <div class="list-unstyled">
                <?php
                if (isset($_SESSION['clickeds']['commands'])):
                    $commands = $_SESSION['clickeds']['commands'];
                    $long_commands = count($commands);
                    $long_commands--;
                    for ($i = 0; $i <= $long_commands; $i++):
                        $txt = $txt . $commands[$i] . "\n";
                ?>
                   <img width="18px" alt="Default Logo" src=".././resources/img/logos/default-logo.png?>">
                   <label class="list-unstyled"><?=$commands[$i]?></label><br/>
                <?php
                    endfor;
                endif;
                ?>
                <?php
                $long = count($_SESSION['clickeds']['software']);
                $long--;
                for ($i = 0; $i <= $long; $i++):
                    $namesclickeds = searcherPacketsFromID($db, $_SESSION['clickeds']['software'][$i]);
                    $nameclickeds = mysqli_fetch_assoc($namesclickeds);
                    $altlogo = explode(".", $nameclickeds['name']);
                    $altlogo = $altlogo[0];
                    $altlogo = $altlogo . " Logo";
                ?>
                    <div class="list-unstyled">
                        <img width="18px" alt="<?=$altlogo?>" src=".././resources/img/logos/<?=$nameclickeds['logo']?>">
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

            <a href=".././validate_data/autoinstaller/autoinstaller.sh"" class="btn btn-primary" download>Download Autoinstaller</a>

        <?php deleteErrors(); ?>

     <br/>
     <footer class="text-left list-unstyled">

         <ul class="list-unstyled">

             <li class="nav-item">
                 <a href=".././about/terms_and_conditions.php" class="nav-link" target="_blank">Terms and Conditions</a>
             </li>

             <li class="nav-item">
                 <a href=".././about/cookies_policy.php" class="nav-link" target="_blank">Cookies Policy</a>
             </li>

             <li class="nav-item">
                 <a href="https://github.com/danielmac03/Linsetup" class="nav-link" target="_blank">Github</a>
             </li>

         </ul>
     </footer>

    </body>
</html>
