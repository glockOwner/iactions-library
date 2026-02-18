<?php include 'views/layouts/header.php' ?>
    <!-- Основной контент -->
    <main class="flex-fill" style="padding-top: 7rem; margin-bottom: 3rem;">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Поиск книги</h5>
                            <form id="searchForm" class="row g-3 align-items-end" autocomplete="off">
                                <div class="col-md-6">
                                    <label for="title" class="form-label">Название книги</label>
                                    <input type="text" name="title" class="form-control" id="title"
                                           placeholder="Введите название">
                                </div>
                                <div class="col-md-6">
                                    <label for="author" class="form-label">Автор</label>
                                    <select id="bookAuthor" class="form-select" name="author_id" required>
                                        <option value="0">Выберите автора</option>
                                        <?php foreach ($authors as $key => $author): ?>
                                            <option value="<?php echo $author->getId(); ?>"><?php echo $author->getName(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <button id="searchBtn" type="button" class="btn btn-primary">Поиск</button>
                                </div>
                            </form>
                            <div class="alert alert-danger mt-4 d-none" role="alert">
                                Для фильтрации заполните хотя бы одно из полей!
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm">
                        <div id="table-card-body" class="card-body">
                            <h6 class="card-title mb-3">Результаты поиска</h6>
                            <div class="table-responsive">
                                <table class="table table-striped table-sm" id="resultsTable">
                                    <thead>
                                    <tr>
                                        <th>Название</th>
                                        <th>Автор</th>
                                        <th>Кол-во читателей</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                                <div id="noResults" class="text-muted d-none">По вашему запросу ничего не найдено.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script src="/template/main.js"></script>

<!--        <div class="card-body d-flex justify-content-center">-->
<!--            <div class="spinner-border" role="status">-->
<!--                <span class="visually-hidden">Loading...</span>-->
<!--            </div>-->
<!--        </div>-->

<?php include 'views/layouts/footer.php' ?>