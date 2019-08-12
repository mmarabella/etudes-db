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
    <link rel="stylesheet" href="style/search.css">
    <script src="search.js"> </script>
    <title>Violin Etudes</title>
  </head>

<?php include("header.php"); ?>
<?php
  $title = $_GET['title'];
  $composers = $_GET['composer'];
  $techniques = $_GET['technique'];
  $levels = $_GET['difficulty'];

  $host = "localhost";
  $user = "cs329e_mitra_mem44";
  $pwd = "Atomic9steel-ratify";
  $dbs = "cs329e_mitra_mem44";
  $port = "3306";
  $table = "e_etudes";

  $connect = mysqli_connect ($host, $user, $pwd, $dbs, $port);

  if (empty($connect))
  {
    die("mysqli_connect failed: " . mysqli_connect_error());
  }

  $sqlString = "SELECT * FROM $table WHERE title LIKE '%$title%' AND (technique = '$techniques[0]' ";

  foreach ($techniques as $technique) {
    $sqlString = $sqlString . " OR technique = '" . $technique . "'";
  }

  if (count($techniques) == 0) {
    $sqlString = $sqlString . "OR 1 = 1";
  }

  $sqlString = $sqlString . ") AND (composer = '$composers[0]' ";

  foreach ($composers as $composer) {
    $sqlString = $sqlString . " OR composer = '" . $composer . "'";
  }

  if (count($composers) == 0) {
    $sqlString = $sqlString . "OR 1 = 1";
  }

  $sqlString = $sqlString . ") AND (difficulty = '$levels[0]' ";

  foreach ($levels as $level) {
    $sqlString = $sqlString . " OR difficulty = '" . $level . "'";
  }

  if (count($levels) == 0) {
    $sqlString = $sqlString . "OR 1 = 1";
  }

  $sqlString = $sqlString . ')';
//  echo $sqlString; 
  $result = mysqli_query($connect, $sqlString);


  echo <<<TOP
  <h2 style="margin: auto;">Search Results</h2>
  <table class="table table-hover table-bordered" style="margin-top: 10px;">
  <thead class="thead-dark">
  <tr>
    <th>Title</th>
    <th>Composer</th>
    <th>Etude Number</th>
    <th>Technique</th>
    <th>IMSLP</th>
  <tr>
  </thead>
TOP;

  while ($row = $result->fetch_row())
  {
    echo <<<BODY
    <tr>
      <td>$row[0]</td>
      <td>$row[1]</td>
      <td>$row[8]</td>
      <td>$row[5]</td>
      <td><a href='$row[7]' target='_blank'>$row[7]</a></td>
    </tr>
BODY;
  }  
  
  echo "</table>";
?>

      </div>
      <div class="row footer">
        <span> Page created by: <a href="mailto:mmarabella@utexas.edu">Madalyn Marabella</a> </span>
        <span id="timestamp"> <script> document.write("This page was last modified on: " + document.lastModified +""); </script> </span>
        <div id="citation">All images used are open source and do not require citation</div>
      </div>
    </div>
  </body>
</html>
