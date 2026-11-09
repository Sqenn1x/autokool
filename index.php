<?php
session_start();


$GLOBALS['config'] = require __DIR__ . '/config.php';

require_once __DIR__ . '/inc/database.php';
require_once __DIR__ . '/inc/helpers.php'; 

if (isset($_GET['lang']) && in_array($_GET['lang'], ['et', 'ru'], true)) {
    $_SESSION['language'] = $_GET['lang'];
}

include_once __DIR__ . '/model/Course.php';
include_once __DIR__ . '/model/Instructor.php';
include_once __DIR__ . '/model/Booking.php';


include_once __DIR__ . '/controller/Controller.php';


include __DIR__ . '/route/routing.php';

echo $response ?? '';