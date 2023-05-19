<?php

// my-account.php

require_once('User.php');
require_once('functions.php');

use ITS\A\SPACE\User;

session_start();

if (userIsLoggedIn()) {
    $user = User::getUserById($_SESSION['user_uid']);
} else {
    header('Location: login.php');
    die;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Upload | Synth Builds</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../CSS/styles.css">
        <script type="module" src="../js/upload-patch.mjs"></script>
        <script type="module" src="../js/load-search-options.mjs"></script>
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
          <h1>Upload Your Recipe</h1>
          <form id="upload-form">
            <div id="upload-part-1"class="list-search">

              <div class="form-item-container">
                <div class="form-item">
                  <label for="title">Title:</label>
                  <input required class="search-field" type="text" id="title" name="title" placeholder="Enter a Title">
                </div>  
                <div class="options-container"></div>  
              </div>
          
              <div class="form-item-container">
                <div class="form-item">
                  <label for="synth">Synth:</label>
                  <input required class="search-field" type="text" id="synth" name="synth" placeholder="Enter a Synth">
                </div>  
                <div class="options-container"></div>  
              </div>

              <div class="form-item-container">
                <div class="form-item">
                  <label for="genre">Genre:</label>
                  <input required class="search-field" type="text" id="genre" name="genre" placeholder="Enter a Genre">
                </div>  
                <div class="options-container"></div>  
              </div>
            </div>

              <h2 class="section-header">Instructions</h2>
              <button id="add-step-button" >Add Step</button>
              <button id="remove-step-button" >Remove Step</button>
              <div class="steps-container">
                <div class="step-row" id="last-row">
                  <label>Step 1</label><input class="step step-text" type="text">
                </div>
              </div>

            <div id="form-button"><input type="submit"></div>
              
          </form>
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