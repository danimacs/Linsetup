<?php


$server = 'localhost';
$username = 'phpmyadmin';
$password = 'root';
$database = 'project';
$db = mysqli_connect($server, $username, $password, $database);

mysqli_query($db, "SET NAMES 'utf8");

session_start();

