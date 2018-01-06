<?php
  $title = "Pagrindinis";
  require_once("shared/header.php");
  session_start();
  if(!isset($_SESSION['id']))
    header("location: login.php");
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
  					</div>
  				</div>
  				<!-- END SIDEBAR USER TITLE -->
  				<!-- SIDEBAR BUTTONS -->
  				<div class="profile-userbuttons">
            <!-- display only if the user has a drive that day -->
  					<button type="button" class="btn btn-success btn-sm">Drive</button>
  					<button type="button" class="btn btn-danger btn-sm">Messages</button>
  				</div>
  				<!-- END SIDEBAR BUTTONS -->
  				<!-- SIDEBAR MENU -->
  				<div class="profile-usermenu">
            <ul class="nav flex-column">
              <li class="nav-item active" onclick="home()" id="homelink">
                <a class="nav-link" href="#"><h4><i class="fa fa-home" aria-hidden="true"></i></h4> Pagrindinis</a>
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
              <?php } ?>
              <!-- shown only to the admin -->
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
            <!-- content is loaded automatically by js -->
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
</body>

<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="javascript/main.js"></script>
</html>
<script><?php directToPage(); ?> </script>
