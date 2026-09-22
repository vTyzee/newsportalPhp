<?php

class controllerAdmin
{
    public static function formLoginSite()
    {
        if (isset($_SESSION['userId'])) {

            include_once 'viewAdmin/startAdmin.php';

        } else {

            include_once 'viewAdmin/formLogin.php';

        }
    }

    public static function loginAction()
    {
        $login = modelAdmin::userAuthentication();

        if ($login) {

            header('Location: ./');
            exit;

        } else {

            include_once 'viewAdmin/formLogin.php';

        }
    }

    public static function logoutAction()
    {
        modelAdmin::userLogout();

        header('Location: ./');
        exit;
    }

    public static function error404()
    {
        include_once 'viewAdmin/error404.php';
    }
}

?>