<?php
class baza {
    
    private $veza; 

    public function __construct($host, $username, $password, $ime_baze) {
        $this->veza = new mysqli($host, $username, $password, $ime_baze);

        if (mysqli_connect_error()) {
            die("GREŠKA: Dogodila se greška kod povezivanja s bazom!"); 
        }

        $this->veza->set_charset("utf8");
        $this->veza->query("SET SQL_MODE = ''");
    }

    public function query($sql) {
        $query = $this->veza->query($sql);
        if (!$this->veza->errno){
            if (isset($query->num_rows)) {
                $podaci = array();

                while ($red = $query->fetch_assoc()) {
                    $podaci[] = $red;
                }

                $rezultat = new stdClass();
                $rezultat->num_rows = $query->num_rows;
                $rezultat->row = isset($podaci[0]) ? $podaci[0] : array();
                $rezultat->rows = $podaci;

                unset($podaci);

                $query->close();

                return $rezultat;
            } else {
            return true;
            }
        } else {
            die("GREŠKA: Dogodila se greška kod slanja upita [" . $sql . "] prema bazi! <br /> " . $this->veza->error . "<br /> Kod: " . $this->veza->errno. "<br /> " );
        }
    }

    public function escape($podatak) {
        return $this->veza->real_escape_string($podatak);
    }

    public function zadnji_unos_baza() {
		return $this->veza->insert_id;
    }

    public function getVeza(){
        return $this->veza; 
    }

    public function __destruct() {
		$this->veza->close();
	}




}
?>