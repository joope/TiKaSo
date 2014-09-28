<?php
$sivunro = 1;
if (isset($_GET['sivu'])) {
    $sivunro = (int)$_GET['sivu'];
    if ($sivunro < 1){ 
        $sivunro = 1;
    }
}  
$listausmaara = 4;
$asiakaslista = Kayttaja::getKayttajatSivulla($sivunro, $listausmaara); 
$sivumaara = ceil(Kayttaja::lukumaara()/$listausmaara);

checkPrivileges($sivu, array(
    'hakutulos' => $asiakaslista,
    'sivumaara' => $sivumaara,
    'sivu' => $sivunro
));