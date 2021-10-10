<form method="post" enctype="multipart/form-data" action="" name="forma_vijest">
    <input type="hidden" name="cid" value="<?php echo isset($vijest) ? $vijest['id'] : '';  ?>">    

    <div class="form-group">
        <label for="naslov">Naslov</label>
        <?php $er_class = !empty($errors['naslov']) ? 'is-invalid' : ''; ?>
        <input type="text" class="form-control <?php echo $er_class; ?>" id="naslov" name="naslov" placeholder="" value="<?php echo isset($vijest) ? $vijest['naslov'] : '';  ?>">
        <?php if (isset($errors['naslov'])) { ?>
            <div class="invalid-feedback"> <?php echo !empty($errors['naslov']) ? $errors['naslov'] : ''; ?> </div>
        <?php } ?>
        
    </div>
    <div class="form-group">
        <label for="sazetak">Sazetak</label>
        <?php $er_class = !empty($errors['sazetak']) ? 'is-invalid' : ''; ?>
        <textarea class="form-control <?php echo $er_class; ?>" id="sazetak" name="sazetak" rows="3"><?php echo isset($vijest) ? $vijest['sazetak'] : '';  ?></textarea>
        <?php if (isset($errors['sazetak'])) { ?>
            <div class="invalid-feedback"> <?php echo !empty($errors['sazetak']) ? $errors['sazetak'] : ''; ?> </div>
        <?php } ?>
    </div>
    <div class="form-group">
        <label for="sadrzaj">Sadržaj</label>
        <?php $er_class = !empty($errors['sadrzaj']) ? 'is-invalid' : ''; ?>
        <textarea class="form-control <?php echo $er_class; ?>" id="sadrzaj" name="sadrzaj" rows="3"><?php echo isset($vijest) ? $vijest['sadrzaj'] : '';  ?></textarea>
        <?php if (isset($errors['sadrzaj'])) { ?>
            <div class="invalid-feedback"> <?php echo !empty($errors['sadrzaj']) ? $errors['sadrzaj'] : ''; ?> </div>
        <?php } ?>
    </div>
    <div class="form-group">
        <label for="slika">Slika</label>
        <?php $er_class = !empty($errors['slika']) ? 'is-invalid' : ''; ?>
        <input type="hidden" name="slika_hid" id="slika_hid" value="<?php echo isset($vijest) ? $vijest['slika'] : '';  ?>">
        <input type="file" class="form-control-file <?php echo $er_class; ?>" id="slika" name="slika">
        <?php if (isset($errors['slika'])) { ?>
            <div class="invalid-feedback"> 
                <?php 
                    if(!empty($errors['slika'])){
                        if(is_array($errors['slika'])){
                            echo implode('<br/>', $errors['slika']);
                        } else {
                            echo $errors['slika'];
                        }
                    }
                ?>
            </div>
       <?php } ?>
    </div>
    <div class="form-group">
        <label for="kategorija">Kategorija</label>
        <?php $er_class = !empty($errors['kategorija']) ? 'is-invalid' : ''; ?>
        <select class="form-control <?php echo $er_class; ?>" name="kategorija" id="kategorija">
            <option>Odaberi kategoriju</option>
            <?php if(isset($vijest)) {
                    if($vijest['kategorija'] == 'sport') {
                        echo '<option value="sport" selected="selected">Sport</option>';
                    } else {
                        echo '<option value="sport" >Sport</option>';
                    }

                    if($vijest['kategorija'] == 'politika') {
                        echo '<option value="politika" selected="selected">Politika</option>';
                    } else {
                        echo '<option value="politika" >Politika</option>';
                    }

                } else { ?>
                    <option value="sport" >Sport</option>
                    <option value="politika">Politika</option>
            <?php } ?>
            
        </select>
        <?php if (isset($errors['kategorija'])) { ?>
            <div class="invalid-feedback"> <?php echo !empty($errors['kategorija']) ? $errors['kategorija'] : '' ;?> </div>
       <?php } ?>
    </div>
    <div class="form-group">
        <label for="datum">Datum</label>
        <?php $er_class = !empty($errors['datum']) ? 'is-invalid' : ''; ?>
        <input type="text" class="form-control <?php echo $er_class; ?>" id="datum" name="datum" placeholder="" value="<?php echo isset($vijest) ? $vijest['datum'] : '';  ?>">
        
    </div>
    <div class="form-check">
        <input type="hidden" name="arhiva" value="0">
        <input class="form-check-input" type="checkbox" value="1" id="arhiva" name="arhiva">
        <label class="form-check-label" for="arhiva">Arhivirano</label>
    </div>



    <button type="submit" class="btn btn-primary" name="spremi">Spremi</button>
</form>