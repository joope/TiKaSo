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
$asiakaslista = Kayttaja::getKayttajatSivulla($sivunro, $listausmaara);
$sivumaara = ceil(Kayttaja::lukumaara() / $listausmaara);

naytaNakyma($sivu, array(
    'oikeudet' => $oikeudet,
    'hakutulos' => $asiakaslista,
    'sivumaara' => $sivumaara,
    'sivu' => $sivunro
));
