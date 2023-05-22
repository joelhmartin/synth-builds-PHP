<?php
  require_once('User.php');
  require_once('functions.php');

  use ITS\A\SPACE\User;
  
  session_start();

  $errorMessage = NULL;

  if (userIsLoggedIn()) {
    header('Location: my-account.php');
    die;
  }

  if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $salted_password = $username . $password . strrev($username);
    $md5_password = md5($salted_password);
    $user = User::getUserByLoginCredentials($username, $md5_password);
    if ($user) {
      $_SESSION['user_uid'] = $user->getId();
      header('Location: my-account.php');
      die;
    } else {
      $errorMessage = 'The username or password was invalid';
  }
}
?>

<!DOCTYPE html>
<html>
  <head> 
    <meta charset="utf-8">
    <title>Login</title>
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
        <h2 class="section-header">Please Log in to continue</h2>

        <?php $message = $errorMessage ? $errorMessage : '&nbsp;'; ?>
        <h2 style="color: red;"><?php print $message; ?></h2>
        <form method="post" action="login.php">
          <label for="username">Username:</label>
          <input required type="text" id="username" name="username"><br><br>
          <label for="password">Password:</label>
          <input required type="password" id="password" name="password"><br><br>
          <input type="submit" id="login" name="login" value="Log In"><br><br>
        </form>
        <form action="create-account.php">
            <input type="submit" value="Create Account">
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