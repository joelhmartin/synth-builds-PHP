<?php

  require_once('User.php');
  require_once('functions.php');
  
  use ITS\A\SPACE\User;

  session_start();
  
  $errorMessages = [];

  if (userIsLoggedIn()) {
    header('Location: my-account.php');
    die;
  }
  
  if (isset($_POST['create-account'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $picture = file_get_contents($_FILES['picture']['tmp_name']);
    $type = $_FILES['picture']['type'];
    $salted_password = $username . $password . strrev($username);
    $md5_password = md5($salted_password);

    if (!User::usernameIsAvailable($username)) {
      $errorMessages[] = 'This username is not available';
    }

    if (substr($type,0,5) !== 'image') {
      $errorMessages[] = 'Please upload images only';
    }

    if (count($errorMessages) === 0) {
      User::createUser($username, $md5_password, $picture, $type);
      $user = User::getUserByLoginCredentials($username, $md5_password);
      $_SESSION['user_uid'] = $user->getId();
      header('Location: my-account.php');
      die;
    }
  }
?>
<!DOCTYPE html>
<html>
  <head> 
    <meta charset="utf-8">
    <title>Create Account</title>
    <link rel="stylesheet" href="../CSS/styles.css">
  </head>
  <body>

    <header class="main-header">
      <h1 class="page-name page-name-big">Synth Builds</h1>
      <nav class="nav main-nav">
          <ul>
              <li><a href="home.php">HOME</a></li>
              <li><a href="login.php">MY ACCOUNT</a></li>
              <li><a href="about.php">ABOUT</a></li>
          </ul>
      </nav>
    </header>
    <section class="main-section container">
      <h2 class="section-header">Please create an account</h2>
        <?php if (count($errorMessages) > 0): ?>
          <?php foreach($errorMessages as $errorMessage): ?>
            <h2 style="color: red;"><?php print $errorMessage; ?></h2>
          <?php endforeach; ?>
          <?php else: ?>
            <h2><?php print '&nbsp;'; ?></h2>
        <?php endif; ?>
      <form method="post" enctype="multipart/form-data" action="create-account.php">
        <label for="username">Username:</label>
          <input required type="text" id="username" name="username"><br><br>
        <label for="password">Password:</label>
          <input required type="password" id="password" name="password"><br><br>
        <label for="picture">Picture:</label>
          <input required type="file" id="picture" name="picture"><br><br>
        <input type="submit" id="create-account" name="create-account" value="Create Account"><br><br>
      </form>
      <form action="login.php">
          <input type="submit" value="Back to Login">
      </form>
    </section>
    <footer class="main-footer">
      <div class="main-footer-container">
        <h3 class="page-name">Synth Builds</h3>
        <ul class="nav footer-nav">
          <li>
              <a href="https://www.youtube.com" target="_blank">
                  <img src="../images/youtube.png" alt="youtube icon">
              </a>
          </li>
          <li>
              <a href="https://www.twitter.com" target="_blank">
                  <img src="../images/twitter.png" alt="twitter icon">
              </a>
          </li>
          <li>
              <a href="https://www.facebook.com" target="_blank">
                  <img src="../images/facebooks.png" alt="facebook icon">
              </a>
          </li>
        </ul>
      </div>
    </footer>
  </body>
</html>