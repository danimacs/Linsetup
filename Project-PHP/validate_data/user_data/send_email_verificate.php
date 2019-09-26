<?php
require_once '../.././configs/connection.php';
require_once '../.././configs/functions.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../.././vendor/phpmailer/phpmailer/src/Exception.php';
require '../.././vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../.././vendor/phpmailer/phpmailer/src/SMTP.php';

if (!isset($_GET['user_id'])){
    $_SESSION['errors'] = "There was an error sending the data";
    header("Location: ../.././index.php");
}

$user_id = $_GET['user_id'];

$token = bin2hex(random_bytes(30));

$sql = "INSERT INTO tokens VALUE (null, $user_id, '$token', NOW());";
mysqli_query($db, $sql);

$user = getUserFromId($db, $user_id);
$user = mysqli_fetch_assoc($user);



    // Load Composer's autoloader
    require '../../vendor/autoload.php';

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = 0;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = '';                                    // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'register@PROJECT.com';                  // SMTP username
        $mail->Password   = '';                                     // SMTP password
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = '';                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('¡¡', '¡');
        $mail->addAddress($user['email'], $user['user']);     // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Verificate Account';
        $mail->Body    = 'Hello '.$user['user'].' <br/> Please, verificate your account do click -> <a href="www.PROJECT.com/validate_data/user/verificate_account.php?user='.$user_id.'&token='.$token.'">Verificate Account</a>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        $_SESSION['completed'] = "The registration has been successfully completed, check your email";
    } catch (Exception $e) {
        $_SESSION['errors'] = "There was an error sending the data";
    }

    header('Location: ../.././index.php');
