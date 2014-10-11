<?php

$oikeudet = tarkistaOikeudet();
$kayttajaID = (int) $_SESSION['kirjautunut'];
if (isset($_POST['viesti'])) {
    $uusiViesti = new Viesti();
    $timestamp = date("Y-m-d H:i:s");
    $uusiViesti->setLahettajaID((int) $_POST['viesti']);
    $uusiViesti->setVastaanottajaID($kayttajaID);
    $uusiViesti->setSisalto("ALOITUSVIESTI");
    $uusiViesti->setLahetysaika($timestamp);
    $uusiViesti->lahetaViesti(false);
}
if (isset($_POST['poistaviesti']) && $_POST['poistaviesti'] != null) {
    $poistettava = Viesti::getViesti($_POST['poistaviesti']);
    if ($poistettava == null){
        $_SESSION['Epaonnistui'] = "Yritit poistaa olematonta viestiä!";
    } else if ($poistettava->getLahettajaID() == $kayttajaID) {
        Viesti::poistaViesti($_POST['poistaviesti']);
        $_SESSION['Onnistui'] = "Viesti poistettu.";
    } else {
        $_SESSION['Epaonnistui'] = "Et voi poistaa toisten viestejä!";
    }
}

/*Listaa käyttäjälle viestejä lähettäneet käyttäjät. Jos viestejä ei ole siirrytään selaus.php-sivulle*/
$lahettajat = Kayttaja::etsiViestejaLahettaneet($kayttajaID);

if ($lahettajat == null) {
    $_SESSION['Epaonnistui'] = "Ei viestejä. Voit lähettää viestejä klikkaamalla Lähetä viesti-painiketta profiilin kohdalla.";
    header('Location: selaus.php');
    exit();
}

if (isset($_POST['keskustelu'])) {
    $lahettajaID = (int) $_POST['keskustelu'];
} else {
    $eka = reset($lahettajat);
    $lahettajaID = (int) $eka->getAsiakasID();
}
$uusiViesti = new Viesti();

if (isset($_POST['uusiViesti'])) {
    $timestamp = date("Y-m-d H:i:s");
    $uusiViesti->setLahettajaID($kayttajaID);
    $uusiViesti->setVastaanottajaID($lahettajaID);
    $uusiViesti->setSisalto($_POST['uusiViesti']);
    $uusiViesti->setLahetysaika($timestamp);
    $uusiViesti->lahetaViesti(false);
}

$viestit = Viesti::etsiViestit($kayttajaID, $lahettajaID);
$lahettaja = Kayttaja::etsiKayttaja($lahettajaID);
$kayttaja = Kayttaja::etsiKayttaja($kayttajaID);

naytaNakyma($sivu, array(
    'oikeudet' => $oikeudet,
    'lahettajat' => $lahettajat,
    'viestit' => $viestit,
    'lahettajaID' => $lahettajaID,
    'lahettaja' => $lahettaja,
    'kayttaja' => $kayttaja
));
