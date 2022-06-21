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
                                $errors['ime'] = "Ime nesmije biti prazno"; 
                            }

                            if(strlen($prezime) == 0) {
                                $errors['prezime'] = "Prezime nesmije biti prazno"; 
                            }

                            if(strlen($username) == 0) {
                                $errors['username'] = "Korisničko nesmije biti prazno"; 
                            }

                            if(strlen($lozinka) == 0) {
                                $errors['lozinka'] = "Lozinka nesmije biti prazno"; 
                            }
                            if($lozinka != $lozinka2) {
                                $errors['lozinka2'] = "Lozinke nisu jednake"; 
                            }

                            if(empty($errors)){
                                $data = array(
                                    'id' => $id,
                                    'ime' => $ime,
                                    'prezime' => $prezime,
                                    'korisnicko_ime' => $username,
                                    'lozinka' => password_hash($lozinka, CRYPT_BLOWFISH),
                                    'razina' => $razina
                                );

                                if($korisnik->urediKorisnika($data, $id)){
                                    $_SESSION['poruka'] = "Korisnik je ažuriran";
                                    header("location: admin.php?page=korisnici");
                                } else {
                                    $_SESSION['error'] = "Korisnik nije ažuriran";
                                }
                            }

                        }

                    $user = $korisnik->getKorisnik($uid); 
                    include('forma_korisnik.php'); 
                
                ?>



                <?php } else {
                        echo "greška"; 
                    }

                } else if (isset($_GET['task']) && $_GET['task'] == 'add') { ?>
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
                                $errors['ime'] = "Ime nesmije biti prazno"; 
                            }

                            if(strlen($prezime) == 0) {
                                $errors['prezime'] = "Prezime nesmije biti prazno"; 
                            }

                            if(strlen($username) == 0) {
                                $errors['username'] = "Korisničko nesmije biti prazno"; 
                            }

                            if(strlen($lozinka) == 0) {
                                $errors['lozinka'] = "Lozinka nesmije biti prazno"; 
                            }
                            if($lozinka != $lozinka2) {
                                $errors['lozinka2'] = "Lozinke nisu jednake"; 
                            }

                            if(empty($errors)){
                                $data = array(
                                    'id' => $id,
                                    'ime' => $ime,
                                    'prezime' => $prezime,
                                    'korisnicko_ime' => $username,
                                    'lozinka' => $lozinka,
                                    'razina' => $razina
                                );

                                if($korisnik->addUser($data)){
                                    $_SESSION['poruka'] = "Korisnik je dodan";
                                    header("location: admin.php?page=korisnici");
                                } else {
                                    $_SESSION['error'] = "Korisnik nije dodan";
                                }
                            }

                        }

                        include('forma_korisnik.php'); 
                
                    ?>



               <?php } else if(isset($_GET['task']) && $_GET['task'] == 'delete') {

                    if(isset($_GET['uid'])) { 
                        $uid = clean($_GET['uid']); 

                        if($korisnik->brisanje($uid)){
                            $_SESSION['poruka'] = "Korisnik je obrisan";
                            header("location: admin.php?page=korisnici");
                        }

                    }

               } else { ?> 
                    <h2>Lista korisnika  <a class="btn btn-success pull-right" href="?page=korisnici&task=add" role="button">Dodaj novog korisnika</a> </h2>
                <?php



                   $korisnici = $korisnik->getKorisnici();

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
                
                <?php } else {
                    echo "Trenutno nema korisinika u bazi !";
                } ?>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                        <a class="btn btn-success" href="?page=korisnici&task=add" role="button">Dodaj novog korisnika</a> 
                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>    
    </div>    
</div> 
