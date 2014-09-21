<?php

class Kayttaja {

    private $AsiakasID;
    private $Nimimerkki;
    private $Salasana;

    /* public function __construct($KayttajaID, $Nimimerkki, $Salasana) {
      $this->KayttajaID = $KayttajaID;
      $this->Nimimerkki = $Nimimerkki;
      $this->Salasana = $Salasana;
      } */
    
    /* Etsitään kannasta käyttäjätunnuksella ja salasanalla käyttäjäriviä */
    public static function etsiKayttajaTunnuksilla($kayttaja, $salasana) {
        $sql = "SELECT AsiakasID, Nimimerkki, Salasana from Asiakas where Nimimerkki = ? AND salasana = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($kayttaja, $salasana));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $kayttaja = new Kayttaja();
            $kayttaja->setAsiakasID($tulos->asiakasid);
            $kayttaja->setNimimerkki($tulos->nimimerkki);
            $kayttaja->setSalasana($tulos->salasana);

            return $kayttaja;
        }
    }

    public static function getKayttajat() {
        $sql = "SELECT Asiakasid, Nimimerkki, Salasana FROM Asiakas";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $kayttaja = new Kayttaja();
            $kayttaja->setAsiakasID($tulos->asiakasid);
            $kayttaja->setNimimerkki($tulos->nimimerkki);
            $kayttaja->setSalasana($tulos->salasana);

            //$array[] = $muuttuja; lisää muuttujan arrayn perään. 
            //Se vastaa melko suoraan ArrayList:in add-metodia.
            $tulokset[] = $kayttaja;
        }
        return $tulokset;
    }

    public function getAsiakasID() {
        return $this->AsiakasID;
    }

    public function getNimimerkki() {
        return $this->Nimimerkki;
    }

    public function getSalasana() {
        return $this->Salasana;
    }

    public function setAsiakasID($AsiakasID) {
        $this->AsiakasID = $AsiakasID;
    }

    public function setNimimerkki($Nimimerkki) {
        $this->Nimimerkki = $Nimimerkki;
    }

    public function setSalasana($Salasana) {
        $this->Salasana = $Salasana;
    }

    public function getUsername() {
        return $this->Nimimerkki;
    }

}
