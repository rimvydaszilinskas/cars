<?php
  require_once("../../db/init.php");

  // //direct to index.php if no post request
  // if(!isset($name))
  //   header("Location: ../../index.php");

  if(!isset($_POST['name'])){

  }
  $name = $_POST['name'];
  $username = $_POST['username'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $position = $_POST['position'];
  $password = get_hashed_default_password();

  $sql = "INSERT INTO users (name, username, phone, email, position, password, Admin, country) VALUES ('$name', '$username', '$phone', '$email', '$position', '$password', '0', 'LT');";

  $result = mysqli_query($db, $sql);

  if(!$result)
    header("Location: ../../index.php?p=users&m=user_bad");
  else {
    header("Location: ../../index.php?p=users&m=user_added&username=$username");
  }
?>
