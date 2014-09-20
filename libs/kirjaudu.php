<?php
if (empty($_POST["username"]) || empty($_POST["password"])) {
    /* Käytetään omassa kirjastotiedostossa määriteltyä näkymännäyttöfunktioita */
    naytaNakyma('login.php');
    exit(); // Lopetetaan suoritus tähän. Kutsun voi sijoittaa myös naytaNakyma-funktioon, niin sitä ei tarvitse toistaa joka paikassa
}

$kayttaja = $_POST["username"];
$salasana = $_POST["password"];

$haettuKayttaja = Kayttaja::etsiKayttajaTunnuksilla($kayttaja, $salasana);
if ($haettuKayttaja == null){
    naytaNakyma("login.php", array(
        'virheViesti' => "Väärä salasana tai tunnus!",
        'kayttaja' => $kayttaja,
    ));
} else {
    naytaNakyma("profiili.php", array(
        'kayttaja' => $haettuKayttaja,
        'onnistumisViesti' => "Kirjautuminen onnistui! Tervetuloa ",
    ));
    
}


