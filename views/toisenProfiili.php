<div class="container profiiliikkuna">
    <div class="row">
        <div class="col-md-4">
            <h3 style="text-align: center;"><?php echo $data->kayttaja->getNimimerkki(); ?>n profiili</h3>
            <p class="centeredImage"><img src="pics/profile-placeholder.jpg" width="280" height="240" align="middle" alt="Kaunis nainen :D"></p>
            <div class="infovalikko">
                <form action="viestit.php" method="POST">
                    <input type="hidden" name="viesti" value="<?php echo $data->kayttaja->getAsiakasID() ?>">
                    <input type="hidden" name="keskustelu" value="<?php echo $data->kayttaja->getAsiakasID() ?>">
                    <button class="link" type="submit">Lähetä viesti</button><br>
                </form>
                <form action="profiili.php" method="POST" role="form">
                    <select name="salaisuudet">
                        <option value="oletus">--Salaisuus--</option>
                        <?php foreach (salainenSivu::getSalaisetSivut($_SESSION['kirjautunut']) as $salaisuus){?>
                        <option value="<?php echo $salaisuus->getSalainenID(); ?>"><?php echo $salaisuus->getOtsikko() ?></option>
                        <?php } ?>
                    </select>
                    <input type="hidden" name="kenelle" value=<?php echo $data->kayttaja->getAsiakasID() ?>>
                    <button type="submit">Jaa salaisuus</button></td>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <h3 style="text-align: center;">Julkiset tiedot</h3>
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
            <?php
            if (!empty($data->salaisuudet)) {
                echo '<h3 style="text-align: center;">Sinulle jaetut salaisuudet</h3>';
            }
            ?>
                    <?php foreach ($data->salaisuudet as $salaisuus) { ?>
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #b9b9b9;">
                        <?php echo $salaisuus->getOtsikko() ?>
                    </div>
                    <div class="panel-body salaisuus">
                <?php echo $salaisuus->getSisalto() ?>
                    </div>
                </div>
<?php } ?>
        </div>
    </div>
</div>

