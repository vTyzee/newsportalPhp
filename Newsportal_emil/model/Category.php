<?php

class Category
{
    public static function getAllCategory()
    {
        $db = new Database();

        return $db->getAll(
            "SELECT * FROM category ORDER BY name"
        );
    }
}