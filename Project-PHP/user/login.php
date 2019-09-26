<?php
include_once '../configs/connection.php';
include_once '../configs/functions.php';
?>
<!DOCTYPE HTML>
    <head>
        <?php require_once '.././configs/config.php'; ?>
        <title>Project</title>
        <link rel="stylesheet" type="text/css" href="../resources/css/signin_login.css">
    </head>
    <body>
    <h2>Login</h2>
    <?php if(isset($_SESSION['errors']['login'])): ?>
        <div class="errors">
            <?=$_SESSION['errors']['login'] ?>
        </div>
    <?php endif; ?>
    <form method="POST" action=".././validate_data/sessions/validate_login.php" class="login">
        <input type="text" name="email_user" placeholder="Email or User:"/>
        <br/>
        <br/>
        <input type="password" name="password" placeholder="Password:"/>
        <br/>
        <br/>
        <input type="submit" value="Login"/>
        <br/>
        <br/>
    </form>
    <a href=".././recovery_password/forgot_password.php" class="forgot_password">Forgot Password?</a>
    </body>
</html>