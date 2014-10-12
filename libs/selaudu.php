<?php

$oikeudet = tarkistaOikeudet();
$sivunro = 1;
$listausmaara = 4;

$asiakaslista = Kayttaja::getKayttajatSivulla($sivunro, $listausmaara);
$sivumaara = ceil(Kayttaja::lukumaara() / $listausmaara);
if (isset($_GET['sivu'])) {
    $sivunro = (int) $_GET['sivu'];
    if ($sivunro < 1) {
        $sivunro = 1;
    }
}
if ($sivu == 'selaa.php') {
    naytaNakyma($sivu, array(
        'oikeudet' => $oikeudet,
        'hakutulos' => $asiakaslista,
        'sivumaara' => $sivumaara,
        'sivu' => $sivunro
    ));
} else {
    if (isset($_POST['hakusana']) && $_POST['hakusana'] != "") {
        $hakusana = $_POST['hakusana'];
        $hakuperuste = $_POST['hakuperuste'];
        $asiakaslista = Kayttaja::etsiKayttajiaNimimerkilla($hakusana);
        if ($asiakaslista == null) {
            $_SESSION['Epaonnistui'] = "Ei hakutuloksia!";
            $asiakaslista = Kayttaja::getKayttajatSivulla($sivunro, $listausmaara);
            $sivumaara = ceil(Kayttaja::lukumaara() / $listausmaara);
        }
        $sivumaara = 1;
    }
    naytaNakyma($sivu, array(
        'oikeudet' => $oikeudet,
        'hakutulos' => $asiakaslista,
        'sivumaara' => $sivumaara,
        'sivu' => $sivunro
    ));
}