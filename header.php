  <body>
    <div class="content container">
      <div class="row header">
          <div class="col-sm-1 header-logo">
            <a href="index.php"><img src="img/logo2.png" alt="Page logo" id="logo"></a>
          </div>
          <div class="col-sm-11 header-content">
            <div class="title-and-button container-fluid">
              <h1 class="page-title">violin etudes</h1>

<?php
  session_start();
  $name = $_SESSION['name'];
  $logged_in = $_COOKIE['logged_in'];
  if ($logged_in =="true") {
    echo <<<BUTTON
      <div class="logout-button"><p><a href="logout.php">Log Out</a></p></div>
      <div class="logout-button"><p>Welcome, $name!</p></div>
BUTTON;
  }

  else {
    echo <<<BUTTON
      <span><a href="login.php" class="login-button">Log In</a></span>
BUTTON;
  }
?>
            </div>

            <nav class="navbar navbar-default navbar-expand-sm">
              <div class="container-fluid">
                <ul class="nav navbar-nav">
                  <li><a href="search.php">SEARCH</a></li>
                  <li><a href="discussion.php">DISCUSSION</a></li>
                  <li><a href="contact.php">CONTACT US</a></li>
                </ul>
              </div>
            </nav>
          </div>
      </div>
<div class="row home-page-content">
