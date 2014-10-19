<div class="kirjautuminen">
    
    <form class="form-signin" role="form" action="lisaaSalaisuus.php" method="POST" id="salaisuus">
        <h2 class="form-signin-heading">Lisää salaisuus</h2>
        <input type="text" class="form-control" placeholder="Otsikko" required autofocus name="Otsikko" value="<?php echo $data->salaisuus->getOtsikko() ?>">        
        <textarea name="Sisalto" class="form-control" rows="4" cols="60" form="salaisuus"><?php echo $data->salaisuus->getSisalto() ?></textarea>
        <input type="hidden" value="true" name="uusiSalaisuus">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Valmis</button>
    </form>

</div>