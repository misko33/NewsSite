<div>
    <div class="row">
        <div>
          <h2 class="titleLogin">
            Login korisnika
          </h2>
          <?php  $log = $korisnik->all_log_auth();

          if(!empty($log)) { ?>
          <div class="tableFix">
            <table class="table table-striped" style="width:100%" id="sortMyTb">
              <thead style="text-align: center">
                <tr style="text-align: center">
                  <th class="text-center" style="cursor: pointer" onclick="sortTable(0)">User</th>
                  <th class="text-center" style="cursor: pointer" onclick="sortTable(1)">IP</th>
                  <th class="text-center" style="cursor: pointer" onclick="sortTable(2)">Datum</th>
                  <th class="text-center" style="cursor: pointer" onclick="sortTable(3)">Login</th>
                  <th class="text-center" style="cursor: pointer" onclick="sortTable(4)">User Agent</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($log as $l) : ?>
              <tr style="text-align: center">
                <td class="text-center"><?php echo $l['username']; ?></td>
                <td class="text-center"><?php echo $l['ip']; ?></td>
                <td class="text-center"><?php echo $l['datum']; ?></td>
                <td class="text-center"><?php echo $l['islogin'] ? 'True' : 'False'; ?></td>
                <td class="text-center"><?php echo $l['useragent']; ?></td>
              </tr>
              <?php endforeach; ?>
              </tbody>
            </table> 
          </div> 
          <?php
          }
          else {
            echo "Trenutno nema podataka o login-u";
          } ?>
        </div>    
    </div>    
</div>
<div>
 
</div>

<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("sortMyTb");
  switching = true;
  dir = "asc"; 
  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch= true;
          break;
        }
      }
      else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount ++;      
    }
    else {
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>

