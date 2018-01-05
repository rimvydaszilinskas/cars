<?php
  require_once("../../db/init.php");

  $id = $_GET['id'];
  $make = $_POST['make'];
  $year = $_POST['year'];
  $license_plate = $_POST['license_plate'];
  $mileage = $_POST['mileage'];
  if(isset($_POST['maintenance']))
    $maintenance = '1';
  else
    $maintenance = '0';

  $sql = "UPDATE cars SET make='$make', year='$year', license_plate='$license_plate', mileage='$mileage', maintenance='$maintenance' WHERE id='$id' LIMIT 1;";

  $result = mysqli_query($db, $sql);

  if($result == false)
    exit("Could not connect to the database");
  else
    header("Location: ../../index.php?p=cars");
?>
