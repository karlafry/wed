<?php
    include ('inc/config.inc');

    $page_desc = '';
    $page_title = 'Welcome';
    include ('inc/site_head.inc');

    $now = strtotime("now");
    $date = strtotime("2018-10-12 13:00:00");
    $diff = $date - $now;
?>

<div class="main">
    <div class="row">
        <section class="twelvecol slider-container">
            <div class="slider">
                <div>
                    <figure>
                        <img src="images/slider/home-slide-1.jpg">
                        <figcaption>
                            Sean <span>&amp;</span> Karla
                            <br>
                            Friday <span>12</span><sup>th</sup> October
                        </figcaption>
                    </figure>
                </div>
                <div>
                    <figure>
                        <img src="images/slider/home-slide-2.jpg">
                    </figure>
                </div>
                <div>
                    <figure>
                        <img src="images/slider/home-slide-3.jpg">
                    </figure>
                </div>
            </div>
        </section>
    </div>

    <div class="row content">
        <div class="inner-wrap">
            <h1>Test header</h1>

            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>

            <p>In metus vulputate eu scelerisque felis imperdiet proin. Velit sed ullamcorper morbi tincidunt ornare massa eget egestas purus. Quis auctor elit sed vulputate mi sit amet mauris commodo. Et molestie ac feugiat sed lectus. Lectus nulla at volutpat diam ut venenatis. Venenatis tellus in metus vulputate eu. Velit laoreet id donec ultrices tincidunt arcu non sodales. Nec feugiat in fermentum posuere urna nec tincidunt praesent. Nisl suscipit adipiscing bibendum est ultricies integer. Neque viverra justo nec ultrices dui sapien. Sed risus pretium quam vulputate dignissim suspendisse in est ante. Sollicitudin aliquam ultrices sagittis orci. Vitae et leo duis ut diam quam nulla. Viverra maecenas accumsan lacus vel facilisis volutpat est. Sit amet massa vitae tortor condimentum lacinia quis.</p>

            <p>Vel quam elementum pulvinar etiam non quam lacus suspendisse faucibus. Vivamus arcu felis bibendum ut tristique et egestas. Pulvinar elementum integer enim neque. Ornare aenean euismod elementum nisi quis. Sed blandit libero volutpat sed cras. Luctus venenatis lectus magna fringilla urna. In mollis nunc sed id semper risus in hendrerit gravida. Aliquet bibendum enim facilisis gravida. Posuere urna nec tincidunt praesent semper. Facilisis magna etiam tempor orci. Sed vulputate odio ut enim blandit volutpat maecenas volutpat blandit. Gravida rutrum quisque non tellus orci. At volutpat diam ut venenatis tellus in metus. Interdum consectetur libero id faucibus nisl tincidunt. Semper risus in hendrerit gravida rutrum. Facilisis volutpat est velit egestas dui. Quam vulputate dignissim suspendisse in. Orci nulla pellentesque dignissim enim sit amet venenatis. Purus in massa tempor nec feugiat nisl pretium fusce. Elit sed vulputate mi sit amet mauris commodo quis imperdiet.</p>
        </div>
    </div>

    <div class="row content">
        <div class="inner-wrap">
            <h2>Countdown to the big day</h2>
            <div class="clock-countdown"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.slider').slick({
            infinite: true,
            autoplay: true,
            dots: true
        });

        var clock = jQuery('.clock-countdown').FlipClock(<?=$diff?>, {
            clockFace: 'DailyCounter',
            countdown: true,
        });
    });
</script>

<?php
    include ('inc/site_foot.inc');
?>





