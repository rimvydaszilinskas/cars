<?php
  require_once("../../db/init.php");

  $title = mysqli_real_escape_string($db, $_REQUEST['title']);
  $msg = mysqli_real_escape_string($db, $_REQUEST['msg']);
  $date = date('Y') . "-" . date('m') . "-" . date('j');

  $sql = "INSERT INTO public_announcements (title, message, createDate, active) VALUES ('$title', '$msg', '$date', '1')";

  $result = mysqli_query($db, $sql);

  if(!$result)
    exit("Could not connect to the database");
  else {
    header("Location: ../../index.php?p=announcements");
  }
?>
