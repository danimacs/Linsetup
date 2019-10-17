<?php
require_once './configs/connection.php';
require_once './configs/functions.php';

if(isset($_POST['searcher'])){
    $searcher = mysqli_real_escape_string($db, $_POST['searcher']);
}

if (isset($searcher) && !empty($searcher)) {

    if (isset($_POST['complement'])){
        $searchers = searcherPacketsComplements($db, $searcher);
    }else{
        $searchers = searcherPackets($db, $searcher);
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
