<?php

session_start();

if ($_SESSION['user_identify']){
    session_destroy();
}

header('Location: ../index.php');
die();

?>
