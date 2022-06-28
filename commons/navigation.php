<?php
$kategorija = '';
if(isset($_GET['kat'])) {
	$kategorija = clean($_GET['kat']); 
} 
?>

<header>
    <div class="inner-wrapper">
		<nav class="navbar navbar-expand-lg navbar-light" style="border-bottom: solid;">
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
						  <span class="navbar-toggler-icon"></span>
						</button>

						<div class="collapse navbar-collapse " id="navbarNav">
							<ul class="navbar-nav">
								<li class="nav-item <?php if ($page == 'home') echo "active" ?>">
								  <a class="nav-link" href="?page=home">Home</a>
								</li>
								<li class="nav-item <?php if ($page == 'clanci' && $kategorija == 'politika') echo "active" ?>">
								  <a class="nav-link" href="?page=clanci&kat=politika" id="politika">Politik</a>
								</li>
								<li class="nav-item <?php if ($page == 'clanci' && $kategorija == 'sport') echo "active" ?>">
								  <a class="nav-link" href="?page=clanci&kat=sport" id="sport">Sport</a>
								</li>
								<li class="nav-item">
									<?php if($korisnik->jePrijavljen()) {
										// korisnik je prijavljen
										if($korisnik->imaDozvolu()){
											// daj mu admin link
											echo '<a class="nav-link" href="./admin.php">Administracija</a>'; 
										} else {
											// nema dozvolu daj mu link za odjavu 
											echo '<a class="nav-link" href="?page=logout">Odjava</a>';
										}
										} else {
											// nije prijavljen daj mu link do administracije
											echo '<a class="nav-link" href="./admin.php">Administracija</a>'; 
										}
									?>
								</li>
							  </ul>
						</div>
		</nav>
		<nav class="container text-center logo-navigacija" id="logo-navigacija">
			<a href="?page=home"><img src="./images/logo.svg" alt="Franffurter Allgemeine" class="d-inline-block align-top" id="page-logo"></a>
		</nav>
	</div>
</header>