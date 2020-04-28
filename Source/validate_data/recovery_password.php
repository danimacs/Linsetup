<?php

if(isset($_POST)){

    require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/connection.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/functions.php';

    if (isset($_SESSION['user_identify'])){
        session_destroy();
    }

    $user = (int)$_GET['user'];
    $token = isset($_GET['token']) ?  mysqli_real_escape_string($db, $_GET['token']) : false;
    $password = isset($_POST['password']) ?  mysqli_real_escape_string($db, $_POST['password']) : false;
    $password_verify = isset($_POST['password_verify']) ?  mysqli_real_escape_string($db, $_POST['password_verify']) : false;

    $errors = array();

    if (strlen($password) < 8) {
        $errors['password'] = "The password must have a minimum of 8 characters";
    }

    if (empty($password_verify) || $password != $password_verify) {
        $errors['password_verify'] = "The passwords do not match";
    }

    if (count($errors) == 0){
        $sql = "SELECT * FROM tokens WHERE user = $user AND token = '$token'";
        $status = mysqli_query($db, $sql);
        $status = mysqli_fetch_assoc($status);

        if ($status['status'] == 1) {
            $password_secure = password_hash($password, PASSWORD_BCRYPT, ['cost' => 15]);

            $sql = "UPDATE users SET password = '$password_secure' WHERE id = $user";
            mysqli_query($db, $sql);

            $sql = "DELETE FROM tokens WHERE user = $user";
            mysqli_query($db, $sql);


            $_SESSION['completed'] = "Your password is recovered";
            header('Location: ../index.php'); 
            die();
        }

    }else{
        $_SESSION['errors_recovery'] = $errors;
    }

}

header('Location: ../index.php?recovery_password&user='.$user.'&token='.$token);
die();

?>