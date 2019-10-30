<?php

include_once '.././configs/functions.php';
include_once '.././configs/connection.php';

$id = (int)$_GET['id'];
if (is_int($id)) {
    $_SESSION['clickeds'] = getsaveautoinstaller($db, $_GET['id']);
    $_SESSION['clickeds'] = mysqli_fetch_assoc($_SESSION['clickeds']);
    $_SESSION['clickeds'] = $_SESSION['clickeds']['software'];
}

$_SESSION['clickeds'] = explode(" ", $_SESSION['clickeds']);
$long = count($_SESSION['clickeds']);
$long--;
$defect = "sudo apt install ";
$txt = "#!/bin/bash \n\n";

for ($i = 0; $i <= $long; $i++) {
    $searchs = searcherPacketsFromID($db, $_SESSION['clickeds'][$i]);
    $search = mysqli_fetch_assoc($searchs);
    $txt = $txt . $defect . $search['name'] . "\n";
}

$file  = fopen('autoinstaller.sh','w');
fwrite($file, $txt);
fclose($file);

header('Location: .././pages/download_page.php');
