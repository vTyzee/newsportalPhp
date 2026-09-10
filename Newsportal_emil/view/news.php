<?php

class ViewNews
{
    public static function NewsByCategory($arr)
    {
        foreach ($arr as $value) {

            echo '<img src="data:image/jpeg;base64,' .
                base64_encode($value['picture']) .
                '" width="150">';

            echo '<h2>' . $value['title'] . '</h2>';

            Controller::CommentsCount($value['id']);

            echo '<br>';

            echo '<a href="news?id=' .
                $value['id'] .
                '">Edasi</a><br>';
        }
    }

    public static function AllNews($arr)
    {
        foreach ($arr as $value) {

            echo '<h2>' . $value['title'] . '</h2>';

            Controller::CommentsCount($value['id']);

            echo '<br>';

            echo '<a href="news?id=' .
                $value['id'] .
                '">Edasi</a><br>';
        }
    }

    public static function ReadNews($n)
    {
        echo '<h2>' . $n['title'] . '</h2>';

        Controller::CommentsCountWithAnchor($n['id']);

        echo '<br>';

        echo '<img src="data:image/jpeg;base64,' .
            base64_encode($n['picture']) .
            '" width="150">';

        echo '<p>' . $n['text'] . '</p>';
    }
}