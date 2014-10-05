<?php

class salainenSivu{
    private $SalainenID;
    private $OmistajaID;
    private $SalainenTieto;
    private $virheet = array();
    
    public static function lisaaTietokantaan() {
        $sql = "INSERT INTO SalainenSivu (OmistajaID, SalainenTieto) VALUES(?, ?)";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array(
            $this->OmistajaID, 
            $this->SalainenTieto
        ));
    }
    
    public function getSalainenSivu($OmistajaID){
        $sql = "SELECT * FROM SalainenSivu WHERE OmistajaID = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array(
            $OmistajaID
        ));
        
    }
    public function getSalainenID() {
        return $this->SalainenID;
    }

    public function getOmistajaID() {
        return $this->OmistajaID;
    }

    public function getSalainenTieto() {
        return $this->SalainenTieto;
    }

    public function setSalainenID($SalainenID) {
        $this->SalainenID = $SalainenID;
    }

    public function setOmistajaID($OmistajaID) {
        $this->OmistajaID = $OmistajaID;
    }

    public function setSalainenTieto($SalainenTieto) {
        if($SalainenTieto == null){
            $this->virheet['SalainenTieto'] = "Salaisuus ei voi olla tyhjä!";
        } else{
        $this->SalainenTieto = $SalainenTieto;
        }
    }


}

