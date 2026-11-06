<?php
class modelAdminBooking
{
    public static $labels = ['new' => 'Uus', 'confirmed' => 'Kinnitatud', 'cancelled' => 'Tühistatud'];

    //-------------------------List
    public static function getBookingList($status = null)
    {
        $sql = 'SELECT bookings.*, courses.title AS course_title FROM bookings LEFT JOIN courses ON courses.id = bookings.course_id';
        $params = [];
        if ($status !== null && isset(self::$labels[$status])) {
            $sql .= ' WHERE bookings.status = ?';
            $params[] = $status;
        }
        $sql .= ' ORDER BY bookings.id DESC';
        $db = new Database();
        return $db->getAll($sql, $params);
    }

    public static function getCounts()
    {
        $db = new Database();
        $counts = ['new' => 0, 'confirmed' => 0, 'cancelled' => 0];
        foreach ($db->getAll('SELECT status, COUNT(*) AS n FROM bookings GROUP BY status') as $row) {
            $counts[$row['status']] = (int)$row['n'];
        }
        return $counts;
    }

    //-------------------------detail id
    public static function getBookingDetail($id)
    {
        $db = new Database();
        return $db->getOne('SELECT bookings.*, courses.title AS course_title FROM bookings LEFT JOIN courses ON courses.id = bookings.course_id WHERE bookings.id = ?', [(int)$id]);
    }

    //-------------------------status change
    public static function getBookingStatus($id)
    {
        $test = false;
        $status = $_POST['status'] ?? '';
        if (isset(self::$labels[$status])) {
            $db = new Database();
            $test = $db->executeRun('UPDATE bookings SET status = ? WHERE id = ?', [$status, (int)$id]);
        }
        return $test;
    }

    //-------------------------delete
    public static function getBookingDelete($id)
    {
        $test = false;
        if (isset($_POST['save'])) {
            $db = new Database();
            $test = $db->executeRun('DELETE FROM bookings WHERE id = ?', [(int)$id]);
        }
        return $test;
    }
}
