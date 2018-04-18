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

                <div class="timeline">
                    <div class="stem-wrapper">
                        <div class="stem"></div>
                        <div class="stem-background"></div>
                    </div>

                    <div class="post-wrapper">
                        <article class="post church-icon">
                            <div class="stem-overlay">
                                <div class="icon"></div>
                            </div>

                            <div class="post-content">
                                <h3>12:30 - 12:45pm</h3>
                                <div class="entry-content">
                                    <p>Arrive at St Stephen's church</p>
                                </div>
                            </div>
                        </article>

                        <article class="post ceremony-icon">
                            <div class="stem-overlay">
                                <div class="icon"></div>
                            </div>

                            <div class="post-content">
                                <h3>1:00pm</h3>
                                <div class="entry-content">
                                    <p>
                                        Ceremony
                                        <br>
                                        <small>While we welcome you to take photos, we kindly ask that you do not obstruct the photographer</small>
                                    </p>
                                </div>
                            </div>
                        </article>

                        <article class="post photos-icon">
                            <div class="stem-overlay">
                                <div class="icon"></div>
                            </div>

                            <div class="post-content">
                                <h3>3:00pm</h3>
                                <div class="entry-content">
                                    <p>Welcome drinks at New Place Hotel and photographs</p>
                                </div>
                            </div>
                        </article>

                        <article class="post receiving-line-icon">
                            <div class="stem-overlay">
                                <div class="icon"></div>
                            </div>

                            <div class="post-content">
                                <h3>4:30pm</h3>
                                <div class="entry-content">
                                    <p>Receiving line</p>
                                </div>
                            </div>
                        </article>

                        <article class="post speeches-icon">
                            <div class="stem-overlay">
                                <div class="icon"></div>
                            </div>

                            <div class="post-content">
                                <h3>5:00pm</h3>
                                <div class="entry-content">
                                    <p>Wedding breakfast and speeches</p>
                                </div>
                            </div>
                        </article>

                        <article class="post evening-icon">
                            <div class="stem-overlay">
                                <div class="icon"></div>
                            </div>

                            <div class="post-content">
                                <h3>7:30pm</h3>
                                <div class="entry-content">
                                    <p>Evening reception</p>
                                </div>
                            </div>
                        </article>
                        <article class="post cake-icon">
                            <div class="stem-overlay">
                                <div class="icon"></div>
                            </div>

                            <div class="post-content">
                                <h3>8:15pm</h3>
                                <div class="entry-content">
                                    <p>Cutting of the cake followed by first dance</p>
                                </div>
                            </div>
                        </article>

                        <article class="post carriages-icon">
                            <div class="stem-overlay">
                                <div class="icon"></div>
                            </div>

                            <div class="post-content">
                                <h3>12:30am</h3>
                                <div class="entry-content">
                                    <p>Carriages</p>
                                </div>
                            </div>
                        </article>
                    </div> <!-- post-wrapper -->
                </div>

                <p>Confetti will be provided on the day so no need to bring your own.</p>
            </section>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/timeline.js"></script>
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
