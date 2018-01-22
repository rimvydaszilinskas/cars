<?php
  require_once("../db/init.php");

  $reservations = find_all_reservations();

  if($reservations == null)
    exit("Could not connect to the database");
?>

<div class="col-md-12">
  <?php if(mysqli_num_rows($reservations) != 0){ ?>
  <table class="table table-responsive">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Data</th>
      <th scope="col">Keliones tikslas</th>
      <th scope="col">Vartotojas</th>
      <th scope="col">Automobilis</th>
      <th scope="col">Perziureti</th>
    </tr>
    <?php while($reservation = mysqli_fetch_assoc($reservations)){ ?>
    <?php $car = find_car($reservation['carid']); ?>
    <tr>
      <td><?php echo $reservation['id']; ?></td>
      <td><?php echo $reservation['year'] . '-' . $reservation['month'] . '-' . $reservation['day']; ?></td>
      <td><?php echo $reservation['destination']; ?></td>
      <td><?php echo find_user_name($reservation['userid']); ?></td>
      <td><?php echo ($reservation['carid'] != '0') ? $car['make']." ".$car['license_plate'] : "Nepatvirtinta"?></td>
      <td><a href="#" onclick="reservation(<?php echo $reservation['id']; ?>)">Perziureti</a></td>
    </tr>
    <?php } //end fetching assoc?>
  </table>
  <?php } else { ?>
    <div class="alert alert-warning" role="alert">
      Nera aktyviu rezervaciju.
    </div>
  <?php } ?>

</div>
