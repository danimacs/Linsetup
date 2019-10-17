<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<meta name="title" content="">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="robots" content="index, follow, all">
<meta http-equiv="Content-Language" content="en">
<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
<?php
//Refresh Session
if (isset($_SESSION['user_identify'])) {
    $sql = "SELECT * FROM users WHERE id =".$_SESSION['user_identify']['id'];
    $refresh = mysqli_query($db, $sql);
    $_SESSION['user_identify'] = mysqli_fetch_assoc($refresh);
}
?>
