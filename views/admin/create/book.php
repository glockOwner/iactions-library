<?php include 'views/layouts/header.php'?>
<div class="container" style="margin-top: 10rem;">
    <section class="mb-4">
        <h3>Книги</h3>
        <form id="bookForm" method="POST">
            <div class="mb-2">
                <input id="bookTitle" value="" class="form-control" placeholder="Название" required name="book_name">
            </div>
            <div class="mb-2">
                <select id="bookAuthor" class="form-select" name="author" required>
                    <option value="0">Выберите автора</option>
                    <?php foreach ($authors as $key => $author): ?>
                        <option value="<?php echo $author->getId();?>"><?php echo $author->getName();?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button class="btn btn-primary" type="submit" name="create" value="1">Добавить книгу</button>
        </form>
        <div id="bookList" class="mt-2"></div>
        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php elseif(!$error && $result): ?>
            <div class="alert alert-success" role="alert">
                Книга была успешно добавлена
            </div>
        <?php endif; ?>
    </section>
</div>
<?php include 'views/layouts/footer.php'?>