<?php
    if(isset($_GET['cid'])) {
        $cid = clean($_GET['cid']); 
    }
    $vijest = $clanak->getClanak($cid);
?>
<?php
if(isset($_SESSION["poruka-false"])) { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $_SESSION["poruka-false"]; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php }
?>
<div class="clanak-header">
    <div class="container-fluid inner-wrapper">
        <div class="row">
            <div class="col-md-12">
                <p class="kategorija-naslov"><?php echo $vijest['kategorija']; ?></p>
            </div>
        </div>
    </div>
</div>

<article>
    <div class=" inner-wrapper">
        <h1 class="clanak-naslov"><?php echo $vijest['naslov']; ?></h1>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <figure class="clanak-slika">
                      <img src="./images/lesPaul.jpg" class="img-fluid " alt="<?php echo $vijest['naslov']; ?>" title="<?php echo $vijest['naslov']; ?>">
                    </figure>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p class="clanak-sadrzaj">
                        <?php echo $vijest['sadrzaj']; ?>
                    </p>
                    
                </div>
            </div>
        </div>
    </div>
</article>