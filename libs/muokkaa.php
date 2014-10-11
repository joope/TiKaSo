<?php
/*Hakee käyttäjän tiedot ja näyttää ne. Jos tietoja muokataan niin tarkistaa virheet.
Jos virheitä ei löydytty ja muokkaus tehtiin niin tiedot tallennetaan ja siirrytään profiilinäkymään. */

$oikeudet = tarkistaOikeudet();
$kirjautunut = (int) $_SESSION['kirjautunut'];
$uusiKayttaja = Kayttaja::etsiKayttaja($kirjautunut);

if (isset($_POST['muokattiin'])){
    $uusiKayttaja->setNimimerkki($_POST['Tunnus']);
    $uusiKayttaja->setEmail($_POST['Email']);
    $uusiKayttaja->setSukupuoli($_POST['Sex']);
    $uusiKayttaja->setSalasana($_POST['Salasana']);
    $uusiKayttaja->setHakutarkoitus($_POST['Hakuperuste']);
    $uusiKayttaja->setTeksti($_POST['Tekstikentta']);
}


$virheet = $uusiKayttaja->getVirheet();

if (empty($virheet) && isset($_POST['muokattiin'])) {
    $ok = $uusiKayttaja->muutaTietoja();
    $_SESSION['Onnistui'] = "Tiedot muutettu :) ";
    header('Location: profiili.php');
} else {
    naytaNakyma('muokkaus.php', array(
        'oikeudet' => $oikeudet,
        'kayttaja' => $uusiKayttaja,
        'virheViesti' => reset($virheet)
    ));
}





