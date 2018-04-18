<?php
include ('inc/config.inc');

$page_desc = '';
$page_title = 'RSVP';
include ('inc/site_head.inc');

if(isset($_POST) && !empty($_POST)) {
   $success =  Rsvp::sendRsvpConfirmationEmail($_POST);
}
?>

<div class="main no-banner">
    <div class="row content">
        <div class="inner-wrap">
            <?php if(isset($_SESSION['nm_username']) && !empty($_SESSION['nm_username'])) : ?>
                <section class="twelvecol">
                    <h1>RSVP</h1>

                    <?php if($success) : ?>
                        <div class="alert alert-success">
                            <p>We have sent an email to the address provided. Please click the link within the email to complete the RSVP. You may need to check your Junk folder for the email.</p>
                        </div>
                    <?php else: ?>
                        <p>Please use the form below to complete your RSVP.</p>

                        <form name="rsvpForm" class="rsvpForm" action="rsvp.php" method="post">
                            <?php if(isset($_GET['error']) && !empty($_GET['error'])) : ?>
                                <div class="alert alert-error">
                                    <p><?=$_GET['error']?></p>
                                </div>
                            <?php endif; ?>
                            <fieldset>
                                <label>* Name:</label>
                                <div class="name-wrapper">
                                    <input type="text" name="nm_firstname" required placeholder="First name">
                                    <input type="text" name="nm_surname" required placeholder="Surname">
                                </div>
                            </fieldset>

                            <fieldset>
                                <label for="tx_email">* Email:</label>
                                <input name="tx_email" type="email" required id="tx_email">
                                <p><small>We need this to verify your RSVP</small></p>
                            </fieldset>

                            <fieldset>
                                <label>* We'd love for you to celebrate with us:</label>
                                <input name="tx_rsvp" checked id="rsvp_yes" type="radio" value="yes">
                                <label for="rsvp_yes" class="with-radio">Would love to come</label>

                                <input name="tx_rsvp" id="rsvp_no" type="radio" value="no">
                                <label for="rsvp_no" class="with-radio">Sorry, we cant make it</label>
                            </fieldset>

                            <?php if($_SESSION['id_guest_type'] == 1) : ?>
                                <fieldset>
                                    <label>
                                        Need a lift?
                                        <br>
                                        <small>Please indicate which journey(s) you require with our <a href="<?=SITE_HOME?>venue.php#transport" target="_blank">provided transport</a></small>
                                    </label>
                                    <input name="fl_outbound_transport" id="fl_outbound_transport" type="checkbox" value="1">
                                    <label for="fl_outbound_transport" class="with-radio">New Place to Sparsholt Church</label>

                                    <input name="fl_inbound_transport" id="fl_inbound_transport" type="checkbox" value="1">
                                    <label for="fl_inbound_transport" class="with-radio">Sparsholt Church to New Place</label>
                                </fieldset>
                            <?php endif; ?>

                            <fieldset>
                                <label for="tx_dietary">Dietary requirements</label>
                                <textarea name="tx_dietary" id="tx_dietary"  rows="3"></textarea>
                            </fieldset>

                            <div class="rsvp-on-behalf">
                                <p><span id="rsvp-on-behalf-trigger" class="btn">RSVP on behalf of another guest?</span></p>
                            </div>

                            <fieldset>
                                <input type="submit" value="Send RSVP">
                            </fieldset>
                        </form>
                    <?php endif;?>
                </section>
            <?php else:
                include 'inc/login-form.inc';
            endif; ?>
        </div>
    </div>
</div>

<?php if(isset($_SESSION['nm_username']) && !empty($_SESSION['nm_username'])) : ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            var form_el = '<fieldset><label>* Guest\'s Name:</label><div class="name-wrapper"><input type="text" name="nm_firstname_guest[]" required placeholder="First name"><input type="text" name="nm_surname_guest[]" required placeholder="Surname"></div></fieldset><fieldset><label>Dietary requirements</label><textarea name="tx_dietary_guest[]"  rows="3"></textarea></fieldset>';
            var seenMsg = false;

            jQuery('span#rsvp-on-behalf-trigger').on('click', function(e) {
                e.preventDefault();

                if(!seenMsg){
                    if(confirm("When RSVPing on behalf of other guests, this will be using the same response <?=$_SESSION['id_guest_type'] == 1 ? 'and transport details (if given)' : '' ?> you have provided. \nDo you wish to continue?")) {
                        seenMsg = true;
                    } else {
                        return;
                    }
                }

                jQuery('.rsvp-on-behalf').prepend(form_el);
            });

        });
    </script>
<?php endif; ?>

<?php
include ('inc/site_foot.inc');
?>