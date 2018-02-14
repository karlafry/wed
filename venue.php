<?php
include ('inc/config.inc');

$page_desc = '';
$page_title = 'Venue';
include ('inc/site_head.inc');
?>

<div class="main">
    <div class="row">
        <section class="twelvecol slider-container">
            <div class="main-banner">
                <div>
                    <figure>
                        <img src="images/slider/venue-slide.jpg">
                    </figure>
                </div>
            </div>
        </section>
    </div>


    <div class="row content">
        <div class="inner-wrap">
            <section class="twelvecol">
                <h1>Venue</h1>

                <h2>Ceremony</h2>
                <div class="sixcol">
                    <p>The ceremony will be at St. Stephen's Church at 1pm. Limited parking is available opposite the church at the memorial hall, <a href="#transport">please see section below about provided transport.</a></p>

                    <address>
                        St. Stephen's Church<br>
                        Woodman Lane<br>
                        Sparsholt<br>
                        Winchester<br>
                        SO21 2NR
                    </address>
                </div>
                <div class="sixcol last">
                    <div class="map-container">
                        <iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJHR8f4CIMdEgRt0sx96UUa9Y&key=AIzaSyBsDh54a62t_g3ePEnETOlwl_nEYdUAp94" allowfullscreen></iframe>
                    </div>
                </div>
            </section>

            <section class="twelvecol">
                <h2>Reception</h2>
                <div class="sixcol">
                    <p>The reception will be held at New Place Hotel from 3:30pm. Parking is ample and the hotel is happy for cars to be left overnight and collected the next day.</p>

                    <address>
                        New Place Hotel<br>
                        Shirrell Heath<br>
                        Southampton<br>
                        SO32 2JY
                    </address>
                </div>
                <div class="sixcol last">
                    <div class="map-container">
                        <iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJ_epfl1lpdEgRtB9hxEJS3hg&key=AIzaSyBsDh54a62t_g3ePEnETOlwl_nEYdUAp94" allowfullscreen></iframe>
                    </div>
                </div>
            </section>

            <section class="twelvecol" id="transport">
                <h2>Provided transport</h2>
                <div class="sixcol">
                    <p>As parking is limited at the church, we will be providing transport to come from New Place Hotel out to Sparsholt and back again. Please do make use of this if you are coming from around that area and let us know when you RSVP. The transport does allow children, though does not have seatbelts.</p>
                </div>
                <div class="sixcol last">
                    <img src="images/bus.jpg" alt="Wedding bus" >
                </div>
            </section>

            <section class="twelvecol">
                <h2>Route</h2>
                <p>For those who do wish to drive, we suggest this route from the church to the hotel. There is an alternative route going through Crabwood that most sat navs tend to choose, but if you are not familiar with this (and its many pot holes), we suggest sticking to the main roads.</p>
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m32!1m12!1m3!1d40123.22565657715!2d-1.3847793634295718!3d51.058597373763625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m17!3e0!4m5!1s0x48740c22e01f1f1d%3A0xd66b14a5f7314bb7!2sSt+Stephens+Church%2C+Sparsholt%2C+Winchester+SO21+2NR!3m2!1d51.078651!2d-1.379519!4m3!3m2!1d51.0781718!2d-1.3436076!4m5!1s0x48746959975feae3%3A0xb8d404bfcb02cc04!2sNew+Place+Hotel%2C+Shirrell+Heath%2C+Southampton!3m2!1d50.918665999999995!2d-1.195468!5e0!3m2!1sen!2suk!4v1518106150468" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </section>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.main-banner').slick({
            arrows: false
        });
    });
</script>
<?php
include ('inc/site_foot.inc');
?>