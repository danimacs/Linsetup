<?php

if (!isset($_SESSION['user_identify'])){
    header('Location: ../index.php?login');
    die();
}

?>
