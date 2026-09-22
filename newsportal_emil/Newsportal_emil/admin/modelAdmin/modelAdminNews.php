<?php

class modelAdminNews
{
    public static function getNewsList()
    {
        $db = new Database();
        return $db->getAll(
            'SELECT news.id, news.title, category.name, users.username
             FROM news
             INNER JOIN category ON news.category_id = category.id
             INNER JOIN users ON news.user_id = users.id
             ORDER BY news.id DESC'
        );
    }

    public static function getNewsById($id)
    {
        $db = new Database();
        return $db->getOne(
            'SELECT id, title, text, category_id, user_id FROM news WHERE id = ?',
            [(int)$id]
        );
    }

    private static function getPicture($required)
    {
        if (!isset($_FILES['picture']) || $_FILES['picture']['error'] === UPLOAD_ERR_NO_FILE) {
            return $required ? false : null;
        }
        $file = $_FILES['picture'];
        if ($file['error'] !== UPLOAD_ERR_OK || $file['size'] <= 0 || $file['size'] > 5 * 1024 * 1024 || !is_uploaded_file($file['tmp_name'])) {
            return false;
        }
        $info = getimagesize($file['tmp_name']);
        if (!$info || !in_array($info['mime'], ['image/jpeg', 'image/png', 'image/gif', 'image/webp'], true)) {
            return false;
        }
        return file_get_contents($file['tmp_name']);
    }

    private static function formData()
    {
        $title = trim($_POST['title'] ?? '');
        $text = trim($_POST['text'] ?? '');
        $categoryId = filter_var($_POST['idCategory'] ?? null, FILTER_VALIDATE_INT);
        if ($title === '' || $text === '' || mb_strlen($title) > 255 || !$categoryId || $categoryId <= 0) {
            return false;
        }
        $db = new Database();
        if (!$db->getOne('SELECT id FROM category WHERE id = ?', [$categoryId])) {
            return false;
        }
        return [$title, $text, $categoryId];
    }

    public static function getNewsAdd()
    {
        $data = self::formData();
        $image = self::getPicture(true);
        if ($data === false || $image === false) {
            return false;
        }
        $db = new Database();
        return $db->executeRun(
            'INSERT INTO news (title, text, picture, category_id, user_id) VALUES (?, ?, ?, ?, ?)',
            [$data[0], $data[1], $image, $data[2], (int)$_SESSION['userId']]
        );
    }

    public static function updateNews($id)
    {
        $data = self::formData();
        $image = self::getPicture(false);
        if ($id <= 0 || $data === false || $image === false || !self::getNewsById($id)) {
            return false;
        }
        $db = new Database();
        if ($image === null) {
            return $db->executeRun(
                'UPDATE news SET title = ?, text = ?, category_id = ? WHERE id = ?',
                [$data[0], $data[1], $data[2], $id]
            );
        }
        return $db->executeRun(
            'UPDATE news SET title = ?, text = ?, category_id = ?, picture = ? WHERE id = ?',
            [$data[0], $data[1], $data[2], $image, $id]
        );
    }

    public static function deleteNews($id)
    {
        $db = new Database();
        if (!self::getNewsById($id)) {
            return false;
        }
        $db->executeRun('DELETE FROM comments WHERE news_id = ?', [$id]);
        return $db->executeRun('DELETE FROM news WHERE id = ?', [$id]);
    }
}
