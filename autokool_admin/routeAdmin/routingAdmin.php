<?php
$host = explode('?', $_SERVER['REQUEST_URI'])[0];
$num = substr_count($host, '/');
$path = explode('/', $host)[$num];
$logged = isset($_SESSION['sessionId']);

if (!$logged and !in_array($path, ['', 'index.php', 'login'], true)) {
    // Ilma sisselogimata pääseb ainult login-vormini
    controllerAdmin::formLoginSite();
}
elseif ($path == '' or $path == 'index.php') {
    // Avaleht - login-vorm või admin-paneel
    controllerAdmin::formLoginSite();
}
// ------ SISENEMINE -------------
elseif ($path == 'login') {
    controllerAdmin::loginAction();
}
elseif ($path == 'logout') {
    controllerAdmin::logoutAction();
}
// ------ REGISTREERUMISED -------------
elseif ($path == 'bookingsAdmin') {
    controllerAdminBooking::bookingList();
}
elseif ($path == 'bookingStatus' and isset($_GET['id'])) {
    controllerAdminBooking::bookingStatus($_GET['id']);
}
elseif ($path == 'bookingDel' and isset($_GET['id'])) {
    controllerAdminBooking::bookingDeleteForm($_GET['id']);
}
elseif ($path == 'bookingDelResult' and isset($_GET['id'])) {
    controllerAdminBooking::bookingDeleteResult($_GET['id']);
}
// ------ KURSUSED -------------
elseif ($path == 'courseAdmin') {
    controllerAdminCourse::courseList();
}
elseif ($path == 'courseAdd') {
    controllerAdminCourse::courseAddForm();
}
elseif ($path == 'courseAddResult') {
    controllerAdminCourse::courseAddResult();
}
elseif ($path == 'courseEdit' and isset($_GET['id'])) {
    controllerAdminCourse::courseEditForm($_GET['id']);
}
elseif ($path == 'courseEditResult' and isset($_GET['id'])) {
    controllerAdminCourse::courseEditResult($_GET['id']);
}
elseif ($path == 'courseDel' and isset($_GET['id'])) {
    controllerAdminCourse::courseDeleteForm($_GET['id']);
}
elseif ($path == 'courseDelResult' and isset($_GET['id'])) {
    controllerAdminCourse::courseDeleteResult($_GET['id']);
}
else {
    // Lehte ei ole
    controllerAdmin::error404();
}
