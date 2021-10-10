<?php


class Clanak {

    private $db; 
    private $clanci; 
    private $clanak; 


    public function __construct($db) {
        $this->db = $db; 
        $this->clanci = array(); 
        $this->clanak = array(); 
    }

    function getClanci($kategorija = "") {
        $sql = "SELECT * FROM `clanak`"; 
        if(!empty($kategorija) && $kategorija != ""){
            $sql .= " WHERE kategorija ='" . $this->db->escape($kategorija) . "' "; 
        }
        $sql .= "ORDER BY datum ASC";
        $query = $this->db->query($sql); 

        $clanci = array(); 
        foreach($query->rows as $rezultat){
            $clanci[$rezultat['id']] = $this->getClanak($rezultat['id']); 
        }

        return $clanci; 
    }

    function getClanak($id) {
        $sql = "SELECT * FROM `clanak` WHERE `id`=".$id;
        
        $query = $this->db->query($sql);

        if ($query->num_rows) {
            return array(
                'id'          => $query->row['id'],
                'naslov'      => $query->row['naslov'],
                'sazetak'     => $query->row['sazetak'],
                'sadrzaj'     => $query->row['tekst'],
                'slika'       => $query->row['slika'],
                'datum'       => date("d.m.Y", strtotime($query->row['datum'])),
                'kategorija'  => $query->row['kategorija'],
                'arhiva'      => $query->row['arhiva'],
            ); 
        } else {
			return false;
		}

        
    }

    function spremiClanak($data = array()){
        
        if(!empty($data)) {
            $sql = " INSERT INTO clanak (datum, naslov, sazetak,tekst, slika, kategorija, arhiva) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($this->db->getVeza());
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, 'ssssssi', $data['datum'], $data['naslov'], $data['sazetak'],$data['sadrzaj'], $data['slika'], $data['kategorija'], $data['arhiva']);
                mysqli_stmt_execute($stmt);

                return $stmt->affected_rows;
            }
        } else {
            return false; 
        }
    }

    function updateClanak($data = array(), $id){
        // print_r($data);
        if(!empty($data)) {
            $sql = " UPDATE clanak SET datum = '".$data['datum']."', 
                                       naslov = '".$data['naslov']."', 
                                       sazetak = '".$data['sazetak']."',
                                       tekst = '" . $data['sadrzaj'] . "', 
                                       slika = '".$data['slika']."', 
                                       kategorija = '".$data['kategorija']."', 
                                       arhiva = '".$data['arhiva']."' WHERE id = ".(int)$id.";";
        
            return $this->db->query($sql);
        } else {
            return false; 
        }
    }

    public function brisanje($id){
        $sql = "DELETE FROM clanak WHERE id = ". $id;

        return $this->db->query($sql); 
    }



    function ispis_clanka_front($data){

        $slika = "no_image.png";
        if(isset($data['slika']) && !empty($data['slika'])){
            $slika = $data['slika'];
        }

        $clanak_url = "?page=clanci&kat=".$data['kategorija']. "&cid=".$data['id'];


        $out = ""; 
        $out .= '<div class="article-image col-md-12">' . "\n";;
        $out .= '<img src="./images/' . $slika . '" alt="'. $data['naslov']  .'" title="' . $data['naslov'] . '" />' . "\n";;
        $out .= '</div>' . "\n";
        $out .= '<div class="article-content col-md-12">';
        $out .= '<h2 class="article-title"> <a href="' . $clanak_url . '" class="article-title-link"> ' . $data['naslov'] . '</a> </h2>'. "\n";
        $out .= '<p class="article-skraceno">' . $data['sazetak']. '</p>' . "\n";
        $out .= '</div>'. "\n";
   
        echo $out;
    }







}