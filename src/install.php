<?php 
require "../config/config.php";

try {
$connection = new PDO("mysql:host=$db_host",$db_username,$db_password,$pdo_options);
$sql = file_get_contents("../resources/data/init.sql");
// echo $sql . '\n';
echo $connection->exec($sql);
echo "Database and table users created successfully.";
}
catch (PDOException $error){
  echo $sql . "<br>" . $error->getMessage();
}
?>