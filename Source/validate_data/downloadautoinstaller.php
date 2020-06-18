<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/connection.php';

$id = (int)$_GET['id'];

if (is_int($id)) {
    $autoinstaller = getsaveautoinstaller($db, $_GET['id']);
    $autoinstaller = mysqli_fetch_assoc($autoinstaller);
}else{
    header('Location: ../index.php');
    die();
}

if ($autoinstaller['share'] == 1 || $_SESSION['user_identify']['id'] == $autoinstaller['user']) {

    $txt = "#!/bin/bash \n";

    if (!empty($autoinstaller['commands'])) {
        $commands = mysqli_real_escape_string($db, $autoinstaller['commands']);
        $commands = explode('\r\n', $commands);
        $long_commands = count($commands) -1;

        for ($i = 0; $i <= $long_commands; $i++){
            $txt .= "\n" .$commands[$i];
        }

        $_SESSION['clickeds']['commands'] = $commands;
    }

    if (!empty($autoinstaller['software'])) {
        $software = explode(" ", $autoinstaller['software']);
        $long = count($software) -1;

        for ($i = 0; $i <= $long; $i++) {
            $searchs = searcherPacketsFromID($db, $software[$i]);
            $search = mysqli_fetch_assoc($searchs);
            if ($search['add_repository'] != null) {
                $txt .= "\n" . $search['add_repository'];
                $txt .= "sudo apt update";
            }
        }

        for ($i = 0; $i <= $long; $i++) {
            $searchs = searcherPacketsFromID($db, $software[$i]);
            $search = mysqli_fetch_assoc($searchs);

            if(strpos($search['source'], 'snap') !== false && !isset($snap)){
                $txt .= "\n" . 'sudo apt install snapd';
                $snap = true;
            }

            $txt .= "\n" . "sudo" . " " . $search['source'] . " " . $search['name_packet'];
        }

        $_SESSION['clickeds']['software'] = $software;

    }

    $file = fopen('linsetup_autoinstaller.sh', 'w');
    fwrite($file, $txt);
    fclose($file);

    header('Location: ../pages/download_page.php');
    die();

}else{
    $_SESSION['errors'] = "This autoinstaller is not shared";
}

header('Location: ../index.php');
die();

?>