<?php
require_once "../src/common.php";
require_once "../config/config.php";

if (!isset($_SESSION['login_user'])){
  header("Location: index.html");
}
else {
  $connection = new PDO($dsn, $db_username, $db_password, $pdo_options);
    $sql = "
    SELECT * FROM users
    ";
    $stmt = $connection->prepare($sql);
    if($stmt->execute()){
      $users = $stmt->fetchAll();
    }
}
?>
<?php include "../resources/templates/header.php";?>

<div class="row">
  <div class="col-md-10 mx-auto">
    <div class="card card-body light-blue">
      <span class="card-title">Follow Your Friends or Someone New</span>
<?php foreach($users as $user){ ?>
            <div class="card-panel mb-0 mt-0">
              <span class="card-title"><a href="user.php?id=<?php echo $user['id']; ?>"><?php echo $user['name'];?></a></span>
            </div>
<?php }?>
    </div>
  </div>
</div>

<?php include "../resources/templates/footer.html";?>