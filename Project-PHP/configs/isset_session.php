<?php
if (!isset($_SESSION['user_identify'])){
    $_SESSION['errors'] = "You need to login";
    header('Location: .././index.php');
}