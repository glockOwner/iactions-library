const formAlert = document.querySelector("div.alert.alert-danger");

const submitBtn = document.querySelector('#searchBtn');
submitBtn.onclick = function () {
    let bookTitle = document.querySelector("input[name='title']").value;
    let authorId = document.querySelector("select[name='author_id']").value;

    if (bookTitle.length === 0 && authorId === '0') {
        formAlert.classList.remove('d-none');
    } else {
        if (!formAlert.classList.contains('d-none')) {
            formAlert.classList.add('d-none');
        }
        const cardBody = document.querySelector('#table-card-body');
        cardBody.classList.add('d-flex', 'justify-content-center');
        cardBody.innerHTML = `<div class="card-body d-flex justify-content-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>`;

        const url = new URL('http://localhost:88/search');
        const params = authorId === '0' ? {title: bookTitle} : bookTitle.length === 0 ? {author_id: authorId} : {title: bookTitle, author_id: authorId};
        url.search = new URLSearchParams(params).toString();

        fetch(url)
            .then(response => {
                if (!response.ok) throw new Error('Ошибка сети');
                return response.json();
            })
            .then(data => {
                console.log(data);
                cardBody.classList.remove('d-flex', 'justify-content-center');
                cardBody.innerHTML = `<h6 class="card-title mb-3">Результаты поиска</h6>
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
                            </div>`;
                const tableBody = document.querySelector("table tbody");
                tableBody.innerHTML = '';
                data.forEach(function (book) {
                    let newRow = document.createElement('tr');
                    let newTitleColumn = document.createElement('td');
                    newTitleColumn.textContent = book['title'];
                    let newAuthorColumn = document.createElement('td');
                    newAuthorColumn.textContent = book['author']['name'];
                    let newQtyColumn = document.createElement('td');
                    newQtyColumn.textContent = Array.isArray(book['readers']) ? book['readers'].length : Object.keys(book['readers']).length;

                    newRow.append(newTitleColumn, newAuthorColumn, newQtyColumn);

                    tableBody.append(newRow);

                })
            })
            .catch(error => console.error("При отправке запроса возникла ошибка:", error));
    }
}