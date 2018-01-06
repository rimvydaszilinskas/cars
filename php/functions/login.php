<?php
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

  require_once("../../db/init.php");

  $user = findUser($username);

  if($user === 1)
    header("Location: ../../login.php");
  else{
    session_start();
    $_SESSION['id'] = $user['id'];
    $_SESSION['name'] = $user['name'];
    if($user['Admin'] === '1'){
      $_SESSION['admin'] = true;

    }
    header("Location: ../../index.php");
  }
?>
