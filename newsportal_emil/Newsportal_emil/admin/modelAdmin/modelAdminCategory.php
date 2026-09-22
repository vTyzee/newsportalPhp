<?php

class modelAdminCategory
{
    public static function getCategoryList()
    {
        $db = new Database();

        return $db->getAll(
            "SELECT * FROM category ORDER BY name ASC"
        );
    }
}

?>