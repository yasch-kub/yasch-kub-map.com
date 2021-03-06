<?php
class place_model
{
    /**
     * @return array
     */
    public static function getAllPlace()
    {
        $db = Db::getConnection();
        $query = "SELECT place.id, place.name, place.address, category.name AS category, place.info, icon, longtitude, altitude, mark FROM place
            JOIN category ON place.category_id = category.id
            JOIN marker ON category.marker_id = marker.id WHERE place.is_posted = '1'";
        return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $category
     */
    public static function getPlaceIconByCategory($category)
    {
        $db = Db::getConnection();
        $query = sprintf("SELECT icon FROM category JOIN marker ON category.marker_id = marker.id AND category.name = '%s'", $category);
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
            $mark, $id, $_SESSION['login']);
        $db->exec($query);

        return self::getAverageRating($id);
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

    /**
     * @param $place_id
     * @return bool
     */
    public static function isUserRatePlace($place_id){
        $db = Db::getConnection();
        $query = sprintf("SELECT COUNT(*) as count FROM rating JOIN user ON user_id = user.id WHERE place_id = '%s' and user.login = '%s'",
            $place_id, $_SESSION['login']);
        $result = $db->query($query)->fetch(PDO::FETCH_ASSOC);
        return $result['count'] == '0' ? false : true;
    }

    /**
     * @return mixed
     */
    public static function getAddedPlaceId(){
        $db = Db::getConnection();
        $query = sprintf("SELECT MAX(place.id) as id FROM place");
        $result = $db->query($query)->fetch(PDO::FETCH_ASSOC);
        return $result['id'];
    }
}