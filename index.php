<?php
  $title = "Pagrindinis";
  require_once("shared/header.php");
  session_start();
  if(!isset($_SESSION['id']))
    header("location: login.php");

  $user_messages = has_message($_SESSION['id']);

  $has_messages = mysqli_num_rows($user_messages) != 0;

  //vars
  $message = "";
  $error = "";
  $class = "";

  //set variable for displaying correct messages
  if(isset($_GET['m'])){
    $msg = $_GET['m'];
    if($msg == "user_added"){
      $user_added = $_GET['username'];
      $message = "Sekmingai pridetas vartotojas: " . $user_added . ".";
      $class = "user_note";
    } else if($msg == "user_bad"){
      $error = "Neivesti visi duomenys!";
      $class = "user_note";
    } else if($msg == "car_add_error" || $msg == "car_edit_error"){
      $error = "<b>Klaida</b>Negalima prisijungti prie duomenu bazes!";
      $class = "car_note";
    } else if($msg == "car_added"){
      $message = "Automobilis pridetas sekmingai!";
      $class = "car_note";
    } else if($msg == "car_edited"){
      $message = "Automobilis pakoreguotas!";
      $class = "car_note";
    } else if($msg == "user_edit_success"){
      $message = "Vartotojas issaugotas!";
      $class = "user_note";
    } else if($msg == "reserve_success"){
      $message = "Rezervacija sekminga!";
      $class = "reserve_note";
    } else if($msg == "reserve_error"){
      $error = "Klaida!";
      $class = "reserve_note";
    } else if($msg == "user_pw_fail"){
      $error = "Nepavyko is naujo nustatyti slaptazodzio!";
      $class = "user_note";
    } else if($msg == "user_pw_success"){
      $id = $_GET['id'];
      $user_name = find_user_name($id);
      $message = "Vartotojo $user_name slaptazodis nustatytas sekmingai!";
      $class = "user_note";
    } else if($msg == "password_change_success"){
      $message = "Sekmingai pakeistas slaptazodis!";
      $class = "home_note";
    }
  } // end isset check
?>

<body>
  <div class="container">
      <div class="row profile">
  		<div class="col-md-3">
  			<div class="profile-sidebar">
  				<!-- SIDEBAR USERPIC -->
  				<!-- <div class="profile-userpic">
  					<img src="images/profile.jpg" class="img-responsive" alt="">
  				</div> -->
  				<!-- END SIDEBAR USERPIC -->
  				<!-- SIDEBAR USER TITLE -->
  				<div class="profile-usertitle">
  					<div class="profile-usertitle-name">
  						<?php echo $_SESSION['name']; ?>
  					</div>
  					<div class="profile-usertitle-job">
  						<?php echo findUserPosition($_SESSION['id']); ?>
              <?php if(isset($_SESSION['admin'])) echo "<br>Administratorius"?>
  					</div>
  				</div>
  				<!-- END SIDEBAR USER TITLE -->
  				<!-- SIDEBAR BUTTONS -->
  				<div class="profile-userbuttons">
            <!-- display only if the user has a drive that day -->
            <?php if(has_drive($_SESSION['id'])){ ?>
  					<button type="button" class="btn btn-success btn-sm">Drive</button>
            <?php } ?>
            <?php if($has_messages){ ?>
  					<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#messageModal" id="messageToggle">Zinutes</button>
            <?php } ?>
  				</div>
  				<!-- END SIDEBAR BUTTONS -->
  				<!-- SIDEBAR MENU -->
  				<div class="profile-usermenu">
            <ul class="nav flex-column">
              <li class="nav-item active" id="homelink">
                <a class="nav-link" href="index.php"><h4><i class="fa fa-home" aria-hidden="true"></i></h4> Pagrindinis</a>
              </li>
              <li class="nav-item" onclick="reserve()" id="reservelink">
                <a class="nav-link" href="#"><h4><i class="fa fa-calendar" aria-hidden="true"></i></h4> Rezervuoti</a>
              </li>
              <!-- shown only to the admin -->
              <?php if(isset($_SESSION['admin'])){ ?>
              <li class="nav-item" onclick="cars()" id="carslink">
                <a class="nav-link" href="#"><h4><i class="fa fa-car" aria-hidden="true"></i></h4> Automobiliai</a>
              </li>
              <!-- show only to the admin -->
              <li class="nav-item" onclick="users()" id ="userslink">
                <a class="nav-link" href="#" ><h4><i class="fa fa-users" aria-hidden="true"></i></h4> Vartotojai</a>
              </li>
              <!-- shown only to the admin -->
              <li class="nav-item" onclick="announcements()" id ="announcementslink">
                <a class="nav-link" href="#"><h4><i class="fa fa-bullhorn" aria-hidden="true"></i></h4> Pranesimai</a>
              </li>
              <!-- show only to the admin -->
              <li class="nav-item" onclick="reservations()" id ="reservationManagelink">
                <a class="nav-link" href="#"><h4><i class="fa fa-calendar" aria-hidden="true"></i></h4> Rezervacijos</a>
              </li>
              <?php } ?>
              <li class="nav-item" onclick="settings()" id ="settingslink">
                <a class="nav-link" href="#"><h4><i class="fa fa-cog" aria-hidden="true"></i></h4> Nustatymai</a>
              </li>
              <li class="nav-item" id ="logoutlink">
                <a class="nav-link" href="logout.php"><h4><i class="fa fa-sign-out" aria-hidden="true"></i></h4> Atsijungti</a>
              </li>
            </ul>
  				</div>
  				<!-- END MENU -->
  			</div>
  		</div>

      <!-- Start the body -->
  		<div class="col-md-9 contentHolder">
          <div class="content" id="mainContent">

            <div class="alert alert-danger index_note <?php echo $class; ?>" role="alert">
              <?php echo $error; ?>
            </div>
            <div class="alert alert-success index_note <?php echo $class; ?>" role="alert">
              <?php echo $message; ?>
            </div>

            <div id="content-no-errors">
              <!-- content is loaded automatically by js -->
            </div>
          </div>
  		</div>
  	</div>
  </div>

  <footer>
    <center>
      <strong>Powered by <a href="http://rimvydas.site" target="_blank">rimvydas.site</a></strong>
    </center>
  </footer>
  <br>
  <br>

  <!-- Modal -->
  <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pranešimai</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php while($message = mysqli_fetch_assoc($user_messages)){ ?>
            <p class="post-date"><?php echo $message['date']; ?></p>
            <hr>
            <p class="post-body <?php echo ($message['read']=='0')?'unread':'';?>"><?php echo $message['message']; ?></p>
          <?php } ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Uždaryti</button>
        </div>
      </div>
    </div>
  </div>

</body>

<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="javascript/main.js"></script>
<script src="javascript/jquery.js"></script>
</html>
<!-- used to load the content as soon as the page loads -->
<script><?php directToPage(); ?> </script>
