<?php
$oikeudet = tarkistaOikeudet();
$kirjautunut = (int) $_SESSION['kirjautunut'];
$uusiSalaisuus = salainenSivu::getSalaisuus($_POST['muokkausid']);
if($uusiSalaisuus == null || $uusiSalaisuus->getOmistajaID() != $_SESSION['kirjautunut']){
    $_SESSION['Epaonnistui'] = "Ei tarvittavia oikeuksia.";
    header('Location: profiili.php');
}

if (isset($_POST['muokattiin'])){
    $uusiSalaisuus->setOtsikko($_POST['Otsikko']);
    $uusiSalaisuus->setSisalto($_POST['Sisalto']);
}


$virheet = $uusiSalaisuus->getVirheet();

if (empty($virheet) && isset($_POST['muokattiin'])) {
    $uusiSalaisuus->tallennaMuutokset();
    $_SESSION['Onnistui'] = "Salaisuus päivitetty.";
    header('Location: profiili.php');
} else {
    naytaNakyma('muokkaaSalaisuus_view.php', array(
        'oikeudet' => $oikeudet,
        'salaisuus' => $uusiSalaisuus,
        'virheViesti' => reset($virheet)
    ));
}





