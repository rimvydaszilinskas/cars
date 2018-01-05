<?php
  require_once("../../db/init.php");

  $msgID = $_GET['id'];
  $title = $_POST['title'];
  $msg = $_POST['msg'];

  $sql = "UPDATE public_announcements SET title='".mysqli_real_escape_string($db, $title)."', message='".mysqli_real_escape_string($db, $msg)."' WHERE id='$msgID' LIMIT 1;";

  $result = mysqli_query($db, $sql);

  if(!$result)
    exit("could not connect to the database");
  else {
    header("Location: ../../index.php?p=announcements");
  }
?>
