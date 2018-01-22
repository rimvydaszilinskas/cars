<?php
  /*
   * Reservation confirm
   * Receives car ID by post
   * updates database if car id is valid, othervise it is updated as unnaproved
   */

  require_once("../../db/init.php");

  $id = $_REQUEST['id'];
  $car = $_POST['car'];
  $userid = $_POST['userid'];
  list($year, $month, $day) = explode("-", $_POST['date']);
  $today = date("y-m-d");

  if($car == 'null'){
    //update as unnaproved
    $sql = "UPDATE reservations SET carid='0', approved='0' WHERE id='$id' LIMIT 1";
  } else {
    //update as approved and set carid to the car id received by _POST
    $sql = "UPDATE reservations SET carid='$car', approved='1' WHERE id='$id' LIMIT 1";
  }

  //push query
  $result = mysqli_query($db, $sql);

  //check if the result is true
  if(!$result){
    // redirect to index.php and display error message
    header("Location: ../../index.php?p=reservations&m=reservation_error");
  } else {
    //send a message to the user
    if($car == 'null'){
      //get default unnaproved message
      $msg = create_rejected_message($year, $month, $day, $_POST['destination']);
      $sql = $sql = "INSERT INTO messages(`userid`, `read`, `sent`, `message`) VALUES ('$userid', '0', '$today', '$msg');";
      $result = mysqli_query($db, $sql);
      if(!$result)
        exit("Could not connect to the database");
    } else {
      //get default approved message
      $msg = create_approved_message($year, $month, $day, $_POST['destination'], find_car_name($car), find_car($car)['license_plate']);
      $sql = "INSERT INTO messages(`userid`, `read`, `sent`, `message`) VALUES ('$userid', '0', '$today', '$msg');";
      $result = mysqli_query($db, $sql);
      echo $today;
      if(!$result)
        exit("Could not connect to the database");
    }
    // redirect to index.php and display success message
    header("Location: ../../index.php?p=reservations&m=reservation_ok");
  }
?>
