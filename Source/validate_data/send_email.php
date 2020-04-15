<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/functions.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../libraries/PHPMailer/src/Exception.php';
require '../libraries/PHPMailer/src/PHPMailer.php';
require '../libraries/PHPMailer/src/SMTP.php';

if (!isset($_GET['user_id']) && !isset($_POST['email_user'])){
    $_SESSION['errors'] = "There was an error sending the data";
}

if($_GET['action'] == "recovery"){

    $email_user = $_POST['email_user'];

    if (filter_var($email_user, FILTER_VALIDATE_EMAIL)) {
        $sql = "SELECT * FROM users WHERE email = '$email_user'";
    }else{
        $sql = "SELECT * FROM users WHERE user = '$email_user'";
    }

    $get_id = mysqli_query($db, $sql);

    if (mysqli_num_rows($get_id)){
        $get_id = mysqli_fetch_assoc($get_id);
        $user_id = (int)$get_id['id'];
    }

}else{
    $user_id = (int)$_GET['user_id'];
}

if(is_int($user_id)){

    $token = bin2hex(random_bytes(30));

    $sql = "INSERT INTO tokens VALUE (null, $user_id, '$token', 0,NOW());";
    mysqli_query($db, $sql);

    $user = getUserFromId($db, $user_id);
    $user = mysqli_fetch_assoc($user);

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host       = 'null';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'support@linsetup.com';
        $mail->Password   = 'null';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        
        //Recipients
        $mail->setFrom('support@linsetup.com', 'Support Linsetup');
        $mail->addAddress($user['email'], $user['user']);

        if ($_GET['action'] == "signin"){
            $mail->isHTML(true);
            $mail->Subject = 'Verificate Account';
            $mail->Body = 'Hello ' . $user['user'] . ' <br/> Please, verificate your account do click -> <a href="https://www.linsetup.com/validate_data/receive_email.php?user=' . $user_id . '&token=' . $token .'&action=verify'. '">Verificate Account</a>';
        }elseif ($_GET['action'] == "unlock"){
            $mail->isHTML(true);
            $mail->Subject = 'Unlock Account';
            $mail->Body = 'Hello ' . $user['user'] . ' <br/> Please, unlock your account do click -> <a href="https://www.linsetup.com/validate_data/receive_email.php?user=' . $user_id . '&token=' . $token .'&action=unlock'.'">Unlock Account</a>';
        }elseif($_GET['action'] == "recovery"){
            $mail->isHTML(true);
            $mail->Subject = 'Recovery Password';
            $mail->Body = 'Hello ' . $user['user'] . ' <br/> Please, recovery your account do click -> <a href="https://www.linsetup.com/validate_data/receive_email.php?user=' . $user_id . '&token=' . $token .'&action=recovery'.'">Recovery Account</a>';
        }

        $mail->send();
    } catch (Exception $e) {
        $_SESSION['errors'] = "There was an error sending the data";
    }

}

header('Location: ../index.php');
die();

?>