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

  function check_for_all_announcements(){
    global $db;

    $sql = "SELECT * FROM public_announcements;";

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

  function directToPage(){
    if(isset($_GET['p'])){
      //deletepost
      if($_GET['p'] === 'announcements')
        echo "announcements();";
      else if($_GET['p'] === 'users')
        echo "users();";
      else if($_GET['p'] === 'settings')
        echo "settings();";
      else if($_GET['p'] === 'cars')
        echo "cars();";
      else if($_GET['p'] === 'reserve')
        echo "reserve();";
      else if($_GET['p'] === 'profile')
        echo "profile();";
      else {
        echo "home();";
      }
    } else {
      echo "home();";
    }
  }

  //find user according to username
  function findUser($username){
    global $db;

    $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";

    $result = mysqli_query($db, $sql);

    if(!$result)
      return -1;

    $user = mysqli_fetch_assoc($result);
    return $user;
  }

  function find_user_name($id){
    global $db;

    $sql = "SELECT name FROM users WHERE id='$id' LIMIT 1";

    $result = mysqli_query($db, $sql);

    if(!$result)
      return -1;

    $user = mysqli_fetch_assoc($result);
    return $user['name'];
  }

  function findUserPosition($id){
    global $db;

    $sql = "SELECT position FROM users WHERE id='$id' LIMIT 1";

    $result = mysqli_query($db, $sql);

    if(!$result)
      exit("Cannot connect");

    $user = mysqli_fetch_assoc($result);

    return $user['position'];
  }

  function get_hashed_default_password(){
    global $db;

    $sql = "SELECT * FROM settings WHERE setting='default_password' LIMIT 1;";

    $result = mysqli_query($db, $sql);

    if(!$result)
      exit("Cannot connect to the database");
    
    return password_hash("slaptazodis", PASSWORD_BCRYPT);
  }

  //returns true if passwords match
  //othervise returns false
  function authorize_user($password_entered, $password){
    if(password_verify($password_entered, $password))
      return true;
    return false;
  }

  //returns an array of cars that today are free and not in repairs
  function get_free_cars(){
    global $db;
    $cars = [];
    $sql = "SELECT * FROM cars WHERE maintenance='0'";

    $result = mysqli_query($db, $sql);

    if(!$result)
      return $cars;

    //get requested and reserved cars list

    while($car = mysqli_fetch_assoc($result)){
      //compare if the today the car is free

      //store the car in the cars array
      $cars[] = $car;
    }

    return $cars;
  }

  function today(){
    return date('j');
  }

  function get_month_number(){
    return date('m');
  }

  function get_month_name($month, $year){
    return date('F');
  }

  function get_year(){
    return date('Y');
  }

  //return current date
  function get_day_number(){
    return date('j');
  }

  function get_week_day_number($day, $month, $year){
    return date('N');
  }

  function get_week_day_name($day, $month, $year){
    return date('w');
  }

  function get_start_of_month_number($month, $year){
    date('N', mktime(0, 0, 0, get_month_number(), 1, get_year()));
  }

  function get_day_count($month, $year){
    return date('t');
  }

  function check_end_of_week($day, $month, $year){
    $weekday = date('N', mktime(0, 0, 0, $month, $day, $year));
    if($weekday == 7)
      return true;
    else
      return false;
  }

  function has_drive($id){
    return false;
  }

  // find_all_reservations(){
  //
  // }
  //
  // find_user_reservations(){
  //
  // }

  function find_unnaproved_requests(){
    global $db;

    $today_day = today();
    $today_month = get_month_number();
    $today_year = get_year();

    $sql = "SELECT * FROM reservations WHERE approved='0' AND day>='$today_day' AND month>='$today_month' AND year>='$today_year'";

    $result = mysqli_query($db, $sql);

    if(!$result){
      return null;
    }
    return $result;
  }

  function is_admin($id){
    global $db;

    $sql = "SELECT admin FROM users WHERE id='$id' LIMIT 1";

    $result = mysqli_query($db, $sql);

    if(!$result)
      exit("Cannot connect to the database");

    $admin = mysqli_fetch_assoc($result);

    if($admin['admin']=='1')
      return true;
    return false;
  }
?>
