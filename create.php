<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/home-body.css">
    <link rel="stylesheet" href="style/shared.css">
    <link rel="stylesheet" href="style/login.css">
    <script src="login.js"></script>
    <title>Login</title>
  </head>
<?php include("header.php"); ?>

<?php
  $script = $_POST['PHP_SELF'];
  echo <<<FORM
<div class="login-form">
<form method="post" action="$script" onsubmit="return validate();" id="createForm">
  <label>User Name</label><br>
  <input type="text" onchange="callServer();" name="newUserName" id="newUserName"/><br><br>
  <label>Password</label><br>
  <input type="password" name="newPassword"/><br><br>
  <input type="submit" name="submit" class="my-button" value="Create account"/>
</form>
</div>
<br><br><div class="create-text"><p id="nameTaken" style='color: red;'></p></div>
FORM;

  $file = fopen ("passwd", "r");
  $users = array();
  while (!feof($file))
  {
    $line = fgets($file);
    $exploded = explode(":",$line);
    $name = trim($exploded[0]);
    $pwd = trim($exploded[1]);
    $users[$name] = $pwd;
  }
  unset($users['']);
  unset($users[' ']);

  fclose($file);

  $uName = trim($_POST['newUserName']);
  $password = trim($_POST['newPassword']);

  if (array_key_exists($uName, $users)) {
    echo "<div class='create-text'><br><p style='color: red;'>Could not create account! User name already exists</p></div>";
  }
  else {
    if (!empty($uName) && !empty($password)) {
      $file = fopen ("passwd", "a");
      $hash = hash('sha512', $password);
      fwrite($file, $uName . ":" . $hash . "\n");
      fclose($file);
      echo "<div class='create-text'><br><p>Account created!</p></div><br>
        <div class='create-text'><a href='https://fall-2018.cs.utexas.edu/cs329e-mitra/mem44/project-part6/login.php'>Log in</a></div>";
    }
 }
?>

<?php include("footer.php");?>
