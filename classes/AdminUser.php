<?php

/**
 * @author Karla Fry <karla@powder-blue.com>
 */
class AdminUser
{
    public $id_admin_user;
    public $nm_admin_user;
    public $tx_admin_password;

    public function __construct($id_admin_user = 0)
    {
        if($id_admin_user > 0) {
            $sql = "
                SELECT * FROM sk_admin_user WHERE id_admin_user = ?
            ";

            $stmt = Database::db()->prepare($sql);
            $stmt->bind_param('i',$id_admin_user);
            $stmt->execute();
            $row = Database::fetchObject($stmt);

            if($row) {
                $this->id_admin_user = $row->id_admin_user;
                $this->nm_admin_user = $row->nm_admin_user;
                $this->tx_admin_password = $row->tx_admin_password;
            }
        }
    }

    public function save()
    {
        $sql = "
            INSERT INTO sk_admin_user
            SET         nm_admin_user = ?,
                        tx_admin_password = ?
        ";

        $stmt = Database::db()->prepare($sql);
        $stmt->bind_param('ss',
            Database::db()->escape_string($this->nm_admin_user),
            self::generatePassword($this->tx_admin_password)
        );
        $stmt->execute();

        return($stmt->insert_id);
    }

    public static function adminLogin($nm_admin_user, $tx_admin_password)
    {
        if($nm_admin_user == '' || $tx_admin_password == '') {
            throw new Exception('Both Username and Password are required');
        } else {
            $sql = "
                SELECT * FROM sk_admin_user
                WHERE LOWER(nm_admin_user) = ?
                AND   tx_admin_password = ?
            ";
            $stmt = Database::db()->prepare($sql);
            $stmt->bind_param('ss',
                strtolower(Database::db()->escape_string($nm_admin_user)),
                self::generatePassword($tx_admin_password)
            );
            $stmt->execute();

            $row = Database::fetchObject($stmt);

            if($row) {
                $_SESSION['id_admin_user'] = $row->id_admin_user;
                $_SESSION['nm_admin_user'] = $row->nm_admin_user;

                header('Location: ' . SITE_HOME_ADMIN);
            }
        }



    }

    private static function generatePassword($tx_password)
    {
        return strrev(md5($tx_password.'!Fk69nt*'));
    }

    public static function checkLoginStatus()
    {
        if(!isset($_SESSION['id_admin_user'])) {
            header('Location: ' . SITE_HOME_ADMIN.'login.php');
        }
    }
    
}