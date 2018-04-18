<?php
include ('../inc/config.inc');

$page_title = 'Login';
include ('inc/admin_site_head.inc');

if(isset($_POST) && !empty($_POST)) {
    try {
        AdminUser::adminLogin($_POST['nm_admin_user'], $_POST['tx_admin_password']);
    } catch(Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<div class="main no-banner">
    <div class="row content">
        <div class="inner-wrap">
            <section class="twelvecol">
                <h1>Admin Login</h1>
                    <form name="loginUser" method="post">
                        <?php if(isset($error)) : ?>
                            <div class="alert alert-error">
                                <p><?=$error?></p>
                            </div>
                        <?php endif; ?>
                        <fieldset>
                            <label for="nm_admin_user">Username:</label>
                            <input type="text" name="nm_admin_user" id="nm_admin_user" required>
                        </fieldset>

                        <fieldset>
                            <label for="tx_admin_password">Password:</label>
                            <input type="password" name="tx_admin_password" id="tx_admin_password" required>
                        </fieldset>

                        <fieldset>
                            <input type="submit" value="Login">
                        </fieldset>
                    </form>
            </section>
        </div>
    </div>
</div>

<?php
include ('../inc/site_foot.inc');
?>
