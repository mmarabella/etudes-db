<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/home-body.css">
    <link rel="stylesheet" href="style/login.css">
    <link rel="stylesheet" href="style/shared.css">
<link rel="stylesheet" href="style/shared.css">
    <script src="login.js"></script>
    <title>Login</title>
  </head>
<?php include("header.php"); ?>

<?php
if (!empty($_POST["userName"])) {
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

  $uName = $_POST['userName'];
  $password = $_POST['password'];
  $hash = hash('sha512', $password);
  if (array_key_exists($uName, $users) && $users[$uName] == $hash) {
    setcookie ("logged_in", "true", time()+1800);
    $_SESSION['name'] = "$uName";
    header ('Location: index.php');
    exit();
  }
  else {
    echo "<p class='create-text' style='color: red;'>Invalid login</p>";
  }
}
  $script = $_SERVER['PHP_SELF'];
  echo <<<FORM
  <div class='login-form'>
  <form method="post"
  action="$script">
  <label>User Name</label><br>
  <input type="text" name="userName"/><br><br>
  <label>Password</label><br>
  <input type="password" name="password"/><br><br>
  <input type="submit" name="submit" value="Log In" class="my-button"/><br><br>
  </form>
FORM;
?>
<div class="create-new"><a href="https://fall-2018.cs.utexas.edu/cs329e-mitra/mem44/project-part6/create.php">Create new account</a></div>
</div>
<?php include("footer.php");?>
