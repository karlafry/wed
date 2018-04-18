<?php
include ('../inc/config.inc');

$page_title = 'Guest List Overview';
include ('inc/admin_site_head.inc');

AdminUser::checkLoginStatus();

$filters = new \stdClass();
$filters->tx_rsvp = 'yes';
$filters->id_guest_type = 1;
$filters->id_rsvp_confirm = '!= 0';
$day_guests_attending = Guest::searchGuests($filters);

$filters = new \stdClass();
$filters->tx_rsvp = 'no';
$filters->id_guest_type = 1;
$filters->id_rsvp_confirm = '!= 0';
$day_guests_unattending = Guest::searchGuests($filters);

$filters = new \stdClass();
$filters->tx_rsvp = 'yes';
$filters->id_guest_type = 1;
$filters->id_rsvp_confirm = '!= 0';
$filters->fl_outbound_transport = 1;
$outbound_bus = count(Guest::searchGuests($filters));

$filters = new \stdClass();
$filters->tx_rsvp = 'yes';
$filters->id_guest_type = 1;
$filters->id_rsvp_confirm = '!= 0';
$filters->fl_inbound_transport = 1;
$inbound_bus = count(Guest::searchGuests($filters));

$filters->tx_rsvp = 'yes';
$filters->id_guest_type = 2;
$filters->id_rsvp_confirm = '!= 0';
$eve_guests_attending = Guest::searchGuests($filters);

$filters = new \stdClass();
$filters->tx_rsvp = 'no';
$filters->id_guest_type = 2;
$filters->id_rsvp_confirm = '!= 0';
$eve_guests_unattending = Guest::searchGuests($filters);

$filters = new \stdClass();
$filters->id_rsvp_confirm = 0;
$await_response = Guest::searchGuests($filters);

$confirmedNotMatched = Rsvp::getConfirmedNotMatchedRsvps();

$total
?>

<div class="main no-banner">
    <div class="row content">
        <div class="inner-wrap">
            <section class="twelvecol guest-list">
                <h1>Guest list overview</h1>

                <p><strong>Total guests for whole day: <?= (count($day_guests_attending) + count($eve_guests_attending))?></strong></p>

                <p>
                    <strong><?=$outbound_bus?></strong> people require transport from Hotel -> Sparsholt<br>
                    <strong><?=$inbound_bus?></strong> people require transport from Sparsholt -> Hotel
                </p>
                <br>

                <div class="collapsible">
                    <h4>Attending Day Guests (<?=count($day_guests_attending)?>)</h4>
                    <div class="expandable-content">
                        <?php if($day_guests_attending) : ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($day_guests_attending as $id_guest => $guest) : ?>
                                        <tr>
                                            <td><a href="manage_guest.php?id_guest=<?=$id_guest?>">Edit</a></td>
                                            <td><?=$guest->nm_firstname?> <?=$guest->nm_surname?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <h4>No day guests confirmed as of yet</h4>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="collapsible">
                    <h4>Unattending Day Guests (<?=count($day_guests_unattending)?>)</h4>
                    <div class="expandable-content">
                        <?php if($day_guests_unattending) : ?>
                            <table>
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($day_guests_unattending as $id_guest => $guest) : ?>
                                    <tr>
                                        <td><a href="manage_guest.php?id_guest=<?=$id_guest?>">Edit</a></td>
                                        <td><?=$guest->nm_firstname?> <?=$guest->nm_surname?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <p>No day guests confirmed as of yet</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="collapsible">
                    <h4>Attending Evening Guests (<?=count($eve_guests_attending)?>)</h4>
                    <div class="expandable-content">
                        <?php if($eve_guests_attending) : ?>
                            <table>
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($eve_guests_attending as $id_guest => $guest) : ?>
                                    <tr>
                                        <td><a href="manage_guest.php?id_guest=<?=$id_guest?>">Edit</a></td>
                                        <td><?=$guest->nm_firstname?> <?=$guest->nm_surname?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <p>No evening guests confirmed as of yet</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="collapsible">
                    <h4>Unattending Evening Guests (<?=count($eve_guests_unattending)?>)</h4>
                    <div class="expandable-content">
                        <?php if($eve_guests_unattending) : ?>
                            <table>
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($eve_guests_unattending as $id_guest => $guest) : ?>
                                    <tr>
                                        <td><a href="manage_guest.php?id_guest=<?=$id_guest?>">Edit</a></td>
                                        <td><?=$guest->nm_firstname?> <?=$guest->nm_surname?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <p>No evening guests confirmed as of yet</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="collapsible">
                    <h4>Awaiting response (<?=count($await_response)?>)</h4>
                    <div class="expandable-content">
                        <?php if($await_response) : ?>
                            <table>
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Guest type</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($await_response as $id_guest => $guest) : ?>
                                    <tr>
                                        <td><a href="manage_guest.php?id_guest=<?=$id_guest?>">Edit</a></td>
                                        <td><?=$guest->nm_firstname?> <?=$guest->nm_surname?></td>
                                        <td><?=$guest->id_guest_type == 1 ? 'Day Guest' : 'Evening Guest'?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <p>Awaiting no responses</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="collapsible">
                    <h4>Confirmed but not matched (<?=count($confirmedNotMatched)?>)</h4>
                    <div class="expandable-content">
                        <?php if($confirmedNotMatched) : ?>
                            <table>
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Response</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($confirmedNotMatched as $id_rsvp_confirm => $rsvp) : ?>
                                    <tr>
                                        <td><a href="manage_rsvp.php?id_rsvp_confirm=<?=$id_rsvp_confirm?>">Edit</a></td>
                                        <td><?=$rsvp->nm_firstname?> <?=$rsvp->nm_surname?></td>
                                        <td><?=$rsvp->tx_rsvp?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <p>No mismatched guests require attention</p>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<?php
include ('../inc/site_foot.inc');
?>
