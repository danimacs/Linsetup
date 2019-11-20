<?php

require_once '.././configs/connection.php';
require_once '.././configs/functions.php';

$id = (int)$_GET['id'];

if (is_int($id)){

    $sql = "UPDATE saveautoinstaller SET share = 1 WHERE id = $id";
    mysqli_query($db, $sql);

}

header('Location: .././user/my_user.php');
?>
