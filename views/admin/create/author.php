<?php include 'views/layouts/header.php'?>
    <div class="container" style="margin-top: 10rem;">
        <section class="mb-4">
            <h3>Авторы</h3>
            <form id="authorForm" method="POST">
                <div class="mb-2">
                    <input id="authorName" value="" class="form-control" placeholder="Имя автора" required name="author_name">
                </div>
                <button class="btn btn-primary" type="submit" name="create" value="1">Добавить автора</button>
            </form>
            <?php if ($error): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php elseif(!$error && $result): ?>
                <div class="alert mt-2 alert-success" role="alert">
                    Автор успешно добавлен
                </div>
            <?php endif; ?>
        </section>
    </div>
<?php include 'views/layouts/footer.php'?>