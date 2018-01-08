<?php
  require_once("../db/init.php");

  $sql = "SELECT * FROM cars";

  $result = mysqli_query($db, $sql);

  if(!$result)
    exit("Could not connect to the database");
?>
  <table class="table table-responsive">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Modelis</th>
      <th scope="col">Valst. Numeris</th>
      <th scope="col">Metai</th>
      <th scope="col">Rida</th>
      <th scope="col"></th>
    </tr>
  <?php while($car = mysqli_fetch_assoc($result)){?>
      <tr <?php if($car['maintenance'] === '1') echo 'class="table-danger"'; ?>>
        <td><?php echo $car['id']; ?></td>
        <td><?php echo $car['make']; ?></td>
        <td><?php echo preg_replace('/\s+/', '', $car['license_plate']); ?></td>
        <td><?php echo $car['year']; ?></td>
        <td><?php echo $car['mileage']; ?></td>
        <td>
          <button type="button" class="btn btn-danger" onclick="deleteCar(this)" id="delete-<?php echo $car['id'];?>"><i class="fa fa-trash-o" aria-hidden="true" name="delete"></i></button>
          <button type="button" class="btn btn-dark" onclick="editCar(this)" id="edit-<?php echo $car['id'];?>"><i class="fa fa-pencil" aria-hidden="true"></i></button>
          <button type="button" class="btn btn-dark" onclick="commentsCar(this)" id="comments-<?php echo $car['id'];?>"><i class="fa fa-comment" aria-hidden="true"></i></button>
        </td>
      </tr>
  <?php
    }
  ?>
    <tr>
      <td><button type="button" class="btn btn-success" onclick="fillContent('addNewCar')">Add new car</button></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </table>
</div>
