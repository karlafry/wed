<?php
include ('inc/config.inc');

$page_desc = '';
$page_title = 'Contact us';
include ('inc/site_head.inc');


if(isset($_POST) && count($_POST) > 0) {
    if($_POST['submit_check'] == '1') {
        //send email with message.
$mail_body = "
You have received an enquiry from the wedding website.\n\n
From: {$_POST['tx_fname']} {$_POST['tx_surname']} \n
Reply: {$_POST['tx_email']}\n
Message:\n
{$_POST['tx_message']}
";
        $headers = 'From: Wedding Site <contact@sean-karla-wedding.co.uk>' . "\r\n";
        if(mail('karla.fry86@gmail.com','Wedding Website enquiry',$mail_body, $headers)) {
            $msg = "Thank you, your message has been sent successfully.";
        } else {
            $msg = "We were not able to send your message, please try again";
        }

    } else {
        $msg = "Something went wrong, please try again.";
    }

}
?>

<div class="main no-banner">
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
                            <input type="hidden" name="submit_check" value="1">
                            <button type="submit" class="btn" id="submit_form">Submit</button>
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

    jQuery('#submit_form').on('click', function(e) {
        if(jQuery('#contact_form')[0].checkValidity()) {
            e.preventDefault();
            grecaptcha.execute();
        }
    });
</script>
<?php
include ('inc/site_foot.inc');
?>