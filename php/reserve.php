<?php
  require_once("../db/init.php");
  $today = get_day_number();
  $month = get_month_number();
  $year = get_year();
?>

<div class="col-md-12">
  <h1><?php echo get_month_name($month, $year); ?></h1>
  <table class="table table-responsive table-bordered">
    <tr>
      <th>Pirm</th>
      <th>Antr</th>
      <th>Trec</th>
      <th>Ketv</th>
      <th>Penkt</th>
      <th>Sest</th>
      <th>Sekm</th>
    </tr>
    <tr>
      <?php for($i = 1; $i <= get_day_count($month, $year); $i++){ ?>
        <!-- skip the days we dont have -->
        <?php for($y = 0; $y < get_start_of_month_number($month, $year); $y++){ ?>
          <td></td>
        <?php } ?>
        <td class="reserve-calendar <?php echo ($today == $i) ? 'table-primary': ''; ?>"><?php echo $i; ?></td>
        <!-- check if theres need to be a split for weeks -->
        <?php if(check_end_of_week($i, $month, $year)){ ?>
        </tr><tr>
        <?php } ?>
      <?php } ?>
    </tr>
  </table>
</div>
