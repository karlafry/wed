<?php

if(strpos($_SERVER['HTTP_HOST'], 'localhost') !== false)
{
    /* DEV PATH DETAILS */


    // IN-HOUSE ROOT ADDRESSES (must end with '/')
    $site_home 		= 'http://'.$_SERVER['HTTP_HOST'].'/DEV/sean-karla-wedding/';
    $static_home 	= 'http://'.$_SERVER['HTTP_HOST'].'/DEV/sean-karla-wedding/';
    $absolute_path 	= $_SERVER['DOCUMENT_ROOT'].'/DEV/sean-karla-wedding/';

    //---- DB DETAILS  -------------------------------------------------------------

    $db_host = "localhost";
    $db_name = "sk-wedding";
    $db_username = "root";
    $db_password = "";
}
elseif(strpos($_SERVER['HTTP_HOST'], 'karlafry.co.uk') !== false)
{
    // CLIENT DEV ROOT ADDRESSES (must end with '/')
    $site_home 		= 'http://'.$_SERVER['HTTP_HOST'].'/clients/sean-karla-wedding/';
    $static_home 	= 'http://'.$_SERVER['HTTP_HOST'].'/clients/sean-karla-wedding/';
    $absolute_path 	= $_SERVER['DOCUMENT_ROOT'].'/clients/sean-karla-wedding/';

    //----- DB DETAILS  -------------------------------------------------------------

    $db_host = "213.171.200.80";
    $db_name = "sk-wedding";
    $db_username = "sk_wedding";
    $db_password = "SGakF!3HCp9$";

}
else
{
    /* LIVE PATH DETAILS  */

    // IN-HOUSE ROOT ADDRESSES (must end with '/')
    $site_home 		= 'http://'.$_SERVER['HTTP_HOST'].'/';
    $static_home 	= 'http://'.$_SERVER['HTTP_HOST'].'/';
    $absolute_path 	= $_SERVER['DOCUMENT_ROOT'].'/';

    //----- DB DETAILS  -------------------------------------------------------------

    $db_host = "213.171.200.80";
    $db_name = "sk-wedding";
    $db_username = "sk_wedding";
    $db_password = "SGakF!3HCp9$";

}

//------ OTHER PATH DETAILS ------------------------------------------------------

// DOMAIN NAME WHEN LIVE/DEV/STAGING
$live_root_domain = substr( $_SERVER['HTTP_HOST'], (strpos($_SERVER['HTTP_HOST'], '.')+1), strlen($_SERVER['HTTP_HOST']) );

// If the site is a sub-site on a domain
$additional_folder_name = '';

if(strpos($_SERVER['HTTP_HOST'], 'localhost') === false)
{
    set_include_path('/var/www/vhosts/'.$live_root_domain.'/httpdocs/'.$additional_folder_name);
    $absolute_path = $_SERVER['DOCUMENT_ROOT'].'/'.$additional_folder_name;
}

define('STATIC_HOME', $static_home);
define('SITE_HOME', $site_home);
define('ABSOLUTE_PATH', $absolute_path);
define('DBHOST', $db_host);
define('DBUSER', $db_username);
define('DBPASS', $db_password);
define('DBNAME', $db_name);

session_start();
//Autoload classes

spl_autoload_register(function ($class_name) {
    require_once(ABSOLUTE_PATH.'classes/' . $class_name . '.php');
});

// tidy up - don't need these anymore

unset($static_home);
unset($site_home);
unset($absolute_path);

unset($live_root_domain);
unset($additional_folder_name);

?>