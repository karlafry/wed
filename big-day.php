<?php
    include ('inc/config.inc');

    $page_desc = '';
    $page_title = 'The Big Day';
    include ('inc/site_head.inc');
?>

<div class="main">
    <div class="row">
        <section class="twelvecol slider-container">
            <div class="main-banner">
                <div>
                    <figure>
                        <img src="images/slider/big-day-slide-1.jpg">
                    </figure>
                </div>
                <div>
                    <figure>
                        <img src="images/slider/big-day-slide-2.jpg">
                    </figure>
                </div>
            </div>
        </section>
    </div>

    <div class="row content">
        <div class="inner-wrap">
            <section class="twelvecol">
                <h1>The big day</h1>

                <h2>Order of day</h2>
                <ul>
                    <li><span>12:30pm</span> Arrive at church</li>
                    <li><span>1pm</span> Ceremony</li>
                    <li><span>3:30pm</span> Welcome drinks at New Place Hotel and photographs</li>
                    <li><span>4:30pm</span> Wedding breakfast and speeches</li>
                    <li><span>7:30pm</span> Evening Reception</li>
                    <li><span>8:30pm</span> Cutting cake and first dance</li>
                    <li><span>12:30am</span> Carriages</li>
                </ul>

            </section>
            <section class="twelvecol">

            </section>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.main-banner').slick({
            infinite: true,
            autoplay: true,
            dots: true,
            arrows: false
        });
    });
</script>
<?php
    include ('inc/site_foot.inc');
?>
