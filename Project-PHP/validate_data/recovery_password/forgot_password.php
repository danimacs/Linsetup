<?php
require_once '../.././configs/connection.php';
require_once '../.././configs/functions.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../.././vendor/phpmailer/phpmailer/src/Exception.php';
require '../.././vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../.././vendor/phpmailer/phpmailer/src/SMTP.php';

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
        $user_id = $user['id'];

        $token = bin2hex(random_bytes(30));

        $sql = "INSERT INTO tokens VALUE (null, $user_id, '$token',  NOW());";
        mysqli_query($db, $sql);


// Load Composer's autoloader
        require '../../vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->CharSet = 'UTF-8';
            $mail->SMTPDebug = 0;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Set mailer to use SMTP
            $mail->Host       = 'smtp.ionos.es';                        // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'recovery_password@PROJECT.com';         // SMTP username
            $mail->Password   = 'ZcCFzDNydwE3E8h';                      // SMTP password
            $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('recovery_password@PROJECT.com', 'PROJECT');
            $mail->addAddress($user['email'], $user['user']);     // Add a recipient


            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Recovery Password';
            $mail->Body    = 'Hello '.$user['user'] .' <br/> Please to recovery your password do click -> <a href="www.PROJECT.com/recovery_password/recovery_password.php?user='.$user['id'].'&token='.$token.'">Recovery Password</a>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            $_SESSION['completed'] = "Please check your email, it may be spam";

        } catch (Exception $e) {
            $_SESSION['errors'] = "There was an error sending the data";
        }

    }else{
        $_SESSION['errors'] = "There is no account with this email";
    }

header("Location: ../.././index.php");
