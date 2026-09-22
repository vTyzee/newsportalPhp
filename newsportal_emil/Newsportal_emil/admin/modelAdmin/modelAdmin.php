<?php

class modelAdmin
{
    public static function userAuthentication()
    {
        if (!isset($_POST['btnLogin'])) {
            return false;
        }

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($email == '' || $password == '') {
            $_SESSION['errorstring'] = 'Sisesta e-post ja parool';
            return false;
        }

        $db = new Database();

        $user = $db->getOne(
            "SELECT * FROM users WHERE email = ?",
            [$email]
        );

        if ($user && password_verify($password, $user['password'])) {

            session_regenerate_id(true);

            $_SESSION['userId'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['status'] = $user['status'];

            unset($_SESSION['errorstring']);

            return true;
        }

        $_SESSION['errorstring'] =
            'Vale e-post või parool';

        return false;
    }

    public static function userLogout()
    {
        unset($_SESSION['userId']);
        unset($_SESSION['username']);
        unset($_SESSION['status']);
        unset($_SESSION['errorstring']);

        return true;
    }
}

?>