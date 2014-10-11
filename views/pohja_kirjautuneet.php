<!DOCTYPE html>
<html>
    <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <title>Ystävänvälityspalvelu</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body class ="tausta">
        <div class="container" id="sisalto"> 
            <ul class="nav nav-pills" id="navigaatio">
                <li class="navbar-header">
                    <a class="navbar-brand" href="index.php">Ystävänvälityspalvelu</a></li>
                <li <?= echoActiveClassIfRequestMatches("etsi") ?>><a href="etsi.php">Etsi</a></li>
                <li <?= echoActiveClassIfRequestMatches("selaus") ?>><a href="selaus.php">Selaa</a></li>
                <li <?= echoActiveClassIfRequestMatches("viestit") ?>><a href="viestit.php">Viestit</a></li>
                <li <?= echoActiveClassIfRequestMatches("profiili") ?>><a href="profiili.php">Profiili</a></li>
                <li class="navbar-right"><a href="kirjaudu_ulos.php">Kirjaudu ulos</a></li> 
            </ul>
            <!-- Tähän ilmoitukset mahdollisista virhe- ja onnistumisviesteistä -->
            <?php if (!empty($_SESSION['Onnistui'])): ?>
                <div class="alert alert-success"><?php echo $_SESSION['Onnistui']; ?></div>
                <?php unset($_SESSION['Onnistui']); ?>
            <?php endif; ?>
            <?php if (!empty($_SESSION['Epaonnistui'])): ?>
                <div class="alert alert-danger"><?php echo $_SESSION['Epaonnistui']; ?></div>
                <?php unset($_SESSION['Epaonnistui']); ?>
            <?php endif; ?>
            <?php if (!empty($data->virheViesti)): ?>
                <div class="alert alert-danger"><?php echo $data->virheViesti; ?></div>
            <?php endif; ?>
            <?php if (!empty($data->onnistumisViesti)): ?>
                <div class="alert alert-success"><?php echo $data->onnistumisViesti; ?></div>
            <?php endif; ?>
            <div class="sisalto">
                <?php require 'views/' . $sivu;
                ?>
            </div>
            <footer class="lopuke">
                ©joopeti, PariTELE Oy 2014
            </footer>
        </div>


    </body>
</html>
