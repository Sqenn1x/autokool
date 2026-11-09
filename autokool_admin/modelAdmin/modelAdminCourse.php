<?php
class modelAdminCourse
{
    //-------------------------List
    public static function getCourseList()
    {
        $db = new Database();
        return $db->getAll('SELECT * FROM courses ORDER BY category, price');
    }

    //-------------------------detail id
    public static function getCourseDetail($id)
    {
        $db = new Database();
        return $db->getOne('SELECT * FROM courses WHERE id = ?', [(int)$id]);
    }

    // loeb ja kontrollib vormi andmed, vea korral null
    private static function readPost()
    {
        $d = [
            'category' => trim($_POST['category'] ?? ''),
            'title' => trim($_POST['title'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'price' => (float)str_replace(',', '.', $_POST['price'] ?? '0'),
            'duration_weeks' => max(1, (int)($_POST['duration_weeks'] ?? 1)),
            'theory_hours' => max(0, (int)($_POST['theory_hours'] ?? 0)),
            'driving_hours' => max(0, (int)($_POST['driving_hours'] ?? 0)),
            'active' => isset($_POST['active']) ? 1 : 0,
        ];
        if ($d['category'] === '' || mb_strlen($d['category']) > 20) return null;
        if ($d['title'] === '' || mb_strlen($d['title']) > 150) return null;
        if ($d['description'] === '' || $d['price'] <= 0) return null;
        return array_values($d);
    }

    //-------------------------Add
    public static function getCourseAdd()
    {
        $test = false;
        if (isset($_POST['save'])) {
            $d = self::readPost();
            if ($d !== null) {
                $db = new Database();
                $test = $db->executeRun('INSERT INTO courses (category,title,description,price,duration_weeks,theory_hours,driving_hours,active) VALUES (?,?,?,?,?,?,?,?)', $d);
            }
        }
        return $test;
    }

    //-------------------------Edit
    public static function getCourseEdit($id)
    {
        $test = false;
        if (isset($_POST['save'])) {
            $d = self::readPost();
            if ($d !== null) {
                $d[] = (int)$id;
                $db = new Database();
                $test = $db->executeRun('UPDATE courses SET category=?, title=?, description=?, price=?, duration_weeks=?, theory_hours=?, driving_hours=?, active=? WHERE id=?', $d);
            }
        }
        return $test;
    }

    //-------------------------Delete (ei kustuta, kui kursusel on registreerumisi)
    public static function getCourseDelete($id)
    {
        $test = false;
        if (isset($_POST['save'])) {
            $db = new Database();
            $used = $db->getOne('SELECT COUNT(*) AS n FROM bookings WHERE course_id = ?', [(int)$id]);
            if ((int)$used['n'] === 0) {
                $test = $db->executeRun('DELETE FROM courses WHERE id = ?', [(int)$id]);
            }
        }
        return $test;
    }
}
