<?php
include ('../inc/config.inc');

$page_title = '';
include ('inc/admin_site_head.inc');

if(isset($_POST) && !empty($_POST)) {
    $new_user = new AdminUser();
    $new_user->nm_admin_user = $_POST['nm_admin_user'];
    $new_user->tx_admin_password = $_POST['tx_admin_password'];

    if($new_user->save() > 0) {
        AdminUser::adminLogin($_POST['nm_admin_user'],$_POST['tx_admin_password']);
    } else {
        $error_msg = "Something went wrong, please try again.";
    }
}
?>

<div class="main no-banner">
    <div class="row content">
        <div class="inner-wrap">
            <section class="twelvecol">
                <h1>Create new user</h1>
                <form name="addUser" method="post">
                    <?php if(isset($error_msg)) : ?>
                        <div class="alert alert-error">
                            <p><?=$error_msg?></p>
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
                        <input type="submit" value="Create User">
                    </fieldset>
                </form>
            </section>
        </div>
    </div>
</div>

<?php
include ('../inc/site_foot.inc');
?>
