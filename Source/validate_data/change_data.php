 <?php
 if (isset($_POST)) {

    require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/connection.php';

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

    $sql = "SELECT * FROM users WHERE user = '$user'";
    $checkuser = mysqli_query($db, $sql);

    if (mysqli_num_rows($checkuser) && $_SESSION['user_identify']['user'] != $user){
        $errors['user'] = "The user already exists";
    }

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $checkemail = mysqli_query($db, $sql);

    if (mysqli_num_rows($checkemail) && $_SESSION['user_identify']['email'] != $email){
        $errors['email'] = "The email already exists";
    }

    if (count($errors) == 0) {

    $sql = "UPDATE users SET user = '$user', email = '$email', last_connection_datetime = NOW()  WHERE id = ".$_SESSION['user_identify']['id'];
    $query_save = mysqli_query($db,$sql);

    if ($query_save){
        $_SESSION['completed'] = "The process was completed perfectly";
    }else{
        $_SESSION['errors_change_data'] = "The user already exists or the email already exists";
    }

    }else{
    $_SESSION['errors_change_data'] = $errors;
    }

}

header( 'Location: ../index.php' ); die();

?>