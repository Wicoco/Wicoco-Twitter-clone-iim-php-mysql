<?php
require_once "../config/config.php";
require_once "../src/common.php";
if (isset($_POST['submit'])) {
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
        die();
    }
}
if (isset($_POST['submit'])) {
    if (isset($_SESSION['login_user'])) {
        $connection = new PDO($dsn, $db_username, $db_password, $pdo_options);

        $sql = "
      INSERT INTO follows (id, follows_id) VALUES (?, ?)
     ";
        $stmt = $connection->prepare($sql);
        if ($stmt->execute(array($_SESSION['login_id'], $_POST['follow_id']))) {
          header('Location: '.$_POST['previous_uri']);
        }
    }
}