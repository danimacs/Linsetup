<?php

include_once '.././configs/connection.php';
include_once '.././configs/isset_session.php';

if (!isset($_SESSION)) {
    session_start();
}

$id = $_GET['id'];

$sql = "DELETE FROM saveautoinstaller WHERE id = $id";
mysqli_query($db, $sql);

header('Location: .././index.php');
