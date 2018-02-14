<?php
include ('inc/config.inc');

$page_desc = '';
$page_title = 'Photos';
include ('inc/site_head.inc');
?>

<div class="main no-banner">
    <div class="row content">
        <div class="inner-wrap">
            <section class="twelvecol">
                <h1>Photos</h1>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </section>

            <section class="twelvecol">
                <div id="instafeed"></div>
                <button class="btn" id="load-more">Load More</button>
            </section>
        </div>
    </div>
</div>
<script type="text/javascript" src="bower_components/instafeed.js/instafeed.min.js"></script>
    <script type="text/javascript">
        var loadButton = jQuery('#load-more');
        var feed = new Instafeed({
            get: 'tagged',
            tagName: 'barnes',
            accessToken: '<?=INSTA_ACCESS_TOKEN?>',
            resolution: 'standard_resolution',
            limit: 24,
            template: '<div><figure><img src="{{image}}" /><figcaption><div><span>{{likes}}</span>{{caption}}</div></figcaption></figure></div>',
            after: function() {
                if (!this.hasNext()) {
                    loadButton.hide();
                }
            },
        });

        // bind the load more button
        loadButton.on('click', function() {
            feed.next();
        });

        feed.run();
    </script>

<?php
include ('inc/site_foot.inc');
?>