<?php
// FRONT CONTROLLER
// 1. ОБЩИЕ НАСТРОЙКИ
session_start();
ini_set('display_errors', 1);
error_reporting(1);

$parsedEnv = parse_ini_file('.env');
if ($parsedEnv) {
    $_ENV = array_merge($_ENV, parse_ini_file('.env'));
}
define('ROOT', dirname(__FILE__));
// 2. ПОДКЛЮЧЕНИЕ ФАЙЛОВ СИСТЕМЫ
require_once ROOT . '/components/Router.php';
require_once ROOT . '/components/Db.php';

// 3. ВЫЗОВ ROUTER
$router = new Router();
$router->run();