<form method="post" enctype="multipart/form-data" action="" name="forma_korisnik">

    <input type="hidden" name="uid" value="<?php echo isset($user) ? $user['id'] : '';  ?>">

    <div class="form-group">
        <label for="ime">Ime</label>
        <input type="text" class="form-control" id="ime" name="ime" placeholder="" value="<?php echo isset($user) ? $user['ime'] : '';  ?>">
    </div>
    <div class="form-group">
        <label for="prezime">Prezime</label>
        <input type="text" class="form-control" id="prezime" name="prezime" placeholder="" value="<?php echo isset($user) ? $user['prezime'] : '';  ?>">
    </div>
    <div class="form-group">
        <label for="korisnicko_ime">Korisiničko ime</label>
        <input type="text" class="form-control" id="korisnicko_ime" name="korisnicko_ime" placeholder="" value="<?php echo isset($user) ? $user['korisnicko_ime'] : '';  ?>">
    </div>
    <div class="form-group">
        <label for="lozinka">Lozinka</label>
        <input type="password" class="form-control" id="lozinka" name="lozinka" placeholder="" value="">
    </div>
    <div class="form-group">
        <label for="lozinka2">Ponovljena lozinka</label>
        <input type="password" class="form-control" id="lozinka2" name="lozinka2" placeholder="" value="">
    </div>

    <div class="form-group">
        <label for="razina">Razina</label>
        
        <select class="form-control " name="razina" id="razina">
            <option>Odaberi razinu</option>
            <?php if(isset($user)) {
                    if($user['razina'] == 0) {
                        echo '<option value="0" selected="selected">Korisnik</option>';
                    } else {
                        echo '<option value="0" >Korisnik</option>';
                    }

                    if($user['razina'] == 1) {
                        echo '<option value="1" selected="selected">Administrator</option>';
                    } else {
                        echo '<option value="1" >Administrator</option>';
                    }

                } else { ?>
                    <option value="0" >Korisnik</option>
                    <option value="1">Administrator</option>
            <?php } ?>
            
        </select>

    </div>

    <button type="submit" class="btn btn-primary" name="spremi">Spremi</button>
</form>