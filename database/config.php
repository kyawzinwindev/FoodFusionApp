<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$host = "127.0.0.1";
$username = 'root';
$password = '';
$db = 'FoodFusionApp';

$connection = mysqli_connect($host, $username, $password, $db);

