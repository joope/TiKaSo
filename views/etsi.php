<div class="panel-heading">
    <h2>Etsi ystäviä</h2>
</div>
<form class="hakulomake" action="etsi.php" method="POST">
    <p>
    <input type="text" style="width: 200px; display: inline-block;" name="hakusana" class="form-control" placeholder="Hakusana">
    <button style="display: inline-block; margin-left: 10px;" type="submit" class="btn btn-lg btn-primary">Hae!</button></p>
    Etsi: 
    <select name="hakuperuste">
        <option value="Nimimerkki">Nimimerkillä</option>
        <option value="Hakutarkoitus">Hakutarkoituksella</option>
        <option value="Sukupuoli">Sukupuolella</option>
        <option value="Syntymapaiva">Iällä</option>
    </select>    
</form>

<table class="table">
    <thead>
    <th></th>
    <th>Nimimerkki</th>
    <th>Hakutarkoitus</th>
    <th>Oma kuvaus</th>
    <th>Toiminnot</th>
</thead>
<?php foreach ($data->hakutulos as $asiakas) { ?>
    <tr>
        <td class="profiililistaus"><img src="pics/profile-placeholder.jpg" alt="profiilikuva" style="width:64px;height:64px"></td>
        <td><?php echo $asiakas->getNimimerkki(); ?></td>
        <td><?php echo $asiakas->getHakutarkoitus(); ?></td>
        <td><?php echo $asiakas->getTeksti(); ?></td>
    <form action="profiili.php" method="POST" role="form">
        <input type="hidden" name="profiili" value=<?php echo $asiakas->getAsiakasID() ?>>
        <td><button type="submit">Näytä profiili</button>
    </form>
    <form action="viestit.php" method="POST" role="form">
        <input type="hidden" name="viesti" value=<?php echo $asiakas->getAsiakasID() ?>>
        <input type="hidden" name="keskustelu" value=<?php echo $asiakas->getAsiakasID() ?>>
        <button type="submit">Lähetä viesti</button></td>
    </form>
    </tr>
<?php } ?>
</table>
<ul class="pagination">
    <?php if ($data->sivu > 1): ?>
        <a href="etsi.php?sivu=<?php echo $data->sivu - 1; ?>">Edellinen sivu</a>
    <?php endif; ?>
    <?php if ($data->sivu < $data->sivumaara): ?>
        <a href="etsi.php?sivu=<?php echo $data->sivu + 1; ?>">Seuraava sivu</a>
    <?php endif; ?>
    <br>Sivu <?php echo $data->sivu; ?>/<?php echo $data->sivumaara; ?>
</ul>