<?php
include ('inc/config.inc');

$page_desc = 'Oops this page cannot be found';
$page_title = '404';
include ('inc/site_head.inc');
?>

    <div class="main">
        <div class="row content">
            <div class="inner-wrap">
                <section class="twelvecol">
                    <h1>Page not found</h1>

                    <p>Oops, look like soemthing went wrong and we cannot find the page you are after.</p>
                    <p><strong>Go back to <a href="<?=SITE_HOME?>">Home page</a></strong></p>
                </section>
            </div>
        </div>
    </div>

<?php
include ('inc/site_foot.inc');
?>