<?php

class controllerAdminNews
{
    private static function checkAdmin()
    {
        if (!isset($_SESSION['userId']) || ($_SESSION['status'] ?? '') !== 'admin') {
            header('Location: ./');
            exit;
        }
    }

    public static function NewsList()
    {
        self::checkAdmin();
        $arr = modelAdminNews::getNewsList();
        include __DIR__ . '/../viewAdmin/newsList.php';
    }

    public static function newsAddForm()
    {
        self::checkAdmin();
        $arr = modelAdminCategory::getCategoryList();
        include __DIR__ . '/../viewAdmin/newsAddForm.php';
    }

    public static function newsAddResult()
    {
        self::checkAdmin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['save'])) {
            header('Location: newsAdd');
            exit;
        }
        $arr = modelAdminCategory::getCategoryList();
        $test = modelAdminNews::getNewsAdd();
        include __DIR__ . '/../viewAdmin/newsAddForm.php';
    }

    public static function newsEditForm()
    {
        self::checkAdmin();
        $id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);
        $news = $id ? modelAdminNews::getNewsById($id) : false;
        if (!$news) {
            header('Location: newsAdmin');
            exit;
        }
        $arr = modelAdminCategory::getCategoryList();
        include __DIR__ . '/../viewAdmin/newsEditForm.php';
    }

    public static function newsEditResult()
    {
        self::checkAdmin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['save'])) {
            header('Location: newsAdmin');
            exit;
        }
        $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
        $news = $id ? modelAdminNews::getNewsById($id) : false;
        if (!$news || !isset($_SESSION['editToken']) || !hash_equals($_SESSION['editToken'], $_POST['token'] ?? '')) {
            header('Location: newsAdmin');
            exit;
        }
        $saved = modelAdminNews::updateNews((int)$id);
        $news = modelAdminNews::getNewsById($id);
        $arr = modelAdminCategory::getCategoryList();
        include __DIR__ . '/../viewAdmin/newsEditForm.php';
    }

    public static function newsDeleteForm()
    {
        self::checkAdmin();
        $id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);
        $news = $id ? modelAdminNews::getNewsById($id) : false;
        if (!$news) {
            header('Location: newsAdmin');
            exit;
        }
        $_SESSION['deleteToken'] = bin2hex(random_bytes(16));
        include __DIR__ . '/../viewAdmin/newsDeleteForm.php';
    }

    public static function newsDeleteResult()
    {
        self::checkAdmin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: newsAdmin');
            exit;
        }
        $token = $_POST['token'] ?? '';
        if (!isset($_SESSION['deleteToken']) || !hash_equals($_SESSION['deleteToken'], $token)) {
            header('Location: newsAdmin');
            exit;
        }
        unset($_SESSION['deleteToken']);
        $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
        if ($id) {
            modelAdminNews::deleteNews((int)$id);
        }
        header('Location: newsAdmin');
        exit;
    }
}
