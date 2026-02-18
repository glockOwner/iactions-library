<?php include 'views/layouts/header.php'?>
    <div class="container" style="margin-top: 10rem;">
        <section class="mb-4">
            <h3>Авторы</h3>
            <form id="authorForm" method="POST">
                <div class="mb-2">
                    <input id="authorName" value="<?php echo $author->getName();?>" class="form-control" placeholder="Название" required name="author_name">
                </div>
                <button class="btn btn-primary" type="submit" name="update" value="1">Обновить автора</button>
            </form>
            <?php if ($error): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php elseif(!$error && $result): ?>
                <div class="alert mt-2 alert-success" role="alert">
                    Автор успешно обновлен
                </div>
            <?php endif; ?>
        </section>
    </div>
<?php include 'views/layouts/footer.php'?>