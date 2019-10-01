<?php
require_once '.././configs/connection.php';
require_once '.././configs/isset_session.php';
require_once '.././configs/functions.php';
?>
<!doctype html>
    <!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <meta name="title" content="">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="robots" content="index, follow, all">
        <meta http-equiv="Content-Language" content="en">
        <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
        <title>WPM - Settings</title>
        <link rel="stylesheet" type="text/css" href="../resources/css/my_data.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<main>
    <article class="data">
    <?php if(isset($_SESSION['completed']['data'])): ?>
        <div class="errors">
            <?=$_SESSION['completed']['data']?></div>
        </div>
    <?php endif; ?>

            <h2>Edit my data</h2>

        <form method="POST" action="../validate_data/user_data/change_my_data.php" enctype="multipart/form-data">
            <label for="user">User:</label><br/>
            <input type="text" name="user" autofocus value="<?=$_SESSION['user_identify']['user']; ?>"/><br/>
            <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'user') : ''; ?>
            <br/>

            <label for="email">Email:</label><br/>
            <input type="email" name="email" value="<?=$_SESSION['user_identify']['email']; ?>"/><br/>
            <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'email') : ''; ?>
            <br/>

            <input type="submit" value="Actualizar" name="submit" />
        </form><br/>
    </article>

    <article class="password">
        <?php if(isset($_SESSION['completed']['password'])): ?>
            <div class="errors">
                <?=$_SESSION['completed']['password']?></div>
            </div>
        <?php endif; ?>

        <h2>Change my Password</h2>

        <form method="POST" action="../validate_data/user_data/change_password.php">
            <label for="password_old">Last password:</label><br/>
            <input type="password" name="password_old" autofocus/><br/>
            <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'password_old') : ''; ?>
            <br/>
            <label for="password_new">New password:</label><br/>
            <input type="password" name="password_new"/><br/>
            <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'password_new') : ''; ?>
            <br/>
            <input type="submit" value="Actualizar" name="submit" />
        </form>
    </article>
<?php deleteErrors(); ?>
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

