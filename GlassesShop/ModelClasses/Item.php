<?php

class Item
{
    public static function getAllItems()
    {
        global $capsule;
        return $capsule->table("items")->get();
    }
    
    public static function search($column, $keyword)
    {
        global $capsule;
        return $capsule->table("items")->where($column, 'LIKE', "%$keyword%")->get();
    }
}
