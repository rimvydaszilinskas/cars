<?php
  require_once("../db/init.php");

  session_start();
  if(!isset($_SESSION['id']) || !isset($_SESSION['admin'])){
    header("location: ../index.php");
  }
  $sql = "SELECT id FROM users;";

  $result = mysqli_query($db, $sql);

  while($id = mysqli_fetch_assoc($result)){
    $i[] = $id['id'];
  }

  $password = "slaptazodis";
  $hashed_password = password_hash($password, PASSWORD_BCRYPT);
  $escaped_hashed_password = mysqli_real_escape_string($db, $hashed_password);

  for($y = 0; $y < count($i); $y++){
    $sql = "UPDATE users SET password='$escaped_hashed_password' WHERE id='".$i[$y]."';";
    $result = mysqli_query($db, $sql);

    if($result)
      echo "updated " . $i[$y] . "<br>";
    else
      echo "failed<br>";
  }
?>
