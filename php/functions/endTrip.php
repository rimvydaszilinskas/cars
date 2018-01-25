<?php
  require_once("../../db/init.php");

  session_start();

  $reservation_id = $_REQUEST['id'];
  $reservation = get_reservation($reservation_id);
  $car = find_car($reservation['carid']);
  $carid = $car['id'];
  $mileage = $_POST['end_mileage'];
  $note = $_POST['end_note'];
  $time = date("H:i:s");
  $distance = $mileage - $car['mileage'];
  if($distance < 0)
    exit("Error");
  //update car mileage
  $sql = "UPDATE cars SET mileage='$mileage' WHERE id='$carid' LIMIT 1;";
  if(!mysqli_query($db, $sql))
    exit("Could not connect to the database1");

  //update reservation
  $sql = "UPDATE reservations SET distance='$distance' WHERE id='$reservation_id' LIMIT 1";
  if(!mysqli_query($db, $sql))
    exit("Could not connect to the database2");

  //submit note
  $sql = "INSERT INTO notes (type, message, userid, carid, reservationid, mileage, post_time) VALUES ('1', '$note', '".$_SESSION['id']."', '$carid', '$reservation_id', '$mileage', '$time');";
  if(!mysqli_query($db, $sql))
    exit("Could not connect to the database3");

  //redirect to index.php
  header("Location: ../../index.php");
?>
