<?php
require_once '.././configs/connection.php';
require_once '.././configs/functions.php';
require_once '.././configs/isset_session.php';
?>
    <!DOCTYPE html>
    <head>
      <?php include_once '.././configs/meta.php'; ?>
        <link rel="stylesheet" type="text/css" href=".././resources/css/my_user.css">
        <title>WPM - <?=$_SESSION['user_identify']['user']?></title>
    </head>
 <body>
    <h1><a href="../index.php">WPM</a></h1>
    <header>
    <a href="./my_user.php"><?=$_SESSION['user_identify']['user'];?></a>
    <a href="./my_data.php">Settings</a>
    <a href="../configs/logout.php">Sign Off</a>
    </header>
<br/>
<hr>
    <article class="my_data">
    <h2>My Data</h2>
    <label for="user">User:</label><br/>
    <p><a href="./my_user.php"><?=$_SESSION['user_identify']['user']?></a><br/></p>

    <label for="email">Email:</label>
    <p><?=$_SESSION['user_identify']['email']; ?></p>

    </article>
    <main>
    <article class="entry"><br/>
    <h2>AutoInstallers</h2>
    <?php
    $autoinstallers = getsaveautoinstaller($db, $_SESSION['user_identify']['id']);
    if(!empty($autoinstallers)):
        while($autoinstaller = mysqli_fetch_assoc($autoinstallers)):
            ?>

            <p><?=$autoinstaller['create_datetime']?></p>
            <a href=".././functions/downloadautoinstaller.php?software=<?=$autoinstaller['software']?>" class="buttons">Download Autoinstaller</a>
            <a href=".././functions/deleteautoinstaller.php?id=<?=$autoinstaller['id']?>" class="buttons">Delete Autoinstaller</a>
            <br>
            <br>

        <?php
                endwhile;
            endif;
            ?>

        <?php if ($autoinstallers->num_rows == 0): ?>
            <p>You haven't saved any autoinstallers yet</p>
        <?php endif; ?>
        </article>
    </main>
    <footer>
          Developed by "Propietario" &copy; <?=date("Y")?>
          <nav>
              <a href=".././about/terms_and_conditions.php">Terms and Conditions</a>
              <a href=".././about/cookies_policy.php">Cookies Policy</a>
          </nav>
      </footer>
</body>
</html>
