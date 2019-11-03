 <?php
 if (isset($_POST)) {

     require_once '../.././configs/connection.php';

     $errors = array();

     $user_id = $_SESSION['user_identify']['id'];
     $user = isset($_POST['user']) ?  mysqli_real_escape_string($db, $_POST['user']) : false;
     $email = isset($_POST['email']) ?  mysqli_real_escape_string($db, trim($_POST['email'])) : false;

     if (empty($user)) {
         $errors['user'] = "The user is invalid";
     }

     if (empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $errors['email'] = "The email is invalid";
     }

     if (count($errors) == 0) {

             $sql = "UPDATE users SET user = '$user', email = '$email'  WHERE id = ".$_SESSION['user_identify']['id'];
             $query_save = mysqli_query($db,$sql);

             $sql = "UPDATE users SET last_connection_datetime = NOW() WHERE id =".$_SESSION['user_identify']['id'];
             mysqli_query($db, $sql);

             if ($query_save){
                 $_SESSION['completed'] = "The process was completed perfectly";
                 Header( 'Location: ../.././index.php' );
             }else{
                     $_SESSION['errors']['general'] = "The user already exists or the email already exists";
                 header('Location: ../.././user/my_data.php');
             }
     }else{
         $_SESSION['errors'] = $errors;
         header('Location: ../.././user/my_data.php');
     }

 }
