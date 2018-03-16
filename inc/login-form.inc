<section class="twelvecol">
    <form name="loginForm" method="post" action="login.php">
        <h1>Login</h1>

        <p>You need to login to view this content.</p>

        <?php if(isset($_GET['error']) && !empty($_GET['error'])) : ?>
            <div class="alert alert-error">
                <p><?=$_GET['error']?></p>
            </div>
        <?php endif; ?>
        <fieldset>
            <label for="nm_username">Your name:</label>
            <input type="text" name="nm_username" id="nm_username" required>
        </fieldset>

        <fieldset>
            <label for="tx_password">
                Password:<br>
                <small>This can be found on your invitation</small>
            </label>
            <input type="password" name="tx_password" id="tx_password" required>
        </fieldset>

        <fieldset>
            <input type="hidden" name="tx_url" value="<?=strtok($_SERVER["REQUEST_URI"],'?')?>">
            <input type="submit" value="Login">
        </fieldset>
    </form>
</section>