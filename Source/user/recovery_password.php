<?php
include_once '../configs/connection.php';
include_once '../configs/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once '.././configs/meta.php'; ?>
        <title>LINSETUP</title>
    </head>

    <body class="container">

        <nav class="navbar navbar-expand-sm bg-dark navbar-light">

            <ul class="list-unstyled">

                <li class="nav-item">
                    <h1><a href=".././index.php">LINSETUP</a></h1>
                </li>

               <li class="nav-item text-right">
                     <a href=".././pages/login_signin.php" class="nav-link">Login | Signin</a>
                 </li>

            </ul>
        </nav>

        <h2>Forgot Password?</h2>

         <form method="POST" action=".././validate_data/recovery_password/update_password.php?user=<?=$_GET['user']?>&token=<?=$_GET['token']?>">

            <div class="form-group">
                <label for="password">Password:</label><br/>
                <input type="password" name="password" autofocus class="form-control"/><br/>
                <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'password') : ''; ?>
            </div>

            <div class="form-group">
                <label for="password_verify">Verify Password:</label><br/>
                <input type="password" name="password_verify" class="form-control"/><br/>
                <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'password_verify') : ''; ?>
            </div>

            <input type="submit" value="Sign Up" name="submit" class="btn btn-primary"/>

        </form>
        <?php deleteErrors();?>
    </body>
</html>
