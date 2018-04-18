<?php
include ('../inc/config.inc');

$page_title = 'Manage Rsvp';
include ('inc/admin_site_head.inc');

AdminUser::checkLoginStatus();

if(isset($_POST) && !empty($_POST)) {

        $edit_rsvp = new Rsvp($_POST['id_rsvp_confirm']);
        $edit_rsvp->nm_firstname = $_POST['nm_firstname'];
        $edit_rsvp->nm_surname = $_POST['nm_surname'];
        $edit_rsvp->id_guest_type = $_POST['id_guest_type'];
        $edit_rsvp->tx_rsvp = $_POST['tx_rsvp'];
        $edit_rsvp->tx_dietary = $_POST['tx_dietary'];
        $edit_rsvp->fl_outbound_transport = $_POST['fl_outbound_transport'];
        $edit_rsvp->fl_inbound_transport = $_POST['fl_inbound_transport'];
        $edit_rsvp->tx_nm_rsvp = $_POST['tx_nm_rsvp'];
        $edit_rsvp->save();

    if($_POST['save']) {
        if($_POST['id_guest_list'] > 0) {
            $edit_rsvp->fl_matched = 1;
            $edit_rsvp->save();

            $guest = new Guest($_POST['id_guest_list']);
            $guest->tx_rsvp = $_POST['tx_rsvp'];
            $guest->tx_dietary = $_POST['tx_dietary'];
            $guest->fl_outbound_transport = $_POST['fl_outbound_transport'];
            $guest->fl_inbound_transport = $_POST['fl_inbound_transport'];
            $guest->id_rsvp_confirm = $_POST['id_rsvp_confirm'];
            $guest->save();
        }
    } elseif ($_POST['create-guest']){
        $edit_rsvp->fl_matched = 1;
        $edit_rsvp->save();

        $new_guest = new Guest();
        $new_guest->nm_firstname = $_POST['nm_firstname'];
        $new_guest->nm_surname = $_POST['nm_surname'];
        $new_guest->id_guest_type = $_POST['id_guest_type'];
        $new_guest->tx_rsvp = $_POST['tx_rsvp'];
        $new_guest->tx_dietary = $_POST['tx_dietary'];
        $new_guest->fl_outbound_transport = $_POST['fl_outbound_transport'];
        $new_guest->fl_inbound_transport = $_POST['fl_inbound_transport'];
        $new_guest->id_rsvp_confirm = $_POST['id_rsvp_confirm'];
        $new_guest->save();
    }

    $success = true;
}

$id_rsvp_confirm = $_GET['id_rsvp_confirm'];
$rsvp = new Rsvp($id_rsvp_confirm);
?>

<div class="main no-banner">
    <div class="row content">
        <div class="inner-wrap">
            <section class="twelvecol">
                <h1>Manage RSVP</h1>

                <?php if(isset($success)) : ?>
                    <div class="alert alert-success">
                        <p>The database has been successfully updated with you changes</p>
                    </div>
                <?php endif; ?>

                <form method="post">
                    <fieldset>
                        <label>* Name:</label>
                        <div class="name-wrapper">
                            <input type="text" name="nm_firstname" required placeholder="First name" value="<?=$rsvp->nm_firstname?>">
                            <input type="text" name="nm_surname" required placeholder="Surname" value="<?=$rsvp->nm_surname?>">
                        </div>
                    </fieldset>

                    <fieldset>
                        <label for="id_guest_type">Guest Type</label>
                        <div class="select-wrapper">
                            <select name="id_guest_type" id="id_guest_type">
                                <option value="1" <?=$rsvp->id_guest_type == 1 ? 'selected' : '' ?>>Day Guest</option>
                                <option value="2" <?=$rsvp->id_guest_type == 2 ? 'selected' : '' ?>>Evening Guest</option>
                            </select>
                        </div>
                    </fieldset>

                    <fieldset>
                        <label>Response</label>
                        <input name="tx_rsvp" id="rsvp_yes" type="radio" value="yes" <?=$rsvp->tx_rsvp == 'yes' ? 'checked' : '' ?>>
                        <label for="rsvp_yes" class="with-radio">Yes</label>

                        <input name="tx_rsvp" id="rsvp_no" type="radio" value="no" <?=$rsvp->tx_rsvp == 'no' ? 'checked' : '' ?>>
                        <label for="rsvp_no" class="with-radio">No</label>
                    </fieldset>

                    <fieldset>
                        <label>Transport?</label>
                        <input name="fl_outbound_transport" id="fl_outbound_transport" type="checkbox" value="1" <?=$rsvp->fl_outbound_transport ? 'checked' : '' ?>>
                        <label for="fl_outbound_transport" class="with-radio">New Place to Sparsholt Church</label>

                        <input name="fl_inbound_transport" id="fl_inbound_transport" type="checkbox" value="1" <?=$rsvp->fl_inbound_transport ? 'checked' : '' ?>>
                        <label for="fl_inbound_transport" class="with-radio">Sparsholt Church to New Place</label>
                    </fieldset>

                    <fieldset>
                        <label for="tx_dietary">Dietary requirements</label>
                        <textarea name="tx_dietary" id="tx_dietary"  rows="3"><?=$rsvp->tx_dietary?></textarea>
                    </fieldset>

                    <fieldset>
                        <label for="tx_nm_rsvp">RSVPed by who</label>
                        <input type="text" name="tx_nm_rsvp" id="tx_nm_rsvp" value="<?=$rsvp->tx_nm_rsvp?>">
                    </fieldset>

                    <fieldset>
                        <label>Associate to Guest</label>
                        <input type="text" name="nm_guest" id="autocomplete">
                        <input type="hidden" name="id_guest_list" id="id_guest_list" value="">
                    </fieldset>

                    <fieldset>
                        <input type="hidden" name="id_rsvp_confirm" value="<?=$rsvp->id_rsvp_confirm?>">
                        <input type="submit" name="save" value="Save Changes">
                        <input type="submit" name="create-guest" value="Create as guest">
                    </fieldset>
                </form>
            </section>
        </div>
    </div>
</div>

<script type="text/javascript" src="../js/jquery.autocomplete.js"></script>
<script type="text/javascript">
    jQuery('#autocomplete').autocomplete({
        serviceUrl: 'get-guest-list.php',
        type: 'GET',
        dataType : 'json',
        minChars: 3,
        onSelect: function (suggestion) {
            jQuery('input#id_guest_list').val(suggestion.id);
        }
    });
</script>
<?php
include ('../inc/site_foot.inc');
?>


