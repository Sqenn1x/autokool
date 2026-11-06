<?php
class Course
{
    // aktiivsed kursused (valikuliselt ühe kategooria kaupa)
    public static function getAllCourses($category = null)
    {
        $query = 'SELECT * FROM courses WHERE active = 1';
        $params = [];
        if ($category) {
            $query .= ' AND category = ?';
            $params[] = $category;
        }
        $query .= ' ORDER BY category, price';
        $db = new Database();
        $arr = $db->getAll($query, $params);
        return $arr;
    }

    public static function getCategories()
    {
        $db = new Database();
        $rows = $db->getAll('SELECT DISTINCT category FROM courses WHERE active = 1 ORDER BY category');
        return array_column($rows, 'category');
    }

    public static function getCourseByID($id)
    {
        $db = new Database();
        $c = $db->getOne('SELECT * FROM courses WHERE id = ?', [(int)$id]);
        return $c;
    }
}
