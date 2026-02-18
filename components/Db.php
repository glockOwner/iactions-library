<?php

class Db
{
    //Подключение к базе данных
    public static function getConnection(){
        $paramsPath = ROOT . '/config/db_params.php';
        $params = include($paramsPath);

        $dsn = "pgsql:host={$params['host']};port={$params['port']};dbname={$params['dbname']};user={$params['user']};password={$params['password']};";

        try {
            $db = new PDO($dsn, null, null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);/**/
        } catch (PDOException $exception) {
            die("DB error: " . $exception->getMessage());
        }

        return $db;
    }
}