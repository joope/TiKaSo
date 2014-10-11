<?php

$oikeudet = tarkistaOikeudet();
$sivunro = 1;
$listausmaara = 4;
if (isset($_GET['sivu'])) {
    $sivunro = (int) $_GET['sivu'];
    if ($sivunro < 1) {
        $sivunro = 1;
    }
}
if ($sivu == 'selaa.php') {
    $asiakaslista = Kayttaja::getKayttajatSivulla($sivunro, $listausmaara);
    $sivumaara = ceil(Kayttaja::lukumaara() / $listausmaara);

    naytaNakyma($sivu, array(
        'oikeudet' => $oikeudet,
        'hakutulos' => $asiakaslista,
        'sivumaara' => $sivumaara,
        'sivu' => $sivunro
    ));
} else {
    if(isset($_POST['hakusana'])){

        $hakusana = $_POST['hakusana'];
        $hakuperuste = $_POST['hakuperuste'];
        $asiakaslista = Kayttaja::etsiKayttajiaNimimerkilla($hakusana);
    }
    naytaNakyma($sivu, array(
        'oikeudet' => $oikeudet,
        'hakutulos' => $asiakaslista,
        'sivumaara' => $sivumaara,
        'sivu' => $sivunro
    ));
}