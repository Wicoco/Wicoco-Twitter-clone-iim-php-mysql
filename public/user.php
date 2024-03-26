<?php
require_once "../config/config.php";
require_once "../src/common.php";
if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
}
if (isset($_GET['id'])) {
    $connection = new PDO($dsn, $db_username, $db_password, $pdo_options);

    $sql = "
    SELECT users.name, tweets.content, tweets.date, tweets.user_id
     FROM tweets
     LEFT JOIN users ON tweets.user_id = users.id
     WHERE users.id = ?
     ORDER BY tweets.date DESC
     ";
    $stmt = $connection->prepare($sql);
    if ($stmt->execute(array($_GET['id']))) {
        $tweets = $stmt->fetchAll();
    }
    if (isset($tweets) && count($tweets) > 0) {
        $has_tweets = true;
    }
    $sql = "
    SELECT name FROM users WHERE id = ? LIMIT 1
     ";
    $stmt = $connection->prepare($sql);
    if ($stmt->execute(array($_GET['id']))) {
        $user = $stmt->fetch();
        if (isset($user)) {
            $username = $user['name'];
        } else {
            header("Location: index.php");
        }
    }
    $sql = "
    SELECT count(*) as followers FROM follows WHERE follows_id = ?
     ";
    $stmt = $connection->prepare($sql);
    if ($stmt->execute(array($_GET['id']))) {
        $followers = $stmt->fetch()['followers'];
    }
    $sql = "
    SELECT count(*) as following FROM follows WHERE id = ?
     ";
    $stmt = $connection->prepare($sql);
    if ($stmt->execute(array($_GET['id']))) {
        $following = $stmt->fetch()['following'];
    }
    // User follows you?
    $sql = "
    SELECT * FROM follows WHERE id = ? AND follows_id = ?
     ";
    $stmt = $connection->prepare($sql);
    if ($stmt->execute(array($_GET['id'], $_SESSION['login_id']))) {
        $follows_you = count($stmt->fetchAll()) > 0;
    }
    // you follow this user?
    $sql = "
    SELECT * FROM follows WHERE id = ? AND follows_id = ?
     ";
    $stmt = $connection->prepare($sql);
    if ($stmt->execute(array($_SESSION['login_id'], $_GET['id']))) {
        $follows_them = count($stmt->fetchAll()) > 0;
    }
    $my_page = $_SESSION['login_id'] == $_GET['id'];

} else {
    header("Location: index.php");
}
?>
<?php include "../resources/templates/header.php";?>

<?php if (isset($username)) {?>
  <div class="container">
<h3><span> <?php echo $username; ?>'s Profile
<b>Followers: <?php echo $followers; ?></b>
<b> Following: <?php echo $following; ?></b>
</span></h3>

<?php if ($follows_you) {?>
<h6>Follows you.</h6>
<?php }?>
<?php if (!$follows_them && !$my_page) {?>

<form action="follow_user.php" method="POST">
<input type="submit" name="submit" class="btn btn-primary" value="Follow <?php echo $username; ?>">
        <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
<input type="hidden" name="follow_id" value="<?php echo $_GET['id']; ?>">
<input type="hidden" name="previous_uri" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
</form>
</div>

<?php } elseif (!$my_page) { ?>
  <form action="unfollow_user.php" method="POST">
<input type="submit" name="submit" class="btn btn-primary" value="Unfollow <?php echo $username; ?>">
        <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
<input type="hidden" name="follow_id" value="<?php echo $_GET['id']; ?>">
<input type="hidden" name="previous_uri" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
</form>
</div>

<?php }?>
<?php }?>


<?php if (isset($has_tweets)) {?>

<div class="row">
  <div class="col-md-10 mx-auto">
    <div class="card card-body light-blue">
      <span class="card-title"><?php echo $tweets[0]['name']; ?>'s Feed</span>
<?php foreach ($tweets as $tweet) {?>
            <div class="card-panel mb-0 mt-0">
              <span class="card-title"><a href="user.php?id=<?php echo $tweet['user_id']; ?>"><?php echo $tweet['name']; ?></a></span>
              <span class="text"><?php echo $tweet['date']; ?></span>
              <p><?php echo $tweet['content']; ?></p>
            </div>
<?php }?>
    </div>
  </div>
</div>
<?php } else {?>
  <div class="row center">
  <div class="col-md-10 mx-auto">
  <h3> This user has no tweets yet.</h3>
</div>
</div>

<?php }?>

<?php include "../resources/templates/footer.html";?>