<?php include 'views/layouts/header.php' ?>
    <!-- Основной контент -->
    <main class="container" style="padding-top: 4.5rem;"><h1 class="mb-4">Панель администратора</h1>
        <p class="lead">Здесь можно управлять книгами/авторами и редактировать запись.</p>
        <?php if ($_GET['isAuthorDeleted']): ?>
            <div class="alert alert-success" role="alert">
                Автор успешно удален
            </div>
        <?php endif; ?>

        <div class="container py-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mb-0">Авторы</h2>
                <a href="/admin/authors/create"><button class="btn btn-primary" id="btnAdd">Добавить автора</button></a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped align-middle" id="booksTable">
                    <thead class="table-light">
                    <tr>
                        <th>Имя автора</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($authors as $author): ?>
                        <tr>
                            <td><?php echo $author->getName(); ?></td>
                            <td>
                                <a href="/admin/authors/update/<?php echo $author->getId(); ?>"><button class="btn btn-sm btn-outline-primary me-1 btn-edit">Изменить</button></a>
                                <a href="/admin/authors/delete/<?php echo $author->getId(); ?>"><button class="btn btn-sm btn-outline-danger btn-delete">Удалить</button></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

<?php include 'views/layouts/footer.php' ?>