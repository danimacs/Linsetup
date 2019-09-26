<!DOCTYPE HTML>
<!DOCTYPE html>
<head>
    <?php require_once '.././configs/config.php'; ?>
    <title>PROJECT | The social network for gamers</title>
    <link rel="stylesheet" type="text/css" href="../resources/css/forgot_password.css">
</head>
 <body>
    <h1><a href="../index.php">PROJECT</a></h1>
<?php if (isset($_SESSION['errors']['login'])) : ?>
<div class="errors_login">
    <?=$_SESSION['errors']['login'];?>
</div>
<?php endif;?>
<?php if(isset($_SESSION['completed'])): ?>
<div class="completed">
    <?=$_SESSION['completed']?>
</div>
<?php endif; ?>
    <form method="POST" action=".././validate_data/sessions/validate_login.php" class="login">
        <input type="text" name="email_user" placeholder="Email or User:" class="header_input"/>
        <input type="password" name="password" placeholder="Password:" class="header_input"/>
        <input type="submit" value="Login"/>
    </form>
<hr>
<div class="description">
    <h2>What is PROJECT?</h2>
    <br/>
    PROJECT is a social network developed for gamers by gamers. We welcome you to this new community that we are trying to create from PROJECT and we hope to get very far with you. We would appreciate your suggesting changes that will make us improve. <br/>
    <b>¡Enjoy!</b> <br/>
    <b>Create, publish and vote</b>
    </p>
</div>
<div class="vl"></div>
<div id="signin" class="signin">
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

<footer>
    Developed by "Propietario" &copy; <?=date("Y")?>
    <nav>
        <a href="../about/terms_and_conditions.php">Terms and Conditions</a>
        <a href="../about/cookies_policy.php">Cookies Policy</a>
    </nav>
</footer>
</body>
</html>
