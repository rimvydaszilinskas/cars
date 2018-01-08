<form action="php/functions/addUser.php" method="post">
  <div class="form-group">
    <label for="name">Vardas</label>
    <input type="text" class="form-control" id="name" name="name"></input>
  </div>
  <div class="form-group">
    <label for="username">Prisijungimo vardas</label>
    <input type="text" class="form-control" id="username" name="username"></input>
  </div>
  <div class="form-group">
    <label for="phone">Tel. numeris</label>
    <input type="text" class="form-control" id="phone" name="phone"></input>
  </div>
  <div class="form-group">
    <label for="email">El. pastas</label>
    <input type="email" class="form-control" id="email" name="email"></input>
  </div>
  <div class="form-group">
    <label for="position">Pareigos</label>
    <input type="text" class="form-control" id="position" name="position"></input>
  </div>

  <button type="submit" id="userSubmit" class="btn btn-primary">Prideti</button>
</form>
