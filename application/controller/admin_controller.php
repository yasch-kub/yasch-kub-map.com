<?php

class admin_controller
{
    public static function action_view() {
        if (user_model::isAdmin()) {
            include root . '/application/view/admin_view.php';
        }
        else
        {
            header("Location: " . '/');
        }
    }

    public static function action_add($id) {
        if (admin_model::postPlace($id))
            exit(json_encode(['status' => 'OK']));
        else
            exit(json_encode(['status' => 'FAIL', 'message' => 'Помилка при додаванні']));
    }

    public static function action_remove($id) {
        if (admin_model::removePlace($id))
            exit(json_encode(['status' => 'OK']));
        else
            exit(json_encode(['status' => 'FAIL', 'message' => 'Помилка при видаленні']));
    }

    public static function all_place_table() {
        exit('allplace');
        include root . '/application/view/templates/admin_place_table.php';
    }

    public static function new_place_table() {
        exit('newplace');
        include root . '/application/view/templates/admin_new_place_table.php';
    }

    public static function n() {
        exit('newplace');
    }
}