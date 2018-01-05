<?php
  require_once('../../db/init.php');
  //hides post and redirects back to the main menu announcements area
  $id = $_GET['id'];
  $active = $_GET['active'];

  if($active === '1')
    $sql = "UPDATE public_announcements SET active='0' WHERE id='$id' LIMIT 1";
  else
    $sql = "UPDATE public_announcements SET active='1' WHERE id='$id' LIMIT 1";

  $result = mysqli_query($db, $sql);

  if(!$result)
    exit("Could not connect to the database");
  else
    header("Location: ../../index.php?p=announcements");
?>
