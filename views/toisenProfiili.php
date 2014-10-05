<div class="container kirjautuminen">
    <h3>Oma profiili</h3>
    <div class="row">
        <div class="col-md-4">
            <p class="centeredImage"><img src="http://www.fact.co.uk/media/497038/the_shining_2.png" width="320" height="200" align="middle" alt="Kaunis nainen :D"></p>
            <div class="infovalikko">
                <?php //if($_SESSION['admin'] || $_SESSION['kirjautunut'] == $data->kayttaja->getAsiakasID){ ?>
                <a href="#">Raportoi</a><br>
                <a href="#">Tarkastele salaisia sivuja</a><br>
                <form action="profiili.php" method="POST">
                    <input type="hidden" name="poista" value="<?php echo $_SESSION['kirjautunut'] ?>"/>
                    <button class="link" onclick="varmista()" type="submit">Poista tunnus</button><br>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Perustiedot</div>
                <div class="panel-body">
                    Nimimerkki: <?php echo $data->kayttaja->getNimimerkki(); ?><br>
                    Sukupuoli: <?php echo $data->kayttaja->naytaSukupuoli(); ?><br>
                    Hakutarkoitus: <?php echo $data->kayttaja->getHakutarkoitus(); ?><br>
                    Syntymäpäivä: <?php echo $data->kayttaja->getSyntymapaiva(); ?><br>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Oma kuvaus:</h3>
                </div>
                <div class="panel-body">
                    <?php echo $data->kayttaja->getTeksti(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

