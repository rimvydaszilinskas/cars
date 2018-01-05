<?php
  require_once("../db/init.php");
  if(check_for_all_announcements()){
    //only get this if there are any announcements
    $announcements = get_all_announcements();
?>
<table class="table table-responsive">
  <tr>
    <th scope="col">ID</th>
    <th scope="col">Pavadinimas</th>
    <th scope="col">Tekstas</th>
    <th scope="col">Data</th>
    <th scope="col">Aktyvus</th>
    <th scope="col"></th>
    <th scope="col"></th>
    <th scope="col"></th>
  </tr>
<?php
    //loop through the announcement list
    while($announcement = mysqli_fetch_assoc($announcements)){
?>
        <tr <?php echo ($announcement['active'] == '1' ? "" : "class='table-danger'"); ?>>
          <td><?php echo $announcement['id']; ?></td>
          <td><?php echo $announcement['title']; ?></td>
          <td><?php echo $announcement['message']; ?></td>
          <td><?php echo $announcement['createDate']; ?></td>
          <td><?php echo ($announcement['active'] == '1' ? "Taip" : "Ne"); ?></td>
          <td><a href="#" onclick="loadEditMsg(<?php echo $announcement['id']; ?>)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
          <td><a href="php/functions/hidePost.php?id=<?php echo $announcement['id']; ?>&active=<?php echo $announcement['active'];?>"><i class="fa fa-power-off" aria-hidden="true"></i></a></td>
          <td><a href="php/functions/deletePost.php?id=<?php echo $announcement['id']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>

        </tr>
      <?php
    }
?>
</table>
<button type="button" class="btn btn-success" id="newAnnouncement" onclick="newAnnouncement()">Naujas pranesimas</button>
<?php } else { ?>

  <h2 class="center">Nera pranesimu!</h2>
  <button type="button" class="btn btn-success center" id="newAnnouncement" onclick="newAnnouncement()">Prideti pranesima</button>

<?php } ?>
