<?php
require_once '../.././configs/connection.php';
require_once '../.././configs/functions.php';

if (isset($_SESSION['user_identify'])){
    session_destroy();
}

    $user = isset($_GET['user']) ?  mysqli_real_escape_string($db, $_GET['user']) : false;
    $token = isset($_GET['token']) ?  mysqli_real_escape_string($db, $_GET['token']) : false;
    $password = isset($_POST['password']) ?  mysqli_real_escape_string($db, $_POST['password']) : false;
    $password_verify = isset($_POST['password_verify']) ?  mysqli_real_escape_string($db, $_POST['password_verify']) : false;

    $errors = array();

    if (strlen($password) < 8) {
        $errors['password'] = "The password must have a minimum of 8 characters";
    }

    if (empty($password_verify)) {
        $errors['password_verify'] = "The passwords do not match";
    }

    if ($password != $password_verify){
        $errors['password_verify'] = "The passwords do not match";
    }

    if (count($errors) == 0){

        $status = getStatus($db, $user, $token);
        $status = mysqli_fetch_assoc($status);

        if ($status['status'] == 1) {

            $password_secure = password_hash($password, PASSWORD_BCRYPT, ['cost' => 15]);

            $sql = "UPDATE users SET password = '$password_secure' WHERE id = $user";
            mysqli_query($db, $sql);

            $sql = "DELETE FROM tokens WHERE user = $user";
            mysqli_query($db, $sql);


            $_SESSION['completed'] = "Your password is recovered";
            header("Location: ../.././pages/login_signin.php");
        }else{
            header("Location: ../.././validate_data/recovery_password/recovery_password.php?user=$user&token=$token");
        }

    }else{
        $_SESSION['errors'] = $errors;
        header("Location: ../.././user/recovery_password.php?user=$user&token=$token");
    }







