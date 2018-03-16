<?php

class User
{
    const PASSWORD = 'testfornow';

    public $nm_username;
    public $tx_password;

    public function __construct()
    {

    }

    public static function login($data)
    {
        if (empty($data)) {
            return 'You must fill in your details';
        }

        if($data['tx_password'] != self::PASSWORD) {
            return 'The password is incorrect, please try again';
        }

        $_SESSION['nm_username'] = $data['nm_username'];
        return true;
    }
}