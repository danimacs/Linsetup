<?php
require_once '../.././configs/connection.php';
require_once '../.././configs/functions.php';

if ($_POST){

    $email_user = trim($_POST['email_user']);
    $password = $_POST['password'];


    if (filter_var($email_user, FILTER_VALIDATE_EMAIL)) {
        $sql = "SELECT * FROM users WHERE email = '$email_user'";
    }else{
        $sql = "SELECT * FROM users WHERE user = '$email_user'";
    }

    $login = mysqli_query($db, $sql);

    if ($login && mysqli_num_rows($login) == 1){
        $user_database = mysqli_fetch_assoc($login);

        $verify = password_verify($password, $user_database['password']);

        if ($verify){
            $_SESSION['user_identify'] = $user_database;

            $id = $_SESSION['user_identify']['id'];
            $sql = "UPDATE users SET last_connection_datetime = NOW() WHERE id = $id";
            mysqli_query($db, $sql);
            
        }else{
                $_SESSION['errors']['login'] = "Incorrect Login";
            }
        }

    else{
        $_SESSION['errors']['login'] = "Incorrect Login";
    }


    if (isset($_SESSION['user_identify'])){
        header("Location: ../.././index.php");
    }else{
        $_SESSION['errors']['login'] = "Incorrect Login";
        header("Location: ../.././user/login.php");
    }
}

