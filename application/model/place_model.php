<?php
class place_model
{
    /**
     * @return array
     */
    public static function getAllPlace()
    {
        $db = Db::getConnection();
        $query = 'select place.id, place.name, place.address, place.info, icon, longtitude, altitude, mark from place
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
        $query = 'SELECT name FROM category ORDER BY name';
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

    /**
     * @param $mark
     * @param $id
     */
    public static function addRating($mark, $id){
        $db = Db::getConnection();
        $query = sprintf("INSERT INTO rating(mark, place_id, user_id) VALUES('%s','%s', (SELECT user.id FROM user WHERE user.login = '%s'))",
            $mark, $id, $_COOKIE['login']);
        $db->exec($query);
        $query = sprintf("SELECT ROUND(AVG(mark) * 2, 0) / 2 AS mark FROM rating WHERE place_id = '%s'", $id);
        $result = $db->query($query)->fetch(PDO::FETCH_ASSOC);
        return $result['mark'];

    }

    /**
     * @param $id
     * @return mixed
     */
    public static function getAverageRating($id){
        $db = Db::getConnection();
        $query = sprintf("SELECT mark FROM place WHERE place.id = '%s'", $id);
        $result = $db->query($query)->fetch(PDO::FETCH_ASSOC);
        return $result['mark'];
    }

    public static function isUserRatePlace($place_id){
        $db = Db::getConnection();
        $query = sprintf("SELECT COUNT(*) as count FROM rating JOIN user ON user_id = user.id WHERE place_id = '%s' and user.login = '%s'",
            $place_id, $_COOKIE['login']);
        $result = $db->query($query)->fetch(PDO::FETCH_ASSOC);
        return $result['count'] == '0' ? false : true;
    }

    public static function getAddedPlaceId(){
        $db = Db::getConnection();
        $query = sprintf("SELECT MAX(place.id) as id FROM place ");
        $result = $db->query($query)->fetch(PDO::FETCH_ASSOC);
        return $result['id'];
    }
}