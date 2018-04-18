<?php
include ('../inc/config.inc');

$page_title = 'Home';
include ('inc/admin_site_head.inc');

AdminUser::checkLoginStatus();
?>

<div class="main no-banner">
    <div class="row content">
        <div class="inner-wrap">
            <section class="twelvecol">
                <h1>Admin Home</h1>

                <p>Not a lot here...<br>
                <a href="<?=SITE_HOME?>" target="_blank">Back to main site</a> </p>
            </section>
        </div>
    </div>
</div>

<?php
include ('../inc/site_foot.inc');
?>
