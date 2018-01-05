<?php
  require_once("../../db/init.php");

  $id = $_REQUEST['id'];

  $sql = "DELETE FROM cars WHERE id='".$id."';";

  $result = mysqli_query($db, $sql);

  if(!$result)
    exit("Could not connect to the database");
  else if($result === true)
    header("Location: ../../index.php?p=cars");

?>
