<?php 

if(isset($_GET['page']) && $_GET['page'] == 'clanci') {
  if(isset($_GET['kat'])) { 
    $kategorija = clean($_GET['kat']);

    if(isset($_GET['cid'])) {
      $clanak_id = clean($_GET['cid']);
        
      $clanak_data = $clanak->getClanak($clanak_id);

      $slika = "no_image.png";
      if(isset($clanak_data['slika']) && !empty($clanak_data['slika'])) {
        $slika = $clanak_data['slika'];
      }
      ?>

  <section class="<?php echo strtolower($kategorija); ?> clanak">
    <div class="section-content">
      <article>
    <div class="row">
      <div class="col-md-2">
    </div>
      <div class="col-md-8">
        <header class="clanak-header">
          <h1 class="clanak-naslov"><?php echo $clanak_data['naslov']; ?></h1>
          <span class="clanak-datum"><?php echo "AKTUALISIERT AM " . $clanak_data['datum']; ?></span>
        </header>
      </div>
    </div>
                    
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <figure class="clanak-slika">
            <img src="./images/<?php echo $slika; ?>" class="img-fluid " alt="<?php echo $clanak_data['naslov']; ?>" title="<?php echo $clanak_data['naslov']; ?>">
          </figure>
        </div>
      </div>
        <div class="row">
          <div class="col-md-2"></div>
            <div class="col-md-8">
                <p class="clanak-sazetak">
                  <?php echo $clanak_data['sazetak']; ?>
                </p>
                <p class="clanak-sadrzaj">
                  <?php echo $clanak_data['sadrzaj']; ?>
                </p>
            </div>
        </div>
          <div class="row komentariBox">
            <div class="col-md-2"></div>
              <div class="col-md-8">
                <?php
                $allComments = $clanak->getComments($clanak_id);

                if(!$korisnik->jePrijavljen()) {
                  $_SESSION["poruka-false"] = "Za komentiranje potrebno je ulogirati se";
                }

                if(isset($_POST['komentiraj'])) {
                  if($korisnik->jePrijavljen()) {

                    $userName   = $korisnik->getKorisnickoIme();
                    $userId     = $korisnik->jePrijavljen();
                    $text       = $_POST['addComment'];
                    $datum      = date( 'Y-m-d H:i:s' );

                    $data = array();
                    $data['userId']     = $userId;  
                    $data['clanakId']   = $clanak_id;
                    $data['userName']   = $userName;
                    $data['commText']   = $text;
                    $data['datum']      = $datum;

                    $_POST = array();

                    $commented = $clanak->addComment($data);

                    if($commented) {
                      $_SESSION["poruka-true"] = "Komentar je dodan YAY";
                      echo "<meta http-equiv='refresh' content='0'>";
                    }
                    else {
                      $_SESSION["poruka-false"] = "Doslo je do pogreske pri spremanju komentara.";
                    }
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

                <?php // for testing ?>
                <h4>Komentari</h4>
                <div class="comment" id="Komentiraj">
                  <form action="" method="post" name="Comment-post">
                    <textarea id="addComment" type="message" name="addComment" minlength="2" maxlength="150" style="high: 100%; width: 100%" placeholder="Zelimo cuti Vase misljenje"></textarea>
                    <div class="countCom">

                      <?php if($korisnik->jePrijavljen()) { ?>
                      <input type="submit" name="komentiraj" class="btn btn-custom btn-md" value="Submit" onclick="return submitKom()" action="clanci.php" id="btn-komentiraj" />
                      <?php } ?>

                      <?php if(!$korisnik->jePrijavljen()) { ?>
                      <input type="submit" name="komentiraj" class="btn btn-custom btn-md" value="Submit" onclick="return submitKom()" id="btn-komentiraj" disabled />
                      <?php } ?>

                    </form>
                    <div id="counter">0/150</div>
                  </div>
                </div>

                <?php 
                foreach ($allComments as $c) : ?>

                <div class="userNameComment">
                  <?php echo $c['username']; ?>
                </div>

                <div class="userComment">
                  <?php echo $c['text']; ?>
                </div>

                <div class="datumComment">
                  <?php echo $c['datum']; ?>
                </div>

                <?php endforeach ?>
              </div>
            </div>
          </div>
        </div>
      </article>
    </div>
  </section>
  <?php } else { ?>

    <section class="sport">
      <div class="section-content">
        <ul class="articles">
          <div class="section-heading">
            <h2 class="section-title"><a href="?page=clanci&kat=<?php echo strtolower ($kategorija); ?>" class="heading-link"><?php echo ucfirst($kategorija); ?></a></h2>
          </div>
          <?php 
            $clanci = $clanak->getClanci(strtolower ($kategorija)); 
            if(!empty($clanci)) {
              foreach ($clanci as $vijest) { 
                $clanak_url = "?page=clanci&kat=" . $vijest['kategorija'] . "&cid=" . $vijest['id'];
                echo "<li id='" . $vijest['kategorija'] . $vijest['id'] ."' style='cursor: pointer'>" ;
                $clanak->ispis_clanka_front($vijest);
                echo "</li>";
                echo '<script>document.getElementById("' . $vijest['kategorija'] . $vijest['id'] . '").onclick = function(){ location.href=`' . $clanak_url . '`};</script>';
              }
            } else {
              echo "<li>" ;
              echo "Trenutno nema clanaka u kategoriji"; 
              echo "</li>";
            }
          ?>
        </ul>
      </div>
    </section>
    <?php } 
  }
} else {
  echo "GREŠKA! "; 
}
?>

<script>

const messageEle = document.getElementById('addComment');
const counterEle = document.getElementById('counter');

messageEle.addEventListener('input', function (e) {
  const target = e.target;

  const maxLength = target.getAttribute('maxlength');

  const currentLength = target.value.length;

  counterEle.innerHTML = `${currentLength}/${maxLength}`;
});

function unhide() {
  var x = document.getElementById("countCom");
  if (x.style.display === "none") {
    x.style.display = "block";
  }
  else {
    x.style.display = "none";
  }
} 

function submitKom() {
  var slanjeForme = true;
  var poljeaddComment = document.getElementById("addComment");
  var addComment = document.getElementById("addComment").value;
  console.log(document.getElementById("addComment").value);

  if (addComment.length == 0) {
    slanjeForme = false;
    poljeaddComment.style.border = "1px solid red";
  }

  if (addComment.length >= 2) {
    slanjeForme = true;
  }

  return slanjeForme;
}


</script>