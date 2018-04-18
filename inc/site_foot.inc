<?php include ABSOLUTE_PATH.'inc/footer.inc'; ?>
</div> <!-- end wrapper -->

<!-- jQuery Libs
    ================================================= -->
<script src="<?= SITE_HOME;?>js/modernizr.js"></script>
<script type="text/javascript" src="<?= SITE_HOME;?>js/slick.min.js"></script>
<script type="text/javascript" src="<?= SITE_HOME;?>bower_components/jquery.togglebutton.min/index.js"></script>

<script>
    Modernizr.load([
        //first test need for polyfill
        {
            test: window.matchMedia,
            nope: "<?= SITE_HOME;?>bower_components/media-match/media.match.min.js"
        },

        //and then load enquire
        "<?= SITE_HOME;?>bower_components/enquire/dist/enquire.min.js",
        "<?= SITE_HOME;?>js/application.js"
    ]);
</script>
</body>
</html>