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

        <h2>Sign in</h2>
        <form method="POST" action="../validate_data/sessions/validate_signin.php">

            <div class="form-group">
                <label for="user">User:</label>
                <input type="text" name="user" class="form-control" placeholder="User"/><br/>
                <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'user') : ''; ?>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" placeholder="Email"/><br/>
                <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'email') : ''; ?>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password"class="form-control" placeholder="Password"/><br/>
                <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'password') : ''; ?>
            </div>

            <div class="form-group">
                <label for="password_verify">Password verification:</label>
                <input type="password" name="password_verify" class="form-control" placeholder="Password verification"/><br/>
                <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'password_verify') : ''; ?>
            </div>

            <p>By clicking on Sign Up you accept the <a href="../about/terms_and_conditions.php">Terms and Conditions</a>, also accept <a href="../about/cookies_policy.php">Cookies Policy</a>.</p>
            <input type="submit" value="Sign Up" name="submit" class="btn btn-primary"/><br/>

            <?php deleteErrors() ?>
        </form>
    </body>
</html>
