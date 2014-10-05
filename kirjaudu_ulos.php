<?php
session_start();
unset($_SESSION["kirjautunut"]);
$_SESSION['Onnistui'] = "Kirjauduttiin ulos.";
header('Location: kirjautuminen.php');
