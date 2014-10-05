<?php
$sivu = 'etusivu.php';
require_once 'libs/common.php';
require_once 'libs/tietokanta.php';
require_once 'libs/models/kayttaja.php';
if(onKirjautunut()){
    naytaNakyma($sivu, array(
    'oikeudet' => "kayttaja"
));
} else{
    naytaNakyma($sivu, array(
    ));
}

