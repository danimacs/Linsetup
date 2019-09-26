<?php

    require_once '../.././configs/connection.php';

        $user = $_GET['user'];
        $token = $_GET['token'];

        if (isset($user) && isset($token)) {
            $sql = "SELECT * FROM tokens WHERE token = '$token' AND user = $user";
            $token = mysqli_query($db, $sql);
            $token = mysqli_fetch_assoc($token);

            if ($token != null){

                //Update row verificate
                $sql = "UPDATE users SET verificate = 1 WHERE id = $user";
                $query_save = mysqli_query($db, $sql);
                
                
                //Delete table
                $sql = "DELETE FROM tokens WHERE token = '$token' AND user = $user";
                mysqli_query($db, $sql);

            }else {
                $_SESSION['errors'] = "There was an error sending the data";
            }

        } else {
            $_SESSION['errors'] = "There was an error sending the data";
        }

    $_SESSION['completed'] = "Your account has been verified";
    header('Location: ../.././index.php');

