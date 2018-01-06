<?php
  require_once("../../db/init.php");

  $id = $_REQUEST['id'];

  $sql = "DELETE FROM users WHERE id='$id' LIMIT 1";

  $result = mysqli_query($db, $sql);

  if(!$result)
    exit("Could not connect to database");
  echo "ok";
?>
