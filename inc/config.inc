<?php
if(strpos($_SERVER['HTTP_HOST'], 'localhost') !== false || strpos($_SERVER['HTTP_HOST'], 'spongebob') !== false)
{
    /* DEV PATH DETAILS */

    // IN-HOUSE ROOT ADDRESSES (must end with '/')
    $site_home 		= 'http://'.$_SERVER['HTTP_HOST'].'/DEV/sean-karla-wedding/';
    $static_home 	= 'http://'.$_SERVER['HTTP_HOST'].'/DEV/sean-karla-wedding/';
    $absolute_path 	= $_SERVER['DOCUMENT_ROOT'].'/DEV/sean-karla-wedding/';
    define('DEV_MODE', true);
    error_reporting(E_ALL & ~E_STRICT & ~E_NOTICE & ~E_DEPRECATED);

    //---- DB DETAILS  -------------------------------------------------------------
    $db_host = "localhost";
    $db_name = "skWedding";
    $db_username = "sk_wedding";
    $db_password = "SGakF!3HCp9$";
}
elseif(strpos($_SERVER['HTTP_HOST'], 'karlafry.co.uk') !== false)
{
    // CLIENT DEV ROOT ADDRESSES (must end with '/')
    $site_home 		= 'http://'.$_SERVER['HTTP_HOST'].'/clients/sean-karla-wedding/';
    $static_home 	= 'http://'.$_SERVER['HTTP_HOST'].'/clients/sean-karla-wedding/';
    $absolute_path 	= $_SERVER['DOCUMENT_ROOT'].'/clients/sean-karla-wedding/';
    define('DEV_MODE', true);
    error_reporting(0);

    //----- DB DETAILS  -------------------------------------------------------------
    $db_host = "213.171.200.80";
    $db_name = "skWeddingTest";
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
    define('DEV_MODE', false);
    error_reporting(0);

    //----- DB DETAILS  -------------------------------------------------------------
    $db_host = "213.171.200.92";
    $db_name = "skWedding";
    $db_username = "sk_wedding";
    $db_password = "SGakF!3HCp9$";

}

//------ OTHER PATH DETAILS ------------------------------------------------------

// DOMAIN NAME WHEN LIVE/DEV/STAGING
$live_root_domain = substr( $_SERVER['HTTP_HOST'], (strpos($_SERVER['HTTP_HOST'], '.')+1), strlen($_SERVER['HTTP_HOST']) );

// If the site is a sub-site on a domain
$additional_folder_name = '';

if(!DEV_MODE)
{
    set_include_path('/var/www/vhosts/'.$live_root_domain.'/httpdocs/'.$additional_folder_name);
    $absolute_path = $_SERVER['DOCUMENT_ROOT'].'/'.$additional_folder_name;
}

define('STATIC_HOME', $static_home);
define('SITE_HOME', $site_home);
define('SITE_HOME_ADMIN', $site_home.'admin/');
define('ABSOLUTE_PATH', $absolute_path);
define('DBHOST', $db_host);
define('DBUSER', $db_username);
define('DBPASS', $db_password);
define('DBNAME', $db_name);

//define('INSTA_ACCESS_TOKEN', '2588795.a80768b.3429a7954c6b44aea571fb98cb2ad977');
define('INSTA_ACCESS_TOKEN', '2588795.ba4c844.c4d56f83974049af8cded9eb352932ac');

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