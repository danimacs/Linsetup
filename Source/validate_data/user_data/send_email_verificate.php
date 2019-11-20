<?php
require_once '../.././configs/connection.php';
require_once '../.././configs/passwords.php';
require_once '../.././configs/functions.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../.././PHPMailer/src/Exception.php';
require '../.././PHPMailer/src/PHPMailer.php';
require '../.././PHPMailer/src/SMTP.php';

if (!isset($_GET['user_id'])){
    $_SESSION['errors'] = "There was an error sending the data";
    header("Location: ../.././index.php");
}

$user_id = (int)$_GET['user_id'];
if(is_int($user_id)){
  $token = bin2hex(random_bytes(30));

  $sql = "INSERT INTO tokens VALUE (null, $user_id, '$token', 0,NOW());";
  mysqli_query($db, $sql);

  $user = getUserFromId($db, $user_id);
  $user = mysqli_fetch_assoc($user);

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

          if ($_GET['action'] == "signin"){
              $mail->isHTML(true);
              $mail->Subject = 'Verificate Account';
              $mail->Body = 'Hello ' . $user['user'] . ' <br/> Please, verificate your account do click -> <a href="www.linsetup.com/validate_data/user_data/receive_email.php?user=' . $user_id . '&token=' . $token .'&action=verify'. '">Verificate Account</a>';
          }elseif ($_GET['action'] == "unlock"){
              $mail->isHTML(true);
              $mail->Subject = 'Unlock Account';
              $mail->Body = 'Hello ' . $user['user'] . ' <br/> Please, unlock your account do click -> <a href="www.linsetup.com/validate_data/user_data/receive_email.php?user=' . $user_id . '&token=' . $token .'&action=unlock'.'">Unlock Account</a>';
          }

          $mail->send();
          $_SESSION['completed'] = "The registration has been successfully completed, check your email";
      } catch (Exception $e) {
          $_SESSION['errors'] = "There was an error sending the data";
      }
}
    header('Location: ../.././index.php');
?>