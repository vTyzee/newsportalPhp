<?php

class Comments
{
    public static function insertComment($comment, $newsId)
    {
        $db = new Database();

        $query = "INSERT INTO comments
                  (user_id, news_id, text, date)
                  VALUES (?, ?, ?, CURRENT_TIMESTAMP)";

        return $db->executeRun(
            $query,
            [2, $newsId, $comment]
        );
    }

    public static function getCommentByNewsID($newsId)
    {
        $db = new Database();

        $query = "SELECT * FROM comments
                  WHERE news_id = ?
                  ORDER BY id DESC";

        return $db->getAll(
            $query,
            [$newsId]
        );
    }

    public static function getCommentsCountByNewsID($newsId)
    {
        $db = new Database();

        $query = "SELECT COUNT(id) AS count
                  FROM comments
                  WHERE news_id = ?";

        return $db->getOne(
            $query,
            [$newsId]
        );
    }
}