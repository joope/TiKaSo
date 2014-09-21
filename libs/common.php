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

function checkPrivileges($sivu) {
    if (onKirjautunut()) {
        naytaNakyma($sivu);
    } else {
        naytaNakyma("login.php", array(
            'virheViesti' => 'Et ole kirjautunut sisään!',
        ));
    }
}
