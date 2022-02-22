USE test_db;

DROP TABLE IF EXISTS users;

CREATE TABLE users(
	id INT(6) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(100) NOT NULL,
    create_date DATE NOT NULL,
    is_admin BOOLEAN NOT NULL DEFAULT false,
    is_deleted BOOLEAN NOT NULL DEFAULT false
);

INSERT INTO users (name, email, password, create_date, is_admin, is_deleted)
VALUES ('Guilherme', 'gui@empresa.com', '$2y$10$/vC1UKrEJQUZLN2iM3U9re/4DQP74sXCOVXlYXe/j9zuv1/MHD4o.', '2021-1-1', 1, 0);

INSERT INTO users (name, email, password, create_date, is_admin, is_deleted)
VALUES ('Fulano', 'fulano@empresa.com', '$2y$10$/vC1UKrEJQUZLN2iM3U9re/4DQP74sXCOVXlYXe/j9zuv1/MHD4o.', '2020-1-1', 0, 0);