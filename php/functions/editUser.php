<?php
  require_once("../../db/init.php");

  $id = $_GET['id'];
  $name = $_POST['name'];
  $number = $_POST['number'];
  $email = $_POST['email'];
  $position = $_POST['position'];

  $sql = "UPDATE users SET name='$name', email='$email', position='$position' WHERE id='$id' LIMIT 1";

  $result = mysqli_query($db, $sql);

  if($result == false)
    exit("Could not connect to the database");
  else
    header("Location: ../../index.php?p=users");
?>
