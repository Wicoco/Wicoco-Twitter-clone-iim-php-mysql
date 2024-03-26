<?php
require_once "../config/config.php";
require_once "../src/common.php";

if (isset($_POST['submit'])) {
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
        die();
    }
}

if (isset($_POST['submit']) && isset($_SESSION['login_user'])) {
    $connection = new PDO($dsn, $db_username, $db_password, $pdo_options);

    $sql = "INSERT INTO tweets (user_id, content) VALUES (?, ?);";
    $stmt = $connection->prepare($sql);
    if ($stmt->execute(array($_SESSION['login_id'],$_POST['content']))){
      echo 'SUCCESS';
    }
}
header('Location: index.php');
?>