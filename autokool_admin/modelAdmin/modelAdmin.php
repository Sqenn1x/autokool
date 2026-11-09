<?php
class modelAdmin
{
    // ADMINI AUTENTIMINE
    public static function userAuthentication()
    {
        if (isset($_SESSION['sessionId'])) {
            return true;
        }
        $logIn = false;
        if (isset($_POST['btnLogin'])) {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = $_POST['password'] ?? '';
            if ($email && $password !== '') {
                $db = new Database();
                $item = $db->getOne('SELECT * FROM `users` WHERE `email` = ?', [strtolower($email)]);
                if ($item != null && password_verify($password, $item['password'])) {
                    session_regenerate_id(true);
                    $_SESSION['sessionId'] = session_id();
                    $_SESSION['userId'] = $item['id'];
                    $_SESSION['name'] = $item['username'];
                    $_SESSION['status'] = $item['status'];
                    $logIn = true;
                }
            }
        }
        return $logIn;
    }

    // VÄLJUMINE ADMINIST
    public static function userLogout()
    {
        unset($_SESSION['sessionId']);
        unset($_SESSION['userId']);
        unset($_SESSION['name']);
        unset($_SESSION['status']);
        session_destroy();
        return;
    }
}
