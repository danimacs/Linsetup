<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/functions.php';

$id = (int)$_GET['id'];
$user = $_SESSION['user_identify']['id'];

if (is_int($id)){

    $sql = "UPDATE saveautoinstaller SET share = 1 WHERE id = '$id' AND user = '$user'";
    mysqli_query($db, $sql);

    $autoinstaller = getsaveautoinstaller($db, $_GET['id']);
    $autoinstaller = mysqli_fetch_assoc($autoinstaller);

    if($autoinstaller['share'] == 1){
        $_SESSION['completed'] = "The link has been generated and copied";
        header('Location: ../pages/my_user.php');
        die();
    }else{
        $_SESSION['errors'] = "You are not authorized to generate a link";
        header('Location: ../index.php');
        die();
    }
    
}

?>
