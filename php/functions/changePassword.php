<?php
  require_once("../../db/init.php");

  session_start();

  $password = $_POST['password_change'];
  $password_repeat = $_POST['password_repeat'];
  $userID = $_SESSION['id'];
  echo "<script>alert('$password');</script>";
  if($password == $password_repeat){
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $escaped_password = mysqli_real_escape_string($db, $hashed_password);
    $sql = "UPDATE users SET password='$escaped_password' WHERE id='$userID' LIMIT 1;";

    $result = mysqli_query($db, $sql);
    if(!$result)
      exit("Cannot connect to the database");
    else
      header("Location: ../../index.php?m=password_change_success&p=$password");
  } else {
    //redirect back to change password page with an error message
    header("Location: ../../changePassword.php?m=no_match");
  }


?>
