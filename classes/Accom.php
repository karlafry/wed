<?php


class Accom
{
    public $id_accom;
    public $nm_accom;
    public $tx_website;
    public $tx_website_display;
    public $tx_contact;
    public $tx_img_filename;
    public $map_lat;
    public $map_lng;

    const NEW_PLACE_LAT = '50.918666';
    const NEW_PLACE_LNG = '-1.195468';

    public function __construct($id_accom = 0)
    {
        if($id_accom > 0) {
            $sql = "
                SELECT * FROM sk_accom WHERE id_accom = ?
            ";
            $stmt = Database::db()->prepare($sql);
            $stmt->bind_param('i',$id_accom);
            $stmt->execute();

            $row = Database::fetchObject($stmt);

            if($row) {
                $this->id_accom = $row->id_accom;
                $this->nm_accom = $row->nm_accom;
                $this->tx_website = $row->tx_website;
                $this->tx_website_display = $row->tx_website_display;
                $this->tx_contact = $row->tx_contact;
                $this->tx_img_filename = $row->tx_img_filename;
                $this->map_lat = $row->map_lat;
                $this->map_lng = $row->map_lng;
            }
        }
    }

    public static function getAllAccoms()
    {
        $sql = "
                SELECT id_accom,
                ( 3959 * ACOS( COS( RADIANS(?) ) * COS( RADIANS( map_lat ) )
                * COS( RADIANS( map_lng ) - RADIANS(?) ) + SIN( RADIANS(?) )
                * SIN( RADIANS( map_lat ) ) ) ) AS distance
                FROM sk_accom
                ORDER BY distance
        ";

        $center_lat = self::NEW_PLACE_LAT;
        $center_lng = self::NEW_PLACE_LNG;

        $stmt = Database::db()->prepare($sql);
        $stmt->bind_param('sss',
            $center_lat,
            $center_lng,
            $center_lat
        );
        $stmt->execute();

        $accoms = array();
        while($row = Database::fetchObject($stmt)) {
            $accom = new Accom($row->id_accom);
            $accom->distance = $row->distance;

            $accoms[$row->id_accom] = $accom;
        }

        return $accoms;
    }
}