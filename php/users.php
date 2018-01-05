<?php
  require_once("../db/init.php");

  $sql = "SELECT * FROM users";

  $result = mysqli_query($db, $sql);

  if(!$result)
    exit("Could not connect to the database");
?>
<div class="col-md-12">
<table class="table table-responsive">
  <tr>
    <th scope="col">ID</th>
    <th scope="col">Vardas</th>
    <th scope="col">Tel. nr.</th>
    <th scope="col">El. pastas</th>
    <th scope="col"></th>
  </tr>
  <?php while($user = mysqli_fetch_assoc($result)){ ?>
    <tr <?php if($user['Admin']==='1') echo 'class="table-primary"';?>>
      <td><?php echo $user['id']; ?></td>
      <td><?php echo $user['name']; ?></td>
      <td><?php echo $user['phone']; ?></td>
      <td><?php echo $user['email']; ?></td>
      <td>
        <!-- delete user -->
        <button type="button" class="btn btn-danger" id="delete"><i class="fa fa-trash-o" aria-hidden="true" name="delete"></i></button>
        <!-- edit user -->
      </td>
      <td>
        <button type="button" class="btn btn-dark" id="edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>
        <!-- reset user password -->
      </td>
      <td>
        <button type="button" class="btn btn-dark" id="resetPassword"><i class="fa fa-key" aria-hidden="true"></i></button>
      </td>
    </tr>
  <?php } ?>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
<button type="button" class="btn btn-success">Prideti nauja vartotoja</button>
</div>
