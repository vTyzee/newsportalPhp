<?php

class ViewNews
{
    public static function NewsByCategory($arr)
    {
        foreach ($arr as $value) {

            $info = @getimagesizefromstring($value['picture']);
            $mime = $info['mime'] ?? 'image/jpeg';
            echo '<img src="data:' . $mime . ';base64,' .
                base64_encode($value['picture']) .
                '" width="150">';

            echo '<h2>' . htmlspecialchars($value['title'], ENT_QUOTES, 'UTF-8') . '</h2>';

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

            echo '<h2>' . htmlspecialchars($value['title'], ENT_QUOTES, 'UTF-8') . '</h2>';

            Controller::CommentsCount($value['id']);

            echo '<br>';

            echo '<a href="news?id=' .
                $value['id'] .
                '">Edasi</a><br>';
        }
    }

    public static function ReadNews($n)
    {
        echo '<h2>' . htmlspecialchars($n['title'], ENT_QUOTES, 'UTF-8') . '</h2>';

        Controller::CommentsCountWithAnchor($n['id']);

        echo '<br>';

        $info = @getimagesizefromstring($n['picture']);
        $mime = $info['mime'] ?? 'image/jpeg';
        echo '<img src="data:' . $mime . ';base64,' .
            base64_encode($n['picture']) .
            '" width="150">';

        echo '<p>' . nl2br(htmlspecialchars($n['text'], ENT_QUOTES, 'UTF-8')) . '</p>';
    }
}