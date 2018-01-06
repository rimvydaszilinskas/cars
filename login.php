<?php
  $title = "AutoSistema - Prisijungimas";
  $loadInit = 1; //just not to load init.php
  require("shared/header.php");
?>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-4 offset-md-4 loginBox">
        <form action="php/functions/login.php" method="post">
          <p class="lead">Prisijungimas</span></p>
          <div class="form-group">
            <label for="username">Vardas</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Vartojo vardas"></input>
          </div>
          <div class="form-group">
            <label for="password">Slaptazodis</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="slaptazodis"></input>
          </div>
          <button type="submit" class="btn btn-primary">Prisijungti</button>
        </form>
      </div>
    </div>
  </div>
</body>

<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="javascript/main.js"></script>
</html>
