<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="en-gb" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex" />
    <title>Admin | <?=$page_title?> | Sean &amp; Karla are getting married </title>

    <!-- CSS and Fonts
    ================================================== -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?= SITE_HOME;?>css/style.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?= SITE_HOME;?>admin/css/admin_style.css" type="text/css" media="screen" />

    <!-- jQuery
    ================================================= -->
    <script src="http://code.jquery.com/jquery-2.2.4.min.js"></script>
</head>
<body>
<div id="wrapper">
<?php
    if($_SESSION['id_admin_user'] > 0) :
        include ABSOLUTE_PATH.'admin/inc/header.inc';
    endif;
?>