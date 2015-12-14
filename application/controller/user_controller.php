<?php

class user_controller
{
    /**
     *
     */
    public static function action_show_details()
    {
        $id = file_get_contents("php://input");
        include_once root . '/application/view/detail_information_view.php';
    }

    /**
     *
     */
    public static function action_add_comment()
    {
        $id = $_POST['id'];
        $comment['value'] = Validation::clear($_POST['comment']);
        $comment['login'] = $_SESSION['login'];
        $comment['date'] = date('jS \of F Y G:i:s');

        user_model::addComment($id, $comment['value'], $comment['date'], $comment['login']);
        include_once root . '/application/view/comment_view.php';
    }

    /**
     *
     */
    public static function action_login()
    {

        extract($_POST);
        $result = user_model::login($login, $password);

        ob_start();
        include root . '/application/view/templates/header.php';
        $result['header'] = ob_get_clean();

        exit(json_encode($result));
    }

    /**
     *
     */
    public static function action_registration()
    {
        extract($_POST);
        $login = Validation::clear($login);
        $email = Validation::clear($email);
        $result = user_model::registration($login, $password, $password_confirm, $email);

        ob_start();
        include_once root . '/application/view/templates/header.php';
        $result['header'] = ob_get_clean();

        exit(json_encode($result));
    }

    /**
     *
     */
    public static function action_logout()
    {
        unset($_SESSION['login']);
        unset($_SESSION['email']);

        ob_start();
        include_once root . '/application/view/templates/header.php';
        $result['header'] = ob_get_clean();

        exit(json_encode($result));
    }
}