<?php

/**
 * @author Karla Fry <karla@powder-blue.com>
 */

class Rsvp
{
    public $id_rsvp_confirm;
    public $nm_firstname;
    public $nm_surname;
    public $id_guest_type;
    public $tx_rsvp;
    public $tx_dietary;
    public $fl_outbound_transport;
    public $fl_inbound_transport;
    public $tx_nm_rsvp;
    public $fl_confirmed;
    public $tx_verify_key;
    public $dt_response;
    public $fl_matched;

    public function __construct($id_rsvp_confirm = 0)
    {
        if($id_rsvp_confirm > 0) {
            $sql = "
                SELECT * FROM sk_rsvp_confirm WHERE id_rsvp_confirm = ?
            ";

            $stmt = Database::db()->prepare($sql);
            $stmt->bind_param('i',$id_rsvp_confirm);
            $stmt->execute();

            $row = Database::fetchObject($stmt);

            if($row) {
                $this->id_rsvp_confirm = $row->id_rsvp_confirm;
                $this->nm_firstname = $row->nm_firstname;
                $this->nm_surname = $row->nm_surname;
                $this->id_guest_type = $row->id_guest_type;
                $this->tx_rsvp = $row->tx_rsvp;
                $this->tx_dietary = $row->tx_dietary;
                $this->fl_outbound_transport = $row->fl_outbound_transport;
                $this->fl_inbound_transport = $row->fl_inbound_transport;
                $this->tx_nm_rsvp = $row->tx_nm_rsvp;
                $this->fl_confirmed = $row->fl_confirmed;
                $this->tx_verify_key = $row->tx_verify_key;
                $this->dt_response = $row->dt_response;
                $this->fl_matched = $row->fl_matched;
            }
        }
    }

    public function insert()
    {
        $sql = "
            INSERT INTO sk_rsvp_confirm
            SET         nm_firstname = ?,
                        nm_surname = ?,
                        id_guest_type = ?,
                        tx_rsvp = ?,
                        tx_dietary = ?,
                        fl_outbound_transport = ?,
                        fl_inbound_transport = ?,
                        tx_nm_rsvp = ?,
                        tx_verify_key = ?,
                        dt_response = NOW()
        ";
        $stmt = Database::db()->prepare($sql);
        $stmt->bind_param('ssissiiss',
            Database::db()->escape_string($this->nm_firstname),
            Database::db()->escape_string($this->nm_surname),
            $this->id_guest_type,
            Database::db()->escape_string($this->tx_rsvp),
            Database::db()->escape_string($this->tx_dietary),
            $this->fl_outbound_transport,
            $this->fl_inbound_transport,
            Database::db()->escape_string($this->tx_nm_rsvp),
            $this->tx_verify_key
        );
        $stmt->execute();
    }

    public function update()
    {
        $sql = "
            UPDATE      sk_rsvp_confirm
            SET         nm_firstname = ?,
                        nm_surname = ?,
                        id_guest_type = ?,
                        tx_rsvp = ?,
                        tx_dietary = ?,
                        fl_outbound_transport = ?,
                        fl_inbound_transport = ?,
                        tx_nm_rsvp = ?,
                        fl_confirmed = ?,
                        tx_verify_key = ?,
                        fl_matched = ?
            WHERE       id_rsvp_confirm = ?
        ";
        $stmt = Database::db()->prepare($sql);
        $stmt->bind_param('ssissiisisii',
            Database::db()->escape_string($this->nm_firstname),
            Database::db()->escape_string($this->nm_surname),
            $this->id_guest_type,
            Database::db()->escape_string($this->tx_rsvp),
            Database::db()->escape_string($this->tx_dietary),
            $this->fl_outbound_transport,
            $this->fl_inbound_transport,
            Database::db()->escape_string($this->tx_nm_rsvp),
            $this->fl_confirmed,
            $this->tx_verify_key,
            $this->fl_matched,
            $this->id_rsvp_confirm
        );
        $stmt->execute();
    }

    public function save()
    {
        if(isset($this->id_rsvp_confirm)) {
            $this->update();
        } else {
            $this->insert();
        }
    }

    public function delete()
    {

    }

    public static function checkGuestExists($data)
    {
        $filters = new \stdClass();
        $filters->nm_firstname = Database::db()->escape_string($data->nm_firstname);
        $filters->nm_surname = Database::db()->escape_string($data->nm_surname);
        $filters->id_guest_type = $data->id_guest_type;
        $guest = Guest::searchGuests($filters);

        if(count($guest) == 0) {
            $filters = new \stdClass();
            $filters->custom[] = sprintf("FIND_IN_SET('%s',tx_alt_names) > 0",Database::db()->escape_string($data->nm_firstname));
            $filters->nm_surname = Database::db()->escape_string($data->nm_surname);
            $filters->id_guest_type = $data->id_guest_type;
            $guest = Guest::searchGuests($filters);
        }

        return $guest;
    }

    public static function sendRsvpConfirmationEmail($data)
    {
        $id_guest_type = $_SESSION['id_guest_type'];
        $tx_rsvp = $data['tx_rsvp'];
        $fl_outbound_transport = $data['fl_outbound_transport'];
        $fl_inbound_transport = $data['fl_inbound_transport'];
        $tx_nm_rsvp = $_SESSION['nm_username'];
        $tx_verify_key = Rsvp::generateKey();

        $confirm_link = SITE_HOME.'rsvp-confirm.php?key='.$tx_verify_key;

        $lead_guest = new Rsvp();
        $lead_guest->nm_firstname = $data['nm_firstname'];
        $lead_guest->nm_surname = $data['nm_surname'];
        $lead_guest->id_guest_type = $id_guest_type;
        $lead_guest->tx_rsvp = $tx_rsvp;
        $lead_guest->tx_dietary = $data['tx_dietary'];
        $lead_guest->fl_outbound_transport = $fl_outbound_transport;
        $lead_guest->fl_inbound_transport = $fl_inbound_transport;
        $lead_guest->tx_nm_rsvp = $tx_nm_rsvp.' (lead)';
        $lead_guest->tx_verify_key = $tx_verify_key;
        $lead_guest->save();

        if(count($data['nm_firstname_guest']) > 0) {
            for($i = 0; $i <= count($data['nm_firstname_guest']); $i++) {
                if($data['nm_firstname_guest'][$i] == '') continue;

                $behalf_guest = new Rsvp();
                $behalf_guest->nm_firstname = $data['nm_firstname_guest'][$i];
                $behalf_guest->nm_surname = $data['nm_surname_guest'][$i];
                $behalf_guest->id_guest_type = $id_guest_type;
                $behalf_guest->tx_rsvp = $tx_rsvp;
                $behalf_guest->tx_dietary = $data['tx_dietary_guest'][$i];
                $behalf_guest->fl_outbound_transport = $fl_outbound_transport;
                $behalf_guest->fl_inbound_transport = $fl_inbound_transport;
                $behalf_guest->tx_nm_rsvp = $tx_nm_rsvp;
                $behalf_guest->tx_verify_key = $tx_verify_key;
                $behalf_guest->save();
            }
        }

        $mail_to = $data['tx_email'];
        $mail_subject = 'RSVP Online Confirmation';
        $mail_headers = "From: Sean and Karla Wedding Site <no-reply@sean-karla-wedding.co.uk> \r\n";
        $mail_body = "
Hi {$tx_nm_rsvp},

Thank you for filling in the online RSVP for our wedding. To verify and complete the RSVP please click on the link below:
{$confirm_link}

If you cannot click on the link, you can copy and paste the link into a browser, please ensure the full link has been copied.

Thanks,

Karla and Sean
x
        ";

        if(mail($mail_to,$mail_subject,$mail_body,$mail_headers)) {
            return true;
       }

        return false;
    }

    public static function verifyRsvpResponse($key)
    {
        $sql = "
            SELECT *
            FROM sk_rsvp_confirm RC
            INNER JOIN sk_guest_type GT ON GT.id_guest_type = RC.id_guest_type
            WHERE tx_verify_key = ?
        ";
        $stmt = Database::db()->prepare($sql);
        $stmt->bind_param('s',$key);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $unmatched_guests = array();
            $matched_guests = array();
            $multiple_match_guests = array();

            while ($row = Database::fetchObject($stmt)) {
                $matched_guest = self::checkGuestExists($row);

                if ($matched_guest) :
                    if(count($matched_guest) > 1) {
                        //We've matched more than one guest for this notify
                        foreach($matched_guest as $guest) :
                            $multiple_match_guests[$row->id_rsvp_confirm][] = $guest;
                            $rsvp = new Rsvp($row->id_rsvp_confirm);
                            $rsvp->fl_confirmed = 1;
                            $rsvp->save();
                        endforeach;
                    } else {
                        $matched_guest = reset($matched_guest);

                        //Update matched guest with rsvp details
                        $rsvp = new Rsvp($row->id_rsvp_confirm);
                        $rsvp->fl_confirmed = 1;
                        $rsvp->fl_matched = 1;
                        $rsvp->save();

                        $guest = new Guest($matched_guest->id_guest_list);
                        $guest->tx_rsvp = $row->tx_rsvp;
                        $guest->tx_dietary = $row->tx_dietary;
                        $guest->fl_outbound_transport = $row->fl_outbound_transport;
                        $guest->fl_inbound_transport = $row->fl_inbound_transport;
                        $guest->id_rsvp_confirm = $row->id_rsvp_confirm;
                        $guest->save();
                        $matched_guests[] = $guest;
                    }
                else :
                    // update rsvp details and mark as confirmed and put into unmatched array
                    $unmatched_guests[] = $row;
                    $rsvp = new Rsvp($row->id_rsvp_confirm);
                    $rsvp->fl_confirmed = 1;
                    $rsvp->save();
                endif;
            }

            $mail_headers = "From: Sean and Karla Wedding Site <no-reply@sean-karla-wedding.co.uk> \r\n";
            if(count($unmatched_guests) > 0) {
               //send email to me notifying to sort this shit out.
$mail_body = "
You have received an RSVP but the following guests could not be matched:
";
foreach($unmatched_guests as $guest) {
$mail_body .= "
Name: {$guest->nm_firstname} {$guest->nm_surname},
Guest type: {$guest->nm_guest_type},
RSVP by: {$guest->tx_nm_rsvp}
RSVP: {$guest->tx_rsvp}
-------------------------------------------------
";
}

$mail_body .= "
Please review and correct within the admin";

                mail('karla.fry86@gmail.com','Wedding Website RSVP mismatch notification',$mail_body,$mail_headers);
            }

            if(count($matched_guests) > 0) {
                //send email to notify me
$mail_body = "
You have received an RSVP for the following guests:
";
foreach($matched_guests as $id_guest => $guest) {
    $guest->nm_guest_type = $guest->id_guest_type == 1 ? 'Day Guest' : 'Evening Guest';
$mail_body .= "
Name: {$guest->nm_firstname} {$guest->nm_surname},
Guest type: {$guest->nm_guest_type},
RSVP: {$guest->tx_rsvp}
-------------------------------------------------
";
}
                mail('karla.fry86@gmail.com','Wedding Website RSVP notification',$mail_body,$mail_headers);
            }

            if(count($multiple_match_guests) > 0) {
                //send email to notify me
                $mail_body = "
You have received an RSVP but the guest matched the following multiple guests:
";
                foreach($multiple_match_guests as $id_rsvp => $guests) {
                    $rvsp = new Rsvp($id_rsvp);
                    $rvsp->nm_guest_type = $rvsp->id_guest_type == 1 ? 'Day Guest' : 'Evening Guest';
                    $mail_body .= "
Name: {$rvsp->nm_firstname} {$rvsp->nm_surname},
Guest type: {$rvsp->nm_guest_type},
RSVP: {$rvsp->tx_rsvp}
MATCHED THE FOLLOWING:
";
                    foreach($guests as $id_guest => $guest) {
                        $guest->nm_guest_type = $guest->id_guest_type == 1 ? 'Day Guest' : 'Evening Guest';
                        $mail_body .= "
Name: {$guest->nm_firstname} {$guest->nm_surname},
Alt Names: {$guest->tx_alt_names},
Guest type: {$guest->nm_guest_type},
";
                    }
$mail_body .= "
-------------------------------------------------
";
                }
                $mail_body .= "
Please review and correct within the admin";

                mail('karla.fry86@gmail.com','Wedding Website RSVP multiple match notification',$mail_body,$mail_headers);
            }

            return true;
        }

        throw new Exception('Could not match verification key!');
    }

    public static function getConfirmedNotMatchedRsvps()
    {
        $sql = "
            SELECT *
            FROM sk_rsvp_confirm
            WHERE fl_confirmed = 1
            AND fl_matched = 0;
        ";
        $stmt = Database::db()->prepare($sql);
        $stmt->execute();

        $rsvps = array();
        while($row = Database::fetchObject($stmt)) {
            $rsvps[$row->id_rsvp_confirm] = new Rsvp($row->id_rsvp_confirm);
        }

        return $rsvps;
    }

    public static function generateKey()
    {
        return md5('barnesWed2018'.time());
    }
    
}