<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Библиотека — админ панель</title>  <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>  <!-- Хедер -->
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
        <div class="container"><a class="navbar-brand" href="/">Библиотека</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav"
                    aria-controls="adminNav" aria-expanded="false" aria-label="Переключить навигацию"><span
                    class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="adminNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if ($_SESSION['is_auth']): ?>
                        <li class="nav-item"><a class="nav-link <?php if (rtrim($_SERVER['REQUEST_URI'], '/') == '/admin/books'): ?> active <?php endif; ?>" href="/admin/books" aria-current="page">Редактирование книг</a></li>
                        <li class="nav-item"><a class="nav-link <?php if (rtrim($_SERVER['REQUEST_URI'], '/') == '/admin/authors'): ?> active <?php endif; ?>" href="/admin/authors" aria-current="page">Редактирование авторов</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/'): ?> active <?php endif; ?>" href="/">Поиск книги</a></li>
                </ul>
                <?php if ($_SESSION['is_auth']): ?>
                    <span class="badge navbar-text text-white" id="adminUser"><?php if ($_SESSION['user_login']): ?> <?php echo $_SESSION['user_login'] ?> <?php else:?>Администратор<?php endif; ?></span>
                    <a href="/logout"><button id="logoutBtn" class="btn btn-outline-light btn-sm ms-2">Выйти</button></a>
                <?php else: ?>
                    <a href="/login"><button id="loginBtn" class="btn btn-outline-light btn-sm ms-2">Войти</button></a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>
