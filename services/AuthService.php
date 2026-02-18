<?php

class AuthService
{
    public static function login()
    {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $errors = false;

        //Валидация пароля
        if (!static::checkPassword($password))
        {
            $errors[] = 'Пароль должен быть не менее 6-ти символов';
        }

        //Проверяем, существует ли пользователь
        $userId = static::checkAdminData($login, $password);

        if ($userId == false)
        {
            //Если данные неправильные, показываем ошибку
            $errors[] = 'Неправильные данные для входа';

        }
        else
        {
            //Если данные правильные, запоминаем пользователя в сессии
            static::auth($userId, $login);

            //Перенаправляем пользователя в Админ-панель
            header('Location: /admin/books');
        }

        return $errors;
    }

    public static function logout()
    {
        unset($_SESSION['user_login']);
        unset($_SESSION['is_auth']);
        unset($_SESSION['user']);
    }

    /**
     * Проверка длины пароля(должно быть больше 5-ти символов)
     */
    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Проверяем, существует ли в БД пользователь с
     * заданными логином и паролем
     */
    public static function checkAdminData($login, $password)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM admins WHERE username = :login';

        $result = $db->prepare($sql);
        $result->bindParam(':login', $login,PDO::PARAM_STR);
        $result->execute();

        $admin = $result->fetch();

        if ($admin && password_verify($password, $admin['password']))
        {
            return $admin['id'];
        }
        else
        {
            return false;
        }
    }

    /**
     *
     * Запоминаем пользователя в сессию
     *
     */
    public static function auth($userId, $login)
    {
        session_start();
        $_SESSION['user_login'] = $login;
        $_SESSION['is_auth'] = true;
        $_SESSION['user'] = $userId;
    }
}