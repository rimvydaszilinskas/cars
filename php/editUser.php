<?php
  require_once("../db/init.php");

  $id = $_REQUEST['id'];
  $sql = "SELECT * FROM users WHERE id='$id' LIMIT 1";

  $result = mysqli_query($db, $sql);

  if(!$result)
    exit("Could not connect to the database");

  $user = mysqli_fetch_assoc($result);
?>

<form action="php/functions/editUser.php?id=<?php echo $id; ?>" method="post">
  <p class="lead">Redaguojamo vartotojo ID: <?php echo $id; ?></p>
  <div class="form-group">
    <label for="name">Vardas</label>
    <input type="text" class="form-control" id="name" name="name"value="<?php echo $user['name']; ?>"></input>
  </div>
  <div class="form-group">
    <label for="username">Prisijungimo vardas</label>
    <input readonly type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>"></input>
  </div>
  <div class="form-group">
    <label for="number">Tel. numeris</label>
    <input type="text" class="form-control" id="number" name="number" value="<?php echo $user['phone']; ?>"></input>
  </div>
  <div class="form-group">
    <label for="email">El. pastas</label>
    <input type="text" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>"></input>
  </div>
  <div class="form-group">
    <label for="position">Pareigos</label>
    <input type="text" class="form-control" id="position" name="position" value="<?php echo $user['position']; ?>"></input>
  </div>

  <button type="submit" class="btn btn-primary">Issaugoti</button>
</form>
