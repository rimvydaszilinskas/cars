<?php
  require_once("../../db/init.php");

  $title = $_REQUEST['title'];
  $msg = $_REQUEST['msg'];
  $date = date('Y') . "-" . date('m') . "-" . date('j');

  $sql = "INSERT INTO public_announcements (title, message, createDate, active) VALUES ('$title', '$msg', '$date', '1')";

  $result = mysqli_query($db, $sql);

  if(!$result)
    exit("Could not connect to the database");
  else {
    
  }
?>
