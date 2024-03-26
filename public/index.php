<?php
require_once "../src/common.php";
require_once "../config/config.php";
?>
<?php include "../resources/templates/header.php";?>
<?php
$logged_in = false;
if (isset($_SESSION['login_user'])) {
    $logged_in = true;
}

// Get the latest tweets from the database
// For now just get all available tweets
// Later we will only get tweets from people we follow
if ($logged_in) {
    $connection = new PDO($dsn, $db_username, $db_password, $pdo_options);
    $sql = "
    SELECT users.name, tweets.content, tweets.date, tweets.user_id 
    FROM tweets 
    JOIN users ON tweets.user_id = users.id
    WHERE tweets.user_id IN (SELECT follows_id FROM follows WHERE id = ?)
    ORDER BY tweets.date DESC
    ";
    $stmt = $connection->prepare($sql);
    if($stmt->execute(array($_SESSION['login_id']))){
      $tweets = $stmt->fetchAll();
    }
}
?>
<div class="container center">
<h1>Welcome to Twitter Clone</h1>
</div>
<?php if ($logged_in) {?>
<div class="row">
  <div class="col-md-10 mx-auto">
    <div class="card card-body light-blue">
      <span class="card-title">Tweet Something</span>
      <form action="add_tweet.php" method="POST">
        <div class="form-group">
          <textarea type="text" class="form-control" name="content" maxlength="140" required></textarea>
        </div>
        <input type="submit" name="submit" value="Tweet" class="btn btn-primary">
        <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
      </form>
    </div>
  </div>
</div>
<?php }?>

<?php if ($logged_in) {?>

<div class="row">
  <div class="col-md-10 mx-auto">
    <div class="card card-body light-blue">
      <span class="card-title">Home Feed</span>
<?php foreach($tweets as $tweet){ ?>
            <div class="card-panel mb-0 mt-0">
              <span class="card-title"><a href="user.php?id=<?php echo $tweet['user_id']; ?>"><?php echo $tweet['name'];?></a></span>
              <span class="text"><?php echo $tweet['date'];?></span>
              <p><?php echo $tweet['content'];?></p>
            </div>
<?php }?>
    </div>
  </div>
</div>

<?php }?>

<?php include "../resources/templates/footer.html";?>