<?php
require_once '.././configs/connection.php';
require_once '.././configs/functions.php';
require_once '.././configs/isset_session.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
      <?php include_once '.././configs/meta.php'; ?>
        <title>LINSETUP - <?=$_SESSION['user_identify']['user']?></title>
        <script type="text/javascript" src=".././configs/functions.js"></script>
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

             </ul>

         </nav>

            <article>
            <h2>My Data</h2>
            <label for="user">User:</label><br/>
            <p><a href="./my_user.php"><?=$_SESSION['user_identify']['user']?></a><br/></p>

            <label for="email">Email:</label>
            <p><?=$_SESSION['user_identify']['email']; ?></p>

            </article>
            <article><br/>
            <h2>AutoInstallers</h2>
            <?php
            $autoinstallers = getsaveautoinstallers($db, $_SESSION['user_identify']['id']);
            if(!empty($autoinstallers)):
                while($autoinstaller = mysqli_fetch_assoc($autoinstallers)):
                    ?>

                    <p><?=$autoinstaller['name']?></p>

                    <div class="buttons">

                        <a href="../validate_data/autoinstaller/downloadautoinstaller.php?id=<?=$autoinstaller['id']?>" class="btn btn-primary">Download Autoinstaller</a>
                        <a href="../validate_data/autoinstaller/deleteautoinstaller.php?id=<?=$autoinstaller['id']?>" class="btn btn-primary">Delete Autoinstaller</a>
                        <a href=".././configs/update_share.php?id=<?=$autoinstaller['id']?>" onclick="fcopy(<?=$autoinstaller['id']?>)" class="btn btn-primary" >Generate Link</a>

                    </div>

                    <input type="text" style="opacity: 0" id="<?=$autoinstaller['id']?>" value="www.linsetup.com/validate_data/autoinstaller/downloadautoinstaller.php?id=<?=$autoinstaller['id']?>">

                    <br/><br/>

                <?php
                        endwhile;
                    endif;
                    ?>


                <?php if ($autoinstallers->num_rows == 0): ?>
                    <p>You haven't saved any autoinstallers yet</p>
                <?php endif; ?>
                </article>

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
