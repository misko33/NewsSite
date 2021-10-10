<?php 

class User {

    private $db; 
    
    private $user_id; 
    private $username;
    private $dozvola;

    public function __construct($db) {
        $this->db = $db; 
        if(isset($_SESSION['user_id'])) {
            $uid = clean($_SESSION['user_id']);
            $korisnik = $this->db->query("SELECT * FROM korisnik WHERE id = '" . (int)$uid . "';");

            if ($korisnik->num_rows) {
                $this->user_id = $korisnik->row['id'];
                $this->username = $korisnik->row['korisnicko_ime'];
                $this->dozvola = $korisnik->row['razina'];

            } else {
				$this->logout();
			}
        }
    }

    public function login($username, $password) {
        $korisnik = $this->db->query("SELECT * FROM korisnik WHERE korisnicko_ime = '" . $this->db->escape($username) . "'");

        if ($korisnik->num_rows) {
            if (password_verify($password, $korisnik->row['lozinka'])) { 
                $_SESSION['user_id'] = $korisnik->row['id'];
                $this->username = $korisnik->row['korisnicko_ime'];
                $this->dozvola = $korisnik->row['razina'];

                return true;
            } else {
                return false; 
            }

        } else {
            return false; 
        }
    }

    public function addUser($data){
        if(!empty($data)){
            $sql = "INSERT INTO korisnik (ime, prezime,korisnicko_ime, lozinka, razina) VALUES (?, ?, ?, ?, ?);";
            $stmt = mysqli_stmt_init($this->db->getVeza());
            if (mysqli_stmt_prepare($stmt, $sql)) {
                $hashed_password = password_hash($data['lozinka'], CRYPT_BLOWFISH);
                $razina = 0; 
                if(isset($data['razina'])) {
                    $razina = $data['razina'];
                }
                mysqli_stmt_bind_param($stmt, 'ssssi', $data['ime'], $data['prezime'], $data['korisnicko_ime'], $hashed_password, $razina);
                mysqli_stmt_execute($stmt);

                return $stmt->affected_rows;
            }
        } else {
            return false; 
        }
    }

    public function urediKorisnika($data, $id){
        if(!empty($data)) {
            $sql = "UPDATE korisnik SET ime = '".$data['ime']."', 
                                    prezime = '".$data['prezime']."', 
                                    korisnicko_ime = '".$data['korisnicko_ime']."',
                                    lozinka = '".$data['lozinka']."',
                                    razina = '".$data['razina']."' WHERE id = ".(int)$id.";";

            return $this->db->query($sql);

        } else {
            return false; 
        }      
    }

    public function brisanje($id){
        $sql = "DELETE FROM korisnik WHERE id = ". $id;

        return $this->db->query($sql); 
    }


    public function logout() {
        unset($_SESSION['user_id']);
		$this->user_id = '';
		$this->username = '';
	}

    public function jePrijavljen() {
		return $this->user_id;
    }
    
    public function getKorisnickoIme() {
		return $this->username;
    }
    
    public function imaDozvolu() {
        return $this->dozvola;
    }

    public function getKorisnici(){
        $sql = "SELECT * FROM korisnik ;";
        $query = $this->db->query($sql);

        $korisnici = array(); 
        foreach($query->rows as $rezultat){
            $korisnici[$rezultat['id']] = $this->getKorisnik($rezultat['id']); 
        }
        return $korisnici;
    }

    public function getKorisnik($id){
        $sql = "SELECT * FROM korisnik WHERE id = '" . (int)$id . "';";
        $query = $this->db->query($sql);
        if ($query->num_rows) {
            return array(
                'id'             => $query->row['id'],
                'ime'            => $query->row['ime'],
                'prezime'        => $query->row['prezime'],
                'korisnicko_ime' => $query->row['korisnicko_ime'],
                'lozinka'        => $query->row['lozinka'],
                'razina'         => $query->row['razina'],
                
                
            ); 
        } else {
			return false;
		}
    }
}
?>