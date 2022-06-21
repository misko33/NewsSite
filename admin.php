<?php

include('./system/init.php');

$page = 'dashboard';
if (isset($_GET['page'])) {
  $page = clean($_GET['page']);
}

if ($korisnik->jePrijavljen()) {
  if (!$korisnik->imaDozvolu()) {
    header("location: index.php");
    exit;
  }
  else {
    if(!isset($_GET['page'])) $page = 'home';  
  }
} else {
  header("location: login.php");
  exit;
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../../../favicon.ico">

  <title>Administracija</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
  <link href="./assets/css/admin.css" rel="stylesheet">

</head>

<body>

  <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="?page=home">Administracija</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a
            <?php if($page == 'home') {
              ?> class="nav-link active "<?php } else ?> class="nav-link" href="?page=home">Naslovna</a>
          </li>
          <li class="nav-item">
            <a
            <?php if($page == 'clanci') {
              ?> class="nav-link active" <?php } else ?> class="nav-link" href="?page=clanci">Vijesti</a>
          </li>
          <li class="nav-item">
            <a 
            <?php if($page == 'korisnici') {
              ?> class="nav-link active" <?php } else ?> class="nav-link" href="?page=korisnici">Korisnici</a>
          </li>
        </ul>

        <ul class="navbar-nav my-2 my-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $korisnik->getKorisnickoIme(); ?></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="?page=profil">Moj profil</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="?page=logout">Odjava</a>
            </div>
          </li>
        </ul>

      </div>
    </nav>
  </header>

  <main role="main" class="container">
    <?php

    switch ($page) {
      case 'dashboard':
        include('admin/dashboard.php');
        break;
      case 'clanci':
        include('admin/clanci.php');
        break;
      case 'korisnici':
        include('admin/korisnici.php');
        break;
      case 'profil':
        include('admin/profil.php');
        break;
      case 'logout':
        $korisnik->logout();
        header("location: login.php");
        break;

      default:
        include('admin/dashboard.php');
        break;
    }
    ?>
  </main>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
  <script src="./assets/js/pwa.js"></script>
</body>

</html>