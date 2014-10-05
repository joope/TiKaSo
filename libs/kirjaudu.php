<?php

if (empty($_POST["username"]) && empty($_POST["password"])) {
    /* Käytetään omassa kirjastotiedostossa määriteltyä näkymännäyttöfunktioita */
    naytaNakyma('login.php');
    exit(); // Lopetetaan suoritus tähän. Kutsun voi sijoittaa myös naytaNakyma-funktioon, niin sitä ei tarvitse toistaa joka paikassa
}
//Tarkistetaan että vaaditut kentät on täytetty:
if (empty($_POST["username"])) {
    naytaNakyma("login.php", array(
        'virheViesti' => "Kirjautuminen epäonnistui! Et antanut käyttäjätunnusta.",
    ));
}
$kayttaja = $_POST["username"];

if (empty($_POST["password"])) {
    naytaNakyma("login.php", array(
        'kayttaja' => $kayttaja,
        'virheViesti' => "Kirjautuminen epäonnistui! Et antanut salasanaa.",
    ));
}
$salasana = $_POST["password"];

$haettuKayttaja = Kayttaja::etsiKayttajaTunnuksilla($kayttaja, $salasana);
if ($haettuKayttaja == null) {
    naytaNakyma("login.php", array(
        'virheViesti' => "Väärä salasana tai tunnus!",
        'kayttaja' => $kayttaja,
    ));
} else {
    $_SESSION['kirjautunut'] = $haettuKayttaja->getAsiakasID();
    $_SESSION['admin'] = $haettuKayttaja->getYllapitaja();
    $_SESSION['juuriKirjautunut'] = true;
    //lisää toiminto jolla siirrytään haettuun sivuun
    if (isset($_SESSION['haettuSivu'])) {
        $haettu = $_SESSION['haettuSivu'];
        header('Location: '.$haettu);
        exit();
    } else {
        header('Location: profiili.php');
    }
}


