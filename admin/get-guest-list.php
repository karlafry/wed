<?php
include ('../inc/config.inc');

header('Content-Type: application/json');

$search_str = $_GET['query'];

$filters = new \stdClass();
$filters->custom_or[] = sprintf("nm_firstname LIKE '%%%s%%'",$search_str);
$filters->custom_or[] = sprintf("nm_surname LIKE '%%%s%%'",$search_str);
$filters->custom_or[] = sprintf("CONCAT_WS(' ',nm_firstname,nm_surname) LIKE '%%%s%%'",$search_str);
$filters->id_rsvp_confirm = 0;

$possible_guests = Guest::searchGuests($filters);

$values = array();

foreach($possible_guests as $guest) {
    $values[] = array(
        'value' => "{$guest->nm_firstname} {$guest->nm_surname}".($guest->tx_alt_names != '' ? " ({$guest->tx_alt_names})" : '' ),
        'id' => $guest->id_guest_list
    );
}

if(empty($values)) {
    $values[] = array(
        'value' => 'No results found for "'.$search_str.'"',
        'id' => 0
    );
}

echo json_encode(array('suggestions' => $values));
