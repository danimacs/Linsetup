<?php

include_once '.././configs/connection.php';
include_once '.././configs/isset_session.php';

$id = $_GET['id'];

if(is_int($id)){
    $sql = "DELETE FROM saveautoinstaller WHERE id = '$id';";
    mysqli_query($db, $sql);
}

header('Location: .././index.php');

?>