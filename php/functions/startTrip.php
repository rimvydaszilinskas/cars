<?php
  require_once("../../db/init.php");

  session_start();

  $reservation_id = $_REQUEST['id'];
  $reservation = get_reservation($reservation_id);
  $car = find_car($reservation['carid']);
  $carid = $car['id'];
  $mileage = $_POST['start_mileage'];
  $note = $_POST['start_note'];
  $time = date("H:i:s");

  //check if the mileage on car is different than entered
  if($mileage > $car['mileage']){
    //update it
    $sql = "UPDATE cars SET mileage='$mileage' WHERE id='$carid' LIMIT 1";

    $result = mysqli_query($db, $sql);

    if(!$result)
      exit("Could not connect to the database");
  }

  //submit notes
  $sql = "INSERT INTO notes(type, message, userid, carid, reservationid, mileage, post_time) VALUES('0', '".mysql_escape($note)."', '".$_SESSION['id']."', '$carid', '$reservation_id', '$mileage', '$time');";

  if(!mysqli_query($db, $sql))
    exit("Could not connect to the database");

  //update reservation and set started to 1
  $sql = "UPDATE reservations SET started='1' WHERE id='$reservation_id' LIMIT 1;";
  if(!mysqli_query($db, $sql))
    exit("Could not connect to the database");

  //redirect to index.php
  header("Location: ../../index.php");
?>
