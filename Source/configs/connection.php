<?php

$server = "localhost";
$username = "phpmyadmin";
$password = "root";
$database = "WPM";
$db = mysqli_connect($server, $username, $password, $database);

mysqli_query($db, "SET NAMES 'utf8'");

session_start();

