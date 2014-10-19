<?php

$oikeudet = tarkistaOikeudet();
$id = (int) $_SESSION['kirjautunut'];

/* Jos profiilille on annettu arvo, näytetään kyseinen profiili oman sijaan */
if (isset($_GET['profiili'])) {
    $id = (int) $_GET['profiili'];
}

if (isset($_POST['salaisuudet']) && $_POST['salaisuudet'] != "oletus") {
    if (salainenSivu::onkoJoJaettu($_POST['salaisuudet'], $_POST['kenelle'])) {
        $_SESSION['Epaonnistui'] = "Olet jo jakanut tämän salaisuuden";
    } else {
        salainenSivu::naytaSalaisuusAsiakkaalle($_POST['salaisuudet'], $_POST['kenelle']);
        $_SESSION['Onnistui'] = "Salaisuus jaettu.";
    }
    $id = ($_POST['kenelle']);
}

if(isset($_POST['poistasalaisuus'])){
    $poistettavasalaisuus = salainenSivu::getSalaisuus($_POST['poistasalaisuus']);
    if($poistettavasalaisuus != null && $poistettavasalaisuus->getOmistajaID() == $_SESSION['kirjautunut']){
        salainenSivu::poistaRiippuvuudet($_POST['poistasalaisuus']);
        salainenSivu::poistaSalaisuus($_POST['poistasalaisuus']);
        $_SESSION['Onnistui'] = "Salaisuus poistettu";
    }
}

$kayttaja = Kayttaja::etsiKayttaja($id);

/* Jos käyttäjä haluaa poistaa tunnuksen tarkistetaan onko hänellä oikeudet siihen.
 * Käyttäjältä poistetaan myös viestit ja ohjataan etusivulle. */
if (isset($_POST['poista'])) {
    if ($_SESSION['admin'] || $_SESSION['kirjautunut'] == $id) {
        $poistoid = (int) $_POST['poista'];
        Viesti::poistaViestit($poistoid);
        Kayttaja::poistaTunnus($poistoid);

        unset($_SESSION["kirjautunut"]);

        $_SESSION['Onnistui'] = "Profiili poistettu";
        header('Location: index.php');
    } else {
        naytaNakyma($sivu, array(
            'oikeudet' => $oikeudet,
            'kirjautunut' => $_SESSION['kirjautunut'],
            'kayttaja' => $kayttaja
        ));
    }
}
/* Profiilin valikkovaihtoehdot näytetään käyttäjien oikeuksien mukaan. Omaa profiilia tarkastellessa käyttäjä näkee muokkauspainikkeet,
  toisen käyttäjää tarkastellessa voi raportoida tai viestitellä kyseiselle käyttäjälle. */
if ($id == $_SESSION['kirjautunut'] || $_SESSION['admin']) {
    $salaisuudet = salainenSivu::getSalaisetSivut($_SESSION['kirjautunut']);
    naytaNakyma($sivu, array(
        'oikeudet' => $oikeudet,
        'kirjautunut' => $_SESSION['kirjautunut'],
        'kayttaja' => $kayttaja,
        'salaisuudet' => $salaisuudet
    ));
} else {
    $salaisuudet = salainenSivu::naytaSalaisuudetJosJaettu($id, $_SESSION['kirjautunut']);
    //$salaisuudet = salainenSivu::getSalaisetSivut($id);
    naytaNakyma("toisenProfiili.php", array(
        'oikeudet' => $oikeudet,
        'kirjautunut' => $_SESSION['kirjautunut'],
        'kayttaja' => $kayttaja,
        'salaisuudet' => $salaisuudet
    ));
}
