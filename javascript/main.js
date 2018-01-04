const body = document.getElementById("mainContent");

//menu js
function home(){
  clearActive("homelink");
  fillContent("home");
}

function users(){
  clearActive("userslink");
  fillContent("users");
}

function settings(){
  clearActive("settingslink");
  fillContent("settings");
}

function cars(){
  clearActive("carslink");
  fillContent("cars");
}

function clearActive(element){
  var menuItems = document.getElementsByClassName("nav-item");

  for(var i = 0; i < menuItems.length; i++){
      menuItems[i].classList.remove("active");
  }

  document.getElementById(element).className += " active";
}

function fillContent(filename){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
      body.innerHTML = this.responseText;
    }//end if
  }//end function()
  xmlhttp.open("GET", "php/" + filename + ".php");
  xmlhttp.send();
}

//cars.php js
function deleteCar(car){
  var carId = car.id.replace( /^\D+/g, '');

  if (confirm('Ar tikrai norite istrinti?')) {
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
      if(this.readyState == 4 && this.status == 200){
        alert(this.responseText);
      }//end if
    }//end function()
    xmlhttp.open("GET", "php/functions/deleteCar.php?id=" + carId);
    xmlhttp.send();
  }
}

function editCar(car){
  var carId = car.id.replace( /^\D+/g, '');
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
      body.innerHTML = this.responseText;
    }//end if
  }//end function()
  xmlhttp.open("GET", "php/editCar.php?id=" + carId);
  xmlhttp.send();
}

function commentsCar(car){
  var carId = car.id.replace( /^\D+/g, '');
}

//edit car js
function submitCarEdit(){
  var make = document.getElementById("editMake").value;
  var year = document.getElementById("editYear").value;
  var license_plate = document.getElementById("editLicense_plate").value;
  var mileage = document.getElementById("editMileage").value;
  var maintenance = document.getElementById("editMaintenance").checked;
  var carId = document.getElementById("carIdEdit").value;

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
      fillContent("cars");
    }//end if
    else{
      alert("Nepavyko!")
    }
  }//end function()
  xmlhttp.open("GET", "php/functions/editCar.php?make=" + make + "&year=" + year + "&lp=" + license_plate + "&mileage=" + mileage + "&maintenance=" + maintenance==true?"1":"0" + "&id=" + carId);
  xmlhttp.send();

  alert(maintenance);
}

//
