<?php
  require_once("../../db/init.php");
  //continue session
  session_start();

  //get the variables
  $id = $_SESSION['id'];
  $date = $_POST['date'];
  $destination = $_POST['destination'];
  list($day, $month, $year) = explode("-", $date);

  $sql = "INSERT INTO reservations (userid, day, month, year, carid, destination, distance, approved, note) VALUES ('$id', '$day', '$month', '$year', '0', '$destination', '0', '0', ' ');";

  $result = mysqli_query($db, $sql);

  if(!$result){
    header("Location: ../../index.php?p=reserve&m=reserve_error");
  }

  header("Location: ../../index.php?p=reserve&m=reserve_success");
?>
