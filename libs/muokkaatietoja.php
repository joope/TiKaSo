<?php

$uusiKayttaja = Kayttaja::etsiKayttaja($_SESSION['kirjautunut']);

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
    $uusiKayttaja->muutaTietoja();
    $_SESSION['Onnistui'] = "Tietot muutettu.";
    header('Location: profiili.php');
} else {
    naytaNakyma('rekisterointi.php', array(
        'kayttaja' => $uusiKayttaja,
        'virheViesti' => reset($virheet)
    ));
}





