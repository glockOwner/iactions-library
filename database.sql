CREATE TABLE authors (
                         id SERIAL PRIMARY KEY,
                         name VARCHAR(255) NOT NULL,
                         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE books (
                       id SERIAL PRIMARY KEY,
                       title VARCHAR(255) NOT NULL,
                       /*rating REAL DEFAULT 0.00,*/
                       author_id INT NOT NULL REFERENCES authors(id) ON DELETE CASCADE,
                       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

/*ALTER TABLE books ADD CONSTRAINT check_rating_range CHECK (rating >= 0 AND rating <= 5);*/

CREATE TABLE readers (
                         id SERIAL PRIMARY KEY,
                         book_id INT NOT NULL REFERENCES books(id) ON DELETE CASCADE,
                         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE admins (
                        id SERIAL PRIMARY KEY,
                        username VARCHAR(100) UNIQUE NOT NULL,
                        password VARCHAR(255) NOT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Тестовый админ (пароль: password)
INSERT INTO admins (username, password)
VALUES ('admin', '$2y$10$9d7pE7zUIrDvxpQRGyguRu0ixfZi/f6.ZcJUnzEs7ucJ.yb5y/bOS');

-- Тестовый данные
INSERT INTO authors (name) VALUES ('Достоевский'), ('Пушкин');

INSERT INTO books (title, author_id) VALUES ('Преступление и наказание', 1), ('Тест 1', 1), ('Тест 2', 1), ('Тест 3', 1), ('Тест 4', 1), ('ДубровскийREA', 2) ;
