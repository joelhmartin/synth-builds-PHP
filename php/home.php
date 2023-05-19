<?php
// my-account.php
require_once('User.php');
require_once('functions.php');

use ITS\A\SPACE\User;

session_start();

if (userIsLoggedIn()) {
    $user = User::getUserById($_SESSION['user_uid']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>My Account</title>
  <link rel="stylesheet" href="../CSS/styles.css">
  <script type="module" src="../js/filter-search.mjs"></script>
</head>
<body>

      <header class="main-header">
        <h1 class="page-name page-name-big">Synth Builds</h1>
        <nav class="nav main-nav">
          <ul>
            <li><a  class="selected" href="home.php">HOME</a></li>
            <li><a href="login.php">MY ACCOUNT</a></li>
            <li><a href="about.php">ABOUT</a></li>
          </ul>
        </nav>
      </header>

<div class="page-container">

<div class="left-container">

  <div class="account-display">
    <h3 class="my-account-title"><?php print isset($user) ? 'Logged in as' : 'Not Logged In'  ; ?></h3>
    <h3><?php print isset($user) ? $user->getUsername() : ''  ; ?></h3><span><img id="prof-thumb" src="get-picture.php"></span>
    <?php print isset($user) ? '<form action="logout.php"><input type="submit" value="Logout"></form>' : '<form action="login.php"><input type="submit" value="Login/Register"></form>'?>
    <?php print isset($user) ? '<form action="upload.php"><input type="submit" value="Upload&#10;Patch"></form>' : ''  ; ?>
  </div>

  <div class="left-image-container">
    <img src="../images/synth_monster.jpeg" alt="dinosaur holding synth">
  </div>
</div>

<section class="main-section container">
  <div class="synths-container">

    <h2 class="section-header">Recent Uploads</h2>
      <div class="main-patch-container recents">
      </div>

    <h2 class="section-header">Browse Patches</h2>
      <form id="filter-search" class="list-search">
        <div class="form-item-container">
          <div class="form-item">
            <label for="genre">Genre:</label>
            <input class="search-field" type="text" id="genre" name="genre" placeholder="Search by Genre">
          </div>  
          <div class="options-container"></div>  
        </div>

        <div class="form-item-container">
          <div class="form-item">
            <label for="title">Title:</label>
            <input class="search-field" type="text" id="title" name="title" placeholder="Search by Title">
          </div>  
          <div class="options-container"></div>  
        </div>

        <div class="form-item-container">
          <div class="form-item">
            <label for="synth">Synth:</label>
            <input class="search-field" type="text" id="synth" name="synth" placeholder="Search by Synth">
          </div>  
          <div class="options-container"></div>  
        </div>

        <div class="form-item-container">
          <div class="form-item">
            <label for="author">Author:</label>
            <input class="search-field" type="text" id="author" name="author" placeholder="Search by Author">
          </div>  
          <div class="options-container"></div>  
        </div>

        <div class="form-item-container">
          <div class="form-item">
            <input type="submit">
          </div>
        </div>
      </form>
    <div class="main-patch-container browse">
    </div>

  </div>
</section>

</div>

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
