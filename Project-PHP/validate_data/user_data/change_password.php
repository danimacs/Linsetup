<?php
if (isset($_POST)) {

    require_once '../.././configs/connection.php';

    $password_old = isset($_POST['password_old']) ?  mysqli_real_escape_string($db, $_POST['password_old']) : false;
    $password_new = isset($_POST['password_new']) ?  mysqli_real_escape_string($db, $_POST['password_new']) : false;

    $errors = array();

    $verify = password_verify($password_old, $user_database['password']);
    if (!empty($password_old) || $verify) {
        $password_old_validate = true;
    }else{
        $password_old_validate = false;
        $errors['password_old'] = "La password anterior es erronia";
    }

    if (!empty($password_new)) {
        $password_new_validate = true;
    }else{
        $password_new_validate = false;
        $errors['password_new'] = "La password esta vacia";
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
            Header( 'Location: ../.././user/my_profile.php' );
        }else{
            $_SESSION['errors'] = "Your password could not be saved successfully";
            header('Location: ../.././user/change_password.php');
        }

    }else{
        $_SESSION['errors'] = $errors;
        header('Location: ../.././user/change_password.php');
    }

}





