<?php
class controllerAdmin
{
    // avaleht: login-vorm või admin-paneel
    public static function formLoginSite()
    {
        if (isset($_SESSION['sessionId'])) {
            self::start();
        } else {
            include_once __DIR__ . '/../viewAdmin/formLogin.php';
        }
    }

    // admin-paneeli algleht
    private static function start()
    {
        $counts = modelAdminBooking::getCounts();
        include_once __DIR__ . '/../viewAdmin/startAdmin.php';
    }

    // sisselogimise toiming
    public static function loginAction()
    {
        csrf_check();
        $logIn = modelAdmin::userAuthentication();
        if (isset($logIn) and $logIn == true) {
            self::start();
        } else {
            $_SESSION['errorString'] = 'Vale e-post või parool';
            include_once __DIR__ . '/../viewAdmin/formLogin.php';
        }
    }

    // väljumine admin-paneelist
    public static function logoutAction()
    {
        modelAdmin::userLogout();
        include_once __DIR__ . '/../viewAdmin/formLogin.php';
    }

    // Page Error
    public static function error404()
    {
        http_response_code(404);
        include_once __DIR__ . '/../viewAdmin/error404.php';
    }

}//end class
