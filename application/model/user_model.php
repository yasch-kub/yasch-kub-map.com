<?php

class user_model
{
    /**
     * @param $id
     * @param $comment
     * @param $date
     * @param $user
     */
    public static function addComment($id, $comment, $date, $user)
    {
        $db = Db::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            $stmt = $db->prepare("INSERT INTO comment(place_id, value, date, user_id) VALUES (:id, :comment, :date, (SELECT user.id FROM user WHERE login = :user))");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':comment', $comment);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':user', $user);
            $stmt->execute();
        } catch(PDOException $exception) {
            echo $exception;
        }
    }

    /**
     * @return bool
     */
    public static function isAdmin() {
        if(isset($_SESSION['login']))
        {
            $db = Db::getConnection();
            $query = sprintf("SELECT user_type.name FROM user JOIN user_type ON user.type = user_type.id AND user.login = '%s'", $_SESSION['login']);
            $result = $db->query($query)->fetch(PDO::FETCH_ASSOC);
            return $result['name'] == 'admin' ? true : false;
        }
        else
            return false;
    }

    /**
     * @param $id
     * @return array|Exception|PDOException
     */
    public static function getAllCommentsByPlaceID($id)
    {
        $db = Db::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            $stmt = $db->prepare("SELECT comment.value, date, login FROM comment JOIN place ON place.id = comment.place_id AND place.id = :id JOIN user ON user.id = user_id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $exception) {
            return $exception;
        }
    }

    /**
     * @param $login
     * @param $password
     * @param $passwordConfirm
     * @param $email
     * @return array
     */
    public static function registration($login, $password, $passwordConfirm, $email)
    {
        $error = array(
            'login' => self::isLoginExist($login) ? "Користувач з таким ім'ям вже існує.": 'OK',
            'email' => self::isEmailExist($email) ? 'Користувач з таким email вже існує.' : 'OK'
        );
        $error['login'] = self::checkName($login);
        $error['email'] = self::checkEmail($email);
        $error = array_merge($error, self::comparePasswords($password, $passwordConfirm));

        if ($error['login'] == 'OK'
            and $error['email'] == 'OK'
            and $error['password'] == 'OK'
            and $error['password_confirm'] == 'OK')
        {
            $error['answer'] = 'OK';
            self::saveUser($login, $password, $email);
            $error['loginvalue'] = $login;
            $_SESSION['login'] = $login;
            $_SESSION['email'] = $email;
        }

        return $error;
    }

    /**
     * @param $login
     * @param $password
     * @return array
     */
    public static function login($login, $password)
    {
        $db = Db::getConnection();
        $error = array();

        $sql = sprintf("SELECT password, email FROM user WHERE login = '%s'", $login);
        $stmt = $db -> query($sql);

        if ($stmt -> rowCount() == 0)
            $error['login'] = 'Невірний логін.';
        else
        {
            $user = $stmt -> fetch();
            $hash = $user['password'];

            if (password_verify($password, $hash))
            {
                $error['answer'] = 'OK';
                $error['loginvalue'] = $login;

                $_SESSION['login'] = $login;
                $_SESSION['email'] = $email;
            }
            else
                $error['password'] = 'Невірний пароль.';
        }

        return $error;
    }

    /**
     * @param $login
     * @param $password
     * @param $email
     */
    private function saveUser($login, $password, $email)
    {
        $db = Db::getConnection();
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = sprintf("INSERT INTO user(login, password, email) VALUES('%s', '%s', '%s')",
            $login,
            $password,
            $email);

        $db -> exec($sql);
    }

    /**
     * @param $login
     * @return bool
     */
    private function isLoginExist($login)
    {
        $db = Db::getConnection();

        $sql = sprintf("SELECT login FROM user WHERE login = '%s'", $login);

        if ($db -> query($sql) -> rowCount() == 0)
            return false;
        return true;
    }

    /**
     * @param $email
     * @return bool
     */
    private function isEmailExist($email)
    {
        $db = Db::getConnection();

        $sql = sprintf("SELECT login FROM user WHERE email = '%s'", $email);

        if ($db -> query($sql) -> rowCount() == 0)
            return false;
        return true;
    }

    /**
     * @param $password
     * @param $passwordConfirm
     * @return array
     */
    private function comparePasswords($password, $passwordConfirm)
    {
        $error = array();
        if (empty($password))
            $error['password'] = 'Пароль не може бути порожнім.';
        elseif ($password != $passwordConfirm)
            $error['password_confirm'] = 'Паролі не співпадають.';
        else
        {
            $error['password'] = 'OK';
            $error['password_confirm'] = 'OK';
        }

        return $error;
    }

    /**
     * @param $email
     * @return string
     */
    private function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL))
            return 'OK';
        return 'Невірний email.';
    }

    /**
     * @param $name
     * @return string
     */
    private function checkName($name)
    {
        if (!empty($name))
            return 'OK';
        return "Невірне ім'я.";
    }
}