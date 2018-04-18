<?php

/**
 * @author Karla Fry <karla@powder-blue.com>
 */
class Guest
{
    public $id_guest_list;
    public $nm_firstname;
    public $nm_surname;
    public $tx_alt_names;
    public $id_guest_type;
    public $tx_rsvp;
    public $tx_dietary;
    public $fl_outbound_transport;
    public $fl_inbound_transport;
    public $id_rsvp_confirm;

    public function __construct($id_guest_list = 0)
    {
        if($id_guest_list > 0) {
            $sql = "
                SELECT * FROM sk_guest_list WHERE id_guest_list = ?
            ";

            $stmt = Database::db()->prepare($sql);
            $stmt->bind_param('i',$id_guest_list);
            $stmt->execute();

            $row = Database::fetchObject($stmt);

            if($row) {
                $this->id_guest_list = $row->id_guest_list;
                $this->nm_firstname = $row->nm_firstname;
                $this->nm_surname = $row->nm_surname;
                $this->tx_alt_names = $row->tx_alt_names;
                $this->id_guest_type = $row->id_guest_type;
                $this->tx_rsvp = $row->tx_rsvp;
                $this->tx_dietary = $row->tx_dietary;
                $this->fl_outbound_transport = $row->fl_outbound_transport;
                $this->fl_inbound_transport = $row->fl_inbound_transport;
                $this->id_rsvp_confirm = $row->id_rsvp_confirm;
            }
        }
    }

    public function insert()
    {
        $sql = "
            INSERT INTO sk_guest_list
            SET         nm_firstname = ?,
                        nm_surname = ?,
                        tx_alt_names = ?,
                        id_guest_type = ?,
                        tx_rsvp = ?,
                        tx_dietary = ?,
                        fl_outbound_transport = ?,
                        fl_inbound_transport = ?,
                        id_rsvp_confirm = ?
        ";
        $stmt = Database::db()->prepare($sql);
        $stmt->bind_param('sssissiii',
            Database::db()->escape_string($this->nm_firstname),
            Database::db()->escape_string($this->nm_surname),
            Database::db()->escape_string($this->tx_alt_names),
            $this->id_guest_type,
            Database::db()->escape_string($this->tx_rsvp),
            Database::db()->escape_string($this->tx_dietary),
            $this->fl_outbound_transport > 0 ? $this->fl_outbound_transport : 0,
            $this->fl_inbound_transport > 0 ? $this->fl_inbound_transport : 0,
            $this->id_rsvp_confirm > 0 ? $this->id_rsvp_confirm : 0
        );
        $stmt->execute();
    }

    public function update()
    {
        $sql = "
            UPDATE      sk_guest_list
            SET         nm_firstname = ?,
                        nm_surname = ?,
                        tx_alt_names = ?,
                        id_guest_type = ?,
                        tx_rsvp = ?,
                        tx_dietary = ?,
                        fl_outbound_transport = ?,
                        fl_inbound_transport = ?,
                        id_rsvp_confirm = ?
            WHERE       id_guest_list = ?
        ";
        $stmt = Database::db()->prepare($sql);
        $stmt->bind_param('sssissiiii',
            Database::db()->escape_string($this->nm_firstname),
            Database::db()->escape_string($this->nm_surname),
            Database::db()->escape_string($this->tx_alt_names),
            $this->id_guest_type,
            Database::db()->escape_string($this->tx_rsvp),
            Database::db()->escape_string($this->tx_dietary),
            $this->fl_outbound_transport > 0 ? $this->fl_outbound_transport : 0,
            $this->fl_inbound_transport > 0 ? $this->fl_inbound_transport : 0,
            $this->id_rsvp_confirm > 0 ? $this->id_rsvp_confirm : 0,
            $this->id_guest_list
        );
        $stmt->execute();
    }

    public function save()
    {
        if(isset($this->id_guest_list)) {
            $this->update();
        } else {
            $this->insert();
        }
    }

    public static function searchGuests(\stdClass $filters = null)
    {
        $sql = sprintf("
            SELECT id_guest_list
            FROM   sk_guest_list
            %s
        ",
            Database::sqlFromFilters($filters)
        );
        $stmt = Database::db()->prepare($sql);
        $stmt->execute();

        $guests = array();
        while($guest = Database::fetchObject($stmt)) {
            $guests[$guest->id_guest_list] = new Guest($guest->id_guest_list);
        }

        return $guests;
    }
}