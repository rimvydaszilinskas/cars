<?php
  function url_escape($str){
    return urlencode ( $str );
  }

  function mysql_escape($str){
    return mysqli_real_escape_string($str);
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
      else if($_GET['p'] === 'reservations')
        echo "reservations();";
      else if($_GET['p'] === 'newuser')
        echo "newUser();";
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

  //checks if user exists
  //returns true/false
  function username_exists($username){
    global $db;

    $username = mysqli_real_escape_string($username);
    $sql = "SELECT username FROM users WHERE username='$username';";
    $result = mysqli_query($db, $sql);

    if(!$result)
      exit("Cannot connect to the database");

    //if there are any matching rows return true
    if(mysqli_num_rows($result) != 0)
      return true;

    //default return false
    return false;
  }

  //return association car object
  function find_car($id){
    //return null if it doesnt have car assigned
    if($id == '0')
      return null;

    global $db;

    $sql = "SELECT * FROM cars WHERE id='".$id."' LIMIT 1";

    $result = mysqli_query($db, $sql);

    if(!$result)
      exit("Cannot connect");

    $car = mysqli_fetch_assoc($result);

    return $car;
  }

  //returns only the name of the given car
  function find_car_name($id){
    if($id == '0')
      exit("Blogai nurodytas automobilis");

    global $db;

    $sql = "SELECT make FROM cars WHERE id='".$id."' LIMIT 1";

    $result = mysqli_query($db, $sql);

    if(!$result)
      exit("Cannot connect");

    $car = mysqli_fetch_assoc($result);

    return $car['make'];
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

  //return the day number of the month
  function today(){
    return date('j');
  }

  function get_month_number(){
    return date('m');
  }

  function get_month_name($month, $year){
    return date('F', mktime(0, 0, 0, $month, 1, $year));
  }

  function get_year(){
    return date('Y');
  }

  //return current date
  function get_day_number(){
    return date('j');
  }

  function get_week_day_number($day, $month, $year){
    return date('N', mktime(0, 0, 0, $month, $day, $year));
  }

  function get_week_day_name($day, $month, $year){
    return date('w', mktime(0, 0, 0, $month, $day, $year));
  }

  function get_start_of_month_number($month, $year){
    return date('N', mktime(0, 0, 0, $month, 1, $year));
  }

  function get_day_count($month, $year){
    return date('t',mktime(0, 0, 0, $month, 1, $year));
  }

  function check_end_of_week($day, $month, $year){
    $weekday = date('N', mktime(0, 0, 0, $month, $day, $year));
    if($weekday == 7)
      return true;
    else
      return false;
  }

  function has_drive($id){
    global $db;

    $sql = "SELECT * FROM reservations WHERE userid='".$id."' AND day='".today()."' AND month='".get_month_number()."' AND year='".get_year()."' AND approved='1' LIMIT 1";

    //$sql = "SELECT * FROM reservations WHERE userid='4' AND day='15' AND month='1' AND year='2018' AND approved='1' LIMIT 1";

    $result = mysqli_query($db, $sql);
    if(!$result)
      return false;
    if(mysqli_num_rows($result) == 0)
      return false;
    return true;
  }

  function reservation($id){
    global $db;

    $sql = "SELECT * FROM reservations WHERE userid='".$id."' AND day='".today()."' AND month='".get_month_number()."' AND year='".get_year()."' AND approved='1' LIMIT 1";

    //$sql = "SELECT * FROM reservations WHERE userid='4' AND day='15' AND month='1' AND year='2018' AND approved='1' LIMIT 1";

    $result = mysqli_query($db, $sql);
    if(!$result)
      exit("Could not connect to the database");
    if(mysqli_num_rows($result) == 0)
      return null;

    return mysqli_fetch_assoc($result);
  }

  function drive_finished($id){
    $reservation = reservation($id);

    if($reservation['distance'] == '0')
      return false;
    return true;
  }

  //get reservation on reservationID
  function get_reservation($id){
    global $db;

    $sql = "SELECT * FROM reservations WHERE id='$id' LIMIT 1";

    $result = mysqli_query($db, $sql);

    if(!$result)
      exit("Could not connect to the database");

    return mysqli_fetch_assoc($result);
  }

  function drive_started($id){
    global $db;

    $sql = "SELECT * FROM reservations WHERE userid='".$id."' AND day='".today()."' AND month='".get_month_number()."' AND year='".get_year()."' AND approved='1' LIMIT 1";

    $result = mysqli_query($db, $sql);

    if(!$result)
      exit("Cannot connect to the database");

    $check = mysqli_fetch_assoc($result);

    if($check['started'] == '0')
      return false;
    return true;
  }

  //find all reservations from today on
  function find_all_reservations(){
    global $db;

    $sql = "SELECT * FROM reservations WHERE day>='".today()."' AND month>='".get_month_number()."' AND year>='".get_year()."' ORDER BY month ASC, day ASC";

    $result = mysqli_query($db, $sql);

    if(!$result)
      return null;

    return $result;
  }
  //
  // find_user_reservations(){
  //
  // }

  function find_unnaproved_requests(){
    global $db;

    $today_day = today();
    $today_month = get_month_number();
    $today_year = get_year();

    $sql = "SELECT * FROM reservations WHERE approved='0' AND day>='$today_day' AND month>='$today_month' AND year>='$today_year' ORDER BY year ASC, month ASC, day ASC";

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

  //returns the approved message with the given values
  function create_approved_message($year, $month, $day, $destination, $car, $license_plate){
    global $db;

    $date = $year . "-" . $month . "-" . $day;

    $sql = "SELECT value FROM settings WHERE setting='default_approved_message' LIMIT 1";

    $result = mysqli_query($db, $sql);

    if(!$result)
      exit("Cannot connect to the database");

    $msg = mysqli_fetch_assoc($result);

    $message = $msg["value"];

    $message = str_replace('[data]', $date, $message);
    $message = str_replace('[keliones_tikslas]', $destination, $message);
    $message = str_replace('[automobilis]', $car . '[' . $license_plate . ']', $message);

    return $message;
  }

  function create_rejected_message($year, $month, $day, $destination){
    global $db;

    $date = $year . "-" . $month . "-" . $day;

    $sql = "SELECT value FROM settings WHERE setting='default_declined_message' LIMIT 1";

    $result = mysqli_query($db, $sql);

    if(!$result)
      exit("Cannot connect to the database");

    $msg = mysqli_fetch_assoc($result);

    $message = $msg["value"];

    $message = str_replace('[data]', $date, $message);
    $message = str_replace('[keliones_tikslas]', $destination, $message);

    return $message;
  }

  function has_message($id){
    global $db;

    $sql = "SELECT * FROM messages WHERE userid='$id'";

    $result = mysqli_query($db, $sql);

    if(!$result)
      exit("Cannot connect to the database");

    return $result;
  }

  //returns association array of the request, otherwise quits
  function find_reservation($id){
    global $db;

    $sql = "SELECT * FROM reservations WHERE id='$id' LIMIT 1";

    $result = mysqli_query($db, $sql);

    if(!$result)
      exit("Cannot connect to the database");

    return mysqli_fetch_assoc($result);
  }

  //returns an array of the ids of free cars
  function find_free_cars($day, $month, $year){
    global $db;

    //variables
    $free_cars = [];
    $reserved_cars = [];

    //find the cars already reserved on the given date
    $sql = "SELECT * FROM reservations WHERE day='$day' AND month='$month' AND $year";
    $result = mysqli_query($db, $sql);
    if(!$result){
      exit("Cannot connect to the database");
    }
    //extract the cars into an array
    while($car = mysqli_fetch_assoc($result))
      if($car['carid'] != 0)
        $reserved_cars[] = $car['carid'];

    //get all cars
    $sql = "SELECT * FROM cars WHERE maintenance='0';";
    $result = mysqli_query($db, $sql);
    if(!$result){
      exit("Cannot connect to the database");
    }
    //compare lists
    while($car = mysqli_fetch_assoc($result)){
      //if the car id is not added to the reserved_cars list
      if(!contains($reserved_cars, $car['id'])){
        //add it to free cars
        $free_cars[] = $car['id'];
      }
    }

    return $free_cars;
  }

  //checks if the array has value
  //returns true/false
  function contains($array, $value){
    for($i = 0; $i < count($array); $i++){
      if($array[$i] == $value)
        return true;
    }
    return false;
  }


?>
