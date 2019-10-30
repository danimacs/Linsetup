<?php
require_once '../.././configs/connection.php';
require_once '../.././configs/functions.php';

if ($_POST){

    $email_user = mysqli_real_escape_string($db, trim($_POST['email_user']));
    $password = mysqli_real_escape_string($db, $_POST['password']);


    if (filter_var($email_user, FILTER_VALIDATE_EMAIL)) {
        $sql = "SELECT * FROM users WHERE email = '$email_user'";
    }else{
        $sql = "SELECT * FROM users WHERE user = '$email_user'";
    }

    $login = mysqli_query($db, $sql);

    if ($login && mysqli_num_rows($login) == 0){
        $_SESSION['errors']['login'] = "There is no such account";
    }

    if ($login && mysqli_num_rows($login) == 1) {
        $user_database = mysqli_fetch_assoc($login);

        $verify = password_verify($password, $user_database['password']);

        if ($verify && $user_database['blocked'] == 0) {
            $_SESSION['user_identify'] = $user_database;

            if (filter_var($email_user, FILTER_VALIDATE_EMAIL)) {
                $sql = "UPDATE users SET last_connection_datetime = NOW() WHERE email = '$email_user'";
            } else {
                $sql = "UPDATE users SET last_connection_datetime = NOW() WHERE user = '$email_user'";
            }

            mysqli_query($db, $sql);

            if (filter_var($email_user, FILTER_VALIDATE_EMAIL)) {
                $sql = "UPDATE users SET try = 0 WHERE email = '$email_user'";
            } else {
                $sql = "UPDATE users SET try = 0 WHERE user = '$email_user'";
            }

            mysqli_query($db, $sql);

        } else {

            if (filter_var($email_user, FILTER_VALIDATE_EMAIL)) {
                $sql = "SELECT * FROM users WHERE email = '$email_user'";
            }else{
                $sql = "SELECT * FROM users WHERE user = '$email_user'";
            }

            $account = mysqli_query($db, $sql);
            $account = mysqli_fetch_assoc($account);
            $try = $account['try'];
            $try++;

            if ($try >= 10){

                if (filter_var($email_user, FILTER_VALIDATE_EMAIL)) {
                    $sql = "UPDATE users SET blocked = 1 WHERE email = '$email_user'";
                } else {
                    $sql = "UPDATE users SET blocked = 1 WHERE user = '$email_user'";
                }

                $_SESSION['errors']['login'] = "This account is blocked, check your email";
                $account = $account['id'];

            }else{

                if (filter_var($email_user, FILTER_VALIDATE_EMAIL)) {
                    $sql = "UPDATE users SET try = $try WHERE email = '$email_user'";
                } else {
                    $sql = "UPDATE users SET try = $try WHERE user = '$email_user'";
                }
                $_SESSION['errors']['login'] = "Incorrect Login";

            }

            mysqli_query($db, $sql);

        }

    }


    if (isset($_SESSION['user_identify'])){
        header("Location: ../.././index.php");
    }else{
        if ($try >= 10){
        header("Location: ../.././validate_data/user_data/send_email_verificate.php?user_id=$account&from=unlock");
        }else{
        header("Location: ../.././pages/login_signin.php");
        }
    }
}
