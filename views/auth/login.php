<?php include 'views/layouts/header.php' ?>
    <!-- Контент -->
    <main class="container" style="padding-top: 7rem; margin-bottom: 3rem;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card shadow-sm">
                        <div class="card-body"><h5 class="card-title mb-4 text-center">Авторизация администратора</h5>
                            <form id="loginForm" method="POST" novalidate>
                                <div class="mb-3"><label for="username" class="form-label">Имя пользователя</label>
                                    <input
                                            type="text" class="form-control" name="login" id="username" placeholder="admin" required>
                                    <div class="invalid-feedback">Пожалуйста, введите username.</div>
                                </div>
                                <div class="mb-3"><label for="password" class="form-label">Пароль</label> <input
                                            type="password" class="form-control" name="password" id="password" placeholder="••••••••"
                                            required>
                                    <div class="invalid-feedback">Пожалуйста, введите пароль.</div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" name="auth" value="1" class="btn btn-primary">Войти</button>
                                </div>
                            </form>
                            <?php if ($errors): ?>
                                <?php foreach ($errors as $error): ?>
                                    <div id="loginError" class="alert alert-danger mt-3" role="alert">
                                        <?php echo $error?>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <hr class="my-4">
                            <p class="text-center mb-0 text-muted small"> В тестовом окружении можно использовать: логин
                                <strong>admin</strong>, пароль <strong>password</strong>. </p></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php include 'views/layouts/footer.php' ?>