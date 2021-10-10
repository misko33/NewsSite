<?php 
    $errors = array(); 
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <?php 
                if(isset($_GET['task']) && $_GET['task'] == 'edit') {
                
                    if(isset($_GET['cid'])) { ?>
                        
                        <h2>Uređivanje članka </h2>
                        <?php 
                            $cid = clean($_GET['cid']); 

                            if(isset($_POST['spremi'])) {
                                $naziv_slike = '';
                                $id = clean($_POST['cid']);
                                $naslov = clean($_POST['naslov']);
                                $sazetak = clean($_POST['sazetak']);
                                $sadrzaj = clean($_POST['sadrzaj']);
                                $kategorija = clean($_POST['kategorija']);
                                $arhiva = clean($_POST['arhiva']);
                                $datum = clean($_POST['datum']);

                                $datum =strtotime($datum);

                                $datum = date( 'Y-m-d H:i:s', $datum );

                                if(isset($_POST['slika_hid'])) {
                                    $slika_org = clean($_POST['slika_hid']);
                                    $naziv_slike = $slika_org; 
                                }
                                
                                if(isset($_FILES['slika'])){
                                    
                                    $file_name = $_FILES['slika']['name'];
                                    $file_size =$_FILES['slika']['size'];
                                    $file_tmp =$_FILES['slika']['tmp_name'];
                                    $file_type=$_FILES['slika']['type'];
                                    
                                    $tmp = explode('.', $file_name);
                                    $file_ext =strtolower( end($tmp));

                                    $extensions= array("jpeg","jpg","png", "gif");
                                    
                                    if(in_array($file_ext,$extensions)=== false){
                                       $errors['slika'][]="Ova extenzija nije dozvoljena. Probajte s jpeg, jpg, png, gif";
                                    }
                                    
                                    if($file_size > 10485760){
                                       $errors['slika'][]='Datoteka je prevelika. Dozvoljeno je 10MB';
                                    }
                                    
                                    if(empty($errors)){
                                       move_uploaded_file($file_tmp,"upload/".$file_name);
                                       $naziv_slike = $file_name;
                                    }
                                } else {
                                    if($naziv_slike == $slika_org) {
                                        $naziv_slike = $slika_org;
                                    } else {
                                        $errors['slika'] = "Slika nesmije biti prazna ";
                                    }
    
                                }

                                if(strlen($naslov) < 0 ){
                                    $errors['naslov'] = "Naslov nesmije biti prazan";
                                }

                                if(strlen($sazetak) < 0 ) {
                                    $errors['sazetak'] = "Sažetak nesmije biti prazan"; 
                                }

                                if(strlen($sadrzaj) < 0 ) {
                                    $errors['sadrzaj'] = "Sadrzaj nesmije biti prazan"; 
                                }

                                if(empty($errors)) {

                                    $data = array(
                                        'id' => $id,
                                        'naslov' => $naslov,
                                        'sazetak' => $sazetak,
                                        'sadrzaj' => $sadrzaj,
                                        'slika' => $naziv_slike,
                                        'kategorija' => $kategorija,
                                        'arhiva' => $arhiva,
                                        'datum' => $datum,
                                    );

                                    if($clanak->updateClanak($data, $id)){
                                        $_SESSION['poruka'] = "Članak je ažuriran";
                                        header("location: admin.php?page=clanci");
                                    } else {
                                        $_SESSION['error'] = "Članak nije ažuriran";
                                    }
                                }

                            }

                            $vijest = $clanak->getClanak($cid); 
                            include('forma_clanak.php'); 
                        ?>


                <?php } else {
                        echo "greška"; 
                    }

                } else if (isset($_GET['task']) && $_GET['task'] == 'add') { ?>
                    <h2>Dodavanje novog članka </h2>
                    <?php 


                    if(isset($_POST['spremi'])) {
                        $naziv_slike = '';
                        $id = clean($_POST['cid']);
                        $naslov = clean($_POST['naslov']);
                        $sazetak = clean($_POST['sazetak']);
                        $sadrzaj = clean($_POST['sadrzaj']);
                        $kategorija = clean($_POST['kategorija']);
                        $arhiva = clean($_POST['arhiva']);
                        $datum = clean($_POST['datum']);

                        $datum =strtotime($datum);

                        $datum = date( 'Y-m-d H:i:s', $datum );


                        if(isset($_POST['slika_hid'])) {
                            $slika_org = clean($_POST['slika_hid']);
                            $naziv_slike = $slika_org; 
                        }
                        
                        if(isset($_FILES['slika'])){
                            
                            $file_name = $_FILES['slika']['name'];
                            $file_size =$_FILES['slika']['size'];
                            $file_tmp =$_FILES['slika']['tmp_name'];
                            $file_type=$_FILES['slika']['type'];

                            $tmp = explode('.', $file_name);
                            $file_ext =strtolower( end($tmp));
                            
                            $extensions= array("jpeg","jpg","png", "gif");
                            
                            if(in_array($file_ext,$extensions)=== false){
                               $errors['slika'][]="Ova extenzija nije dozvoljena. Dozvoljene ekstenzije su: jpeg, jpg, png, gif";
                            }
                            
                            if($file_size > 10485760){
                               $errors['slika'][]='Datoteka je prevelika. Dozvoljena veličina je 10MB';
                            }
                            
                            if(empty($errors)){
                               move_uploaded_file($file_tmp,"upload/".$file_name);
                               $naziv_slike = $file_name;

                            }
                        } else {
                            if($naziv_slike == $slika_org) {
                                $naziv_slike = $slika_org;
                            } else {
                                $errors['slika'] = "Slika nesmije biti prazna ";
                            }

                        }
 
                        if(strlen($naslov) < 0 ){
                            $errors['naslov'] = "Naslov nesmije biti prazan";
                        }

                        if(strlen($sazetak) < 0 ) {
                            $errors['sazetak'] = "Sažetak nesmije biti prazan"; 
                        }

                        if(strlen($sadrzaj) < 0 ) {
                            $errors['sadrzaj'] = "Sadrzaj nesmije biti prazan"; 
                        }



                        if(empty($errors)) {

                            $data = array(
                                'id' => $id,
                                'naslov' => $naslov,
                                'sazetak' => $sazetak,
                                'sadrzaj' => $sadrzaj,
                                'slika' => $naziv_slike,
                                'kategorija' => $kategorija,
                                'arhiva' => $arhiva,
                                'datum' => $datum,
                            );

                            if($clanak->spremiClanak($data)){
                                $_SESSION['poruka'] = "članak je dodan";
                                header("location: admin.php?page=clanci");
                            } else {
                                $_SESSION['error'] = "Članak nije dodan";
                            }
                        }

                    }

                        include('forma_clanak.php'); 

                } else if(isset($_GET['task']) && $_GET['task'] == 'delete') {
					
                    if(isset($_GET['cid'])) { 

                        $cid = clean($_GET['cid']); 

                        if($clanak->brisanje($cid)){
                            $_SESSION['poruka'] = "članak je obrisan";
                            header("location: admin.php?page=clanci");
                        }

                    }

               } else { 
                   
                   $clanci = $clanak->getClanci();?>
                
                <h2>Lista članaka  <a class="btn btn-success pull-right" href="?page=clanci&task=add" role="button">Dodaj novi članak</a> </h2>

            <?php  
                if(isset($_SESSION['poruka'])) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $_SESSION['poruka']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>            
            <?php }
                if(isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $_SESSION['error']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>            
                <?php }
            
            if(!empty($clanci) > 0) { ?>
                    

                    <table id="lista_clanaka" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th>Naslov</th>
                                <th>Datum</th>
                                <th>Kategorija</th>
                                <th class="text-center">Arhivirano</th>
                                <th class="text-center">Akcija</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($clanci as $vijest) : ?>
                            <tr>
                                <td class="text-center"><?php echo $vijest['id']; ?></td>
                                <td><?php echo $vijest['naslov']; ?></td>
                                <td><?php echo $vijest['datum']; ?></td>
                                <td><?php echo $vijest['kategorija']; ?></td>
                                <td class="text-center"><?php echo $vijest['arhiva'] ? 'Da' : 'Ne'; ?></td>
                                <td class="text-center">
                                    <a class="btn btn-primary btn-sm" href="?page=clanci&task=edit&cid=<?php echo $vijest['id']; ?>" role="button">Uredi</a> 
                                    <a class="btn btn-danger btn-sm" href="?page=clanci&task=delete&cid=<?php echo $vijest['id']; ?>" role="button">Brisanje</a> 
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                
                <?php } else {
                    echo "Trenutno nema članaka u bazi !";
                } ?>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                        <a class="btn btn-success" href="?page=clanci&task=add" role="button">Dodaj novi članak</a> 
                        </div>
                    </div>
                </div>
                    
            <?php } ?>

        </div>    
    </div>    
</div>