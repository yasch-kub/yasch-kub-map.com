<?php

class admin_model
{
    public static function getAllNewAddedPlaces()
    {
        $db = Db::getConnection();
        $query = "SELECT place.id, place.name, category.name as category, place.address, place.info, icon FROM place
            JOIN category ON place.category_id = category.id
            JOIN marker ON category.marker_id = marker.id WHERE place.is_posted = '0'";
        return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function postPlace($id)
    {
        $db = Db::getConnection();
        $query = sprintf("UPDATE place SET is_posted = 1 WHERE place.id = '%s'", $id);

        return $db->exec($query) ? true : false;
    }

    public static function removePlace($id)
    {
        $db = Db::getConnection();
        $query = sprintf("DELETE FROM place WHERE place.id = '%s'", $id);

        return $db->exec($query) ? true : false;
    }

    public static function changePlaceInfoById($info, $id)
    {
        $db = Db::getConnection();
        $query = sprintf("UPDATE place SET place.info = '%s' WHERE place.id = '%s'", $info, $id);

        $db->exec($query);
    }
}