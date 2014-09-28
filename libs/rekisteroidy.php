<?php

$uusiKayttaja = new Kayttaja();

if (isset($_POST['Tunnus'])) {
    $uusiKayttaja->setNimimerkki($_POST['Tunnus']);
    $uusiKayttaja->setEmail($_POST['Email']);
    $uusiKayttaja->setSukupuoli($_POST['Sex']);
    $uusiKayttaja->setSalasana($_POST['Salasana']);
    $uusiKayttaja->setHakutarkoitus($_POST['Hakuperuste']);
    $uusiKayttaja->setTeksti($_POST['Tekstikentta']);
}

$virheet = $uusiKayttaja->getVirheet();
$virheilmoitus = "";

if (empty($virheet) && isset($_POST['Tunnus'])) {
    $uusiKayttaja->lisaaTietokantaan();
    $_SESSION['Onnistui'] = "Rekisteröinti onnistui! Kirjaudu sisään.";
    header('Location: kirjautuminen.php');
} else {
    naytaNakyma('rekisterointi.php', array(
        'kayttaja' => $uusiKayttaja,
        'virheViesti' => reset($virheet)
    ));
}





