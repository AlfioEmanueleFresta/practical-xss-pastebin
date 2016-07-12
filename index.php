<?php

/*
 * A simple and badly written web application to
 *  demonstrate some security vulnerabilities.
 *
 * Copyright 2016 Alfio E. Fresta
 */

ob_start();

require('inc/configuration.php');
require('inc/database.php');
require('inc/functions.php');

require('inc/header.php');

if ( empty($_GET['page']) ) {
    $page = 'index';

} else {
    $page = $_GET['page'];

}

$full_path = "./pages/{$page}.php";

if (!file_exists($full_path)) {
    $full_path = "./pages/404.php";
}

require($full_path);

require('inc/footer.php');
