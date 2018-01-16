const body = document.getElementById("content-no-errors");
//menu js
function home(){
  clearActive("homelink");
  fillContent("home");
  showNote("home");
}

function users(){
  clearActive("userslink");
  fillContent("users");
  showNote("user");
}

function settings(){
  clearActive("settingslink");
  fillContent("settings");
  showNote("settings");
}

function cars(){
  clearActive("carslink");
  fillContent("cars");
  showNote("car");
}

function announcements(){
  clearActive("announcementslink");
  fillContent("announcements");
  showNote("announcements");
}

function reserve(){
  clearActive("reservelink");
  fillContent("reserve");
  showNote("reserve");
}

function profile(){
  clearActive("profilelink");
  fillContent("profile");
  showNote("profile");
}

function reservations(){
  clearActive("reservationManagelink");
  fillContent("reservations");
  showNote("reservations");
}

//hide all notes
function hideNotes(){
  var notes = document.getElementsByClassName("index_note");
  for(var i = 0; i < notes.length; i++){
      notes[i].style.display = "none";
  }
}

//show the note needed
function showNote(classname){
  var name = classname + "_note";
  var notes = document.getElementsByClassName(name);

  for(var i = 0; i < notes.length; i++){
    var note = notes[i].innerHTML.trim();
    if(note !== "")
      notes[i].style.display = "block";
  }
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
  hideNotes();
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
    window.location.href = "php/functions/deleteCar.php?id=" + carId;
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
  window.location.href = "php/functions/resetPassword.php?id=" + id;
}
