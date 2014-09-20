<form class="form-signin" action="kirjautuminen.php" method="POST" role="form">
    <h2 class="form-signin-heading">Kirjautuminen</h2>
    <input type="text" name="username" class="form-control" placeholder="Tunnus" value="<?php echo $data->kayttaja; ?>" required autofocus>
    <input type="password" name="password" class="form-control" placeholder="Salasana" required>
    <label class="checkbox">
        <input type="checkbox" value="remember-me"> Muista minut
    </label>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Kirjaudu</button>
</form>
<div class="tyhjablocki"></div>