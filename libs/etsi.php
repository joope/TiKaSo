<?php

$oikeudet = tarkistaOikeudet();
$sivunro = 1;
$listausmaara = 4;

if (isset($_GET['sivu'])) {
    $sivunro = (int) $_GET['sivu'];
    if ($sivunro < 1) {
        $sivunro = 1;
    }
}
$asiakaslista = Kayttaja::getKayttajatSivulla($sivunro, $listausmaara);
$sivumaara = ceil(Kayttaja::lukumaara() / $listausmaara);

/* Jos haettiin jotain ja hakusana ei ollut tyhjä haetaan kaikki käyttäjät joiden nimimerkki sisältää annetun merkkijonon.
 * Jos hakutulos on tyhjä, näytetään käyttäjälle ilmoitus ja listataan kaikki käyttäjät */
if (isset($_POST['hakusana']) && $_POST['hakusana'] != "") {
    $hakusana = $_POST['hakusana'];
    $hakuperuste = $_POST['hakuperuste'];
    if ($hakuperuste == "Nimimerkki") {
        $asiakaslista = Kayttaja::etsiKayttajiaNimimerkilla($hakusana);
    } else if ($hakuperuste == "Hakutarkoitus") {
        $asiakaslista = Kayttaja::etsiKayttajiaHakutarkoituksella($hakusana);
    } else if ($hakuperuste == "Teksti") {
        $asiakaslista = Kayttaja::etsiKayttajiaTekstilla($hakusana);
    }
    $sivumaara = 1;
    if ($asiakaslista == null) {
        $_SESSION['Epaonnistui'] = "Ei hakutuloksia!";
        $asiakaslista = Kayttaja::getKayttajatSivulla($sivunro, $listausmaara);
        $sivumaara = ceil(Kayttaja::lukumaara() / $listausmaara);
    }
}

naytaNakyma($sivu, array(
    'oikeudet' => $oikeudet,
    'hakutulos' => $asiakaslista,
    'sivumaara' => $sivumaara,
    'sivu' => $sivunro
));
