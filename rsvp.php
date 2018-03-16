<?php
include ('inc/config.inc');

$page_desc = '';
$page_title = 'RSVP';
include ('inc/site_head.inc');
?>

    <div class="main no-banner">
        <div class="row content">
            <div class="inner-wrap">
                <?php if(isset($_SESSION['nm_username']) && !empty($_SESSION['nm_username'])) : ?>
                    <section class="twelvecol">
                        <h1>RSVP</h1>
                        <p></p>
                    </section>
                <?php else:
                    include 'inc/login-form.inc';
                endif; ?>
            </div>
        </div>
    </div>

<?php
include ('inc/site_foot.inc');
?>