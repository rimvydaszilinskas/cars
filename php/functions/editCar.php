<?php
  require_once("../../db/init.php");

  $make = $_REQUEST['make'];
  $year = $_REQUEST['year'];
  $license_plate = $_REQUEST['lp'];
  $mileage = $_REQUEST['mileage'];
  $maintenance = $_REQUEST['maintenance'];
  $carId = $_REQUEST['id'];

  $sql = "UPDATE cars SET make='$make', year='$year', license_plate='$license_plate', mileage='$mileage', maintenance='$maintenance' WHERE id='$carId'";

  $result = mysqli_query($db, $sql);

  if($result===true)
    $answer = "ok";
  else
    $answer = "could not connect";

  echo $answer; 
?>
