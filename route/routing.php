<?php
//arvuta marsruut aadressireast
$host = explode('?', $_SERVER['REQUEST_URI'])[0];
$num = substr_count($host, '/');
$path = explode('/', $host)[$num];

if ($path == '' OR $path == 'index' OR $path == 'index.php') {
    $response = Controller::StartSite();
}
elseif ($path == 'courses') {
    $response = Controller::AllCourses();
}
elseif ($path == 'course' and isset($_GET['id'])) {
    $response = Controller::CourseByID($_GET['id']);
}
elseif ($path == 'instructors') {
    $response = Controller::AllInstructors();
}
elseif ($path == 'contact') {
    $response = Controller::Contact();
}
//-----------------registreerumine kursusele
elseif ($path == 'bookingForm') {  // vorm
    $response = Controller::bookingForm();
}
elseif ($path == 'bookingAnswer' and $_SERVER['REQUEST_METHOD'] === 'POST') {  // salvestamine
    $response = Controller::bookingAnswer();
}
else {
    $response = Controller::error404();
}
