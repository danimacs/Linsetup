<?php

include_once '.././configs/functions.php';
include_once '.././configs/connection.php';

$id = (int)$_GET['id'];
if (is_int($id)) {
    $_SESSION['clickeds'] = getsaveautoinstaller($db, $_GET['id']);
    $_SESSION['clickeds'] = mysqli_fetch_assoc($_SESSION['clickeds']);
}

$txt = "#!/bin/bash \n\n";

if (!empty($_SESSION['clickeds']['commands'])){
    $txt = $txt .  $_SESSION['clickeds']['commands'] . "\n";
    $commands = mysqli_real_escape_string($db,  $_SESSION['clickeds']['commands']);
    unset($_SESSION['clickeds']["commands"]);
}

$software = explode(" ", $_SESSION['clickeds']['software']);
$long = count($software);
$long--;

for ($i = 0; $i <= $long; $i++) {
    $searchs = searcherPacketsFromID($db, $software[$i]);
    $search = mysqli_fetch_assoc($searchs);
    if ($search['add_repository'] != null) {
        $txt = $txt . $search['add_repository'];
        $txt = $txt . "sudo apt update" . "\n";
    }
}

for ($i = 0; $i <= $long; $i++) {
    $searchs = searcherPacketsFromID($db, $software[$i]);
    $search = mysqli_fetch_assoc($searchs);
    $txt = $txt . "sudo ". $search['source'] ." ".$search['name_packet'] . "\n";
}

$_SESSION['clickeds'] = $software;

$file  = fopen('autoinstaller.sh','w');
fwrite($file, $txt);
fclose($file);

if (empty($commands[0]) && empty($software[0])){
    header('Location: .././index.php');
}else {
    header('Location: .././pages/download_page.php');
}