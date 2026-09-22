<?php

class News
{
    public static function getLast10News()
    {
        $db = new Database();

        return $db->getAll(
            "SELECT * FROM news ORDER BY id DESC LIMIT 3"
        );
    }

    public static function getAllNews()
    {
        $db = new Database();

        return $db->getAll(
            "SELECT * FROM news ORDER BY id DESC"
        );
    }

    public static function getNewsByCategoryID($id)
    {
        $db = new Database();

        return $db->getAll(
            "SELECT * FROM news
             WHERE category_id = ?
             ORDER BY id DESC",
            [$id]
        );
    }

    public static function getNewsByID($id)
    {
        $db = new Database();

        return $db->getOne(
            "SELECT * FROM news WHERE id = ?",
            [$id]
        );
    }
}