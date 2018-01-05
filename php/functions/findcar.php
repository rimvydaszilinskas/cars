<?php
  $carID = $_REQUEST['id'];

  $sql = "SELECT * FROM cars WHERE id='".$carID."'";

  $result = mysqli_query($db, $sql);

  if(!$result)
    exit("Could not connect to the database");

  $car = mysqli_fetch_assoc($result);

  echo $car['make'];
?>
