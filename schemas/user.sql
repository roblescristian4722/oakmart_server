CREATE TABLE user(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    username VARCHAR(150) NOT NULL,
    password VARCHAR(256) NOT NULL,
    email VARCHAR(256) UNIQUE NOT NULL,
    phone VARCHAR(15),
    PRIMARY KEY (id)
);
