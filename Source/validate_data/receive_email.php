<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/connection.php';

    $user = (int)$_GET['user'];
    $token = mysqli_real_escape_string($db, $_GET['token']);

    if (isset($user) && isset($token))  {
        $sql = "SELECT token FROM tokens WHERE token = '$token' AND user = $user";
        $token = mysqli_query($db, $sql);
        $token = mysqli_fetch_assoc($token);
        $token = $token['token'];

        if ($token){

            //Update row verificate
            if ($_GET['action'] == "verify"){
                $sql = "UPDATE users SET verificate = 1 WHERE id = '$user'";
                $_SESSION['completed'] = "The process completed successfully";
            }elseif ($_GET['action'] == "unlock"){
                $sql = "UPDATE users SET blocked = 0, try = 0 WHERE id = '$user'";
                $_SESSION['completed'] = "The process completed successfully";
            }elseif($_GET['action'] == "recovery"){
                $sql = "UPDATE tokens SET status = 1 WHERE user = '$user' AND token = '$token'";
                mysqli_query($db, $sql);
                header('Location: ../index.php?recovery_password&user='.$user.'&token='.$token);
                die();
            }

            $update = mysqli_query($db, $sql);

            if($update){
                $sql = "DELETE FROM tokens WHERE user = '$user' AND token = '$token'";
                mysqli_query($db, $sql);
            }

        } else {
            $_SESSION['errors'] = "There was an error sending the data";
        }

    } else {
        $_SESSION['errors'] = "There was an error sending the data";
    }

header('Location: ../index.php');
die();

?>