<?php

class Kayttaja {

    private $AsiakasID;
    private $Nimimerkki;
    private $Salasana;
    private $Email;
    private $Sukupuoli;
    private $Syntymapaiva;
    private $Hakutarkoitus;
    private $Teksti;
    private $Yllapitaja;
    private $Virheet = array();

    /* Etsitään kannasta käyttäjätunnuksella ja salasanalla */

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

    public static function poistaTunnus($AsiakasID) {
        $sql = "DELETE from Asiakas WHERE AsiakasID = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $id = $AsiakasID;
        $kysely->execute(array($id));
    }

    public static function etsiKayttaja($AsiakasID) {
        $sql = "SELECT * from Asiakas where AsiakasID = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $id = $AsiakasID;
        $kysely->execute(array($id));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $kayttaja = new Kayttaja();
            $kayttaja->setAsiakasID($tulos->asiakasid);
            $kayttaja->setNimimerkki($tulos->nimimerkki);
            $kayttaja->setSalasana($tulos->salasana);
            $kayttaja->setEmail($tulos->email);
            $kayttaja->setSukupuoli($tulos->sukupuoli);
            $kayttaja->setHakutarkoitus($tulos->hakutarkoitus);
            $kayttaja->setSyntymapaiva($tulos->syntymapaiva);
            $kayttaja->setTeksti($tulos->teksti);

            return $kayttaja;
        }
    }

    public static function etsiViestejaLahettaneet($VastaanottajaID) {
        $sql = "SELECT * FROM Asiakas WHERE AsiakasID IN (SELECT LahettajaID FROM Viesti WHERE VastaanottajaID = ?)";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array(
            $VastaanottajaID,
        ));
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $kayttaja = new Kayttaja();
            $kayttaja->setAsiakasID($tulos->asiakasid);
            $kayttaja->setNimimerkki($tulos->nimimerkki);
            $kayttaja->setEmail($tulos->email);
            $kayttaja->setHakutarkoitus($tulos->hakutarkoitus);
            $kayttaja->setTeksti($tulos->teksti);

            $tulokset[] = $kayttaja;
        }

        return $tulokset;
    }

    public function muutaTietoja() {
        $sql = "UPDATE Asiakas SET Nimimerkki = ?, Email = ?, Sukupuoli = ?, Hakutarkoitus = ?, Teksti = ? WHERE AsiakasID = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array(
            $this->getNimimerkki(),
            $this->getEmail(),
            $this->getSukupuoli(),
            $this->getHakutarkoitus(),
            $this->getTeksti(),
            $this->getAsiakasID()
        ));
    }

    public function lisaaTietokantaan() {
        if ($this->onkoNimimerkkiKaytossa($this->Nimimerkki)) {
            $this->Virheet['Nimimerkki'] = "Nimimerkki on jo käytössä.";
            return false;
        }
        $sql = "INSERT INTO Asiakas(Nimimerkki, Salasana, Email, Sukupuoli, Hakutarkoitus, Teksti, Yllapitaja) VALUES(?,?,?,?,?,?,?) RETURNING AsiakasID";
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array(
            $this->getNimimerkki(),
            $this->getSalasana(),
            $this->getEmail(),
            $this->getSukupuoli(),
            $this->getHakutarkoitus(),
            $this->getTeksti(),
            "false"));
        if ($ok) {
            $this->AsiakasID = $kysely->fetchColumn();
        }
        return $ok;
    }

    public static function getKayttajatSivulla($sivunro, $montako) {
        $sql = "SELECT AsiakasID, Nimimerkki, Hakutarkoitus, Teksti FROM Asiakas ORDER BY Nimimerkki LIMIT ? OFFSET ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($montako, (($sivunro - 1) * $montako)));

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $kayttaja = new Kayttaja();
            $kayttaja->setAsiakasID($tulos->asiakasid);
            $kayttaja->setNimimerkki($tulos->nimimerkki);
            $kayttaja->setHakutarkoitus($tulos->hakutarkoitus);
            $kayttaja->setTeksti($tulos->teksti);

            $tulokset[] = $kayttaja;
        }
        return $tulokset;
    }

    public static function etsiKayttajiaNimimerkilla($nimimerkki) {
        $sql = "SELECT AsiakasID, Nimimerkki, Hakutarkoitus, Teksti FROM Asiakas where Nimimerkki LIKE ? ORDER BY Nimimerkki LIMIT 10";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array('%' . $nimimerkki . '%'));

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $kayttaja = new Kayttaja();
            $kayttaja->setAsiakasID($tulos->asiakasid);
            $kayttaja->setNimimerkki($tulos->nimimerkki);
            $kayttaja->setHakutarkoitus($tulos->hakutarkoitus);
            $kayttaja->setTeksti($tulos->teksti);

            $tulokset[] = $kayttaja;
        }
        return $tulokset;
    }

    public static function etsiKayttajiaHakutarkoituksella($hakutarkoitus) {
        $sql = "SELECT AsiakasID, Nimimerkki, Hakutarkoitus, Teksti FROM Asiakas where Hakutarkoitus LIKE ? ORDER BY Nimimerkki LIMIT 10";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array('%' . $hakutarkoitus . '%'));

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $kayttaja = new Kayttaja();
            $kayttaja->setAsiakasID($tulos->asiakasid);
            $kayttaja->setNimimerkki($tulos->nimimerkki);
            $kayttaja->setHakutarkoitus($tulos->hakutarkoitus);
            $kayttaja->setTeksti($tulos->teksti);

            $tulokset[] = $kayttaja;
        }
        return $tulokset;
    }

    public static function etsiKayttajiaTekstilla($teksti) {
        $sql = "SELECT AsiakasID, Nimimerkki, Hakutarkoitus, Teksti FROM Asiakas where Teksti LIKE ? ORDER BY Nimimerkki LIMIT 10";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array('%' . $teksti . '%'));

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $kayttaja = new Kayttaja();
            $kayttaja->setAsiakasID($tulos->asiakasid);
            $kayttaja->setNimimerkki($tulos->nimimerkki);
            $kayttaja->setHakutarkoitus($tulos->hakutarkoitus);
            $kayttaja->setTeksti($tulos->teksti);

            $tulokset[] = $kayttaja;
        }
        return $tulokset;
    }

    public function naytaSukupuoli() {
        if ($this->getSukupuoli() == true) {
            return "Mies";
        } else {
            return "Nainen";
        }
    }

    public static function lukumaara() {
        $sql = "SELECT count(*) FROM Asiakas";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        return $kysely->fetchColumn();
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

            $tulokset[] = $kayttaja;
        }
        return $tulokset;
    }

    public function onkoNimimerkkiKaytossa($Nimimerkki) {
        $sql = "SELECT * FROM Asiakas WHERE Nimimerkki = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array(
            $Nimimerkki));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return false;
        } else {
            return true;
        }
    }

    public function palautaSukupuoli($Sukupuoli) {
        if (!isset($this->Sukupuoli)) {
            return "";
        }
        if ($this->Sukupuoli && $Sukupuoli == "m") {
            return "checked";
        }
        if (!$this->Sukupuoli && $Sukupuoli == "f") {
            return "checked";
        }
    }

    /* Getterit alkaa */

    public function getAsiakasID() {
        return $this->AsiakasID;
    }

    public function getVirheet() {
        return $this->Virheet;
    }

    public function getNimimerkki() {
        return $this->Nimimerkki;
    }

    public function getEmail() {
        return $this->Email;
    }

    public function getSukupuoli() {
        return $this->Sukupuoli;
    }

    public function getYllapitaja() {
        return $this->Yllapitaja;
    }

    public function getSalasana() {
        return $this->Salasana;
    }

    public function getTeksti() {
        return $this->Teksti;
    }

    public function getHakutarkoitus() {
        return $this->Hakutarkoitus;
    }

    public function getSyntymapaiva() {
        return $this->Syntymapaiva;
    }

    /* Setterit alkaa */

    public function setSyntymapaiva($Syntymapaiva) {
        $this->Syntymapaiva = $Syntymapaiva;
    }

    public function setTeksti($Teksti) {
        if ($Teksti == null) {
            $this->virheet['Teksti'] = "Kirjoita jotain itsestäsi!";
        } else {
            unset($this->Virheet['Teksti']);
            $syote = htmlspecialchars($Teksti);
            $this->Teksti = $syote;
        }
    }

    public function setSukupuoli($Sukupuoli) {
        if ($Sukupuoli != "m" && $Sukupuoli != "f") {
            $this->Virheet['Sukupuoli'] = 'Valitse sukupuoli.';
            return;
        }
        if ($Sukupuoli == "m") {
            $this->Sukupuoli = 1;
            unset($this->Virheet['Sukupuoli']);
        } else {
            $this->Sukupuoli = 0;
            unset($this->Virheet['Sukupuoli']);
        }
    }

    public function setHakutarkoitus($Hakutarkoitus) {
        if ($Hakutarkoitus == '') {
            $this->Virheet['Hakutarkoitus'] = "Hakutarkoitus ei voi olla tyhjä.";
        } else {
            $this->Hakutarkoitus = $Hakutarkoitus;
            unset($this->Virheet['Hakutarkoitus']);
        }
    }

    public function setAsiakasID($AsiakasID) {
        $this->AsiakasID = $AsiakasID;
    }

    public function setNimimerkki($Nimimerkki) {
        if (trim($Nimimerkki == '')) {
            $this->Virheet['Nimimerkki'] = "Nimimerkkisi ei voi olla tyhjä!";
        } else if (!preg_match("#^[a-zA-Z0-9äöüÄÖÜ]+$#", $Nimimerkki)) {
            $this->Virheet['Nimimerkki'] = "Nimimerkkisi sisältää erikoiskirjaimia. Voit käyttää ainoastaan kirjaimia ja lukuja.";
        } else {
            $this->Nimimerkki = $Nimimerkki;
            unset($this->Virheet['Nimimerkki']);
        }
    }

    public function setSalasana($Salasana) {
        if (trim($Salasana == '')) {
            $this->Virheet['Salasana'] = "Salasanasi ei voi olla tyhjä!";
        } else if (!preg_match("#^[a-zA-Z0-9äöüÄÖÜ]+$#", $Salasana)) {
            $this->Virheet['Salasana'] = "Salasanasi sisältää erikoiskirjaimia. Voit käyttää ainoastaan kirjaimia ja lukuja.";
        } else {
            $this->Salasana = $Salasana;
            unset($this->Virheet['Salasana']);
        }
    }

    public function setEmail($Email) {
        if (trim($Email == '')) {
            $this->Virheet['Email'] = "Sähköpostisi ei voi olla tyhjä!";
        } else {
            $this->Email = $Email;
            unset($this->Virheet['Email']);
        }
    }

    public function setYllapitaja($Yllapitaja) {
        $this->Yllapitaja = $Yllapitaja;
    }

    //public function getUsername() {
    //    return $this->Nimimerkki;
    //}
}
