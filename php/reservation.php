<?php
  require_once("../db/init.php");

  $id = $_REQUEST['id'];
  $reservation = find_reservation($id);
  $date = $reservation['year'] . "-" . $reservation['month'] . "-" . $reservation['day'];
  $cars = find_free_cars($reservation['day'], $reservation['month'], $reservation['year']);
  $active_car_id = $reservation['carid'];
  if($active_car_id != 0)
    $active_car = find_car_name($reservation['carid']);

?>

<!-- display warning if there are no free cars -->
<?php if(count($cars) == 0){ ?>
  <div class="alert alert-warning" role="alert">
    Nera laisvu automobiliu!
  </div>
<?php } ?>

<form method="post" action="php/functions/reservationConfirm.php?id=<?php echo $id; ?>">
  <h5>Vairuotojas: <strong><?php echo find_user_name($reservation['userid']); ?></strong></h5>
  <div class="form-group">
    <label for="userid">ID</label>
    <input type="text" class="form-control" id="userid" name="userid" value="<?php echo $reservation['userid']; ?>" readonly></input>
  </div>
  <div class="form-group">
    <label for="date">Data</label>
    <input type="text" class="form-control" id="date" name="date" value="<?php echo $date; ?>" readonly></input>
  </div>
  <div class="form-group">
    <label for="destination">Keliones tikslas</label>
    <input type="text" class="form-control" id="destination" name="destination" value="<?php echo $reservation['destination']; ?>" readonly></input>
  </div>
  <div class="form-group">
    <label for="car">Automobilis</label>
    <select class="form-control" id="car" name="car">
      <?php if($active_car_id != 0){ ?>
        <option value="<?php echo $active_car_id; ?>"><?php echo $active_car; ?></option>
        <?php for($i = 0; $i < count($cars); $i++){ ?>
          <option value="<?php echo $cars[$i]; ?>"><?php echo find_car_name($cars[$i]); ?></option>
        <?php } ?>
        <option value="null"></option>>
        <?php } else {?>
          <?php for($i = 0; $i < count($cars); $i++){ ?>
            <option value="<?php echo $cars[$i]; ?>"><?php echo find_car_name($cars[$i]); ?></option>
          <?php } ?>
          <option value="null"></option>>
        <?php } ?>
    </select>
  </div>
  <div class="form-group">
    <label for="note">Pastaba</label>
    <textarea class="form-control" id="note" name="note" disabled><?php echo $reservation['note'];?></textarea>
  </div>
  <button type="submit" class="btn btn-success">Siusti</button>
</form>
