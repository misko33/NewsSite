<?php 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
      }
      else {
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
        $this->log_auth($username, true);

        return true;
      }
      else {
        $this->log_auth($username, false);

        return false;
      }
    }
    else {
      $this->log_auth($username, false);
      
      return false;
    }
  }

  // insert login data to db
  public function log_auth($username, $auth) {
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $datum = date( 'Y-m-d H:i:s' );

    // PROXY IP
    // if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    //   $ip = $_SERVER['HTTP_CLIENT_IP'];
    // }
    // elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    //   $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    // }

    $sql = "INSERT INTO log_auth (UserName, UserAgent, IP, Datum, isLogin) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($this->db->getVeza());

    if(mysqli_stmt_prepare($stmt, $sql)) {
      $stmt->bind_param('ssssi', $username, $userAgent, $ip, $datum, $auth);
      $stmt->execute();

      return true;
    }
  }
  public function all_log_auth() {
    $sql = "SELECT * FROM log_auth ;";
    $query = $this->db->query($sql);

    $log = array(); 
    foreach($query->rows as $rezultat) {
      $log[$rezultat['id']] = $this->get_log_auth($rezultat['id']); 
    }
    return $log;
  }
  public function get_log_auth($id) {
    $sql = "SELECT * FROM log_auth WHERE id =" . (int)$id;
    $query = $this->db->query($sql);
    if ($query->num_rows) {
      return array(
        'id'          => $query->row['id'],
        'username'    => $query->row['UserName'],
        'useragent'   => $query->row['UserAgent'],
        'ip'          => $query->row['IP'],
        'datum'       => $query->row['Datum'],
        'islogin'     => $query->row['isLogin'],
      ); 
    }
    else {
      return false; 
    }
  }

  public function addUser($data) {
    if(!empty($data)) {
      $sql = mysqli_query($this->db->getVeza(), "SELECT * FROM korisnik WHERE korisnicko_ime ='" . $this->db->escape($data['korisnicko_ime']) . "'");

      if(mysqli_num_rows($sql)) {
        $_SESSION["poruka-false"] = "Korisničko ime je zauzeto";

        return false;
      }

      if(strlen($data['ime']) == 0 || strlen($data['prezime']) == 0 || strlen($data['korisnicko_ime']) == 0 || strlen($data['lozinka']) == 0) {
        $_SESSION["poruka-false"] = "Molimo ispuniti sva polja";

        return false;
      }

      if($data['lozinka'] !== $data['passRep']) {
        $_SESSION["poruka-false"] = "Lozinke se ne podudaraju";
        return false;
      }
      else {
        $sql = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina) VALUES (?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($this->db->getVeza());

        if (mysqli_stmt_prepare($stmt, $sql)) {
          $hashed_password = password_hash($data['lozinka'], CRYPT_BLOWFISH);
          $razina = 0; 

          if(isset($data['razina'])) {
            $razina = $data['razina'];
          }

          $stmt->bind_param('ssssi', $data['ime'], $data['prezime'], $data['korisnicko_ime'], $hashed_password, $razina);
          $stmt->execute();

          return true;
        }
      }   
    }

    else {
      return false; 
    }
  }

  public function urediKorisnika($data, $id) {
    if(!empty($data) && isset($data['lozinka'])) {
      $sql = "UPDATE korisnik SET ime = ?, prezime = ?, korisnicko_ime = ?, lozinka = ?, razina = ? WHERE id = " . (int)$id . ";";
      $stmt = mysqli_stmt_init($this->db->getVeza());
      if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 'ssssi', $data['ime'], $data['prezime'], $data['korisnicko_ime'], $data['lozinka'], $data['razina']);
        mysqli_stmt_execute($stmt);

        return $stmt->affected_rows;
      }
    }
    elseif(!empty($data) && !isset($data['lozinka'])) {
      $sql = "UPDATE korisnik SET ime = ?, prezime = ?, korisnicko_ime = ?, razina = ? WHERE id = " . (int)$id . ";";
      $stmt = mysqli_stmt_init($this->db->getVeza());
      if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 'sssi', $data['ime'], $data['prezime'], $data['korisnicko_ime'], $data['razina']);
        mysqli_stmt_execute($stmt);

        return $stmt->affected_rows;
      }
    }
    else {
      return false; 
    }
  }

  public function brisanje($id) {
    $sql = "DELETE FROM korisnik WHERE id = ". (int)$id;

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

  public function getKorisnici() {
    $sql = "SELECT * FROM korisnik ;";
    $query = $this->db->query($sql);

    $korisnici = array(); 
    foreach($query->rows as $rezultat) {
      $korisnici[$rezultat['id']] = $this->getKorisnik($rezultat['id']); 
    }
    return $korisnici;
  }

  public function getKorisnik($id) {
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
    }
    else {
      return false;
    }
  }
}
?>