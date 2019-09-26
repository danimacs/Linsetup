<?php

if (!isset($_SESSION)) {
    session_start();
}

    if ($_GET['action'] == 'add') {

        if (isset($_GET)) {

            if (!isset($_SESSION['clickeds'])) {
                $_SESSION['clickeds'] = array();
            }
            array_push($_SESSION['clickeds'], $_GET['id']);
        }
    }

    if ($_GET['action'] == 'delete'){

        unset($_SESSION['clickeds'][$_GET['position']]);
        $_SESSION['clickeds'] = array_values($_SESSION['clickeds']);

    }

header('Location: .././index.php');