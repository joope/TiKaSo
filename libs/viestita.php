<?php

$oikeudet = tarkistaOikeudet();
$kayttajaID = (int) $_SESSION['kirjautunut'];
if(isset($_POST['viesti'])){
    $uusiViesti = new Viesti();
    $timestamp = date("Y-m-d H:i:s");
    $uusiViesti->setLahettajaID((int)$_POST['viesti']);
    $uusiViesti->setVastaanottajaID($kayttajaID);
    $uusiViesti->setSisalto("Keskustelu alkoi.");
    $uusiViesti->setLahetysaika($timestamp);
    $uusiViesti->lahetaViesti(false);
}
$lahettajat = Kayttaja::etsiViestejaLahettaneet($kayttajaID);

if ($lahettajat == null) {
    $_SESSION['Epaonnistui'] = "Ei viestejä, voit lähettää viestejä klikkaamalla Lähetä viesti-painiketta profiilin kohdalla.";
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

naytaNakyma($sivu, array(
    'oikeudet' => $oikeudet,
    'lahettajat' => $lahettajat,
    'viestit' => $viestit,
    'lahettajaID' => $lahettajaID,
    'lahettaja' => $lahettaja
));
