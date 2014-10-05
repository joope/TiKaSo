<?php
session_start();

function naytaNakyma($sivu, $data = array()) {
    $data = (object) $data;
    if ($data->oikeudet == "admin") {
        require 'views/pohja_admin.php';
        exit();
    } else if ($data->oikeudet == "kayttaja"){
        require 'views/pohja_kirjautuneet.php';
        exit();
    } else{
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

function kirjautuiAsken() {
    if (isset($_SESSION['juuriKirjautunut']) && $_SESSION['juuriKirjautunut'] == true) {
        return true;
    } return false;
}

function kirjauduUlos() {
    unset($_SESSION["kirjautunut"]);
    header('Location: index.php');
    $_SESSION['Onnistui'] = "Kirjauduttiin ulos.";
}

function tarkistaOikeudet() {
    if (onKirjautunut()) {
        if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){
            return 'admin';
        } else{
            return 'kayttaja';
        }
    } else{
        $_SESSION['Epaonnistui'] = "Kirjaudu ensin sisään!";
        $_SESSION['haettuSivu'] = $sivu;
        header('Location: kirjautuminen.php');
        exit();
    }
}

function checkPrivileges($sivu, $data = array()) {
    if (onKirjautunut()) {
        if (kirjautuiAsken()) {
            $_SESSION['juuriKirjautunut'] = false;
            naytaNakyma($sivu, array(
                'onnistumisViesti' => 'Kirjautuminen onnistui!'
            ));
        } else {
            naytaNakyma($sivu, $data);
        }
    } else {
        naytaNakyma("login.php", array(
            'virheViesti' => 'Et ole kirjautunut sisään!',
            'haettuSivu' => $sivu
        ));
    }
}

function echoActiveClassIfRequestMatches($requestUri) {
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri) {
        echo 'class="active"';
    }
}
