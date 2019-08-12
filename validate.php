<?php
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

  if (array_key_exists($uName, $users)) {
    echo "true";
  }
  else {
    echo "false";
  }
?>
