<?php

class Viesti {

    private $ViestiID;
    private $LahettajaID;
    private $VastaanottajaID;
    private $Sisalto;
    private $Lahetysaika;
    private $Luettu;

    public function lahetaViesti($anonyymi) {
        $sql = "INSERT INTO Viesti(LahettajaID, VastaanottajaID, Sisalto, Lahetysaika, Luettu) VALUES(?,?,?,?,?)";
        $kysely = getTietokantayhteys()->prepare($sql);
        if($anonyymi){
            $this->setLahettajaID("anonyymi");
        }
        $ok = $kysely->execute(array(
            $this->getLahettajaID(),
            $this->getVastaanottajaID(),
            $this->getSisalto(),
            $this->getLahetysaika(),
            "false"));
        return $ok;
    }
    
    public static function getViesti($ViestiID){
        $sql = "SELECT * from Viesti where ViestiID = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array(
            $ViestiID
        ));
        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else{
            $haettuViesti = new Viesti();
            $haettuViesti->setViestiID($tulos->viestiid);
            $haettuViesti->setLahettajaID($tulos->lahettajaid);
            $haettuViesti->setVastaanottajaID($tulos->vastaanottajaid);
            $haettuViesti->setSisalto($tulos->sisalto);
            $haettuViesti->setLahetysaika($tulos->lahetysaika);
            $haettuViesti->setLuettu($tulos->luettu);
            return $haettuViesti;
        }
    }
    
    public static function poistaViesti($ViestiID){
        $poistettava = (int)$ViestiID;
        $sql = "DELETE from Viesti where ViestiID = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array(
            $poistettava
        ));
        
    }

    /*Etsii käyttäjien väliset viestit ja palauttaa ne lähetysajan mukaan taulukossa. Aloitusviestejä ei oteta huomioon */
    
    public static function etsiViestit($VastaanottajaID, $LahettajaID){
        $sql = "SELECT * FROM Viesti WHERE (VastaanottajaID = ? AND LahettajaID = ?) OR (VastaanottajaID = ? AND LahettajaID = ?) ORDER BY Lahetysaika DESC LIMIT 100";
        $kysely = getTietokantayhteys()->prepare($sql);
        $tulokset = array();
        $kysely->execute(array(
            $VastaanottajaID,
            $LahettajaID,
            $LahettajaID,
            $VastaanottajaID
        ));
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            if($tulos->sisalto == "ALOITUSVIESTI"){
                continue;
            }
            $Viesti = new Viesti();
            $Viesti->setViestiID($tulos->viestiid);
            $Viesti->setVastaanottajaID($tulos->vastaanottajaid);
            $Viesti->setLahettajaID($tulos->lahettajaid);
            $Viesti->setSisalto($tulos->sisalto);
            $Viesti->setLahetysaika($tulos->lahetysaika);
            $Viesti->setLuettu(false);

            $tulokset[] = $Viesti;
        }
 
        return $tulokset;
        
    }
    
    public static function poistaViestit($kayttajaID){
        $sql = "DELETE from Viesti where LahettajaID = ? OR VastaanottajaID = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array(
            $kayttajaID,
            $kayttajaID
        ));
    }

    public function getViestiID() {
        return $this->ViestiID;
    }

    public function getLahettajaID() {
        return $this->LahettajaID;
    }

    public function getVastaanottajaID() {
        return $this->VastaanottajaID;
    }

    public function getSisalto() {
        return $this->Sisalto;
    }

    public function getLahetysaika() {
        return $this->Lahetysaika;
    }

    public function getLuettu() {
        return $this->Luettu;
    }

    public function setViestiID($ViestiID) {
        $this->ViestiID = $ViestiID;
    }

    public function setLahettajaID($LahettajaID) {
        $this->LahettajaID = $LahettajaID;
    }

    public function setVastaanottajaID($VastaanottajaID) {
        $this->VastaanottajaID = $VastaanottajaID;
    }

    public function setSisalto($Sisalto) {
        $this->Sisalto = $Sisalto;
    }

    public function setLahetysaika($Lahetysaika) {
        $this->Lahetysaika = $Lahetysaika;
    }

    public function setLuettu($Luettu) {
        $this->Luettu = $Luettu;
    }

}
