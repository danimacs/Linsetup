 <?php
 if (isset($_POST)) {

     require_once '../.././configs/connection.php';

     $errors = array();

     $user_id = $_SESSION['user_identify']['id'];
     $user = isset($_POST['user']) ?  mysqli_real_escape_string($db, $_POST['user']) : false;
     $email = isset($_POST['email']) ?  mysqli_real_escape_string($db, trim($_POST['email'])) : false;
     $steam = isset($_POST['website']) ?  mysqli_real_escape_string($db, trim($_POST['website'])) : false;
     $private_account = $_POST['private_account'];

     if(!empty($_FILES['profile_picture']['name'])){
         $name_profile_picture = $_FILES['profile_picture']['name'];
         $ext = pathinfo($name_profile_picture, PATHINFO_EXTENSION);
         $type_profile_picture = $_FILES['profile_picture']['type'];
         $size_profile_picture = $_FILES['profile_picture']['size'];
         $name_profile_picture = $user_id . "." . $ext;
     }else{
         $name_profile_picture = null;
     }

     if ($private_account == null){
         $private_account = 0;
     }

     if (!empty($name_profile_picture)) {

         if ($type_profile_picture == "image/jpeg" || $type_profile_picture == "image/jpg" || $type_profile_picture == "image/png" || $type_profile_picture == "image/gif") {

             if ($size_profile_picture <= 10000000) {

                 $folder_destination = $_SERVER['DOCUMENT_ROOT'] . '/database/user/';

                 move_uploaded_file($_FILES['profile_picture']['tmp_name'], $folder_destination . $name_profile_picture);

             } else {
                 $_SESSION['errors'] = "The profile picture is too large";
                 header('Location: ../.././user/my_data.php');
             }

         } else {
             $_SESSION['errors'] = "You have not selected anything";
             header('Location: ../.././user/my_data.php');
         }
     }


     if (empty($user)) {
         $errors['user'] = "The user is invalid";
     }

     if (empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $errors['email'] = "The email is invalid";
     }

     if (!empty($website)) {
         if (!filter_var($steam, FILTER_VALIDATE_URL)) {
             $errors['website'] = "The website is invalid";
         }
     }


     if (count($errors) == 0) {

             $sql = "UPDATE users SET user = '$user', email = '$email', website ='$website', private_account = $private_account, profile_picture = '$name_profile_picture' WHERE id = ".$_SESSION['user_identify']['id'];
             $query_save = mysqli_query($db,$sql);

             if ($query_save){
                 $_SESSION['completed'] = "Your data has been updated successfully";
                 Header( 'Location: ../.././index.php' );
             }else{
                     $_SESSION['errors'] = "The user already exists or the email already exists";
                 header('Location: ../.././user/my_data.php');
             }
     }else{
         $_SESSION['errors'] = $errors;
         header('Location: ../.././user/my_data.php');
     }

 }
