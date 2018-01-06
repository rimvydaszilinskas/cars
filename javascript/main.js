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

function announcements(){
  clearActive("announcementslink");
  fillContent("announcements");
}

function reserve(){
  clearActive("reservelink");
  fillContent("reserve");
}

function profile(){
  clearActive("profilelink");
  fillContent("profile");
}

//pass in the element to know which one to set back
function clearActive(element){
  var menuItems = document.getElementsByClassName("nav-item");

  //deactivate all active classes on all buttons
  for(var i = 0; i < menuItems.length; i++){
      menuItems[i].classList.remove("active");
  }

  //set back the just pressed button
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
    var xmlhttp = new XMLHttpRequest();
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
  var xmlhttp = new XMLHttpRequest();
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

//******************************
//announcemenets****************
function submitNewAnnouncement(){
  var title = document.getElementById("announcementName").value;
  var msg = document.getElementById("announcementMessage").value;

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
      body.innerHTML = this.responseText;
    }//end if
  }//end function()
  xmlhttp.open("GET", "php/functions/addNewAnnouncement.php?title=" + title + "&msg=" + msg);
  xmlhttp.send();

}

function newAnnouncement(){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
      body.innerHTML = this.responseText;
    }//end if
  }//end function()
  xmlhttp.open("GET", "php/addNewAnnouncement.php");
  xmlhttp.send();
}

function loadEditMsg(id){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
      body.innerHTML = this.responseText;
    }//end if
  }//end function()
  xmlhttp.open("GET", "php/editAnnouncement.php?id="+id);
  xmlhttp.send();
}

//*****************************
//*********user zone***********

function deleteUser(name, id){
  if (confirm('Ar tikrai norite istrinti vartotoja id: ' + id + '?')) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
      if(this.readyState == 4 && this.status == 200){
        if(this.responseText=="ok"){
          alert("Vartotojas " + name + " sekmingai istrintas.");
          users();
        }
        else {
          alert("Negalima prisijungti prie duomenu bazes");
        }
      }//end if
    }//end function()
    xmlhttp.open("GET", "php/functions/deleteUser.php?id=" + id);
    xmlhttp.send();
  }
}

function editUser(id){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
      body.innerHTML = this.responseText;
    }//end if
  }//end function()
  xmlhttp.open("GET", "php/editUser.php?id="+id);
  xmlhttp.send();
}

function resetUserPassword(id){

}
