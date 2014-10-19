<?php

class salainenSivu {

    private $SalainenID;
    private $OmistajaID;
    private $Otsikko;
    private $Sisalto;
    private $virheet = array();

    public function lisaaTietokantaan() {
        $sql = "INSERT INTO SalainenSivu (OmistajaID, Otsikko, Sisalto) VALUES(?, ?, ?)";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array(
            $this->OmistajaID,
            $this->Otsikko,
            $this->Sisalto
        ));
    }
    
    public static function poistaRiippuvuudet($SalainenID){
        $sql = "DELETE FROM SalaistenNakyvyys WHERE SalainenID = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array(
            $SalainenID
        ));
    }
    
    public static function poistaSalaisuus($SalainenID){
        $sql = "DELETE FROM SalainenSivu WHERE SalainenID = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array(
            $SalainenID
        ));
    }
    
    public static function getSalaisuus($SalainenID){
        $sql = "SELECT * FROM SalainenSivu WHERE SalainenID = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array(
            $SalainenID
        ));
        $tulos = $kysely->fetchObject();
        if($tulos == null){
            return null;
        } else{
            $Salaisuus = new salainenSivu();
            $Salaisuus->setSalainenID($tulos->salainenid);
            $Salaisuus->setOmistajaID($tulos->omistajaid);
            $Salaisuus->setOtsikko($tulos->otsikko);
            $Salaisuus->setSisalto($tulos->sisalto);
            
            return $Salaisuus;
        }
    }
    
    public function tallennaMuutokset(){
        $sql = "UPDATE SalainenSivu SET Otsikko = ?, Sisalto = ? WHERE SalainenID = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array(
            $this->Otsikko,
            $this->Sisalto,
            $this->SalainenID
        ));
    }
    
    public static function onkoJoJaettu($SalainenID, $KatselijaID){
        $sql = "SELECT * FROM Salainensivu, SalaistenNakyvyys WHERE Salainensivu.SalainenID = ? AND SalaistenNakyvyys.AsiakasID = ? AND Salainensivu.SalainenID = SalaistenNakyvyys.SalainenID";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array(
            $SalainenID,
            $KatselijaID
        ));
        $tulos = $kysely->fetchObject();
        if($tulos == null){
            return null;
        } else{
            return true;
        }
    }

    public static function naytaSalaisuudetJosJaettu($OmistajaID, $KatselijaID) {
        $sql = "SELECT Salainensivu.Otsikko, Salainensivu.Sisalto FROM Salainensivu, SalaistenNakyvyys where Salainensivu.OmistajaID = ? AND SalaistenNakyvyys.AsiakasID = ? AND Salainensivu.SalainenID = SalaistenNakyvyys.SalainenID";
        $kysely = getTietokantayhteys()->prepare($sql);
        $tulokset = array();
        $kysely->execute(array(
            $OmistajaID,
            $KatselijaID
        ));
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $haettuSivu = new salainenSivu();
            $haettuSivu->setOtsikko($tulos->otsikko);
            $haettuSivu->setSisalto($tulos->sisalto);

            $tulokset[] = $haettuSivu;
        }
        return $tulokset;
    }

    public static function getSalaisetSivut($OmistajaID) {
        $sql = "SELECT * FROM SalainenSivu WHERE OmistajaID = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $tulokset = array();
        $kysely->execute(array(
            $OmistajaID
        ));
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $haettuSivu = new salainenSivu();
            $haettuSivu->setSalainenID($tulos->salainenid);
            $haettuSivu->setOmistajaID($tulos->omistajaid);
            $haettuSivu->setOtsikko($tulos->otsikko);
            $haettuSivu->setSisalto($tulos->sisalto);
            $tulokset[] = $haettuSivu;
        }
        return $tulokset;
    }
    
        public static function naytaSalaisuudetJoitaEiVielaJaettu($OmistajaID, $Kohde) {
        $sql = "SELECT * FROM SalainenSivu, SalaistenNakyvyys WHERE SalainenSivu.OmistajaID = ? AND SalaistenNakyvyys.AsiakasID != ? AND SalainenSivu.SalainenID = SalaistenNakyvyys.SalainenID";
        $kysely = getTietokantayhteys()->prepare($sql);
        $tulokset = array();
        $kysely->execute(array(
            $OmistajaID,
            $Kohde
        ));
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $haettuSivu = new salainenSivu();
            $haettuSivu->setSalainenID($tulos->salainenid);
            $haettuSivu->setOmistajaID($tulos->omistajaid);
            $haettuSivu->setOtsikko($tulos->otsikko);
            $haettuSivu->setSisalto($tulos->sisalto);
            $tulokset[] = $haettuSivu;
        }
        return $tulokset;
    }

    public static function naytaSalaisuusAsiakkaalle($SalainenID, $AsiakasID) {
        $sql = "INSERT INTO SalaistenNakyvyys(SalainenID, AsiakasID) VALUES(?, ?)";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array(
            $SalainenID,
            $AsiakasID
        ));
    }

    public function getOtsikko() {
        return $this->Otsikko;
    }

    public function getSisalto() {
        return $this->Sisalto;
    }

    public function getVirheet() {
        return $this->virheet;
    }

    public function getSalainenID() {
        return $this->SalainenID;
    }

    public function getOmistajaID() {
        return $this->OmistajaID;
    }

    public function setOtsikko($Otsikko) {
        if ($Otsikko == null) {
            $this->virheet['Otsikko'] = "Otsikko ei voi olla tyhjä!";
        } else {
            $syote = htmlspecialchars($Otsikko);
            $this->Otsikko = $syote;
            unset($this->virheet['Otsikko']);
        }
    }

    public function setSisalto($Sisalto) {
        if ($Sisalto == null) {
            $this->virheet['Sisalto'] = "Salaisuus ei voi olla tyhjä!";
        } else {
            $syote = htmlspecialchars($Sisalto);
            $this->Sisalto = $syote;
            unset($this->virheet['Sisalto']);
        }
    }

    public function setVirheet($virheet) {
        $this->virheet = $virheet;
    }

    public function setSalainenID($SalainenID) {
        $this->SalainenID = $SalainenID;
    }

    public function setOmistajaID($OmistajaID) {
        $this->OmistajaID = $OmistajaID;
    }

}
