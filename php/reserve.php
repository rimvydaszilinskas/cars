<?php
  require_once("../db/init.php");
  $today = get_day_number();
  $month = get_month_number();
  $year = get_year();
?>

<div class="col-md-12">
  <h1><?php echo get_month_name($month, $year); ?></h1>
  <div id="date-hidden" hidden><?php echo $month . "-" . $year; ?></div>
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
      <?php for($y = 1; $y < get_start_of_month_number($month, $year); $y++){ ?>
        <td></td>
      <?php } ?>
      <?php for($i = 1; $i <= get_day_count($month, $year); $i++){ ?>
        <!-- skip the days we dont have -->
        <td class="reserve-calendar <?php echo ($today == $i) ? 'table-primary': ''; ?>"><?php echo ($i>=$today)?'<a class="reserve-link" href="#" data-toggle="modal" data-target="#postModal">': ''?><?php echo $i; ?><?php echo ($i >= $today)?'</a>':''?></td>
        <!-- check if theres need to be a split for weeks -->
        <?php if(check_end_of_week($i, $month, $year)){ ?>
        </tr><tr>
        <?php } ?>
      <?php } ?>
    </tr>
  </table>
</div>

<div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Rezervuoti</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="php/functions/reserveCar.php">
      <div class="modal-body">

          <div class="form-group">
            <label for="date">Data</label>
            <input type="text" class="form-control" id="date-reserve" name="date"></input>
          </div>
          <div class="form-group">
            <label for="destination">Keliones tikslas</label>
            <input type="text" class="form-control" id="destination" name="destination"></input>
          </div>
          <div>
            <label for="info">Papildoma informacija</label>
            <textarea type="text" class="form-control" id="info" name="info"></textarea>
          </div>

      </div>
      <div class="modal-footer">
        <button tupe="submit" class="btn btn-primary">Siusti</button>
      </div>
    </form>
    </div>
  </div>
</div>
