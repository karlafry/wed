<?php
include ('inc/config.inc');

if(isset($_POST)) {
    $login = User::guestLogin($_POST);
    header('Location: ' . $_POST['tx_url'] . ($login !== true ? '?error=' . $login : ''));
} else {
    header('Location: ' . SITE_HOME);
}