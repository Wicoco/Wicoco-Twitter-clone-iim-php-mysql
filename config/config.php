<?php
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "twitter_clone";
$dsn = "mysql:host=$db_host;dbname=$dbname";
$pdo_options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
);
?>