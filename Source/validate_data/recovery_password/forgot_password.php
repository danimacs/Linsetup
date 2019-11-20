<?php
require_once '../.././configs/connection.php';
require_once '../.././configs/passwords.php';
require_once '../.././configs/functions.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../.././PHPMailer/src/Exception.php';
require '../.././PHPMailer/src/PHPMailer.php';
require '../.././PHPMailer/src/SMTP.php';

if (isset($_SESSION['user_identify'])){
    session_destroy();
}


$email_user = isset($_POST['email_user']) ?  mysqli_real_escape_string($db, $_POST['email_user']) : false;

if (filter_var($email_user, FILTER_VALIDATE_EMAIL)) {
    $sql = "SELECT * FROM users WHERE email = '$email_user'";
}else{
    $sql = "SELECT * FROM users WHERE user = '$email_user'";
}

$user = mysqli_query($db, $sql);
$user = mysqli_fetch_assoc($user);

if (!empty($user)){
    $user_id = (int)$user['id'];

    $token = bin2hex(random_bytes(30));

    $sql = "INSERT INTO tokens VALUE (null, $user_id, '$token', null, NOW());";
    mysqli_query($db, $sql);

// Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.ionos.es';                        // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'support@linsetup.com';                 // SMTP username
            $mail->Password   = $mail_password;                         // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('support@linsetup.com', 'Support Linsetup');
            $mail->addAddress($user['email'], $user['user']);     // Add a recipient


            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Recovery Password';
            $mail->Body    = 'Hello '.$user['user'] .' <br/> Please to recovery your password do click -> <a href="www.linsetup.com/validate_data/recovery_password/recovery_password.php?user='.$user['id'].'&token='.$token.'">Recovery Password</a>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            $_SESSION['completed'] = "Please check your email, it may be spam";

        } catch (Exception $e) {
            $_SESSION['errors'] = "There was an error sending the data";
            header("Location: ../.././user/forgot_password.php");
        }

    }else{
        $_SESSION['errors'] = "There is no account with this email";
        header("Location: ../.././user/forgot_password.php");
    }

header("Location: ../.././index.php");
?>