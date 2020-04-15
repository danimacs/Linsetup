<?php

if($_POST){

    require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/functions.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/connection.php';

    $txt = "#!/bin/bash \n\n";

    if (!empty($_POST['commands'])){
        $commands_clean = mysqli_real_escape_string($db, $_POST['commands']);
        $commands = explode('\r\n', $commands_clean);
        $long_commands = count($commands) -1;
        for ($i = 0; $i <= $long_commands; $i++){
            $txt = $txt . $commands[$i] . "\n";
        }
        $_SESSION['clickeds']['commands'] = $commands;
    }

    if (isset($_POST['save_autoinstaller'])){
        $saveautoinstaller = mysqli_real_escape_string($db, $_POST['save_autoinstaller']);
        unset($_POST["save_autoinstaller"]);
    }

    if (!isset($_POST['software'])) {

        unset($_POST['commands']);
        $software = array_keys($_POST);
        $long = count($software) -1;

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
            $txt = $txt . "sudo " . $search['source'] . " " . $search['name_packet'] . "\n";
        }

        $_SESSION['clickeds']['software'] = $software;
    }

    if ($saveautoinstaller){

        $user = $_SESSION['user_identify']['id'];
        $list = implode(" ", $software);
        if ($commands) {
            $sql = "INSERT INTO saveautoinstaller VALUE (null, '$saveautoinstaller', $user, '$list', '$commands_clean', 0, NOW())";
        }else{
            $sql = "INSERT INTO saveautoinstaller VALUE (null, '$saveautoinstaller', $user, '$list', null, 0, NOW())";
        }

        mysqli_query($db, $sql);

    }

    $file  = fopen('autoinstaller.sh','w');
    fwrite($file, $txt);
    fclose($file);

    header('Location: ../pages/download_page.php');
    die();
}else{
    header('Location: ../index.php');
    die();
}

?>