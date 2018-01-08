<form action="php/functions/addCar.php" method="post">
  <div class="form-group">
    <label for="name">Pavadinimas</label>
    <input type="text" class="form-control" id="name" name="name"></input>
  </div>
  <div class="form-group">
    <label for="year">Metai</label>
    <input type="number" class="form-control" id="year" name="year" min="2000" max="<?php echo date('Y'); ?>"></input>
  </div>
  <div class="form-group">
    <label for="mileage">Rida</label>
    <input type="number" class="form-control" id="mileage" name="mileage" min="0" max="300000"></input>
  </div>
  <div class="form-group">
    <label for="license_plate">Reg. Numeris</label>
    <input type="text" class="form-control" id="license_plate" name="license_plate"></input>
  </div>
  <button type="submit" id="userSubmit" class="btn btn-primary">Prideti</button>
</form>
