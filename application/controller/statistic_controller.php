<?php

class statistic_controller
{
    /**
     *
     */
    public static function action_view() {
        $places = statistic_model::getAllPlaceByCategory();
        $places = statistic_model::sort($places, 'name', true);

        include_once root . '/application/view/statistic_view.php';
    }

    /**
     *
     */
    public static function action_get_table() {
        $options = json_decode(file_get_contents("php://input"), true);
        $category = $options['category'];
        $field = $options['field'];
        $order = $options['order'];
        $places = statistic_model::getAllPlaceByCategory($category);
        $places = statistic_model::sort($places, $field, $order);
        include root . '/application/view/templates/statistic_table.php';
    }
}