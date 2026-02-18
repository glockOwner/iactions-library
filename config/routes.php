<?php
$arr = array(
    'index' => 'index/index', //actionIndex в IndexController
    'login' => 'auth/login',   //actionLogin в AuthController
    'logout' => 'auth/logout',   //actionLogin в AuthController
    'search' => 'index/search',   //actionSearch в IndexController
);
//Проверяем, авторизован ли пользователь
if ($_SESSION['is_auth'])
{
    $arr['admin/books/delete/([0-9]+)'] = 'admin/deleteBook/$1'; //actionDeleteBook в AdminController
    $arr['admin/books/update/([0-9]+)'] = 'admin/updateBook/$1'; //actionUpdateBook в AdminController
    $arr['admin/books/create'] = 'admin/createBook'; //actionCreateBook в AdminController
    $arr['admin/books'] = 'admin/index'; //actionIndex в AdminController
    $arr['admin/authors/delete/([0-9]+)'] = 'admin/deleteAuthor/$1'; //actionDeleteAuthor в AdminController
    $arr['admin/authors/update/([0-9]+)'] = 'admin/updateAuthor/$1'; //actionUpdateAuthor в AdminController
    $arr['admin/authors/create'] = 'admin/createAuthor'; //actionCreateAuthor в AdminController
    $arr['admin/authors'] = 'admin/authors'; //actionAuthors в AdminController
}
return $arr;
