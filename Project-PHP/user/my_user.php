<?php
require_once '.././configs/connection.php';
require_once '.././configs/functions.php';
require_once '.././configs/isset_session.php';
?>
<!doctype html>
    <!DOCTYPE html>
<head>
    <?php require_once '.././configs/config.php'; ?>
    <link rel="stylesheet" type="text/css" href=".././resources/css/my_user.css">
    <title>PROJECT - <?=$_SESSION['user_identify']['user']?></title>
</head>
 <body>
    <h1><a href="../index.php">PROJECT</a></h1>
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
    <h2>Entries</h2>
    <?php
    $entries = getEntriesByIDUser($db, $_SESSION['user_identify']['id']);
    if(!empty($entries)):
        while($entry = mysqli_fetch_assoc($entries)):

            ?>

                <?php
                endwhile;
            endif;
            ?>

        <?php if ($entries->num_rows == 0): ?>
            <p>The user has not yet published anything</p>
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



