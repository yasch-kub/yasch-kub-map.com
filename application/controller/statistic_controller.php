<?php

class statistic_controller
{
    public static function action_view() {
        $places = statistic_model::getAllPlaceByCategory();
        include_once root . '/application/view/statistic_view.php';
    }

    public static function action_get_table() {
        $category = file_get_contents("php://input");
        $places = statistic_model::getAllPlaceByCategory($category);

        include root . '/application/view/templates/statistic_table.php';
    }
}