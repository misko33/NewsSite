<?php 
$br_clanaka = 3; 
?>

<section class="politika">
    <div class="section-content">
        <ul class="articles">
			<div class="section-heading">
				<h2 class="section-title"><a href="?page=clanci&kat=politika" class="heading-link">Politik</a></h2>
			</div>
			<?php 
				$clanci = $clanak->getClanci('politika'); 

				if(!empty($clanci)) {
					$count = 0; 
					foreach ($clanci as $vijest) {
						$clanak_url = "?page=clanci&kat=" . $vijest['kategorija'] . "&cid=" . $vijest['id'];
						echo "<li id='" . $vijest['kategorija'] . $vijest['id'] ."' style='cursor: pointer'>";
						$clanak->ispis_clanka_front($vijest);
						echo "</li>";
						echo '<script>document.getElementById("' . $vijest['kategorija'] . $vijest['id'] . '").onclick = function(){ location.href=`' . $clanak_url . '`};</script>';
						$count++;
						if($count === $br_clanaka) {
							break;
						}
					}
				}
				else {
					echo "<li>" ;
					echo "Trenutno nema clanaka u kategoriji"; 
					echo "</li>";
				}
			?>
        </ul>

    </div>
</section>

<section class="sport">
    <div class="section-content">
        <ul class="articles">
			<div class="section-heading">
				<h2 class="section-title"><a href="?page=clanci&kat=sport" class="heading-link">Sport</a></h2>
			</div>
			<?php 
				$clanci = $clanak->getClanci('sport'); 

				if(!empty($clanci)) {
					$count = 0; 
					foreach ($clanci as $vijest) {
						$clanak_url = "?page=clanci&kat=" . $vijest['kategorija'] . "&cid=" . $vijest['id'];
						echo "<li id='" . $vijest['kategorija'] . $vijest['id'] ."' style='cursor: pointer'>";
						$clanak->ispis_clanka_front($vijest);
						echo "</li>";
						echo '<script>document.getElementById("' . $vijest['kategorija'] . $vijest['id'] . '").onclick = function(){ location.href=`' . $clanak_url . '`};</script>';
						$count++;
						if($count === $br_clanaka) {
							break;
						}
					} 
				}
				else {
					echo "<li>" ;
					echo "Trenutno nema clanaka u kategoriji"; 
					echo "</li>";
				}
			?>
        </ul>

    </div>
</section>

