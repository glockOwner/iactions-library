<?php include 'views/layouts/header.php' ?>
    <!-- Основной контент -->
    <main class="container" style="padding-top: 4.5rem;"><h1 class="mb-4">Панель администратора</h1>
        <p class="lead">Здесь можно управлять книгами/авторами и редактировать запись.</p>
        <?php if ($_GET['isBookDeleted']): ?>
            <div class="alert alert-success" role="alert">
                Книга успешно удалена
            </div>
        <?php endif; ?>

        <div class="container py-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mb-0">Книги</h2>
                <a href="/admin/books/create"><button class="btn btn-primary" id="btnAdd">Добавить книгу</button></a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped align-middle" id="booksTable">
                    <thead class="table-light">
                    <tr>
                        <th>Название</th>
                        <th>Автор</th>
                        <th>Кол-во читателей</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td><?php echo $book->getTitle(); ?></td>
                            <td><?php echo ($book->getAuthor())->getName(); ?></td>
                            <td><?php echo count($book->getReaders()); ?></td>
                            <td>
                                <a href="/admin/books/update/<?php echo $book->getId(); ?>"><button class="btn btn-sm btn-outline-primary me-1 btn-edit">Изменить</button></a>
                                <a href="/admin/books/delete/<?php echo $book->getId(); ?>"><button class="btn btn-sm btn-outline-danger btn-delete">Удалить</button></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

<?php include 'views/layouts/footer.php' ?>