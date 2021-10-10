<?php 
    include('./system/init.php'); 
	
	include('./commons/header.php');
    $page = 'home'; 
    if(isset($_GET['page'])) {
        $page = clean($_GET['page']); 
    }  
?>

    <main>
        <div class="inner-wrapper">
            <?php 
				include('./commons/navigation.php');
                switch($page) {
                    case 'home': 
                        include('home.php'); 
                        break; 
                    case 'kategorija':
                        include('kategorija.php');
                        break; 
                    case 'clanci':
                        include('clanci.php');
                        break;
                    case 'logout':
                        $korisnik->logout();
                        header("location: index.php");
                        break;
                    default: 
                        include('home.php'); 
                        break; 
                }
            ?>
        </div>
    </main>

<?php 
    include('./commons/footer.php'); 
?>

<script src="./assets/js/skripta.js"></script>
	

