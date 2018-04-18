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
            <div class="main-banner">
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
            <section class="twelvecol">
                <h1>Welcome</h1>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                <p>In metus vulputate eu scelerisque felis imperdiet proin. Velit sed ullamcorper morbi tincidunt ornare massa eget egestas purus. Quis auctor elit sed vulputate mi sit amet mauris commodo. Et molestie ac feugiat sed lectus. Lectus nulla at volutpat diam ut venenatis. Venenatis tellus in metus vulputate eu. Velit laoreet id donec ultrices tincidunt arcu non sodales. Nec feugiat in fermentum posuere urna nec tincidunt praesent. Nisl suscipit adipiscing bibendum est ultricies integer. Neque viverra justo nec ultrices dui sapien. Sed risus pretium quam vulputate dignissim suspendisse in est ante. Sollicitudin aliquam ultrices sagittis orci. Vitae et leo duis ut diam quam nulla. Viverra maecenas accumsan lacus vel facilisis volutpat est. Sit amet massa vitae tortor condimentum lacinia quis.</p>
            </section>
        </div>
    </div>

    <div class="row content">
        <div class="inner-wrap">
            <section class="twelvecol">
                <h2>Countdown to the big day</h2>
                <div class="clock-countdown"></div>
            </section>
        </div>
    </div>

    <div class="row">
        <section class="twelvecol slider-container">
            <div class="slider-title inner-wrap">
                <h2>Over the years&hellip;</h2>
            </div>
            <div class="carousel">
                <div><figure><img src="images/slider/sk-1.jpg" /></figure></div>
                <div><figure><img src="images/slider/sk-2.jpg" /></figure></div>
                <div><figure><img src="images/slider/sk-3.jpg" /></figure></div>
                <div><figure><img src="images/slider/sk-4.jpg" /></figure></div>
                <div><figure><img src="images/slider/sk-5.jpg" /></figure></div>
                <div><figure><img src="images/slider/sk-6.jpg" /></figure></div>
                <div><figure><img src="images/slider/sk-7.jpg" /></figure></div>
                <div><figure><img src="images/slider/sk-8.jpg" /></figure></div>
                <div><figure><img src="images/slider/sk-9.jpg" /></figure></div>
                <div><figure><img src="images/slider/sk-10.jpg" /></figure></div>
                <div><figure><img src="images/slider/sk-11.jpg" /></figure></div>
                <div><figure><img src="images/slider/sk-12.jpg" /></figure></div>
                <div><figure><img src="images/slider/sk-13.jpg" /></figure></div>
                <div><figure><img src="images/slider/sk-14.jpg" /></figure></div>
            </div>
        </section>
    </div>
</div>

<script type="text/javascript" src="bower_components/flipclock/compiled/flipclock.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.main-banner').slick({
            infinite: true,
            autoplay: true,
            dots: true,
            arrows: false
        });

        var clock = jQuery('.clock-countdown').FlipClock(<?=$diff?>, {
            clockFace: 'DailyCounter',
            countdown: true,
        });

        jQuery('.carousel').slick({
            centerMode: true,
            centerPadding: '60px',
            slidesToShow: 4,
            infinite: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 1
                    }
                }
            ]
        });
    });
</script>

<?php
    include ('inc/site_foot.inc');
?>





