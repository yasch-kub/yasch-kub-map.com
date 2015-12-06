<?php

class user_controller
{
    public static function action_show_details()
    {
        $id = file_get_contents("php://input");
        include_once root . '/application/view/detail_information_view.php';
    }

    public static function action_add_comment()
    {
        $id = $_POST['id'];
        $comment['value'] = Validation::clear($_POST['comment']);
        $comment['user_id'] = '1';
        $comment['date'] = date('jS \of F Y G:i:s');

        user_model::addComment($id, $comment['value'], $comment['date'], $comment['user_id']);
        include_once root . '/application/view/comment_view.php';
    }

}