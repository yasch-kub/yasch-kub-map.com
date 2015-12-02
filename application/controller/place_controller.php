<?php
class place_controller
{
    /**
     *
     */
    public static function action_put_markers()
    {
        $markers = place_model::getAllPlace();
        exit(json_encode($markers));
    }

    /**
     *
     */
    public static  function action_get_categories()
    {
        $categories = place_model::getCategories();
        exit(json_encode($categories));
    }

    /**
     *
     */
    public static function action_add_place()
    {
        $name = self::clear($_POST['name']);
        $address = self::clear($_POST['address']);
        $category = self::clear($_POST['category']);
        $info = self::clear($_POST['info']);
        $altitude = self::clear($_POST['altitude']);
        $longtitude = self::clear($_POST['longtitude']);

        if (place_model::addPlace($name, $address, $category, $info, $altitude, $longtitude))
        {
            $result = array(
                'name' => $name,
                'info' => $info,
                'longtitude' => $longtitude,
                'altitude' => $altitude,
                'icon' => place_model::getPlaceIconByCategory($category)
            );
        }

        exit(json_encode($result));
    }

    /**
     * @param $mark
     * @param $id
     */
    public static function action_add_rating($mark, $id){
        place_model::addRating($mark, $id);
        exit(place_model::getAverageRating($id));
    }

    /**
     * @param $value
     * @return string
     */
    private function clear($value)
    {
        return htmlspecialchars(strip_tags(trim($value)));
    }

}