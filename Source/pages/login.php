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

            <?php if (!isset($_SESSION['user_identify'])): ?>
                <li class="nav-item text-right">
                    <a href="signin.php" class="btn btn-primary">Sign in</a>
                    <a href="login.php" class="btn btn-primary">Login</a>
                </li>
            <?php endif; ?>

        </ul>
    </nav>

        <?php if(isset($_SESSION['completed'])): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?=$_SESSION['completed'] ?>
            </div>
        <?php endif; ?>

        <?php if(isset($_SESSION['errors']['login'])): ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?=$_SESSION['errors']['login'] ?>
            </div>
        <?php endif; ?>

        <h2>Login</h2>
           <form method="POST" action="../validate_data/sessions/validate_login.php">

           <div class="form-group">
               <label for="email_user">Email or User:</label>
               <input type="text" name="email_user" placeholder="Email or User" class="form-control" autofocus/><br/>
           </div>

           <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Password" class="form-control"/><br/>
           </div>

           <input type="submit" value="Login" class="btn btn-primary"/><br/><br/>
           <a href=".././user/forgot_password.php">Forgot Password?</a><br/><br/>


            <?php deleteErrors() ?>
        </form>
    </body>
</html>
