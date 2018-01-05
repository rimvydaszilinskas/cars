<?php
  function url_escape($str){
    return urlencode ( $str );
  }

  //returns true/false if there are active announcements
  function check_for_announcements(){
    global $db;

    $sql = "SELECT * FROM public_announcements WHERE active=1;";

    $result = mysqli_query($db, $sql);

    if(!$result){
      exit("Could not connect to the database");
      return false;
    }

    if(mysqli_num_rows($result) != 0)
      return true;

    else return false;
  }

  function get_announcements(){
    global $db;

    $sql = "SELECT * FROM public_announcements WHERE active=1 ORDER BY id DESC;";

    $result = mysqli_query($db, $sql);

    if(!$result){
      exit("Could not connect to the database");
    }

    return $result;
  }

  function get_all_announcements(){
    global $db;

    $sql = "SELECT * FROM public_announcements ORDER BY id DESC;";
    $result = mysqli_query($db, $sql);

    if(!$result){
      exit("Could not connect to the database");
    }

    return $result;
  }
?>
