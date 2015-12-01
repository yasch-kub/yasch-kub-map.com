<?php
class place_model
{
    /**
     * @return array
     */
    public static function getAllPlace()
    {
        $db = Db::getConnection();
        $query = 'select place.name , place.info, icon, longtitude, altitude from place
            join category on place.category_id = category.id
            join marker on category.marker_id = marker.id';
        return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $category
     */
    public static function getPlaceIconByCategory($category)
    {
        $db = Db::getConnection();
        $query = sprintf("select icon from category join marker on category.marker_id = marker.id AND category.name = '%s'", $category);
        $result = $db->query($query)->fetch(PDO::FETCH_ASSOC);

        return $result['icon'];
    }

    /**
     * @return array
     */
    public static function getCategories()
    {
        $db = Db::getConnection();
        $query = 'select name from category';
        return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *
     */
    public static function addPlace($name, $address, $category, $info, $altitude,$longtitude)
    {
        $db = Db::getConnection();
        $query = sprintf("INSERT INTO place(name, address, category_id, info, altitude, longtitude)
            VALUES('%s', '%s', GetCategoryID('%s'), '%s', '%s', '%s')",
            $name,
            $address,
            $category,
            $info,
            $altitude,
            $longtitude);

        return $db->exec($query) != 0 ? true : false;
    }
}