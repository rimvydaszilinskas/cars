<?php
  require_once("../../db/init.php");

  session_start();

  if(!isset($_SESSION['id'])){
    if(!is_admin($_SESSION['id']))
      header("Location: ../../index.php");
  }

  $id = $_GET['id'];
  $password = get_hashed_default_password();
  $escaped_password = mysqli_real_escape_string($db, $password);

  $sql = "UPDATE users SET password='$escaped_password' WHERE id='$id' LIMIT 1";

  $result = mysqli_query($db, $sql);

  if(!$result){
    header("Location: ../../index.php?p=users&m=user_pw_fail");
  }
  header("Location: ../../index.php?p=users&m=user_pw_success&id=$id");
?>
