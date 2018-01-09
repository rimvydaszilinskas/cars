<?php
  $username = $_POST['username'];
  $password = "slaptazodis";


  require_once("../../db/init.php");

  $user = findUser($username);
  $hashed_password = $user['password'];

  if($user === -1)
    header("Location: ../../login.php?e=not_found");
  else{
    if(password_verify($password, $hashed_password)){
      session_start();
      $_SESSION['id'] = $user['id'];
      $_SESSION['name'] = $user['name'];
      if($user['Admin'] === '1'){
        $_SESSION['admin'] = true;
      }
      header("Location: ../../index.php");
    }
    else {
      header("Location: ../../login.php?e=wrong_pw");
    }
  }
?>
