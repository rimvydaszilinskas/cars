<?php
  require_once("../../db/init.php");

  // //direct to index.php if no post request
  // if(!isset($name))
  //   header("Location: ../../index.php");

  if(!isset($_POST['name']) || !isset($_POST['username']) || !isset($_POST['phone']) || !isset($_POST['email']) || !isset($_POST['position'])){
    //exit
    header("Location: ../../index.php?p=users&m=user_bad");
  }
  
  //exit if the username already exists in the system
  if(username_exists($_POST['username'])){
    header("Location: ../../index.php?p=addUser&m=user_exists");
  }

  $name = $_POST['name'];
  $username = $_POST['username'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $position = $_POST['position'];
  $password = get_hashed_default_password();

  $sql = "INSERT INTO users (name, username, phone, email, position, password, Admin, country) VALUES ('$name', '$username', '$phone', '$email', '$position', '$password', '0', 'LT');";

  $result = mysqli_query($db, $sql);

  if(!$result) // redirect to index.php with an error message
    header("Location: ../../index.php?p=users&m=user_bad");
  else {  //redirect to index.php with success message
    header("Location: ../../index.php?p=users&m=user_added&username=$username");
  }
?>
