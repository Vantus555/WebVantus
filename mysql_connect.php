<?php
require_once 'mysql_data.php';
$dsn = "mysql:host=$host;dbname=$db;charset=utf8;";
$pdo = new PDO($dsn, $user, $password);
?>
