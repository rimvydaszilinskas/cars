<?php
  require_once("../db/init.php");

  //start session
  session_start();
  $requests = find_unnaproved_requests();
  $is_announcements = check_for_announcements();
  $announcements = get_announcements();
  $cars = get_free_cars();
  $count = 0;
  $max_posts = 2;
?>

<div class="row">

  <!-- announcements -->
  <?php if($is_announcements){ ?>
    <div class="col-md-5 card">
      <h3 class="card-title">Pranesimai</h3>
      <?php while($announcement = mysqli_fetch_assoc($announcements)){?>
      <?php
        //check if count of post is greater than 2 if so, break and do not display anymore
        if($count == 2)
          break;
      ?>
      <hr/>
      <p class="post-date">
        <?php echo $announcement['createDate']; ?>
      </p>
      <p class="post-title">
        <?php echo $announcement['title']; ?>
      </p>
      <p class="post-body">
        <?php if(strlen($announcement['message'])>100){
          echo substr($announcement['message'], 0, 100) . "...";
        } else {
          echo $announcement['message'];
        }?>
      </p>
      <?php $count++; } ?>
      <hr/>
      <p class="post-title show-more-post" data-toggle="modal" data-target="#postModal">Rodyti daugiau...</p>
    </div>
  <?php } //end if announcements ?>

  <!-- available cars -->
  <?php if(count($cars) != 0){ ?>
    <div class="col-md-5 card">
      <h3 class="card-title">Laisvi automobiliai</h3>
      <hr/>
      <ul>
        <?php for($i=0; $i<count($cars); $i++){?>
          <li><?php echo $cars[$i]['make']; ?></li>
        <?php } ?>
      </ul>
    </div>
  <?php } ?>

  <!-- latest notes added  -->
  <?php if(isset($_SESSION['admin'])){ ?>
    <div class="col-md-5 card">
      <h5 class="card-title">Paskutines iterptos pastabos</h5>
      <hr/>
    </div>
  <?php }?>

  <!-- reservations -->
  <?php if(isset($_SESSION['admin'])){
          $count = 0; //reset the count to 0
          if($requests != null && mysqli_num_rows($requests)){?>
    <div class="col-md-5 card">
      <h5 class="card-title">Nepatvirtintos uzklausos</h5>
      <hr/>
      <ul>
      <?php while($request = mysqli_fetch_assoc($requests)){ ?>
        <?php if($count<3){ ?>
        <li><?php echo  $request['day'] . "/" . $request['month'] . "/". $request['year'] . " - " . $request['destination']." - ".find_user_name($request['userid']); ?></li>
      <?php } else {
          break;
        }
        $count++;
      } ?>
      </ul>
      <hr/>
      <p class="post-title show-more-post" href="#" onclick="reservations();">Ziureti visus...</p>
    </div>
    <?php } ?>
  <?php } ?>

  <!-- today -->
  <?php if(isset($_SESSION['admin'])){ ?>
    <div class="col-md-5 card">
      <h5 class="card-title">Siandien</h5>
      <hr/>
    </div>
  <?php }?>
</div>

<!-- post modal -->
<div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pranesimai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
          $posts = get_announcements();
          while($post = mysqli_fetch_assoc($posts)){
          ?>
          <p class="post-date">
            <?php echo $post['createDate']; ?>
          </p>
          <p class="post-title">
            <?php echo $post['title']; ?>
          </p>
          <p class="post-body">
            <?php echo $post['message']; ?>
          </p>
           <hr/>
           <?php
           }
         ?>
       </div>
       <!-- <div class="modal-footer">

       </div> -->
     </div>
    </div>
  </div>
