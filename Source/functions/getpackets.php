<?php
require_once './configs/connection.php';
require_once './configs/functions.php';

if (isset($_POST['searcher']) && !empty($_POST['searcher'])) {

    if (isset($_POST['complement'])){
        $searchers = searcherPacketsComplements($db, $_POST['searcher']);
    }else{
        $searchers = searcherPackets($db, $_POST['searcher']);
    }

}else{
    $mostdownloads = searcherPacketsMostDownloads($db);
}

if (!isset($_SESSION['clickeds'])){
    $_SESSION['clickeds'] = array();
}

if (isset($_SESSION['clean_clickeds'])){
    $_SESSION['clickeds'] = array();
    unset($_SESSION['clean_clickeds']);
}

?>