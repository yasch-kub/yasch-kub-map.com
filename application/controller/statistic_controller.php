<?php

class statistic_controller
{
    public static function action_view($category = 'Банк') {
        include_once root . '/application/view/statistic_view.php';
    }
}