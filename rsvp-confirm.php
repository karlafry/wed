<?php
include ('inc/config.inc');

$page_desc = '';
$page_title = 'Online RSVP confirmation';
include ('inc/site_head.inc');

$key = $_GET['key'];
try {
    Rsvp::verifyRsvpResponse($key);
} catch(Exception $e) {
    $error = $e->getMessage();
}
?>

<div class="main no-banner">
    <div class="row content">
        <div class="inner-wrap">
            <section class="twelvecol">
                <h1>RSVP confirmation</h1>
                <?php if(isset($error)) : ?>
                    <div class="alert alert-error">
                        <p><?=$error?></p>
                        <p>If you have copy and pasted the link, please ensure it has copied correctly.</p>
                    </div>
                <?php else :?>
                    <div class="alert alert-success">
                        <p>Thank you! Your RSVP has been successfully received.</p>
                    </div>
                <?php endif; ?>
            </section>
        </div>
    </div>
</div>

<?php
include ('inc/site_foot.inc');
?>
