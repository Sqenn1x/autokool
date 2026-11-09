<?php
class controllerAdminBooking
{
    //list Bookings
    public static function bookingList()
    {
        $filter = $_GET['status'] ?? null;
        $arr = modelAdminBooking::getBookingList($filter);
        $counts = modelAdminBooking::getCounts();
        $labels = modelAdminBooking::$labels;
        include_once __DIR__ . '/../viewAdmin/bookingList.php';
    }

    public static function bookingStatus($id)
    {
        csrf_check();
        $test = modelAdminBooking::getBookingStatus($id);
        flash($test ? 'Staatus muudetud.' : 'Staatuse muutmine ebaõnnestus.');
        header('Location: bookingsAdmin');
        exit;
    }

    public static function bookingDeleteForm($id)
    {
        $detail = modelAdminBooking::getBookingDetail($id);
        if (!$detail) {
            controllerAdmin::error404();
            return;
        }
        include_once __DIR__ . '/../viewAdmin/bookingDeleteForm.php';
    }

    public static function bookingDeleteResult($id)
    {
        csrf_check();
        $test = modelAdminBooking::getBookingDelete($id);
        include_once __DIR__ . '/../viewAdmin/bookingDeleteForm.php';
    }

}//class
