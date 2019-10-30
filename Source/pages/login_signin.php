<?php
include_once '../configs/connection.php';
include_once '../configs/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once '.././configs/meta.php'; ?>
        <title>WPM</title>
        <link rel="stylesheet" type="text/css" href="../resources/css/signin_login.css">
    </head>
    <body>

    <h1><a href="../index.php">WPM</a></h1>

    <a href="login_signin.php" class="signin_login">Login | Signin</a><br/>

    <hr/>
    <div class="login">
        <?php if(isset($_SESSION['errors']['login'])): ?>
            <div class="errors">
                <?=$_SESSION['errors']['login'] ?>
            </div>
        <?php endif; ?>
        <h2>Login</h2>
           <form method="POST" action="../validate_data/sessions/validate_login.php">
            <input type="text" name="email_user" placeholder="Email or User:"/><br/><br/>
            <input type="password" name="password" placeholder="Password:"/><br/><br/>
            <input type="submit" value="Login"/><br/><br/>
        </form>
        <a href="login_signin.php?forgot_password" class="forgot_password">Forgot Password?</a>
    </div>

    <div class="signin">
        <h2>Register</h2>
        <form method="POST" action="../validate_data/sessions/validate_signin.php">
            <input type="text" name="user" autofocus class="input_signin" placeholder="User:"/><br/>
            <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'user') : ''; ?>
            <br/>
            <input type="email" name="email" class="input_signin" placeholder="Email:"/><br/>
            <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'email') : ''; ?>
            <br/>
            <input type="password" name="password" class="input_signin" placeholder="Password:"/><br/>
            <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'password') : ''; ?>
            <br/>
            <input type="password" name="password_verify" class="input_signin" placeholder="Password verification:"/><br/>
            <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'password_verify') : ''; ?>
            <br/>
            <input type="submit" value="Sign Up" name="submit"/>
            <br/>
            <p>By clicking on Sign Up you accept the <a href="../about/terms_and_conditions.php">Terms and Conditions</a>, also accept <a href="../about/cookies_policy.php">Cookies Policy</a>.</p>
        </form>
    </div>

    <?php if (isset($_GET['forgot_password'])): ?>
        <div class="password">
            <h2>Recovery Password</h2>
            <?php if(isset($_SESSION['errors']['forgot_password'])): ?>
                <div class="errors">
                    <?=$_SESSION['errors']['forgot_password'] ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="../validate_data/recovery_password/forgot_password.php">
                <label for="email_user">Email:</label><br/>
                <input type="text" name="email_user" autofocus class="input_signin"/><br/>
                <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'email') : ''; ?>
                <br/>
                <input type="submit" value="Sign Up" name="submit"/>
            </form>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['recovery_password'])): ?>
    <div class="password">
        <h2>Recovery Password</h2>
        <form method="POST" action="../validate_data/recovery_password/update_password.php?user=<?=$_GET['user']?>&token=<?=$_GET['token']?>">
            <label for="password">Password:</label><br/>
            <input type="password" name="password" autofocus class="input_signin"/><br/>
            <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'password') : ''; ?>
            <br/>
            <label for="password_verify">Verify Password:</label><br/>
            <input type="password" name="password_verify" autofocus class="input_signin"/><br/>
            <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'password_verify') : ''; ?>
            <br/>
            <input type="submit" value="Sign Up" name="submit"/>
        </form>
        <?php endif; ?>
        <?php deleteErrors(); ?>
    </body>
</html>
