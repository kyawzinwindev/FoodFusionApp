<?php 

$host = "127.0.0.1";
$username = 'root';
$password = '';
$db = 'FoodFusionApp';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$connection = mysqli_connect($host, $username, $password, $db);

