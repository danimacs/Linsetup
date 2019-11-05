<?php

include_once '.././configs/functions.php';
include_once '.././configs/connection.php';

if (empty($_POST['commands'])){
    unset($_POST["commands"]);
}

if (isset($_POST['commands'])){
    $commands = $_POST['commands'];
    unset($_POST["commands"]);
}

if (isset($_POST['save_autoinstaller'])){
    $saveautoinstaller = mysqli_real_escape_string($db, $_POST['save_autoinstaller']);
    unset($_POST["save_autoinstaller"]);
}

$txt = "#!/bin/bash \n\n";
$software = array_keys($_POST);
$long = count($software);
$long--;

if ($commands){
    $txt = $txt . $commands . "\n";
}

if ($saveautoinstaller){

    $user = $_SESSION['user_identify']['id'];
    $list = implode(" ", $software);
    if ($commands) {
        $sql = "INSERT INTO saveautoinstaller VALUE (null, '$saveautoinstaller', $user, '$list', '$commands', 0, NOW())";
    }else{
        $sql = "INSERT INTO saveautoinstaller VALUE (null, '$saveautoinstaller', $user, '$list', null, 0, NOW())";
    }

    mysqli_query($db, $sql);

}

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

if (empty($_POST)){
    header('Location: .././index.php');
}else{
    header('Location: .././pages/download_page.php');
}

