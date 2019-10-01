<?php

include_once '.././configs/functions.php';
include_once '.././configs/connection.php';
include_once '.././configs/isset_session.php';

$_SESSION['clean_clickeds'] = true;

$user = $_SESSION['user_identify']['id'];

if (empty($_SESSION['clickeds'])){
    header('Location: .././index.php');
}

$list = implode(" ", $_SESSION['clickeds']);

$sql = "INSERT INTO saveautoinstaller VALUE (null, $user, '$list',  NOW())";
mysqli_query($db, $sql);

header('Location: .././index.php');

