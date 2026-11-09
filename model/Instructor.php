<?php
class Instructor
{
    public static function getAllInstructors()
    {
        $db = new Database();
        $arr = $db->getAll('SELECT * FROM instructors ORDER BY name');
        return $arr;
    }
}
