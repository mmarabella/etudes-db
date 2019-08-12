<?php
if ($_COOKIE['logged_in'] != "true") {
  header ('Location: login.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/home-body.css">
    <link rel="stylesheet" href="style/discussion.css">
    <link rel="stylesheet" href="style/shared.css">
    <title>Violin Etudes</title>
  </head>

<?php include("header.php"); ?>
      
<div id="discussion-title"><h2>Discussion</h2> </div>

<?php
  $title = $_POST['topic'];
  $body = $_POST['body'];
  $test = $_POST['test'];

  $host = "localhost";
  $user = "cs329e_mitra_mem44";
  $pwd = "Atomic9steel-ratify";
  $dbs = "cs329e_mitra_mem44";
  $port = "3306";
  $table = "e_discussions";

  $script = $_SERVER['PHP_SELF'];

  $connect = mysqli_connect ($host, $user, $pwd, $dbs, $port);

  if (empty($connect))
  {
    die("mysqli_connect failed: " . mysqli_connect_error());
  }

  if (strlen($body) > 0 && strlen($title) > 0) {
    $titlePurged = purge($title);
    $bodyPurged = purge($body);

    $titleClean = mysqli_real_escape_string($connect, $titlePurged);
    $bodyClean = mysqli_real_escape_string($connect, $bodyPurged);

    $stmt = mysqli_prepare ($connect, "INSERT INTO $table VALUES (?, ?)");
    mysqli_stmt_bind_param ($stmt, 'ss', $titleClean, $bodyClean);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
 }
  $sqlString = "SELECT * FROM $table";

  $result = mysqli_query($connect, $sqlString);
  echo <<<FORM
  <div class='comment-form'>
    <form method="post" action="$script">
      <textarea maxlength='60' placeholder='Topic' cols='45' rows='1' name='topic'/></textarea>
      <br><textarea maxlength='270' cols='45' rows='6' name='body' placeholder='Comment'/></textarea>
      <br><br><input class='my-button' type='submit' value='Post'/>
      <input class='my-button' type='reset' value='Clear'/>
    </form>
  </div>
FORM;

  while ($row = $result->fetch_row())
  {
    echo <<<BODY
    <div class="comment">
      <h5>$row[0]</h5>
      <p>$row[1]</p>
    </div>
BODY;
  }


  function purge ($str)
  {
    $purged_str = preg_replace("/\W/", " ", $str);
    return $purged_str;
  }
?>

<?php include("footer.php"); ?>
