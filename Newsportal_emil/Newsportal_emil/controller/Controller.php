<?php

class Controller
{
    public static function StartSite()
    {
        $arr = News::getLast10News();

        include_once 'view/start.php';
    }

    public static function AllCategory()
    {
        $arr = Category::getAllCategory();

        include_once 'view/category.php';
    }

    public static function AllNews()
    {
        $arr = News::getAllNews();

        include_once 'view/allnews.php';
    }

    public static function NewsByCatID($id)
    {
        $arr = News::getNewsByCategoryID($id);

        include_once 'view/catnews.php';
    }

    public static function NewsByID($id)
    {
        $n = News::getNewsByID($id);

        include_once 'view/readnews.php';
    }

    public static function InsertComment($comment, $id)
    {
        Comments::insertComment($comment, $id);

        header("Location: news?id=" . $id . "#ctable");
        exit;
    }

    public static function Comments($newsId)
    {
        $arr = Comments::getCommentByNewsID($newsId);

        ViewComments::CommentsByNews($arr);
    }

    public static function CommentsCount($newsId)
    {
        $value = Comments::getCommentsCountByNewsID($newsId);

        ViewComments::CommentsCount($value);
    }

    public static function CommentsCountWithAnchor($newsId)
    {
        $value = Comments::getCommentsCountByNewsID($newsId);

        ViewComments::CommentsCountWithAnchor($value);
    }

    public static function registerForm()
    {
        include_once 'view/formRegister.php';
    }

    public static function registerUser()
    {
        $result = Register::registerUser();

        include_once 'view/answerRegister.php';
    }

    public static function error404()
    {
        include_once 'view/error404.php';
    }
}