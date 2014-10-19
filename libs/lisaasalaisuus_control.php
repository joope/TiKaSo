<?php
$oikeudet = tarkistaOikeudet();
$uusiSalaisuus = new salainenSivu();

if(isset($_POST['uusiSalaisuus'])){
    $uusiSalaisuus->setOmistajaID($_SESSION['kirjautunut']);
    $uusiSalaisuus->setOtsikko($_POST['Otsikko']);
    $uusiSalaisuus->setSisalto($_POST['Sisalto']);
}

$virheet = $uusiSalaisuus->getVirheet();

if(empty($virheet) && isset($_POST['uusiSalaisuus'])){
    $uusiSalaisuus->lisaaTietokantaan();
    $_SESSION['Onnistui'] = "Salaisuus lisätty, voit jakaa salaisuutesi muiden kanssa heidän profiilinsa kautta.";
    header('Location: profiili.php');
} else{
    naytaNakyma($sivu, array(
        'oikeudet' => $oikeudet,
        'salaisuus' => $uusiSalaisuus,
        'virheViesti' => reset($virheet)
    ));
}


