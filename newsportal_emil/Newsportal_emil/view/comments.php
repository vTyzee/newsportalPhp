<?php

class ViewComments
{
    public static function CommentsForm()
    {
        $id = htmlspecialchars($_GET['id']);

        echo '
            <form action="insertcomment" method="GET">
                <input type="hidden" name="id" value="' . $id . '">

                <label>Teie kommentaar:</label>

                <input type="text" name="comment" required>

                <input type="submit" value="Saada">
            </form>
        ';
    }

    public static function CommentsByNews($arr)
    {
        if (!$arr) {
            return;
        }

        echo '<table id="ctable">';

        echo '
            <tr>
                <th>Kommentaar</th>
                <th>Kuupäev</th>
            </tr>
        ';

        foreach ($arr as $value) {
            echo '<tr>';

            echo '<td>' .
                htmlspecialchars($value['text']) .
                '</td>';

            echo '<td>' .
                htmlspecialchars($value['date']) .
                '</td>';

            echo '</tr>';
        }

        echo '</table>';
    }

    public static function CommentsCount($value)
    {
        if ($value['count'] > 0) {
            echo '<b style="color:red;">(' .
                $value['count'] .
                ')</b>';
        }
    }

    public static function CommentsCountWithAnchor($value)
    {
        if ($value['count'] > 0) {
            echo '<b><a href="#ctable">(' .
                $value['count'] .
                ')</a></b>';
        }
    }
}