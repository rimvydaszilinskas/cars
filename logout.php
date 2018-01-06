<?php
  require_once("db/init.php");
  //unset the $_SESSION variables
  session_start();
  unset($_SESSION['id']);
  session_destroy();
  //link to login.php
  header("Location: login.php");
?>
