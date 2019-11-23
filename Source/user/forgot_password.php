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
                    <a href="../pages/signin.php" class="btn btn-primary">Sign in</a>
                    <a href="../pages/login.php" class="btn btn-primary">Login</a>
                </li>

            </ul>
        </nav>

        <?php if(isset($_SESSION['errors']['forgot_password'])): ?>
            <div class="alert alert-danger alert-dismissible">
                <?=$_SESSION['errors']['forgot_password']?>
            </div>
        <?php endif; ?>

        <h2>Forgot Password?</h2>

        <form method="POST" action=".././validate_data/recovery_password/forgot_password.php">
            <div class="form-group">
                <label for="email_user">Email or User:</label>
                <input type="text" name="email_user" placeholder="Email or User" class="form-control" autofocus/><br/>
            </div>

            <input type="submit" value="Sign Up" name="submit" class="btn btn-primary"/>
        </form>

    </body>
</html>
