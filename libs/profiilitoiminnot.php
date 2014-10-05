<?php

$oikeudet = tarkistaOikeudet();
$id = (int) $_SESSION['kirjautunut'];
if (isset($_POST['profiili'])) {
    $id = (int) $_POST['profiili'];
}
$kayttaja = Kayttaja::etsiKayttaja($id);

if (isset($_POST['poista'])) {
    if ($_SESSION['admin'] || $_SESSION['kirjautunut'] == $id) {
        $poistoid = (int) $_POST['poista'];
        Kayttaja::poistaTunnus($poistoid);

        unset($_SESSION["kirjautunut"]);

        $_SESSION['Onnistui'] = "Profiili poistettu";
        header('Location: index.php');
    } else {
        naytaNakyma($sivu, array(
            'oikeudet' => $oikeudet,
            'kirjautunut' => $_SESSION['kirjautunut'],
            'kayttaja' => $kayttaja
        ));
    }
}
if ($id == $_SESSION['kirjautunut'] || $_SESSION['admin']) {
    naytaNakyma($sivu, array(
        'oikeudet' => $oikeudet,
        'kirjautunut' => $_SESSION['kirjautunut'],
        'kayttaja' => $kayttaja
    ));
} else{
    naytaNakyma("toisenProfiili.php", array(
        'oikeudet' => $oikeudet,
        'kirjautunut' => $_SESSION['kirjautunut'],
        'kayttaja' => $kayttaja
    ));
}
