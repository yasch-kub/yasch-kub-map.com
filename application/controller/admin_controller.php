<?php

class admin_controller
{
    /**
     *
     */
    public static function action_view() {
        if (user_model::isAdmin()) {
            include root . '/application/view/admin_view.php';
        }
        else
        {
            header("Location: " . '/');
        }
    }

    /**
     * @param $id
     */
    public static function action_add($id) {
        if (admin_model::postPlace($id))
            exit(json_encode(['status' => 'OK']));
        else
            exit(json_encode(['status' => 'FAIL', 'message' => 'Помилка при додаванні']));
    }

    /**
     * @param $id
     */
    public static function action_remove($id) {
        if (admin_model::removePlace($id))
            exit(json_encode(['status' => 'OK']));
        else
            exit(json_encode(['status' => 'FAIL', 'message' => 'Помилка при видаленні']));
    }

    /**
     *
     */
    public static function action_get_all_place_table() {
        include root . '/application/view/templates/admin_all_place_table.php';
    }

    /**
     *
     */
    public static function action_get_new_place_table() {
        include root . '/application/view/templates/admin_new_place_table.php';
    }

    /**
     *
     */
    public static function action_change_info() {
        $info = validation::clear($_POST['info']);
        $id = $_POST['id'];
        exit(admin_model::changePlaceInfoById($info, $id) ? 'Інформація оновлена' : 'Помилка при оновленні інформації');
    }
}