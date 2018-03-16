<?php
include ('inc/config.inc');

$page_desc = 'Upload photos of our special day';
$page_title = 'Upload photos';
include ('inc/site_head.inc');
?>
<div class="main no-banner">
    <div class="row content">
        <div class="inner-wrap">
            <?php if(isset($_SESSION['nm_username']) && !empty($_SESSION['nm_username'])) : ?>
                <section class="twelvecol">
                    <h1>Upload photos</h1>
                    <p></p>
                </section>
            <?php else:
                include 'inc/login-form.inc';
            endif; ?>
        </div>
    </div>
</div>

<?php if(isset($_SESSION['nm_username']) && !empty($_SESSION['nm_username'])) : ?>
    <link rel="stylesheet" href="<?= SITE_HOME;?>js/dropzone/dropzone.css">
    <script type="text/javascript" src="<?= SITE_HOME;?>js/dropzone/dropzone.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {

        });
    </script>
<? endif; ?>

<?php
include ('inc/site_foot.inc');
?>
