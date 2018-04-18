<?php

class User
{
    const DAY_PASSWORD = 'testfornow';
    const EVE_PASSWORD = 'evetest';


    public function __construct()
    {

    }

    public static function guestLogin($data)
    {
        if (empty($data)) {
            return 'You must fill in your details';
        }

        if($data['tx_password'] != self::DAY_PASSWORD && $data['tx_password'] != self::EVE_PASSWORD) {
            return 'The password is incorrect, please try again';
        }

        $_SESSION['nm_username'] = $data['nm_username'];

        if($data['tx_password'] == self::DAY_PASSWORD) {
            $_SESSION['id_guest_type'] = 1;
        } else {
            $_SESSION['id_guest_type'] = 2;
        }
        return true;
    }
}