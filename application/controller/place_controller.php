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

    public static function action_add_place()
    {
        var_dump($_POST);
        $name = self::clear($_POST['name']);
        $address = self::clear($_POST['address']);
        $category = self::clear($_POST['category']);
        $info = self::clear($_POST['info']);
        $altitude = self::clear($_POST['altitude']);
        $longtitude = self::clear($_POST['longtitude']);

        place_model::addPlace($name, $address, $category, $info, $altitude, $longtitude);
    }

    private function clear($value)
    {
        return htmlspecialchars(strip_tags(trim($value)));
    }

}