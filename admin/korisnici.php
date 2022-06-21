<?php 
    $errors = array(); 
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <?php 
      if(isset($_GET['task']) && $_GET['task'] == 'edit') {
                
        if(isset($_GET['uid'])) { ?>
          <h2>Uređivanje korisnika </h2>
          <?php 
            $uid = clean($_GET['uid']); 
                   
            if(isset($_POST['spremi'])) {
              $id = clean($_POST['uid']);
              $ime = clean($_POST['ime']);
              $prezime = clean($_POST['prezime']);
              $username = clean($_POST['korisnicko_ime']);
              $lozinka = clean($_POST['lozinka']);
              $lozinka2 = clean($_POST['lozinka2']);
              $razina = clean($_POST['razina']);

              if(strlen($ime) == 0) {
                $_SESSION["poruka-false"] = "Ime nesmije biti prazno"; 
              }

              if(strlen($prezime) == 0) {
                $_SESSION["poruka-false"] = "Prezime nesmije biti prazno"; 
              }

              if(strlen($username) == 0) {
                $_SESSION["poruka-false"] = "Korisničko nesmije biti prazno"; 
              }

              if(strlen($lozinka) > 0 && $lozinka !== $lozinka2) {
                $_SESSION["poruka-false"] = "Lozinke nisu jednake"; 
              }

              if(empty($_SESSION["poruka-false"])) {
                if(strlen($lozinka) > 0) {
                  $data = array(
                    'id' => $id,
                    'ime' => $ime,
                    'prezime' => $prezime,
                    'korisnicko_ime' => $username,
                    'lozinka' => password_hash($lozinka, CRYPT_BLOWFISH),
                    'razina' => $razina
                  );
                }
                else {
                  $data = array(
                    'id' => $id,
                    'ime' => $ime,
                    'prezime' => $prezime,
                    'korisnicko_ime' => $username,
                    'razina' => $razina
                  );
                }
                
                if($korisnik->urediKorisnika($data, $id)) {
                  $_SESSION["poruka-true"] = "Korisnik je ažuriran";
                  header("location: admin.php?page=korisnici");
                }

                else {
                  $_SESSION["poruka-false"] = "Korisnik nije ažuriran";
                }
              }
            }
            $user = $korisnik->getKorisnik($uid); 
            include('forma_korisnik.php');  
            ?>
            <?php
        }
        else {
          echo "greška"; 
        }
      }
      else if (isset($_GET['task']) && $_GET['task'] == 'add') { ?>
        <h2>Dodavanje novog korisnika </h2>
          <?php 
        if(isset($_POST['spremi'])) {
          $id = clean($_POST['uid']);
          $ime = clean($_POST['ime']);
          $prezime = clean($_POST['prezime']);
          $username = clean($_POST['korisnicko_ime']);
          $lozinka = clean($_POST['lozinka']);
          $lozinka2 = clean($_POST['lozinka2']);
          $razina = clean($_POST['razina']);

          if(strlen($ime) == 0) {
            $_SESSION["poruka-false"] = "Ime nesmije biti prazno"; 
          }

          if(strlen($prezime) == 0) {
            $_SESSION["poruka-false"] = "Prezime nesmije biti prazno"; 
          }

          if(strlen($username) == 0) {
            $_SESSION["poruka-false"] = "Korisničko nesmije biti prazno"; 
          }

          if(strlen($lozinka) == 0) {
            $_SESSION["poruka-false"] = "Lozinka nesmije biti prazna"; 
          }
          if($lozinka !== $lozinka2) {
            $_SESSION["poruka-false"] = "Molimo ponovite lozinku"; 
          }

          if(empty($_SESSION["poruka-false"])) {
            $data = array(
              'id' => $id,
              'ime' => $ime,
              'prezime' => $prezime,
              'korisnicko_ime' => $username,
              'lozinka' => $lozinka,
              'razina' => $razina
            );

            if($korisnik->addUser($data)) {
              $_SESSION['poruka'] = "Korisnik je dodan";
              header("location: admin.php?page=korisnici");
            }
            else {
              $_SESSION["poruka-false"] = "Korisnik nije dodan";
            }
          }

        }
        include('forma_korisnik.php');       
        ?>
        <?php 
      }
      else if(isset($_GET['task']) && $_GET['task'] == 'delete') {
        if(isset($_GET['uid'])) { 
          $uid = clean($_GET['uid']); 

          if($korisnik->brisanje($uid)){
            $_SESSION["poruka-true"] = "Korisnik je obrisan";
            header("location: admin.php?page=korisnici");
          }
        }

      }
      else { ?> 
        <h2>Lista korisnika  <a class="btn btn-success pull-right" href="?page=korisnici&task=add" role="button">Dodaj novog korisnika</a> </h2>
        <?php
        $korisnici = $korisnik->getKorisnici();

        if(isset($_SESSION["poruka-true"])) { ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              <?php echo $_SESSION["poruka-true"]; ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
        <?php
        unset($_SESSION['poruka-true']); }

        if(isset($_SESSION["poruka-false"])) { ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <?php echo $_SESSION["poruka-false"]; ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
      <?php 
      unset($_SESSION['poruka-false']); }
        if(!empty($korisnici) > 0) { ?>
          <table id="lista_korisnika" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th class="text-center">Id</th>
                <th>Ime</th>
                <th>Prezime</th>
                <th>Korisničko ime</th>
                <th class="text-center">Administrator</th>
                <th class="text-center">Akcija</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($korisnici as $kor) : ?>
            <tr>
              <td class="text-center"><?php echo $kor['id']; ?></td>
              <td><?php echo $kor['ime']; ?></td>
              <td><?php echo $kor['prezime']; ?></td>
              <td><?php echo $kor['korisnicko_ime']; ?></td>
              <td class="text-center"><?php echo $kor['razina'] ? 'Da' : 'Ne'; ?></td>
              <td class="text-center">
                <a class="btn btn-primary btn-sm" href="?page=korisnici&task=edit&uid=<?php echo $kor['id']; ?>" role="button">Uredi</a> 
                <a class="btn btn-danger btn-sm" href="?page=korisnici&task=delete&uid=<?php echo $kor['id']; ?>" role="button">Brisanje</a> 
              </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
          </table>  
          <?php
        } 
        else {
          echo "Trenutno nema korisinika u bazi !";
        } ?>

        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
            <a class="btn btn-success" href="?page=korisnici&task=add" role="button">Dodaj novog korisnika</a> 
            </div>
          </div>
        </div>
       <?php
      } ?>
    </div>    
  </div>    
</div> 
