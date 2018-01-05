<?php
  require_once("../db/init.php");

  $msgID = $_REQUEST['id'];

  $sql = "SELECT * FROM public_announcements WHERE id='$msgID'";

  $result = mysqli_query($db, $sql);
  if(!$result){
    exit("Could not connect to the database!");
  } else {
    $msg = mysqli_fetch_assoc($result);
  }
?>

<form action="php/functions/editAnnouncement.php?id=<?php echo $msgID;?>" method="post">
  <p class="lead">Redaguojamo iraso ID: <span id="msgIdEdit"><?php echo $msgID; ?></span></p>
  <div class="form-group">
    <label for="editTitle">Pavadinimas</label>
    <input type="text" class="form-control" id="editTitle" value="<?php echo $msg['title']; ?>" name="title"></input>
  </div>
  <div class="form-group">
    <label for="editMsg">Zinute</label>
    <textarea class="form-control" id="editMsg" name="msg"><?php echo $msg['message'];?></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Issaugoti</button>
</form>
