<?php

include_once '.././configs/connection.php';
include_once '.././configs/isset_session.php';

$user = $_SESSION['user_identify']['id'];
$id = (int)$_GET['id'];

if(is_int($id)){
    $sql = "DELETE FROM saveautoinstaller WHERE id = '$id' AND user = $user";
    mysqli_query($db, $sql);
}

$_SESSION['completed'] = "The autoinstaller was successfully deleted";

header('Location: .././index.php');

?>