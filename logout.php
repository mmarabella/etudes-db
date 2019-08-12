<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/home-body.css">
    <title>Thanks!</title>
  </head>

<?php
$_POST = array();
session_destroy();
/*unset($_COOKIE['logged_in']);*/
$_COOKIE['logged_in'] = "false";
include("header.php");
/*header ('Location: index.php');
exit(); */

?>

<h2 style="width: 100%; text-align: center;">Thank you!</h2>
