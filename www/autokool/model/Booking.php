<?php
class Booking
{
    // vormi andmete kontroll, tagastab vigade massiivi (tühi = korras)
    public static function validate($d)
    {
        $errors = [];
        $course = Course::getCourseByID($d['course_id']);
        if (!$course || !$course['active']) {
            $errors[] = 'Palun vali kursus.';
        }
        if (mb_strlen($d['name']) < 2) {
            $errors[] = 'Palun sisesta oma nimi.';
        }
        if (!filter_var($d['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'E-posti aadress ei ole korrektne.';
        }
        if (!preg_match('/^\+?[0-9 ]{7,20}$/', $d['phone'])) {
            $errors[] = 'Telefoninumber ei ole korrektne.';
        }
        if (mb_strlen($d['message']) > 1000) {
            $errors[] = 'Sõnum on liiga pikk (kuni 1000 märki).';
        }
        return $errors;
    }

    public static function bookingCreate($d)
    {
        $db = new Database();
        $q = $db->executeRun(
            'INSERT INTO bookings (course_id,name,email,phone,message) VALUES (?,?,?,?,?)',
            [$d['course_id'], $d['name'], $d['email'], $d['phone'], $d['message']]
        );
        return $q;
    }
}
