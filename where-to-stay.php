<?php
include ('inc/config.inc');

$page_desc = '';
$page_title = 'Where To Stay';
include ('inc/site_head.inc');

$accoms = Accom::getAllAccoms();
?>

<div class="main">
    <div class="row">
        <section class="twelvecol slider-container">
            <div class="main-banner">
                <div>
                    <figure>
                        <img src="images/slider/where-to-stay.jpg">
                    </figure>
                </div>
            </div>
        </section>
    </div>

    <div class="row content">
        <div class="inner-wrap">
            <section class="twelvecol">
                <h1>Where To Stay</h1>

                <p>We have a reserved number of rooms at New Place hotel which you can use the code provided on the invitation to receive a discount on your stay. Bookings must be made at least 6 weeks prior to receive the discount. Please phone 01329 833543 to make your reservation. We also have a function room reserved the next day where we can all have breakfast together.</p>
            </section>

            <section class="twelvecol">
                <h2>Alternative accommodation</h2>

                <p>Here are a selection of hotels or B&B's in the surrounding area. Click on the map to find out more information.</p>

                <div class="twelvecol alt-accoms">
                    <div class="sixcol map-result-container">
                        <div id="map"></div>
                    </div>

                    <div class="map-results sixcol last">
                        <?php foreach ($accoms as $id_accom => $accom) :?>
                            <article class="result-element" data-id="<?=$id_accom?>">
                                <figure>
                                    <img src="images/accoms/<?=$accom->tx_img_filename?>" alt="<?=$accom->nm_accom?>"/>
                                </figure>
                                <div class="accom-info">
                                    <h3><?=$accom->nm_accom?></h3>
                                    <p>
                                       <a href="<?=$accom->tx_website?>" target="_blank"><?=$accom->tx_website_display?></a><br>
                                       <?=$accom->tx_contact?><br>
                                       <small><?=round($accom->distance,1)?> miles from New Place</small>
                                    </p>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsDh54a62t_g3ePEnETOlwl_nEYdUAp94"></script>
<script type="text/javascript">
    function initializeMap() {
        var gmarkers = [];
        var marker, activeMarker;

        // map options
        var options = {
            zoom: 12,
            maxZoom: 15,
            center: new google.maps.LatLng(<?=Accom::NEW_PLACE_LAT?>,<?=Accom::NEW_PLACE_LNG?>),
            mapTypeId: google.maps.MapTypeId.ROAD,
            mapTypeControl: true,
            scrollwheel: false,
        };

        var image = new google.maps.MarkerImage(
                'images/map_marker.png',
                null,
                null,
                new google.maps.Point(11, 32)
        );

        var imageActive = new google.maps.MarkerImage(
                'images/map_marker_active.png',
                null,
                null,
                new google.maps.Point(11, 32)
        );

        // init map
        var map = new google.maps.Map(document.getElementById('map'), options);

        var markers = [
            <?php
            $i = 1;
            foreach ($accoms as $id_accom => $accom) :?>
                {
                   "id" : "<?=$accom->id_accom?>",
                   "lng" : "<?=$accom->map_lng?>",
                   "lat" : "<?=$accom->map_lat?>",
                   "name" : "<?=$accom->nm_accom?>"
                }<?=$i < count($accoms)?',':''?>
            <?php
                $i++;
            endforeach; ?>
        ];
        var bounds = new google.maps.LatLngBounds();

        for (var i = 0; i < markers.length; i++) {
            // init markers
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(markers[i].lat, markers[i].lng),
                map: map,
                icon: image,
                title: markers[i].name,
                id: markers[i].id
            });
            if (markers[i].lat != '0.00000000000000' && markers[i].lng != '0.00000000000000') {
                bounds.extend(new google.maps.LatLng(markers[i].lat, markers[i].lng));
            }
            gmarkers.push(marker);

            // process marker click events
            (function(marker, i) {
                // add click event
                google.maps.event.addListener(marker, 'click', function() {
                    //Set previous marker back to default
                    activeMarker && activeMarker.setIcon(image);
                    //Update icon
                    marker.setIcon(imageActive);
                    //Set this as the active marker
                    activeMarker = marker;
                    highlightAccomInResults(markers[i].id);
                });
            })(marker, i);
        }

        //Center Marker for New Place
        new google.maps.Marker({
            position: new google.maps.LatLng(<?=Accom::NEW_PLACE_LAT?>,<?=Accom::NEW_PLACE_LNG?>),
            map: map,
            icon: {
                url : 'images/map_marker_center.png',
                anchor:  new google.maps.Point(11, 32),
                labelOrigin : new google.maps.Point(11, -8)
            },
            title: "New Place",
            label: {
                text: "New Place",
                fontWeight: "bold",
                fontSize: "16px",
                color: "#550202"
            }
        });

        map.fitBounds(bounds);
    }
    initializeMap();

    function highlightAccomInResults(id) {
        var headerHeight = jQuery('header.header').outerHeight(true);

        jQuery('article.result-element').removeClass('highlight');
        jQuery('article.result-element[data-id='+id+']').addClass('highlight');

        jQuery('html, body').animate({
            scrollTop: jQuery('article.result-element[data-id='+id+']').offset().top - headerHeight
        }, 500);
    }
</script>

<?php
include ('inc/site_foot.inc');
?>