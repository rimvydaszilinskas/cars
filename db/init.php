<?php
  define("DB_SERVER", "localhost");
  define("DB_USER", "root");
  define("DB_PASS", "");
  define("DB_NAME", "cardb");

  $db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

  if(mysqli_connect_errno()) {
    $msg = "Database connection failed: ";
    $msg .= mysqli_connect_error();
    $msg .= " (" . mysqli_connect_errno() . ")";
    exit($msg);
  }

  if ($db->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo "<script>console.log('CANNOT CONNECT!');</script>";
  }
  else {
    echo "<script>console.log('database connection established')</script>";
  }

  require("functions.php");
?>
