<?php

$oikeudet = tarkistaOikeudet();
$id = (int) $_SESSION['kirjautunut'];

/*Jos profiilille on annettu arvo, näytetään kyseinen profiili oman sijaan*/
if (isset($_POST['profiili'])) {
    $id = (int) $_POST['profiili'];
}
$kayttaja = Kayttaja::etsiKayttaja($id);

/*Jos käyttäjä haluaa poistaa tunnuksen tarkistetaan onko hänellä oikeudet siihen.
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
/*Profiilin valikkovaihtoehdot näytetään käyttäjien oikeuksien mukaan. Omaa profiilia tarkastellessa käyttäjä näkee muokkauspainikkeet,
toisen käyttäjää tarkastellessa voi raportoida tai viestitellä kyseiselle käyttäjälle. */
if ($id == $_SESSION['kirjautunut'] || $_SESSION['admin']) {
    naytaNakyma($sivu, array(
        'oikeudet' => $oikeudet,
        'kirjautunut' => $_SESSION['kirjautunut'],
        'kayttaja' => $kayttaja
    ));
} else{
    naytaNakyma("toisenProfiili.php", array(
        'oikeudet' => $oikeudet,
        'kirjautunut' => $_SESSION['kirjautunut'],
        'kayttaja' => $kayttaja
    ));
}
