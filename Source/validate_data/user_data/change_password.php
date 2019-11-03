<?php
if (isset($_POST)) {

    require_once '../.././configs/connection.php';

    $password_old = isset($_POST['password_old']) ?  mysqli_real_escape_string($db, $_POST['password_old']) : false;
    $password_new = isset($_POST['password_new']) ?  mysqli_real_escape_string($db, $_POST['password_new']) : false;

    $errors = array();

    $verify = password_verify($password_old, $_SESSION['user_identify']['password']);

    if (!$verify) {
        $errors['password_old'] = "The password isn't correct";
    }

    if (empty($password_new)) {
        $errors['password_new'] = "The password is empty";
    }


    $save_users = false;

    if (count($errors) == 0) {
        $save_users = true;

        $password_secure = password_hash($password_new, PASSWORD_BCRYPT, ['cost'=>15]);
        $sql = "UPDATE users SET "."password = '$password_secure'"."WHERE id =".$_SESSION['user_identify']['id'];
        $query_save = mysqli_query($db,$sql);

        if ($query_save){
            $_SESSION['user_identify']['password_new'] = $password_new;
            $_SESSION['completed'] = "Your password has been updated successfully";
            header( 'Location: ../.././index.php' );
        }else{
            $_SESSION['errors']['general'] = "Your password could not be saved successfully";
            header( 'Location: ../.././user/my_data.php' );
        }

    }else{
        $_SESSION['errors'] = $errors;
        header( 'Location: ../.././user/my_data.php' );
    }

}





