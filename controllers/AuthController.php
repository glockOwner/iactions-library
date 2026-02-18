<?php
include_once 'services/AuthService.php';

class AuthController
{
    public function actionLogin()
    {
        $login = '';
        $password = '';

        if ($_POST['auth'])
        {
            $errors = AuthService::login();
        }

        require_once ROOT . "/views/auth/login.php";

        return true;
    }

    //Удаляем данные о пользователе из сессии
    public function actionLogout()
    {
        AuthService::logout();

        header('Location: /');

        return true;
    }
}