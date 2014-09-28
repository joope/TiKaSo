<?php
session_start();

function naytaNakyma($sivu, $data = array()) {
    if (onKirjautunut()) {
        $data = (object) $data;
        require 'views/pohja_kirjautuneet.php';
        exit();
    } else {
        $data = (object) $data;
        require 'views/pohja.php';
        exit();
    }
}

function onKirjautunut() {
    if (isset($_SESSION['kirjautunut'])) {
        return true;
    } else {
        return false;
    }
}

function kirjautuiAsken(){
    if(isset($_SESSION['juuriKirjautunut']) && $_SESSION['juuriKirjautunut'] == true){
        return true;
    } return false;
}

function checkPrivileges($sivu, $data = array()) {
    if (onKirjautunut()) {
        if(kirjautuiAsken()){
            $_SESSION['juuriKirjautunut'] = false;
            naytaNakyma($sivu, array(
                'onnistumisViesti' => 'Kirjautuminen onnistui!'
            ));
        } else{
        naytaNakyma($sivu, $data);
        }
    } else {
        naytaNakyma("login.php", array(
            'virheViesti' => 'Et ole kirjautunut sisään!',
            'haettuSivu' => $sivu
        ));
    }
}

function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri){
    echo 'class="active"';
    }
}
