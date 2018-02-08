<?php
include ('inc/config.inc');

$page_desc = '';
$page_title = 'Contact us';
include ('inc/site_head.inc');


if(isset($_POST) && count($_POST) > 0) {
    if($_POST['submit'] == 'Submit') {
        //send email with message.
        $msg = "Thank you, your message has been sent successfully.";
    } else {
        $msg = "Something went wrong, please try again.";
    }

}
?>

<div class="main">
    <div class="row content">
        <div class="inner-wrap">
            <section class="twelvecol">
                <h1>Contact us</h1>

                <?php if(isset($msg)) :?>
                    <p><strong><?= $msg?></strong></p>
                <?php else : ?>
                    <p>Have any questions about the big day or requests for the DJ? Then you're in the right place, simply fill out the form below.</p>

                    <form method="post" id="contact_form">
                        <fieldset>
                            <label>* Name:</label>
                            <div class="name-wrapper">
                                <input type="text" name="tx_fname" required placeholder="First name">
                                <input type="text" name="tx_surname" required placeholder="Surname">
                            </div>
                        </fieldset>

                        <fieldset>
                            <label for="tx_email">* Email:</label>
                            <input name="tx_email" type="email" required id="tx_email">
                        </fieldset>

                        <fieldset>
                            <label for="tx_message">Your message: </label>
                            <textarea name="tx_message" cols="50" rows="5" required id="tx_message"></textarea>
                        </fieldset>

                        <fieldset>
                            <div id="recaptcha" class="g-recaptcha" data-sitekey="6Ld6N0UUAAAAAIJhczsnxtRy24jsdCinjwvNBHAE" data-callback="onSubmit" data-size="invisible">
                            </div>
                            <input type="submit" name="submit" value="Sumbit">
                        </fieldset>
                    </form>
                <?php endif; ?>
            </section>
        </div>
    </div>
</div>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script type="text/javascript">
    function onSubmit(token) {
        jQuery('#contact_form').submit();
    }

    jQuery('#contact_form').submit(function(e) {
       e.preventDefault();
       grecaptcha.execute();
    });
</script>
<?php
include ('inc/site_foot.inc');
?>