<?php
   require_once "../config/config.php";
   require_once "../src/common.php";
   if(isset($_SESSION['login_user'])){
     header("location: index.php");
   }
   if (isset($_POST['submit'])) {
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
        die();
    }
  }
   if(isset($_POST['submit'])) {
      // username and password sent from form 
      
      $connection = new PDO($dsn, $db_username, $db_password, $pdo_options);
      
      $sql = "SELECT id, name, password FROM users WHERE email = ?";
      $stmt = $connection->prepare($sql);
      $password = '';
      if ($stmt->execute(array($_POST['email']))) {
        $row = $stmt->fetch();
        $password = $row['password'];
        $name = $row['name'];
        $id = $row['id'];
      }
      if(password_verify($_POST['password'], $password)) {
        $_SESSION['login_user'] = $name;
        $_SESSION['login_id'] = $id;
        
        header("location: index.php");
     }else {
        $error = "Your Login Name or Password is invalid";
        echo $error;
     }
   }
?>
<?php include "../resources/templates/header.php";?>

<div class="row">
  <div class="col-md-6 mx-auto">
    <div class="card card-body">
      <h3 class="text-center">Account Login</h3>
      <form action="login.php" method="POST">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" required>
        </div>
        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
      </form>
      <br>
      <a href="register.php">New to Twitter Clone? Register here.</a>
    </div>
  </div>
</div>

<?php include "../resources/templates/footer.html";?>