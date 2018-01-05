<?php
  require_once("../../db/init.php");

  $id = $_REQUEST['id'];

  $sql = "DELETE FROM public_announcements WHERE id='$id'";

  $result = mysqli_query($db, $sql);

  if(!$result)
    exit("Could not connect to the database");
  else {
    header("Location: ../../index.php?p=announcements");
  }
?>
