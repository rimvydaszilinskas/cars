<?php
  require_once("../db/init.php");
  $is_announcements = check_for_announcements();
  $announcements = get_announcements();
?>

<div class="row">
  <?php if($is_announcements){ ?>
    <div class="col-md-5 card">
      <h3 class="card-title">Pranesimai</h3>
      <?php while($announcement = mysqli_fetch_assoc($announcements)){ ?>
      <hr/>
      <p class="post-date">
        <?php echo $announcement['createDate']; ?>
      </p>
      <p class="post-title">
        <?php echo $announcement['title']; ?>
      </p>
      <p class="post-body">
        <?php echo $announcement['message']; ?>
      </p>
      <?php } ?>
    </div>
  <?php }//end if there's announcements ?>

  <div class="col-md-5 card">
    wee
  </div>
</div>
