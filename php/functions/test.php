<?php
  require_once("../../db/init.php");

  $sql = "INSERT INTO messages(userid, read, sent, message) VALUES ('11', '0', '2018-01-22', 'Kazkas tokio'); ";
  $result = mysqli_query($db, $sql);
  if(!$result)
    exit("Could not connect to the database");
?>
