<?php
  require_once("../db/init.php");

  $carId = $_REQUEST['id'];

  $sql = "SELECT * FROM cars WHERE id='".$carId."' LIMIT 1;";
  $result = mysqli_query($db, $sql);

  if(!$result)
    exit("Could not connect to the database");

  $car = mysqli_fetch_assoc($result);
?>

<form>
  <p class="lead" id="carIdEdit"><?php echo $carId; ?></p>
  <div class="form-group">
    <label for="editMake">Gamintojas</label>
    <input type="text" class="form-control" id="editMake" value="<?php echo $car['make'] ?>"></input>
  </div>
  <div class="form-group">
    <label for="editYear">Metai</label>
    <input type="number" min="1990" max="<?php echo date("Y");?>"class="form-control" id="editYear" value="<?php echo $car['year']; ?>">
  </div>
  <div class="form-group">
    <label for="editLicense_plate">Reg. Numeriai</label>
    <input type="text" class="form-control" id="editLicense_plate" value="<?php echo $car['license_plate']; ?>">
  </div>
  <div class="form-group">
    <label for="editMileage">Rida</label>
    <input type="number" class="form-control" min="0" max="400000" id="editMileage" value="<?php echo $car['mileage']; ?>">
  </div>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" id="editMaintenance" value="editMaintenance" <?php if($car['maintenance']==1) echo "checked"; ?>>
    <label class="form-check-label" for="editMaintenance">In repairs</label>
  </div>
  <button type="submit" class="btn btn-primary" onclick="submitCarEdit()">Submit</button>
</form>
