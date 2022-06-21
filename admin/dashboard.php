<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h2>
                Login korisnika
            </h2>
            <?php  $log = $korisnik->all_log_auth();

            if(!empty($log)) { ?>
          <table id="lista_korisnika" class="table table-striped table-bordered" style="width:100%">
            <thead style="text-align: center">
              <tr style="text-align: center">
                <th style="text-align: center">User</th>
                <th class="text-center">IP</th>
                <th class="text-center">Datum</th>
                <th class="text-center">Login</th>
                <th>User Agent</th>
              </tr>
            </thead>
            <tbody style="text-align: center">
            <?php foreach ($log as $log1) : ?>
            <tr style="text-align: center">
              <td style="text-align: center"><?php echo $log1['username']; ?></td>
              <td class="text-center"><?php echo $log1['ip']; ?></td>
              <td class="text-center"><?php echo $log1['datum']; ?></td>
              <td class="text-center"><?php echo $log1['islogin'] ? 'True' : 'False'; ?></td>
              <td><?php echo $log1['useragent']; ?></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
          </table>  
          <?php
        } 
        else {
          echo "Trenutno nema podataka o login-u";
        } ?>
        </div>    
    </div>    
</div>

<div>
    <div>
        <div>
            <h2 style="text-align: right">
            
            </h2>
        </div>
    </div>
</div>

