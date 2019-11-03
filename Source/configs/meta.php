<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<meta name="title" content="LINSETUP">
<meta name="description" content="Installer generator for linux">
<meta name="keywords" content="Linux, Installer, Script, Generator">
<meta name="robots" content="index, follow, all">
<meta http-equiv="Content-Language" content="en">
<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<?php
//Refresh Session
if (isset($_SESSION['user_identify'])) {
    $sql = "SELECT * FROM users WHERE id =".$_SESSION['user_identify']['id'];
    $refresh = mysqli_query($db, $sql);
    $_SESSION['user_identify'] = mysqli_fetch_assoc($refresh);
}
?>
