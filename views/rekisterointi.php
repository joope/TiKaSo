<div class="kirjautuminen">
    <form class="form-signin" role="form" action="rekisterointi.php" method="POST" id="rekisteroityminen">
        <input type="text" class="form-control" placeholder="Tunnus" required autofocus name="Tunnus" value="<?php echo $data->kayttaja->getNimimerkki() ?>">        
        <input type="email" class="form-control" placeholder="Sähköposti" required name="Email" value="<?php echo $data->kayttaja->getEmail() ?>">
        <input type="password" class="form-control" placeholder="Salasana" required name="Salasana">

        <p>Sukupuoli: <input type="radio" name="Sex" value="mies" <?php echo $data->kayttaja->palautaSukupuoli("m") ?>>Mies
            <input type="radio" name="Sex" value="nainen" <?php echo $data->kayttaja->palautaSukupuoli("f") ?>>Nainen</p>
        <p>Mitä etsit?
            <select name="Hakuperuste">
                <option value="Kavereita">kavereita</option>
                <option value="Juttuseuraa">juttuseuraa</option>
                <option value="Seurustelusuhdetta">seurustelusuhdetta</option>
                <option value="Itseäni">avaimia</option>
            </select> </p>
        <p>Syntymäpäivä: <select name="Syntymapaiva">
                <option value="Kavereita">kavereita</option>
                <option value="Juttuseuraa">juttuseuraa</option>
                <option value="Seurustelusuhdetta">seurustelusuhdetta</option>
                <option value="Itseäni">avaimia</option>
            </select> </p>
        Kerro jotain itsestäsi: 
        <br>
        <textarea name="Tekstikentta" rows="4" cols="60" form="rekisteroityminen" value="<?php echo $data->kayttaja->getTeksti() ?>"></textarea>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Valmis</button>
    </form>

</div>