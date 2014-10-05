<script type="text/javascript">
var viestit = document.getElementById('viestit');
objDiv.scrollTop = objDiv.scrollHeight;
</script>
<h3>Keskustelu: <?php echo $data->lahettaja->getNimimerkki(); ?></h3>
<div class="row">
    <div class="col-md-4 yhteystiedot">
        <?php foreach ($data->lahettajat as $lahettaja) { ?>
            <div class="panel-body">
                <img src = "pics/profile-placeholder.jpg" alt = "profiilikuva" style = "width:64px;height:64px">
                <form action="viestit.php" method="POST">
                    <input type="hidden" name="keskustelu" value="<?php echo $lahettaja->getAsiakasID() ?>"/>
                    <button class="link" type="submit"><?php echo $lahettaja->getNimimerkki(); ?></button><br>
                </form>
            </div>
        <?php } ?>
    </div>
    <div class="col-md-8">
        <div class="panel panel-default keskustelu" id="viestit">
            <?php foreach ($data->viestit as $viesti) {?>
            <i><?php echo $viesti->getLahetysaika(); ?></i>
            <b><?php echo $viesti->getLahettajaID(); ?>: </b>
                <?php echo $viesti->getSisalto(); ?>
                <br> <?php } ?>
        </div>
        <div class="panel viestikentta">
            <textarea rows="3" cols="90" name="uusiViesti" form="laheta"></textarea>
        </div>
    </div>
    <div class="col-md-1">
        <div class="panel viestit-oikea">
        </div>
        <form action="viestit.php" method="POST" id="laheta">
            <input type="hidden" name="keskustelu" value="<?php echo $data->lahettajaID ?>"/>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Lähetä</button>
        </form>
    </div>

</div>
