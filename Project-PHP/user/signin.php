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
<h2>Register</h2>
    <?php if(isset($_SESSION['errors']['signin'])): ?>
        <div class="errors">
            <?=$_SESSION['errors']['signin'] ?>
        </div>
    <?php endif; ?>
    <form method="POST" action=".././validate_data/sessions/validate_signin.php">
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
        <p>By clicking on Sign Up you accept the <a href=".././about/terms_and_conditions.php">Terms and Conditions</a>, also accept <a href=".././about/cookies_policy.php">Cookies Policy</a>.</p>
        <?php deleteErrors(); ?>
    </form>
</body>
</html>