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
    <link rel="stylesheet" href="style/shared.css">
    <script src="search.js"></script>
    <title>Violin Etudes</title>
  </head>
<?php include("header.php"); ?>
        <form action="https://fall-2018.cs.utexas.edu/cs329e-mitra/mem44/project-part6/search-results.php" method="get" id="searchForm">
          <h2>Search Etude Database</h2>
          <div class="form-group">
            <h4>Title</h4>
              <span onmouseover="infoBox('title-name');" onmouseout="infoBox('title-name');">&#9432;</span>
              <span class="info-text" id="title-name">Title of etude</span>
            <input type="text" class="form-control" id="title" name="title">
          </div>
          <div class="checkbox-div">
          <h4>Technique</h4>
              <span onmouseover="infoBox('technique');" onmouseout="infoBox('technique');">&#9432;</span>
              <span class="info-text" id="technique">Skill to practice</span>

            <div class="checkbox form-group">
<?php 

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

  $sqlString = "SELECT DISTINCT technique FROM $table";

  $result = mysqli_query($connect, $sqlString);
  while ($row = $result->fetch_row()) {
    echo <<<BOX
    <label><input type="checkbox" name="technique[]" value="$row[0]"/>$row[0]</label> 
BOX;
  }
 
  $result->free();

  echo <<<CLOSE
</div>
</div>
       <div class="checkbox-div">
          <h4>Difficulty</h4>
              <span onmouseover="infoBox('difficulty');" onmouseout="infoBox('difficulty');">&#9432;</span>
              <span class="info-text" id="difficulty">Level of etude</span>

            <div class="checkbox form-group">
CLOSE;


  $sqlString = "SELECT DISTINCT difficulty FROM $table";

  $result = mysqli_query($connect, $sqlString);
  while ($row = $result->fetch_row()) {
    echo <<<BOX
    <label><input type="checkbox" name="difficulty[]" value="$row[0]"/>$row[0]</label>
BOX;
  }

  $result->free();

  echo <<<CLOSE
</div>
</div>
       <div class="checkbox-div">
          <h4>Composer</h4>
              <span onmouseover="infoBox('composer');" onmouseout="infoBox('composer');">&#9432;</span>
              <span class="info-text" id="composer">Composer name</span>

            <div class="form-group">
              <select style="width: 50%" size="7" name="composer[]" multiple="multiple">
CLOSE;


  $sqlString = "SELECT DISTINCT composer FROM $table";

  $result = mysqli_query($connect, $sqlString);
  while ($row = $result->fetch_row()) {
    echo <<<BOX
    <option value="$row[0]"/>$row[0]</option>
BOX;
  }

$result->free();
mysqli_close($connect);

?>
</select>
</div>
</div>
          <div class="after-boxes"> <button type="submit" class="my-button">Search</button></div>
        </form>

<?php include("footer.php"); ?>
