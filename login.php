<?php
include('./system/init.php');

$_SESSION["active-page"] = "prijava";

?>
<!doctype html>
<html lang="en">

<head>
<title>Login</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="./assets/css/login.css">
</head>

<body>

<div class="container">
    <div id="login-row" class="row justify-content-center align-items-center">
      <div class="col-lg-6">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link " id="prijava-tab" data-toggle="tab" href="#prijava" role="tab" aria-controls="prijava" aria-selected="true">Prijava</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="registracija-tab" data-toggle="tab" href="#registracija" role="tab" aria-controls="registracija" aria-selected="false">Registracija</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="home-tab" href="../NewsSite/" role="tab" aria-controls="home" aria-selected="false">Home</a>
            </li>
        </ul>
          <div class="tab-content" id="myTabContent">

          <?php

              if (isset($_POST['prijava'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                
                if(!$korisnik->checkLogInAttempts($username)) {
                  $_SESSION["poruka-false"] = "Previše pokušaja prijave.";
                  $_SESSION["active-page"] = "prijava";
                }
                else {
                  $prijava = $korisnik->login($username, $password);

                  if ($prijava) {
                    if ($korisnik->imaDozvolu()) {
                      header("location: admin.php?page=home");
                    }
                    else {
                      header("location: index.php");
                    }
                  }
                  else {
                    $_SESSION["poruka-false"] = "Neispravana lozinka ili korisničko ime";
                    $_SESSION["active-page"] = "prijava";
                  }
                }                
              }

              else if (isset($_POST['registracija'])) {
                $ime = $_POST['ime'];
                $prezime = $_POST['prezime'];
                $username = $_POST['username2'];
                $password = $_POST['password2'];

                $data = array();
                $data['ime'] = $_POST['ime'];
                $data['prezime'] = $_POST['prezime'];
                $data['korisnicko_ime'] = $_POST['username2'];
                $data['lozinka'] = $_POST['password2'];
                $data['passRep'] = $_POST['passRep'];

                $registriran = $korisnik->addUser($data);

                if ($registriran) {
                  $_SESSION["poruka-true"] = "Registracija je uspješna";
                  $_SESSION["active-page"] = "prijava";
                }

                else {
                  $_SESSION["active-page"] = "registracija";
                }
              }

              if(isset($_SESSION["poruka-true"])) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION["poruka-true"]; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
              <?php
              unset($_SESSION['poruka-true']); 
              }
              if(isset($_SESSION["poruka-false"])) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION["poruka-false"]; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
              <?php 
              unset($_SESSION['poruka-false']); 
          } ?>

            <div class="tab-pane no-gutters fade" id="prijava" role="tabpanel" aria-labelledby="prijava-tab">
              <div id="login-column" class="col-md-12">
                <div id="login-box" class="col-md-12">

                  <form id="login-form" class="form" action="" method="post" name="login_forma">
                    <h3 class="text-center text-custom ">Prijava</h3>
                      <div class="form-group">
                        <label for="username" class="text-custom">Korisničko ime:</label><br>
                          <input type="text" name="username" id="username" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="password" class="text-custom">Lozinka:</label><br>
                        <input type="password" name="password" id="password" class="form-control">
                      </div>
                      <div class="form-group">
                        <input type="submit" name="prijava" class="btn btn-custom btn-md" onclick="return submitForme1()" value="Prijavi" id="btn-prijavi">
                      </div>
                  </form>
                </div>
              </div>
            </div>
        <div class="tab-pane no-gutters fade" id="registracija" role="tabpanel" aria-labelledby="registracija-tab">
                      <div id="login-column" class="col-md-12">
                          <div id="login-box" class="col-md-12">
                              <form id="registracija-form" class="form" action="" method="post" name="registracija_forma">
                                  <h3 class="text-center text-custom ">Registracija</h3>
                                  <div class="form-group">
                                    <label for="ime" class="text-custom">Ime:</label><br>
                                    <input type="text" name="ime" id="ime" class="form-control" >
              <span id="porukaIme" class="bojaPoruke"></span>
                                  </div>
                                  <div class="form-group">
                                      <label for="about">Prezime: </label>
                                      <div class="form-group">
                                        <input type="text" name="prezime" id="prezime" class="form-control">
                                      </div>
              <span id="porukaPrezime" class="bojaPoruke"></span>
                                  </div>
                                  <div class="form-group">
                                      <label for="username2" class="text-custom">Korisničko ime:</label><br>
                                        <input type="text" name="username2" id="username2" class="form-control">
                                      <span id="check-username"></span>
              <span id="porukaUsername" class="bojaPoruke"></span>
                                  </div>
                                  <div class="form-group">
                                    <label for="password2" class="text-custom">Lozinka:</label><br>
                                    <input type="password" name="password2" id="password2" class="form-control" >
              <span id="porukaPass" class="bojaPoruke"></span>
                                  </div>
                                  <div class="form-group">
                                    <label for="passRep" class="text-custom">Ponovljena lozinka:</label><br>
                                    <input type="password" name="passRep" id="passRep" class="form-control">
              <span id="porukaPassRep" class="bojaPoruke"></span> 
                                  </div>

                                  <div class="form-group">
                                    <input type="submit" name="registracija" class="btn btn-custom btn-md" value="Registriraj" onclick="return submitForme()" id="btn-registriraj">
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>

          </div>

      </div>
  </div>

</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="./assets/js/pwa.js"></script>
<script type="text/javascript">

function submitForme() {
  var slanjeForme = true;
  var poljeIme = document.getElementById("ime");
  var ime = document.getElementById("ime").value;

  if (ime.length == 0) {
    slanjeForme = false;
    poljeIme.style.border = "1px solid red";
    document.getElementById("porukaIme").innerHTML = "Unesite ime!";
  } 
  else {
    poljeIme.style.border = "1px solid green";
    document.getElementById("porukaIme").innerHTML = "";
  }

  var poljePrezime = document.getElementById("prezime");
  var prezime = document.getElementById("prezime").value;

  if (prezime.length == 0) {
    slanjeForme = false;
    poljePrezime.style.border = "1px solid red";
    document.getElementById("porukaPrezime").innerHTML = "Unesite prezime!";
  }
  else {
    poljePrezime.style.border = "1px solid green";
    document.getElementById("porukaPrezime").innerHTML = "";
  }

  var poljeUsername = document.getElementById("username2");
  var username2 = document.getElementById("username2").value;
  console.log(username2);

  if (username2.length == 0) {
    slanjeForme = false;
    poljeUsername.style.border = "1px solid red";
    document.getElementById("porukaUsername").innerHTML = "Unesite korisničko ime!";
  }
  else {
    poljeUsername.style.border = "1px solid green";
    document.getElementById("porukaUsername").innerHTML = "";
  }

  var poljePass = document.getElementById("password2");
  var pass2 = document.getElementById("password2").value;
  var poljePassRep = document.getElementById("passRep");
  var passRep = document.getElementById("passRep").value;

  if (pass2.length == 0) {
    slanjeForme = false;
    poljePass.style.border = "1px solid red";
    document.getElementById("porukaPass").innerHTML = "Unesite lozinku!";
  }

  if (pass2.length > 0) {
    poljePass.style.border = "1px solid green";
    document.getElementById("porukaPass").innerHTML = "";
  }

  if(passRep.length == 0){
    slanjeForme = false;
    poljePassRep.style.border = "1px solid red";
    document.getElementById("porukaPassRep").innerHTML = "Unesite ponovljenu lozinku!";
  }

  if(pass2 !== passRep) {
    slanjeForme = false;
    poljePass.style.border = "1px solid red";
    poljePassRep.style.border = "1px solid red";
    document.getElementById("porukaPassRep").innerHTML = "Lozinke nisu iste!";
  }

  if(passRep.length > 0 && pass2.length > 0 && pass2 === passRep) {
    poljePass.style.border = "1px solid green";
    poljePassRep.style.border = "1px solid green";
    document.getElementById("porukaPass").innerHTML = "";
    document.getElementById("porukaPassRep").innerHTML = "";
  }

  if (ime.length > 0 && prezime.length > 0 && username2.length > 0 && pass2.length > 0 && passRep.length > 0 && pass2 === passRep) {
    slanjeForme = true;
  }

  return slanjeForme;
}

function submitForme1() {
  var slanjeForme = true;
  var poljeUsername = document.getElementById("username");
  var username = document.getElementById("username").value;

  if (username.length == 0) {
    slanjeForme = false;
    poljeUsername.style.border = "1px solid red";
  }

  var poljePassword = document.getElementById("password");
  var password = document.getElementById("password").value;

  if (password.length == 0) {
    slanjeForme = false;
    poljePassword.style.border = "1px solid red";
  }

  if (username.length > 0 && password.length > 0){
    slanjeForme = true;
  }

  return slanjeForme;
}
</script>

  <?php
  if(isset($_SESSION["active-page"])) {
    if ($_SESSION["active-page"] == "prijava") echo '<script>document.getElementById("prijava-tab").click();</script>';
    elseif ($_SESSION["active-page"] == "registracija") echo '<script>document.getElementById("registracija-tab").click();</script>';
    unset($_SESSION["active-page"]);
  }
  ?>
  
</body>
</html>