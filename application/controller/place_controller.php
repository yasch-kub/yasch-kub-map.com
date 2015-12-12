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
        $name = Validation::clear($_POST['name']);
        $address = Validation::clear($_POST['address']);
        $category = Validation::clear($_POST['category']);
        $info = Validation::clear($_POST['info']);
        $altitude = Validation::clear($_POST['altitude']);
        $longtitude = Validation::clear($_POST['longtitude']);

        if (place_model::addPlace($name, $address, $category, $info, $altitude, $longtitude))
        {
            $result = array(
                'id' => place_model::getAddedPlaceId(),
                'name' => $name,
                'address' => address,
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
        if (!empty($_COOKIE['login'])){
            if (!place_model::isUserRatePlace($id)){
                place_model::addRating($mark, $id);
                exit(place_model::getAverageRating($id));
            }
            else
                exit("Ви вже проголосували");
        }
        else
            exit("Ви не війшли в акаунт");
    }
}