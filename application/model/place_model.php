<?php
class place_model
{
    public static function getAllPlace(){
        $db = Db::getConnection();
        $query = 'select place.name , place.info, icon, longtitude, altitude from place
            join category on place.category_id = category.id
            join marker on category.marker_id = marker.id';
        return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getCategories(){
        $db = Db::getConnection();
        $query = 'select name from category';
        return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
}