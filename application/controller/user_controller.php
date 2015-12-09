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
        $comment['login'] = $_COOKIE['login'];
        $comment['date'] = date('jS \of F Y G:i:s');

        user_model::addComment($id, $comment['value'], $comment['date'], $comment['login']);
        include_once root . '/application/view/comment_view.php';
    }

    public static function action_login()
    {
        extract($_POST);
        user_model::login($login, $password);
    }

    public static function action_registration()
    {
        extract($_POST);
        $login = Validation::clear($login);
        $email = Validation::clear($email);
        user_model::registration($login, $password, $password_confirm, $email);
    }

    public static function action_logout()
    {
        setcookie("login", "", time()-3600, "/");
        setcookie("email", "", time()-3600, "/");
    }
}