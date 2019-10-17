<?php

    require_once '../.././configs/connection.php';

        $user = mysqli_real_escape_string($db, $_GET['user']);
        $token = mysqli_real_escape_string($db, $_GET['token']);

        if (isset($user) && isset($token)) {
            $sql = "SELECT * FROM tokens WHERE token = '$token' AND user = $user";
            $token = mysqli_query($db, $sql);
            $token = mysqli_fetch_assoc($token);

            if ($token != null){

                //Update row verificate
                if ($_GET['action'] == "verify"){
                    $sql = "UPDATE users SET verificate = 1 WHERE id = '$user'";
                }elseif ($_GET['action'] == "unlock"){
                    $sql = "UPDATE users SET blocked = 0, try = 0 WHERE id = '$user'";
                }

                mysqli_query($db, $sql);

                //Delete table
                $sql = "DELETE FROM tokens WHERE user = '$user'";
                mysqli_query($db, $sql);

            }else {
                $_SESSION['errors'] = "There was an error sending the data";
            }

        } else {
            $_SESSION['errors'] = "There was an error sending the data";
        }

    $_SESSION['completed'] = "The process completed successfully";
    header('Location: ../.././index.php');
