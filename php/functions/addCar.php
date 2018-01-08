<?php
  require_once("../../db/init.php");

  $name = $_POST['name'];
  $year = $_POST['year'];
  $mileage = $_POST['mileage'];
  $license_plate = $_POST['license_plate'];

  $sql = "INSERT INTO cars (make, license_plate, year, mileage, maintenance) VALUES ('$name', '$license_plate', '$year', '$mileage', '0')";

  $result = mysqli_query($db, $sql);

  if(!$result)
    header("Location: ../../index.php?p=cars&m=car_add_error");
  header("Location: ../../index.php?p=cars&m=car_added");
?>
