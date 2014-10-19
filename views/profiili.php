<div class="container profiiliikkuna">
    <div class="row">
        <div class="col-md-4">
            <h3 style="text-align: center;">Oma profiilisi</h3>
            <p class="centeredImage"><img src="pics/profile-placeholder.jpg" width="280" height="240" align="middle" alt="Kaunis nainen :D"></p>
            <div class="infovalikko">
                <a href="lisaaSalaisuus.php">Lisää uusi salaisuus</a><br>
                <a href="muokkaatietoja.php">Muokkaa tietoja</a><br>
                <form action="profiili.php" method="POST" onsubmit="return confirm('Haluatko varmasti poistaa tunnuksesi ja siihen liittyvät tiedot?');">
                    <input type="hidden" name="poista" value="<?php echo $_SESSION['kirjautunut'] ?>"/>
                    <button class="link">Poista tunnus</button><br>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <h3 style="text-align: center;">Julkiset tietosi</h3>
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
        <!-- Tähän salaiset tiedot paneeleina-->
        <div class="col-md-4">
            <h3 style="text-align: center;">Salaisuutesi</h3>
            <?php foreach ($data->salaisuudet as $salaisuus) { ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php echo $salaisuus->getOtsikko(); ?>
                        <form style="display: inline;" action="muokkaasalaisuus.php" method="POST">
                            <input type="hidden" name="muokkausid" value="<?php echo $salaisuus->getSalainenID(); ?>"/>
                            <button class="link">Muokkaa</button>
                        </form>
                        <form style="display: inline;" action="profiili.php" method="POST" onsubmit="return confirm('Poistetaanko salaisuus: <?php echo $salaisuus->getOtsikko(); ?>?');">
                            <input type="hidden" name="poistasalaisuus" value="<?php echo $salaisuus->getSalainenID(); ?>"/>
                            <button class="link">Poista</button>
                        </form>
                    </div>
                    <div class="panel-body salaisuus">
                        <?php echo $salaisuus->getSisalto(); ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>


</div>

